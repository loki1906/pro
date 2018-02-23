package serviceBean;

import java.util.Date;
import java.util.List;

import javax.ejb.Stateless;
import javax.persistence.EntityManager;
import javax.persistence.NoResultException;
import javax.persistence.PersistenceContext;

import dto.PaliwoDTO;
import dto.SamochodDTO;
import entity.Osoba;
import entity.Paliwo;
import entity.Samochod;
import service.PaliwoService;

@Stateless
public class PaliwoServiceBean implements PaliwoService{

	@PersistenceContext
	private EntityManager em;


	@SuppressWarnings("unchecked")
	@Override
	public List<PaliwoDTO> pobierzPaliwaSamochodu(Long idAuta, Date dataOd, Date dataDo) {
		List<PaliwoDTO> lista;
		try{
			lista =  em.createQuery("SELECT new dto.PaliwoDTO(p.id, p.rodzPaliwa, p.iloscPaliwa, p.cenaZaLitr, p.dataTankowania, p.samochod.id, p.przebiegTankowania) FROM Paliwo p where (:idAuta is null or p.samochod.id = :idAuta) and p.dataTankowania BETWEEN :dataOd AND :dataDo ORDER BY p.dataTankowania")
			.setParameter("idAuta", idAuta)
			.setParameter("dataOd", dataOd)
			.setParameter("dataDo", dataDo)
			.getResultList();
		} catch( NoResultException e){
			lista = null;
		}
		
		return lista;
	}

	@Override
	public void zaktualizujDane(List<PaliwoDTO> doZapisu, List<PaliwoDTO> paliwaDoUsuniecia) {
		for (PaliwoDTO paliwo : doZapisu) {
			Paliwo p = new Paliwo();
			p.setId(paliwo.getId());
			p.setIloscPaliwa(paliwo.getIloscPaliwa());
			p.setCenaZaLitr(paliwo.getCenaZaLitr());
			p.setDataTankowania(paliwo.getDataTankowania());
			p.setRodzPaliwa(paliwo.getRodzPaliwa());
			p.setPrzebiegTankowania(paliwo.getPrzebiegTankowania());
			Samochod s = new Samochod();
			s.setId(paliwo.getSamochod().getId());
			if(paliwo.isCzyZapisacPrzebieg()){
//				s.setPrzebieg();
				int executeUpdate = em.createNativeQuery("update samochod set przebieg = :przebiegSam where id = :idSam")
				.setParameter("przebiegSam", paliwo.getSamochod().getPrzebieg())
				.setParameter("idSam", paliwo.getSamochod().getId())
				.executeUpdate();
			}
			p.setSamochod(s);
			
			em.merge(p);
		}
		if(paliwaDoUsuniecia != null && !paliwaDoUsuniecia.isEmpty()){
			for (PaliwoDTO usun : paliwaDoUsuniecia) {
				Paliwo find = em.find(Paliwo.class, usun.getId());
				em.remove(find);
			}			
		}
	}

	@Override
	public Long dajMaxId() {
		Long maxId = (Long) em.createQuery("SELECT max(p.id) FROM Paliwo p").getSingleResult();
		return maxId;
	}
	
}
