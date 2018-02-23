package dto;

import java.io.Serializable;

public class OsobaDTO implements Serializable {
	
	/**
	 * 
	 */
	private static final long serialVersionUID = -6844060306089737800L;
	private Long id;
	
	public OsobaDTO() {
	}
	
	public OsobaDTO (Long id){
		this.id = id;
	}

	public Long getId() {
		return id;
	}

	public void setId(Long id) {
		this.id = id;
	}
	
}
