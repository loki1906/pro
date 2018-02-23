package podstawa;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.Date;
import java.util.HashMap;
import java.util.LinkedList;
import java.util.List;
import java.util.Map;
import java.util.Random;

public class AlgorytmFA {
	
	// parametry poczatkowe
	GeneratorSwietlikow generator;
	double wspAbsorbcji;
	double maxAtracyjnosc;
	long czasObl;
	long czasStartu;
	int iloscSwietlikow;
	
	// parametry z generatora
	int[][] odleglosci;
	int[][] drogi;
	long[] koszty;
	long[] stareKoszty;
	
	Przesuwacz przesuwacz;
	Hamming hamming;
	
	private boolean czyRozproszenie;
	private Integer procentRozproszenia;
	private List<Integer> listaDoRozproszenia = new ArrayList<>();
	 
	public static long najlepszyKoszt;
	static boolean czyZarejestrowanoZmiane;
	static int najlepszyId ;
	static long sredniKoszt ;
	 
	static String wyjscie = "";
	
	public AlgorytmFA(double wspAbsorbcji, double maxAtracyjnosc, long czasObl, int iloscSwietlikow, List<Integer> listaWartZPliku, long czasStartu, 
						boolean czyPiecProcGeneruj, Integer ileProcent, boolean czyRozproszenie, Integer procentRozproszenia) {
		this.wspAbsorbcji = wspAbsorbcji;
		this.maxAtracyjnosc = maxAtracyjnosc;
		this.czasObl = czasObl;
		this.iloscSwietlikow = iloscSwietlikow;
		this.generator = new GeneratorSwietlikow(listaWartZPliku, iloscSwietlikow, czyPiecProcGeneruj, ileProcent);					
		this.czasStartu =czasStartu;
		this.hamming = new Hamming();
		this.przesuwacz = new Przesuwacz();
		this.czyRozproszenie = czyRozproszenie;
		this.procentRozproszenia = procentRozproszenia;
		sredniKoszt =0;
		najlepszyId = 0;
		najlepszyKoszt = Integer.MAX_VALUE;
	}
	
	public void przygotojSwietliki(){
		generator.generujSwietliki();
		odleglosci = generator.getOdleglosci();
		drogi = generator.getDrogi();
		koszty = generator.getKoszty();
		stareKoszty = koszty;
		wyswietlListe(koszty);
		
		
	}

	public String wykonajAlgorytm() throws FileNotFoundException{
		Random r = new Random();
		long czasStop = wyliczKiedyStop();
		int idNajlepszego = 0;
		int iteracja = 0;
		wyjscie = "";
		while(czasStop > System.currentTimeMillis() ){

			if(czyRozproszenie){
				generujListeDoRozproszenia(procentRozproszenia, koszty);				//i wyznacza x% najgorszych kosztów w danej iteracji				
			}
			for(int i = 0; i < iloscSwietlikow ; i++){
				for( int j = i; j < iloscSwietlikow; j++){
					if(i != j){
						if(czyRozproszenie && listaDoRozproszenia.contains(i)){						// mamy losowo przesun¹æ swietlika z listy wiec losujemy mu swietlika z naszych gotowych i przesuwamy 
							int nextInt = r.nextInt(iloscSwietlikow);
							przejscieSwietlika(nextInt, i, idNajlepszego);
						} else if (czyRozproszenie && listaDoRozproszenia.contains(j)){
							int nextInt = r.nextInt(iloscSwietlikow);
							przejscieSwietlika(nextInt, j, idNajlepszego);
						} else if(!listaDoRozproszenia.contains(j) || !listaDoRozproszenia.contains(i)){
							if(koszty[i] < koszty[j]){		// i lepsze od j
								
								przejscieSwietlika(i,j,idNajlepszego);
							} else if(koszty[i] > koszty[j]){ 	//  j lepsze od i
								
								przejscieSwietlika(j,i,idNajlepszego);
							} 
						}
					}
				}
			}
			iteracja++;

			wyliczSrPlusNajlepszy(koszty);
			long currentTimeMillis = System.currentTimeMillis();
			long czasCalosci = currentTimeMillis - czasStartu;
			if(czyZarejestrowanoZmiane){				
				wyjscie += najlepszyKoszt+","+sredniKoszt+","+czasCalosci/1000+","+iteracja+"\r\n";
				czyZarejestrowanoZmiane = false;
			}
		}
		wyswietlListe(koszty);
		wyswietlListeInt(drogi[najlepszyId]);

		long currentTimeMillis = System.currentTimeMillis();
		long czasCalosci = currentTimeMillis - czasStartu;
		wyjscie += "\r\n czas trwania: " + czasCalosci/1000;
		wyjscie += "\r\n iteracje: " + iteracja;

		return wyjscie;
	}

	private void przejscieSwietlika(int mniejszy, int wiekszy, int idNajlepszego) {
		Integer odlHamminga;
		odlHamminga = hamming.obliczOdleglosc(drogi[mniejszy], drogi[wiekszy]);	// mamy odleg³oœæ Hamminga i liste ró¿nic

		int odleglosc = (int) (maxAtracyjnosc * Math.pow(Math.E, -wspAbsorbcji * Math.pow(odlHamminga,2)) * odlHamminga); //mamy konkretn¹ odleg³oœæ
		int[][] rozniceZSasiadami = przesuwacz.sprawdzSasiada(hamming.getPktNiezgodne(), drogi[mniejszy]);		//pobieramy pkt ró¿ny i jego wczesniejszego s¹siada 
		int[] drogaGorszaPoprawiona = przesuwacz.przemiesc(odleglosc, rozniceZSasiadami, drogi[wiekszy]);		//przenosimy tyle ile wychodzi z odleg³oœci
		long kosztGorszego = generator.obliczJedenKoszt(drogaGorszaPoprawiona);				//obliczamy koszt przesuniêtego

		if(koszty[wiekszy]>kosztGorszego){
			drogi[wiekszy] = drogaGorszaPoprawiona;
			koszty[wiekszy] = kosztGorszego;			
		}
		if(najlepszyKoszt > koszty[mniejszy]){
			najlepszyKoszt = koszty[mniejszy];
			czyZarejestrowanoZmiane = true;
		} else if (najlepszyKoszt > koszty[wiekszy]){
			najlepszyKoszt = koszty[wiekszy];
			czyZarejestrowanoZmiane = true;
		}
	}

	private void generujListeDoRozproszenia(Integer procentRozproszenia2, long[] koszty2) {
		double iloscNajgorszych = koszty2.length * 0.01 * procentRozproszenia2;
		Map<Integer, Long> map = new HashMap<>();
		for (int i = 0; i < koszty2.length; i++) {
			map.put(i, koszty2[i]);
		}
		List<Map.Entry<Integer, Long>> list = new LinkedList<>(map.entrySet());
		Collections.sort(list, new Comparator<Map.Entry<Integer, Long>>() {
			@Override
			public int compare(Map.Entry<Integer, Long> o1, Map.Entry<Integer, Long> o2) {
				return (o1.getValue()).compareTo(o2.getValue());
			}
		});

		long najwiekszyKoszt = list.get(koszty2.length-1).getValue();
		
		int granicaKoszt = (int) Math.round((1-0.01*procentRozproszenia2) * najwiekszyKoszt);
		int granicaIlosc = (int) Math.round(koszty2.length - iloscNajgorszych);
		int licznikKoszt = 0;
		List<Integer> listaKoszt = new ArrayList<>();
		int licznikIlosc = 0;
		List<Integer> listaIlosc = new ArrayList<>();
		for(int a = 0; a < list.size(); a++){
			if(a >= granicaIlosc){
				listaIlosc.add(list.get(a).getKey());
				licznikIlosc++;
			}
			if(list.get(a).getValue() >= granicaKoszt){
				listaKoszt.add(list.get(a).getKey());
				licznikKoszt++;
			}
		}
		
		listaDoRozproszenia = listaIlosc ;//licznikIlosc>= licznikKoszt ? listaIlosc : listaKoszt;//

	}

	public long wyliczKiedyStop() {
		long miliSek = czasObl * 1000;
		long czasEnd = miliSek + czasStartu;
		System.out.println("czas startu= "+ czasStartu + " czas obliczania= " + miliSek + " czas stopu= " + czasEnd);
		return czasEnd;
	}
	
	public String przeliczMiliSek(long miliSek){
		long sek = miliSek%60000;
		long min = miliSek/60000;
		System.out.println("czas trwania algorytmu = " + min + ":" + sek);
		return "";
	}
	
	static public void wyswietlMacierz(int[][] macierz) {
		wyjscie += "---------- macierz \n";
		for (int x = 0; x < macierz.length; x++) {
			for (int y = 0; y < macierz[x].length; y++) {
				if (y % macierz[x].length == 0) {
					wyjscie += macierz[x][y];
				} else if (0 < y % macierz[x].length && y % macierz[x].length < macierz[x].length - 1) {
					wyjscie += "-" + (int) macierz[x][y];
				} else if (y % macierz[x].length == macierz[x].length - 1) {
					wyjscie += "-" + (int) macierz[x][y] + "\n";
				}
			}
		}
	}

	static public void wyswietlListe(long[] tab) {
		
		wyjscie += "----------  \n";
		for (int x = 0; x < tab.length; x++) {
			if (x % tab.length == 0) {
				wyjscie +=tab[x];
			} else if (0 < x % tab.length && x % tab.length < tab.length - 1) {
				wyjscie +="-" +  tab[x];
			} else if (x % tab.length == tab.length - 1) {
				wyjscie +="-" +  tab[x] + "\r\n";
			}
			
		}
		
	}
	
	static public void wyswietlListeInt(int[] tab) {
		
		wyjscie += "---------- lista \n";
		for (int x = 0; x < tab.length; x++) {
			if (x % tab.length == 0) {
				wyjscie +=tab[x];
			} else if (0 < x % tab.length && x % tab.length < tab.length - 1) {
				wyjscie +="-" +  tab[x];
			} else if (x % tab.length == tab.length - 1) {
				wyjscie +="-" +  tab[x] + "\r\n";
			}
			
		}
		
	}
	 
	static public void wyliczSrPlusNajlepszy(long[] koszty){
		
		long sumaKosztow =0;
		for (int x = 0; x < koszty.length; x++) {
//			if(koszty[x] < najlepszyKoszt){
//				najlepszyKoszt = koszty[x];
//				najlepszyId = x;
//			}
			sumaKosztow += koszty[x];
		}
		sredniKoszt = sumaKosztow/koszty.length;
	}
	
	public double obliczOdlegloscRij(int[] drogaI, int[] drogaJ){
		double sumaKwadratowOdleglosci = 0;
		for(int x = 0; x < drogaI.length; x++){
			int odlegloscMiedzyPkt = odleglosci[drogaI[x]][drogaJ[x]];
			sumaKwadratowOdleglosci += Math.pow(odlegloscMiedzyPkt, 2);
		}
		return  Math.sqrt(sumaKwadratowOdleglosci);
	}


	public void zapiszDoPliku(String doPliku, String nazwaPliku) throws FileNotFoundException{
		File plik = new File("C:\\"+nazwaPliku);
		PrintWriter zapis = new PrintWriter(plik);
	      zapis.print(doPliku);
	      zapis.close();
	}

	public static long getNajlepszyKoszt() {
		return najlepszyKoszt;
	}
}
