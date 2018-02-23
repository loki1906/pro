package service;

import java.util.List;

import javax.ejb.Remote;

import dto.PrzegladDTO;
import dto.SamochodDTO;

@Remote
public interface PrzegladyService {

	List<PrzegladDTO> pobierzPrzegladyOsoby(SamochodDTO samochodDTO);

	void zaktualizujDane(List<PrzegladDTO> doZapisu, List<PrzegladDTO> doUsuniecia);

	Long dajMaxId();
}
