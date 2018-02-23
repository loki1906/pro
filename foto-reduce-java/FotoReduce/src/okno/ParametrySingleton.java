package okno;

import java.io.File;

public class ParametrySingleton {
	private static ParametrySingleton instance = null;

	private String sciezkaPliku;
	private int procent;
	private File[] pliki;

	protected ParametrySingleton() {
	}

	public static ParametrySingleton getInstance() {
		if (instance == null) {
			instance = new ParametrySingleton();
		}
		return instance;
	}

	public String getSciezkaPliku() {
		return sciezkaPliku;
	}
	
	public void setSciezkaPliku(String sciezkaPliku) {
		this.sciezkaPliku = sciezkaPliku;
	}
	
	public int getProcent() {
		return procent;
	}
	
	public void setProcent(int procent) {
		this.procent = procent;
	}

	public File[] getPliki() {
		return pliki;
	}

	public void setPliki(File[] pliki) {
		this.pliki = pliki;
	}

}
