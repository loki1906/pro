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

import dto.MandatDTO;
import dto.PrzegladDTO;
import service.MandatyService;

@ManagedBean
@ViewScoped
public class PobierzMandatyBean implements Serializable {

	private static final long serialVersionUID = 7575466033825172885L;
	
	@EJB
	MandatyService service;
	
	@ManagedProperty(value = "#{loginBean}")
	private LoginBean loginBean;
	
	private List<MandatDTO> mandaty = new ArrayList<>();
	private List<MandatDTO> zaznaczone;
	private List<MandatDTO> doUsuniecia = new ArrayList<>();
	private List<MandatDTO> doZapisu = new ArrayList<>();
	
	@PostConstruct
	public void init(){
		pobierzMandaty();
	}
	
	public String zapiszEdytowane(){
		service.zaktualizujDane(doZapisu, doUsuniecia);
		doZapisu = new ArrayList<>();
		doUsuniecia = new ArrayList<>();
		FacesMessage msg = new FacesMessage(FacesMessage.SEVERITY_INFO, "INFO", "Zapisano zmienione dane." );
		FacesContext.getCurrentInstance().addMessage(null, msg);
		pobierzMandaty();
		return "";
	}
	
	public String pobierzMandaty(){
		mandaty = service.pobierzMandatyOsoby(loginBean.getOsoba());
		return "";
	}
	
	public void dodajMandat(){
		Long dajMaxId = service.dajMaxId();
		MandatDTO m = new MandatDTO();
		m.setSamochod(loginBean.getSamochodKontekstowy());
		m.setId(++dajMaxId);
		mandaty.add(m);
		doZapisu.add(m);
	}
	
	public void usunMandat(){
		if(zaznaczone != null){
			for(MandatDTO dto : zaznaczone){
				mandaty.remove(dto);
				doUsuniecia.add(dto);
			}
		}
	}
	
	public void onRowEdit(RowEditEvent event) {
		MandatDTO edytowany = (MandatDTO) event.getObject();
		if(edytowany.getDataOtrzymania() == null){
	        FacesMessage msg = new FacesMessage("uzupe³nij pola", "");
	        FacesContext.getCurrentInstance().addMessage(null, msg);
		} else {
			if(doZapisu.isEmpty()){
				doZapisu.add(edytowany);
			} else {
				for(MandatDTO przegladDoZapisu : doZapisu){
					if(!edytowany.equals(przegladDoZapisu)){
						doZapisu.add(edytowany);
					}
				}
			}
		}
	}
	
	public List<MandatDTO> getMandaty() {
		return mandaty;
	}

	public void setMandaty(List<MandatDTO> mandaty) {
		this.mandaty = mandaty;
	}
	
	public LoginBean getLoginBean() {
		return loginBean;
	}

	public void setLoginBean(LoginBean loginBean) {
		this.loginBean = loginBean;
	}

	public List<MandatDTO> getZaznaczone() {
		return zaznaczone;
	}

	public void setZaznaczone(List<MandatDTO> zaznaczone) {
		this.zaznaczone = zaznaczone;
	}

	public List<MandatDTO> getDoUsuniecia() {
		return doUsuniecia;
	}

	public void setDoUsuniecia(List<MandatDTO> doUsuniecia) {
		this.doUsuniecia = doUsuniecia;
	}

	public List<MandatDTO> getDoZapisu() {
		return doZapisu;
	}

	public void setDoZapisu(List<MandatDTO> doZapisu) {
		this.doZapisu = doZapisu;
	}

}
