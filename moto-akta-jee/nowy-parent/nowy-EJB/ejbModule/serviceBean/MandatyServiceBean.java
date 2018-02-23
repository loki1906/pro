package serviceBean;

import java.util.List;

import javax.ejb.Stateless;
import javax.persistence.EntityManager;
import javax.persistence.PersistenceContext;

import dto.MandatDTO;
import dto.OsobaDTO;
import entity.Mandat;
import entity.Samochod;
import service.MandatyService;

@Stateless
public class MandatyServiceBean implements MandatyService{

	@PersistenceContext
	private EntityManager em;

	@SuppressWarnings("unchecked")
	@Override
	public List<MandatDTO> pobierzMandatyOsoby(OsobaDTO dto) {
		List<MandatDTO> lista = em.createQuery("SELECT new dto.MandatDTO(m.id, m.miasto, m.rodzajWykroczenia, m.dataOtrzymania, m.otrzymanePkt, m.kwota, m.samochod.id, "
				+ " concat(m.samochod.marka, '-', m.samochod.model, '-', m.samochod.rocznik) ) "
				+ " FROM Mandat m WHERE m.samochod.osoba.id = :osobaId ")
				.setParameter("osobaId", dto.getId())
				.getResultList();
		return lista;
	}

	@Override
	public void zaktualizujDane(List<MandatDTO> doZapisu, List<MandatDTO> doUsuniecia) {
		for (MandatDTO mandatDto : doZapisu) {
			Mandat m = new Mandat();
			m.setId(mandatDto.getId());
			m.setDataOtrzymania(mandatDto.getDataOtrzymania());
			m.setKwota(mandatDto.getKwota());
			m.setOtrzymanePkt(mandatDto.getOtrzymanePkt());
			m.setMiasto(mandatDto.getMiasto());
			m.setRodzajWykroczenia(mandatDto.getRodzajWykroczenia());
			Samochod s = new Samochod();
			s.setId(mandatDto.getSamochod().getId());
			m.setSamochod(s);
			em.merge(m);
		}
		
		if(doUsuniecia != null && !doUsuniecia.isEmpty()){
			for (MandatDTO usun : doUsuniecia) {
				Mandat find = em.find(Mandat.class, usun.getId());
				em.remove(find);
			}			
		}
	}

	@Override
	public Long dajMaxId() {
		Long maxId = (Long) em.createQuery("SELECT max(m.id) FROM Mandat m").getSingleResult();
		return maxId;
	}

}
