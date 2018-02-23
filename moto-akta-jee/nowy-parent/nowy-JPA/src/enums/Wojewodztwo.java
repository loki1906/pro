package enums;

public enum Wojewodztwo {

    dolnoslaskie("Dolno�l�skie"),
    kujPomor("Kujawsko-pomorskie"),
    lubelskie("Lubelskie"),
    lubuskie("Lubuskie"),
    lodzkie("��dzkie"),
    malopolskie("Ma�opolskie"),
    mazowieckie("Mazowieckie"),
    opolskie("Opolskie"),
    podkarpackie("Podkarpackie"),
    podlaskie("Podlaskie"),
    pomorskie("Pomorskie"),
    slaskie("�l�skie"),
    swietokrzyskie("�wi�tokrzyskie"),
    warmMaz("Warmi�sko-mazurskie"),
    wielkopolskie("Wielkopolskie"),
    zachodniopomorskie("Zachodniopomorskie");

    private String nazwa;
    
    Wojewodztwo(String nazwa){
    	this.nazwa = nazwa;
    }
	
    public String getNazwa() {
		return nazwa;
	}
}
