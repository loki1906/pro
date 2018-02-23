package serviceBean;

import java.io.UnsupportedEncodingException;
import java.net.URLDecoder;
import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;
import java.util.List;

import javax.ejb.Stateless;
import javax.persistence.EntityManager;
import javax.persistence.PersistenceContext;

import dto.PrzegladDTO;
import dto.SamochodDTO;
import entity.Przeglad;
import entity.Samochod;
import service.PrzegladyService;

@Stateless
public class PrzegladyServiceBean implements PrzegladyService{

	@PersistenceContext
	private EntityManager em;
	
	@Override
	public void zaktualizujDane(List<PrzegladDTO> doZapisu, List<PrzegladDTO> doUsuniecia) {
		for (PrzegladDTO przegladDTO : doZapisu) {
			Przeglad p = new Przeglad();
			p.setId(przegladDTO.getId());
			p.setOpisStacji(przegladDTO.getOpisStacji());
			p.setDataPrzegladu(przegladDTO.getDataPrzegladu());
			p.setDataWaznosci(przegladDTO.getDataWaznosci());
			p.setUwagi(przegladDTO.getUwagi());
			Samochod s = new Samochod();
			s.setId(przegladDTO.getSamochodId());
			p.setSamochod(s);
			em.merge(p);
		}
		
		if(doUsuniecia != null && !doUsuniecia.isEmpty()){
			for (PrzegladDTO usun : doUsuniecia) {
				Przeglad find = em.find(Przeglad.class, usun.getId());
				em.remove(find);
			}			
		}
	}

	@SuppressWarnings("unchecked")
	@Override
	public List<PrzegladDTO> pobierzPrzegladyOsoby(SamochodDTO samochodDTO) {
		List<PrzegladDTO> result =  em.createQuery("Select new dto.PrzegladDTO(p.id, p.opisStacji, p.dataPrzegladu, p.dataWaznosci, p.uwagi, p.samochod.id) "
						+ "from Przeglad p where p.samochod.id = :idSamochod ")
				.setParameter("idSamochod", samochodDTO.getId()).getResultList();
		return result;
	}

	@Override
	public Long dajMaxId() {
		Long maxId = (Long) em.createQuery("SELECT max(p.id) FROM Przeglad p").getSingleResult();
		return maxId;
	}

}
