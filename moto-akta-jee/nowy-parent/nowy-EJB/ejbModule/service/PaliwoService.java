package service;

import java.util.Date;
import java.util.List;

import javax.ejb.Remote;

import dto.PaliwoDTO;
import dto.SamochodDTO;
import entity.Paliwo;

@Remote
public interface PaliwoService {

	public List<PaliwoDTO> pobierzPaliwaSamochodu(Long idAuta, Date dataOd, Date dataDo);

	public void zaktualizujDane(List<PaliwoDTO> paliwa, List<PaliwoDTO> paliwaDoUsuniecia);
	
	public Long dajMaxId();
}
