package service;

import java.util.List;

import javax.ejb.Remote;

import dto.MandatDTO;
import dto.OsobaDTO;

@Remote
public interface MandatyService {

	List<MandatDTO> pobierzMandatyOsoby(OsobaDTO dto);

	void zaktualizujDane(List<MandatDTO> doZapisu, List<MandatDTO> doUsuniecia);

	Long dajMaxId();
}
