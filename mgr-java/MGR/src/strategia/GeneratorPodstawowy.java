package strategia;

import java.util.ArrayList;
import java.util.Random;

public class GeneratorPodstawowy implements Generator {

	@Override
	public int[][] wygenerujDrogi(int[][] odleglosci,int iloscSwietlikow) {
		int[][] drogi = new int[iloscSwietlikow][odleglosci.length+1];
		ArrayList<Integer> lista = new ArrayList<>();

		for (int i = 0; i < iloscSwietlikow; i++) {
			int x = 0;
			while (x < odleglosci.length) {
				lista.add(x);
				x++;
			}
			for (int j = 0; j < odleglosci.length; j++) {
				int rand = 0;
				Random r = new Random();
				if (!(lista.size() == odleglosci.length)) { 
					rand = r.nextInt(lista.size());
				}
				Integer odwiedzonyPkt = lista.get(rand);
				lista.remove(rand);
				drogi[i][j] = odwiedzonyPkt;
			}
			drogi[i][odleglosci.length] = drogi[i][0];
		}
		return drogi;
	}

}
