package podstawa;

import java.io.File;
import java.io.FileNotFoundException;
import java.util.ArrayList;
import java.util.Scanner;

public class Plik {

	String nazwa;
	File plik;

	public Plik(File plik) {
		this.plik = plik;
	}

	public Scanner otworzPlik() {
		;
		Scanner scaner = null;

		try {
			scaner = new Scanner(plik);
		} catch (FileNotFoundException e) {
			System.out.println("Nie odnaleziono pliku");
			System.exit(1);
		}

		return scaner;
	}

	public boolean pobierzNazwe(String nextLine){
		boolean znalazlem = false;
		String[] split = nextLine.split(":");
		if(split[0].trim().equals("NAME")){
			nazwa = split[1].trim();
			znalazlem = true;
		}
		return znalazlem;
	}
	
	public ArrayList<Integer> przeczytajPlik() {
		boolean znalazl = false;
		Scanner scaner = otworzPlik();
		Integer licznikWierszy = 1;
		int wierszStartu = Integer.MAX_VALUE;
		ArrayList<Integer> listaWart = new ArrayList<Integer>();

		while (scaner.hasNextLine()) {
			String nextLine = scaner.nextLine();
			if(znalazl == false){
				znalazl = pobierzNazwe(nextLine);				
			}
			if (nextLine.trim().equals("NODE_COORD_SECTION")) {
				wierszStartu = licznikWierszy;
			}
			if (wierszStartu <= licznikWierszy) {
				while (scaner.hasNext()) {
					String next = scaner.next();
					if (next.trim().equals("EOF")) {
						continue;
					} else {
						try{
							if(next.indexOf(".")==-1){
								listaWart.add(new Integer(next));
							} else {
								listaWart.add(new Integer(next.substring(0, next.indexOf("."))));								
							}
						}catch(NumberFormatException e){
							System.out.println("Wczytano waroœæ tekstow¹ zamiast numerycznej");
							System.exit(1);
						}
					}
				}

			}
			licznikWierszy++;
		}
		return listaWart;
	}


	public String getNazwa() {
		return nazwa;
	}
	
}
