package podstawa;

import java.util.List;

import strategia.Generator;
import strategia.GeneratorXProcet;
import strategia.GeneratorPodstawowy;

public class GeneratorSwietlikow {
	List<Integer> listaZPliku;
	int iloscSwietlikow;
	boolean czyNormalnie;
	Generator generator;
	
	int[][] odleglosci ;
	int[][] drogi;
	long[] koszty;
	

	public GeneratorSwietlikow(List<Integer> listaZPliku, int iloscSwietlikow, boolean czyPiecProc, Integer ileProcent) {
		super();
		this.listaZPliku = listaZPliku;
		this.iloscSwietlikow = iloscSwietlikow;
		if(czyPiecProc){
			generator = new GeneratorXProcet(ileProcent);
		} else {
			generator = new GeneratorPodstawowy();
		}
	}
	
	public void generujSwietliki(){
		odleglosci = obliczOdleglosci();
		drogi = wygenerujDrogi(odleglosci);
		koszty = obliczKoszty(drogi);
	}

	// tworzenie macierzy i uzupe³nienie jej odleg³oœciami z pomiêdzy danych pkt
	public int[][] obliczOdleglosci() {
		int[][] wynikiTab = new int[listaZPliku.size() / 3][listaZPliku.size() / 3];
		for (int i = 0; i < listaZPliku.size() - 2; i++) {
			for (int j = 0; j < listaZPliku.size() - 2; j++) {
				if (i % 3 == 0 && j % 3 == 0) {
					if (!listaZPliku.get(i).equals(listaZPliku.get(j))) {

						int xd = (int) Math.pow(listaZPliku.get(i + 1) - listaZPliku.get(j + 1), 2); // xi-xj^2
						int yd = (int) Math.pow(listaZPliku.get(i + 2) - listaZPliku.get(j + 2), 2); // yi-yj^2
						int dij = (int) Math.sqrt(xd + yd); // sqrt(xd^2 + yd^2)
						wynikiTab[i / 3][j / 3] = Math.round(dij);
					}
				}
			}
		}

		return wynikiTab;
	}
	
	// 
	public int[][] wygenerujDrogi(int[][] odleglosci) {
		drogi = generator.wygenerujDrogi(odleglosci, iloscSwietlikow);
		return drogi;
	}

	public long[] obliczKoszty(int[][] drogi) {
		long[] koszty = new long[iloscSwietlikow];
		
		for (int i = 0; i < iloscSwietlikow; i++) {
			long sumaSwietlika = obliczJedenKoszt(drogi[i]);
			koszty[i]=sumaSwietlika;
		}
		return koszty;
	}
	
	public long obliczJedenKoszt(int[] droga){
		long sumaSwietlika=0;
		for (int j = 0; j < droga.length-1; j++) {
			int akt = droga[j];
			int next = droga[j+1];
			sumaSwietlika += odleglosci[akt][next];
			
		}
		return sumaSwietlika;
	}

	public int getIloscSwietlikow() {
		return iloscSwietlikow;
	}

	public void setIloscSwietlikow(int iloscSwietlikow) {
		this.iloscSwietlikow = iloscSwietlikow;
	}


	public List<Integer> getListaZPliku() {
		return listaZPliku;
	}

	public void setListaZPliku(List<Integer> listaZPliku) {
		this.listaZPliku = listaZPliku;
	}
	
	public int[][] getOdleglosci() {
		return odleglosci;
	}

	public void setOdleglosci(int[][] odleglosci) {
		this.odleglosci = odleglosci;
	}

	public int[][] getDrogi() {
		return drogi;
	}

	public void setDrogi(int[][] drogi) {
		this.drogi = drogi;
	}

	public long[] getKoszty() {
		return koszty;
	}

	public void setKoszty(long[] koszty) {
		this.koszty = koszty;
	}

}
