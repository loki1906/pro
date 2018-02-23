package dto;

import java.io.Serializable;

public class SamochodDTO implements Serializable {

	/**
	 * 
	 */
	private static final long serialVersionUID = 8405834911143597983L;
	private Long id;
	private String nazwa;
	private Long przebieg;
	
	public SamochodDTO() {
	}
	
	public SamochodDTO(Long id){
		this.id = id;
	}
	
	public SamochodDTO(Long id, String nazwa){
		this.id = id;
		this.nazwa = nazwa;
	}
	
	public SamochodDTO(Long id, String nazwa, Long przebieg){
		this.id = id;
		this.nazwa = nazwa;
		this.przebieg = przebieg;
	}
	
	public Long getId() {
		return id;
	}
	public void setId(Long id) {
		this.id = id;
	}
	public String getNazwa() {
		return nazwa;
	}
	public void setNazwa(String nazwa) {
		this.nazwa = nazwa;
	}

	public Long getPrzebieg() {
		return przebieg;
	}

	public void setPrzebieg(Long przebieg) {
		this.przebieg = przebieg;
	}
	
}
