package strategia;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.Random;

public class GeneratorXProcet implements Generator {

	private Integer ileProcent;
	
	public GeneratorXProcet(Integer ileProcent) {
		this.ileProcent = ileProcent;
	}
	
	@Override
	public int[][] wygenerujDrogi(int[][] odleglosci,int iloscSwietlikow) {
		double piecProcent = odleglosci.length * 0.01 * ileProcent;
		int[][] drogi = new int[iloscSwietlikow][odleglosci.length+1];
		ArrayList<Integer> lista = new ArrayList<>();
		Random r = new Random();
		int rand = 0;
		for (int i = 0; i < iloscSwietlikow; i++) {
			int x = 0;
			while (x < odleglosci.length) {		
				lista.add(x);
				x++;
			}
			for (int j = 0; j < odleglosci[0].length; j++) {
				if (j<=piecProcent){
					if(j == 0){
					rand = r.nextInt(lista.size());
					Integer odwiedzonyPkt = lista.get(rand);
					lista.remove(rand);
					
						drogi[i][j] = odwiedzonyPkt;		//wylosowany pierwszy pkt
					} else {
						int minKoszt = Integer.MAX_VALUE; 
						int idMinKoszt = 0;
						for(Integer in : lista){
							int l = drogi[i][j-1];
							int k = odleglosci[l][in];
							if(minKoszt > k && k!=0){
								minKoszt = k;
								idMinKoszt = in;						
							}
						}
						drogi[i][j] = idMinKoszt;
						Iterator<Integer> it = lista.iterator();
						while(it.hasNext()){
							if(it.next()==idMinKoszt){
								it.remove();
							}
						}
					}
				} else {
					rand = r.nextInt(lista.size());
					Integer odwiedzonyPkt = lista.get(rand);
					lista.remove(rand);
					drogi[i][j] = odwiedzonyPkt;
				}
			}
			drogi[i][odleglosci.length] = drogi[i][0];
		}
		return drogi;
	}

	public Integer getIleProcent() {
		return ileProcent;
	}

}
