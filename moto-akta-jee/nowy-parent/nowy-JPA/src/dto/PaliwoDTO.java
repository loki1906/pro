package dto;

import java.io.Serializable;
import java.util.Date;

public class PaliwoDTO implements Serializable{

	
	private static final long serialVersionUID = -7368849511774017146L;
	
	private Long id;
	private String rodzPaliwa;
	private double iloscPaliwa;
	private double cenaZaLitr;
	private Date dataTankowania;
	private SamochodDTO samochod;
	private Long przebiegTankowania;
	private boolean czyZapisacPrzebieg = false;
	
	public PaliwoDTO() {
	}
	
	public PaliwoDTO(Long id, String rodzPaliwa, double iloscPaliwa, double cenaZaLitr, Date dataTankowania,
			Long samochodId, Long przebiegTankowania) {
		super();
		this.id = id;
		this.rodzPaliwa = rodzPaliwa;
		this.iloscPaliwa = iloscPaliwa;
		this.cenaZaLitr = cenaZaLitr;
		this.dataTankowania = dataTankowania;
		this.samochod = new SamochodDTO(samochodId);
		this.przebiegTankowania = przebiegTankowania;
	}



	public Long getId() {
		return id;
	}
	public void setId(Long id) {
		this.id = id;
	}
	public String getRodzPaliwa() {
		return rodzPaliwa;
	}
	public void setRodzPaliwa(String rodzPaliwa) {
		this.rodzPaliwa = rodzPaliwa;
	}
	public double getIloscPaliwa() {
		return iloscPaliwa;
	}
	public void setIloscPaliwa(double iloscPaliwa) {
		this.iloscPaliwa = iloscPaliwa;
	}
	public double getCenaZaLitr() {
		return cenaZaLitr;
	}
	public void setCenaZaLitr(double cenaZaLitr) {
		this.cenaZaLitr = cenaZaLitr;
	}
	public Date getDataTankowania() {
		return dataTankowania;
	}
	public void setDataTankowania(Date dataTankowania) {
		this.dataTankowania = dataTankowania;
	}
	public SamochodDTO getSamochod() {
		return samochod;
	}
	public void setSamochod(SamochodDTO samochod) {
		this.samochod = samochod;
	}
	public Long getPrzebiegTankowania() {
		return przebiegTankowania;
	}
	public void setPrzebiegTankowania(Long przebiegTankowania) {
		this.przebiegTankowania = przebiegTankowania;
	}

	public boolean isCzyZapisacPrzebieg() {
		return czyZapisacPrzebieg;
	}

	public void setCzyZapisacPrzebieg(boolean czyZapisacPrzebieg) {
		this.czyZapisacPrzebieg = czyZapisacPrzebieg;
	}

}
