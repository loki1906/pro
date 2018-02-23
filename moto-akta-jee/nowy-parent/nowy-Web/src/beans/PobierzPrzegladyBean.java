package beans;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import javax.annotation.PostConstruct;
import javax.ejb.EJB;
import javax.faces.application.FacesMessage;
import javax.faces.bean.ManagedBean;
import javax.faces.bean.ManagedProperty;
import javax.faces.bean.ViewScoped;
import javax.faces.component.UIOutput;
import javax.faces.context.FacesContext;
import javax.faces.event.AjaxBehaviorEvent;

import org.primefaces.event.RowEditEvent;
import org.primefaces.event.SelectEvent;

import dto.PaliwoDTO;
import dto.PrzegladDTO;
import dto.SamochodDTO;
import service.PrzegladyService;

@ManagedBean
@ViewScoped
public class PobierzPrzegladyBean implements Serializable {

	private static final long serialVersionUID = 7575466033825172885L;
	
	@EJB
	PrzegladyService service;
	
	@ManagedProperty(value = "#{loginBean}")
	private LoginBean loginBean;
	
	private List<PrzegladDTO> przeglady = new ArrayList<>();
	private List<PrzegladDTO> zaznaczone;
	private List<PrzegladDTO> doUsuniecia = new ArrayList<>();
	private List<PrzegladDTO> doZapisu = new ArrayList<>();
	
	@PostConstruct
	public void init(){
		pobierzPrzeglady();
	}
	
	public String zapiszEdytowane(){
		service.zaktualizujDane(doZapisu, doUsuniecia);
		doZapisu = new ArrayList<>();
		doUsuniecia = new ArrayList<>();
		FacesMessage msg = new FacesMessage(FacesMessage.SEVERITY_INFO, "INFO", "Zapisano zmienione dane." );
		FacesContext.getCurrentInstance().addMessage(null, msg);
		pobierzPrzeglady();
		return "";
	}

	public void dodajPrzeglad(){
		Long dajMaxId = service.dajMaxId();
		PrzegladDTO p = new PrzegladDTO();
		p.setSamochodId(loginBean.getSamochodKontekstowy().getId());
		p.setId(++dajMaxId);
		przeglady.add(p);
		doZapisu.add(p);
	}
	
	public void usunPrzeglad(){
		if(zaznaczone != null){
			for(PrzegladDTO dto : zaznaczone){
				przeglady.remove(dto);
				doUsuniecia.add(dto);
			}
		}
	}
	
	public void onRowEdit(RowEditEvent event) {
		PrzegladDTO edytowany = (PrzegladDTO) event.getObject();
		if(edytowany.getDataPrzegladu() == null || edytowany.getDataWaznosci() == null){
	        FacesMessage msg = new FacesMessage("uzupe³nij pola", "");
	        FacesContext.getCurrentInstance().addMessage(null, msg);
		} else {
			if(doZapisu.isEmpty()){
				doZapisu.add(edytowany);
			} else {
				for(PrzegladDTO przegladDoZapisu : doZapisu){
					if(!edytowany.equals(przegladDoZapisu)){
						doZapisu.add(edytowany);
					}
				}
			}
		}
	}
	
	public void pobierzPrzeglady(){
		przeglady = service.pobierzPrzegladyOsoby(loginBean.getSamochodKontekstowy());
	}
	
	public LoginBean getLoginBean() {
		return loginBean;
	}

	public void setLoginBean(LoginBean loginBean) {
		this.loginBean = loginBean;
	}

	public List<PrzegladDTO> getPrzeglady() {
		return przeglady;
	}

	public void setPrzeglady(List<PrzegladDTO> przeglady) {
		this.przeglady = przeglady;
	}

	public List<PrzegladDTO> getZaznaczone() {
		return zaznaczone;
	}

	public void setZaznaczone(List<PrzegladDTO> zaznaczone) {
		this.zaznaczone = zaznaczone;
	}

	public List<PrzegladDTO> getDoUsuniecia() {
		return doUsuniecia;
	}

	public void setDoUsuniecia(List<PrzegladDTO> doUsuniecia) {
		this.doUsuniecia = doUsuniecia;
	}

	public List<PrzegladDTO> getDoZapisu() {
		return doZapisu;
	}

	public void setDoZapisu(List<PrzegladDTO> doZapisu) {
		this.doZapisu = doZapisu;
	}

}
