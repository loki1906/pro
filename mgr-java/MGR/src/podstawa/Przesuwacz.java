package podstawa;

import java.util.Random;

public class Przesuwacz {
	
	public Przesuwacz() {
	}

	public int[][] sprawdzSasiada(int[] tabRoznic, int[] drogaLepsza) {
		int[][] tabSasiadRoznica = new int[tabRoznic.length][2];

		for (int b = 0; b < tabRoznic.length; b++) {
			int minus = tabRoznic[b] - 1;
			if(minus>0){
				tabSasiadRoznica[b][0] = drogaLepsza[minus];
				tabSasiadRoznica[b][1] = drogaLepsza[tabRoznic[b]];
			}
		}
		return tabSasiadRoznica;

	}

	public int[] przemiesc(int iloscPrzesuniec, int[][] tabSasiadRoznica, int[] drogaGorsza) {
		int nextInt=0;
		Random rand = new Random();
		if(tabSasiadRoznica.length-iloscPrzesuniec>0){
			nextInt = rand.nextInt(tabSasiadRoznica.length-iloscPrzesuniec);
		}
		
		for(int a = nextInt; a < iloscPrzesuniec+nextInt; a++) {
			int[] para = tabSasiadRoznica[a];
			int idDocelowe = 0;
			int idstartowe = 0;
			for (int krok = 0; krok < drogaGorsza.length; krok++) {
				
				if(para[0] == drogaGorsza[krok]){
					idDocelowe = krok;
				} else if( para[1] == drogaGorsza[krok]){
					idstartowe = krok;
				}
			}
			if(!(idDocelowe==drogaGorsza.length) && idDocelowe!=0 && idstartowe!=0 && idDocelowe!=drogaGorsza.length-1 && idstartowe!=drogaGorsza.length-1){
				int przesowany = drogaGorsza[idstartowe];
				if(idstartowe>idDocelowe){
					przesunListeWGore(drogaGorsza, idstartowe, idDocelowe);
				} else {
					przesunListeWDol(drogaGorsza, idstartowe, idDocelowe);
				}
				drogaGorsza[idDocelowe] = przesowany;				
			}
			
		}
		return drogaGorsza;
	}

	private void przesunListeWGore(int[] drogaGorszego,int start, int docelowe) {
		for(int i = start; i > docelowe; i--){
			drogaGorszego[i] = drogaGorszego[i-1];
		}
	}
	private void przesunListeWDol(int[] drogaGorszego,int start, int docelowe) {
		for(int i = start; i < docelowe; i++){
			drogaGorszego[i] = drogaGorszego[i+1];
		}
	}
		
}
