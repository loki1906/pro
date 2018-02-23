package podstawa;

public class Hamming {
	
	private int[] pktNiezgodne;
	
	public Hamming() {
	}
	
	public int obliczOdleglosc(int[] akt, int[] next){
		int odleglosc = 0;
		for(int i = 0; i < akt.length; i++){
			if(akt[i] != next[i]){
				odleglosc++;
			}
		}
		wyznaczPktNiezgodne(akt,next,odleglosc);
		return odleglosc;
	}
	
	public int[] wyznaczPktNiezgodne(int[] lepszy, int[] gorszy, int odleglosc){
		pktNiezgodne = new int[odleglosc];
		int licznik = 0;
		for(int i = 0; i < lepszy.length; i++){
			if(lepszy[i] != gorszy[i]){
				pktNiezgodne[licznik] = i;
				licznik++;
			}
		}
		return pktNiezgodne;
	}
	
	public int[] getPktNiezgodne() {
		return pktNiezgodne;
	}
}
