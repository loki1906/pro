package beans;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import javax.annotation.PostConstruct;
import javax.ejb.EJB;
import javax.faces.application.FacesMessage;
import javax.faces.bean.ManagedBean;
import javax.faces.bean.ManagedProperty;
import javax.faces.bean.ViewScoped;
import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;

import org.primefaces.component.tabview.Tab;
import org.primefaces.component.tabview.TabView;
import org.primefaces.event.RowEditEvent;
import org.primefaces.event.SelectEvent;
import org.primefaces.event.TabChangeEvent;
import org.primefaces.model.chart.Axis;
import org.primefaces.model.chart.AxisType;
import org.primefaces.model.chart.LineChartModel;
import org.primefaces.model.chart.LineChartSeries;

import dto.PaliwoDTO;
import dto.SamochodDTO;
import entity.Paliwo;
import entity.Samochod;
import service.PaliwoService;

@ViewScoped
@ManagedBean
public class PobierzPaliwoBean implements Serializable{

	private static final long serialVersionUID = -3762506811437530855L;

	@EJB
	PaliwoService paliwoService;

	private Date dataOd;
	private Date dataDo;
	private List<PaliwoDTO> paliwa = new ArrayList<>();
	private List<PaliwoDTO> paliwaDoUsuniecia = new ArrayList<>();
	private List<PaliwoDTO> paliwaDoZapisania = new ArrayList<>();
	private List<PaliwoDTO> paliwaFiltrowane;
	private List<String> rodzajePaliwa = Arrays.asList("Pb 95","Pb 98","ON","LPG");

	private LineChartModel modelChart = new LineChartModel();
	private LineChartSeries s1 = new LineChartSeries();
	private Map<Object, Number> dane = new HashMap<>();
	
	private Paliwo zaznaczony;
	private List<PaliwoDTO> zaznaczone;
	
	@ManagedProperty(value = "#{loginBean}")
	private LoginBean loginBean;
	
	String text = "a";
	
	@PostConstruct
	public void init(){
		Calendar c = Calendar.getInstance();   // this takes current date
	    c.set(Calendar.DAY_OF_YEAR, 1);
	    dataOd = c.getTime();
	    
	    Calendar cal = Calendar.getInstance();
	    cal.set(Calendar.DATE, cal.getActualMaximum(Calendar.DATE));
	    dataDo = cal.getTime();
	    
	    modelChart.setTitle("Wachania cen paliwa");
		modelChart.setLegendPosition("e");
		Axis yAxis = modelChart.getAxis(AxisType.Y);
        Axis xAxis = modelChart.getAxis(AxisType.X);
        
        xAxis.setMin(1);
        xAxis.setMax(31);
        xAxis.setTickInterval("1");
        xAxis.setLabel("Dni miesi¹ca");
        yAxis.setMin(1);
        yAxis.setMax(6);
        yAxis.setLabel("Cena [z³/l]");
        pobierzPaliwaOsoby();
        s1 = new LineChartSeries(" ");
        s1.setData(dane);
        dane.put(0, 0);
        modelChart.addSeries(s1);
//	    pobierzDaneDlaWykresuAJAX();
        
        
        // TODO: zmieniac dane w serii map¹ moze uda sie nie dodawac nowych serii..
	}
	
	public String pobierzPaliwaOsoby(){
		if(getDataOd()== null || getDataDo() ==null){
			FacesMessage msg = new FacesMessage(FacesMessage.SEVERITY_WARN, "UWAGA!", "Proszê uzupelniæ daty filtruj¹ce." );
			FacesContext.getCurrentInstance().addMessage(null, msg);
			return "";
		}
		List<PaliwoDTO> pobierzPaliwaOsoby = paliwoService.pobierzPaliwaSamochodu(loginBean.getSamochodKontekstowy()!=null?loginBean.getSamochodKontekstowy().getId():null, dataOd, dataDo);
		setPaliwa(pobierzPaliwaOsoby);
		setRodzajePaliwa(Arrays.asList("Pb 95","Pb 98","ON","LPG"));
//		pobierzDaneDlaWykresu();
		return "";
	}
	
	public String zapiszEdytowane(){
		paliwoService.zaktualizujDane(paliwaDoZapisania, paliwaDoUsuniecia);
		paliwaDoUsuniecia = new ArrayList<>();
		paliwaDoZapisania = new ArrayList<>();
		FacesMessage msg = new FacesMessage(FacesMessage.SEVERITY_INFO, "INFO", "Zapisano zmienione dane." );
		FacesContext.getCurrentInstance().addMessage(null, msg);
		pobierzPaliwaOsoby();
		return "";
	}

	public String pobierzDaneDlaWykresu(){
		
		modelChart = initLinearModel();
		modelChart.setTitle("Wachania cen paliwa");
		modelChart.setLegendPosition("e");
        Axis yAxis = modelChart.getAxis(AxisType.Y);
        Axis xAxis = modelChart.getAxis(AxisType.X);
        
        xAxis.setMin(1);
        xAxis.setMax(31);
        xAxis.setTickInterval("1");
        xAxis.setLabel("Dni miesi¹ca");
        yAxis.setMin(1);
        yAxis.setMax(6);
        yAxis.setLabel("Cena [z³/l]");
        
        return"";
	}

	public void pobierzDaneDlaWykresuAJAX(){
		s1.setLabel("cena za litr");
		dane.clear();
		for(PaliwoDTO p : paliwa) {
			if(p.getRodzPaliwa().equals("LPG")){
				Calendar cal = Calendar.getInstance();
				cal.setTime(p.getDataTankowania());
				dane.put(cal.get(Calendar.DAY_OF_MONTH)-1, p.getCenaZaLitr());
			}
		}
	}

	private LineChartSeries initSeriesModel() {
//		modelChart.
		LineChartSeries s1 = new LineChartSeries("Cena All");
		String aaa= "";
		for(PaliwoDTO p : paliwa) {
//			if(p.getRodzPaliwa().equals("LPG"))
			Calendar cal = Calendar.getInstance();
			cal.setTime(p.getDataTankowania());
			s1.set(cal.get(Calendar.DAY_OF_MONTH)-1, p.getCenaZaLitr());
			aaa += p.getCenaZaLitr() + ";";
		}
		setText(aaa);
//		s1.setXaxis(AxisType.X);
//		s1.setYaxis(AxisType.Y);
		return s1;
	}
	
	private LineChartModel initLinearModel() {
		LineChartModel model = new LineChartModel();
		LineChartSeries s1 = new LineChartSeries("Cena All");
		String aaa= "";
//		for(Paliwo p : paliwa) {
//			if(p.getRodzPaliwa().equals("LPG"))
//			Calendar cal = Calendar.getInstance();
//			cal.setTime(p.getDataTankowania());
//			s1.set(cal.get(Calendar.DAY_OF_MONTH)-1, p.getCenaZaLitr());
//			aaa += p.getCenaZaLitr() + ";";
//		}
		s1.set(1, 1);
		s1.set(2, 2);
		setText(aaa);
		model.addSeries(s1);
		return model;
	}

	public void dodajPaliwo(){
		Long dajMaxId = paliwoService.dajMaxId();
		PaliwoDTO p = new PaliwoDTO();
		SamochodDTO s = loginBean.getSamochodKontekstowy();
		p.setSamochod(s);
		p.setId(++dajMaxId);
		paliwa.add(p);
		paliwaDoZapisania.add(p);
	}
	
	public void usunPaliwo(){
		if(zaznaczone != null){
			for (PaliwoDTO paliwo : zaznaczone) {
				paliwa.remove(paliwo);
				if(paliwaFiltrowane !=null){
					paliwaFiltrowane.remove(paliwo);					
				}
				paliwaDoUsuniecia.add(paliwo);
			}						
		}
	}
	
	public void onTabChange(TabChangeEvent event) {
		if(!paliwaDoZapisania.isEmpty() || !paliwaDoUsuniecia.isEmpty()){
			FacesMessage msg = new FacesMessage("Uwaga", "Zosta³y niezapisane zmiany...");			
			FacesContext.getCurrentInstance().addMessage(null, msg);
		}
    }
	
	public void onRowEdit(RowEditEvent event) {
		PaliwoDTO paliwo = (PaliwoDTO) event.getObject();
		if(paliwo.getRodzPaliwa() == null || paliwo.getDataTankowania() == null){
	        FacesMessage msg = new FacesMessage("uzupe³nij pola", "");
	        FacesContext.getCurrentInstance().addMessage(null, msg);
		} else {
			if(paliwo.getPrzebiegTankowania() > loginBean.getSamochodKontekstowy().getPrzebieg()){
				loginBean.getSamochodKontekstowy().setPrzebieg(paliwo.getPrzebiegTankowania());
				paliwo.setCzyZapisacPrzebieg(true);
				paliwo.setSamochod(loginBean.getSamochodKontekstowy());
			}
			if(paliwaDoZapisania.isEmpty()){
				paliwaDoZapisania.add(paliwo);
			} else {
				for(PaliwoDTO pal : paliwaDoZapisania){
					if(!paliwo.equals(pal)){					
						paliwaDoZapisania.add(paliwo);
					}
				}				
			}
			FacesMessage msg = new FacesMessage("ok", "");
			FacesContext.getCurrentInstance().addMessage(null, msg);
			
		}
    }
	
	public void updateDataOd(SelectEvent event){
		setDataOd((Date) event.getObject());
		pobierzPaliwaOsoby();
	}
	
	public void updateDataDo(SelectEvent event){
		setDataDo((Date) event.getObject());
		pobierzPaliwaOsoby();
	}
	
	public LoginBean getLoginBean() {
		return loginBean;
	}

	public void setLoginBean(LoginBean loginBean) {
		this.loginBean = loginBean;
	}

	public List<PaliwoDTO> getPaliwa() {
		return paliwa;
	}

	public void setPaliwa(List<PaliwoDTO> paliwa) {
		this.paliwa = paliwa;
	}

	public List<PaliwoDTO> getPaliwaFiltrowane() {
		return paliwaFiltrowane;
	}

	public void setPaliwaFiltrowane(List<PaliwoDTO> paliwaFiltrowane) {
		this.paliwaFiltrowane = paliwaFiltrowane;
	}

	public List<String> getRodzajePaliwa() {
		return rodzajePaliwa;
	}

	public void setRodzajePaliwa(List<String> rodzajePaliwa) {
		this.rodzajePaliwa = rodzajePaliwa;
	}

	public Date getDataOd() {
		return dataOd;
	}

	public void setDataOd(Date dataOd) {
		this.dataOd = dataOd;
	}

	public Date getDataDo() {
		return dataDo;
	}

	public void setDataDo(Date dataDo) {
		this.dataDo = dataDo;
	}

	public LineChartModel getModelChart() {
		return modelChart;
	}

	public void setModelChart(LineChartModel modelChart) {
		this.modelChart = modelChart;
	}

	public String getText() {
		return text;
	}

	public void setText(String text) {
		this.text = text;
	}

	public Paliwo getZaznaczony() {
		return zaznaczony;
	}

	public void setZaznaczony(Paliwo zaznaczony) {
		this.zaznaczony = zaznaczony;
	}

	public List<PaliwoDTO> getPaliwaDoUsuniecia() {
		return paliwaDoUsuniecia;
	}

	public void setPaliwaDoUsuniecia(List<PaliwoDTO> paliwaDoUsuniecia) {
		this.paliwaDoUsuniecia = paliwaDoUsuniecia;
	}

	public List<PaliwoDTO> getZaznaczone() {
		return zaznaczone;
	}

	public void setZaznaczone(List<PaliwoDTO> zaznaczone) {
		this.zaznaczone = zaznaczone;
	}

	public List<PaliwoDTO> getPaliwaDoZapisania() {
		return paliwaDoZapisania;
	}

	public void setPaliwaDoZapisania(List<PaliwoDTO> paliwaDoZapisania) {
		this.paliwaDoZapisania = paliwaDoZapisania;
	}

}
