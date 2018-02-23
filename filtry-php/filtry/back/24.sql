
---------------------inne---------------------
CREATE TABLE `inne` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(200) DEFAULT NULL,
  `ilosc` decimal(10,1) DEFAULT NULL,
  `margines` decimal(10,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8
 
insert into inne values ('6' ,'KARTON 22' ,'2240.0' ,'1000.0'); 
insert into inne values ('7' ,'KARTON 44' ,'70.0' ,'500.0'); 
insert into inne values ('8' ,'KARTON 96' ,'90.0' ,'300.0'); 
insert into inne values ('10' ,'PPI-F20(10mm)1,25x2mb' ,'3.0' ,'0.0'); 
insert into inne values ('13' ,'PPI-F20(20mm)1,25x1,39' ,'1.0' ,'0.0'); 
insert into inne values ('14' ,'PPI-F20(20mm)1,25x1,89' ,'1.0' ,'0.0'); 
insert into inne values ('17' ,'Minipleat F5-44-1200x600' ,'1.0' ,'0.0'); 
insert into inne values ('18' ,'Minipleat F5-44-600x600' ,'2.0' ,'0.0'); 
insert into inne values ('19' ,'Minipleat F5-92-1200x600' ,'5.0' ,'0.0'); 

---------------------material---------------------
CREATE TABLE `material` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(50) DEFAULT NULL,
  `jednostka` varchar(2) DEFAULT NULL,
  `ilosc` decimal(10,1) DEFAULT NULL,
  `margines` decimal(10,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8
 
insert into material values ('6' ,'F5' ,'mb' ,'246.4' ,'100.0'); 
insert into material values ('7' ,'F7' ,'mb' ,'472.0' ,'100.0'); 
insert into material values ('8' ,'G4' ,'mb' ,'500.0' ,'100.0'); 
insert into material values ('9' ,'F9' ,'mb' ,'14.0' ,'100.0'); 
insert into material values ('10' ,'F6' ,'mb' ,'80.0' ,'100.0'); 
insert into material values ('20' ,'EW150(2X20)' ,'mb' ,'20.0' ,'5.0'); 
insert into material values ('13' ,'EW270(2x2,4)' ,'mb' ,'2.4' ,'2.0'); 
insert into material values ('14' ,'EW320-2X10(2 ROLKI)' ,'mb' ,'20.0' ,'5.0'); 
insert into material values ('29' ,'EW150(2X9,5MB)' ,'mb' ,'9.5' ,'0.0'); 
insert into material values ('18' ,'EW100(2X40MB)' ,'mb' ,'40.1' ,'5.0'); 
insert into material values ('21' ,'EW180(2X20)' ,'mb' ,'15.0' ,'5.0'); 
insert into material values ('23' ,'EW180(1,73X11,4MB)' ,'mb' ,'11.4' ,'1.0'); 
insert into material values ('25' ,'EW190-6370(2X20MB)' ,'mb' ,'16.4' ,'5.0'); 
insert into material values ('27' ,'EW190B/N(2X20)' ,'mb' ,'20.0' ,'5.0'); 
insert into material values ('28' ,'EW190B/N(2X10,3)' ,'mb' ,'10.3' ,'1.0'); 

---------------------naroznik---------------------
CREATE TABLE `naroznik` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `typ` varchar(50) DEFAULT NULL,
  `ilosc` decimal(10,1) DEFAULT NULL,
  `margines` decimal(10,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8
 

---------------------pracownicy---------------------
CREATE TABLE `pracownicy` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `imie` varchar(50) DEFAULT NULL,
  `nazwisko` varchar(50) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `upr` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8
 
insert into pracownicy values ('1' ,'Aneta' ,'Ossowska' ,'a_osso' ,'produkcja' ,'515e4ab4ed1fec43c69876b58d89f89c'); 
insert into pracownicy values ('2' ,'biuro' ,'MKAsystem' ,'biuro' ,'biuro' ,'a906051e8125c1f268e56f6c93f9c00a'); 

---------------------profil_nosny---------------------
CREATE TABLE `profil_nosny` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `material` varchar(50) DEFAULT NULL,
  `dlugosc` int(10) DEFAULT NULL,
  `ilosc` decimal(10,1) DEFAULT NULL,
  `margines` decimal(10,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8
 
insert into profil_nosny values ('15' ,'metal' ,'1500' ,'91.0' ,'30.0'); 
insert into profil_nosny values ('14' ,'metal' ,'876' ,'60.0' ,'10.0'); 
insert into profil_nosny values ('13' ,'metal' ,'284' ,'2065.0' ,'700.0'); 
insert into profil_nosny values ('12' ,'metal' ,'425' ,'1982.0' ,'700.0'); 
insert into profil_nosny values ('11' ,'metal' ,'487' ,'1870.0' ,'700.0'); 
insert into profil_nosny values ('10' ,'metal' ,'589' ,'1173.0' ,'1500.0'); 
insert into profil_nosny values ('17' ,'metal' ,'889' ,'165.0' ,'30.0'); 

---------------------profil_zamykajacy---------------------
CREATE TABLE `profil_zamykajacy` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `material` varchar(50) DEFAULT NULL,
  `dlugosc` int(10) DEFAULT NULL,
  `ilosc_kieszeni` int(10) DEFAULT NULL,
  `ilosc` decimal(10,1) DEFAULT NULL,
  `margines` decimal(10,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8
 
insert into profil_zamykajacy values ('20' ,'plastik 4M' ,'555' ,'6' ,'291.0' ,'500.0'); 
insert into profil_zamykajacy values ('21' ,'plastik 4M' ,'555' ,'0' ,'576.0' ,'500.0'); 
insert into profil_zamykajacy values ('22' ,'plastik 4M' ,'250' ,'0' ,'300.0' ,'200.0'); 
insert into profil_zamykajacy values ('23' ,'plastik 4M' ,'453' ,'0' ,'451.0' ,'200.0'); 
insert into profil_zamykajacy values ('24' ,'plastik 4M' ,'391' ,'4' ,'195.0' ,'100.0'); 
insert into profil_zamykajacy values ('25' ,'plastik 4M' ,'391' ,'5' ,'84.0' ,'30.0'); 
insert into profil_zamykajacy values ('26' ,'plastik 4M' ,'250' ,'4' ,'122.0' ,'30.0'); 
insert into profil_zamykajacy values ('27' ,'plastik 4M' ,'453' ,'5' ,'407.0' ,'200.0'); 
insert into profil_zamykajacy values ('28' ,'plastik 4M' ,'555' ,'8' ,'227.0' ,'50.0'); 
insert into profil_zamykajacy values ('29' ,'plastik 4M' ,'453' ,'4' ,'147.0' ,'50.0'); 
insert into profil_zamykajacy values ('30' ,'plastik 4M' ,'555' ,'4' ,'128.0' ,'50.0'); 
insert into profil_zamykajacy values ('31' ,'plastik 4M' ,'391' ,'0' ,'304.0' ,'100.0'); 
insert into profil_zamykajacy values ('32' ,'plastik 4M' ,'250' ,'3' ,'230.0' ,'100.0'); 
insert into profil_zamykajacy values ('33' ,'plastik 4M' ,'842' ,'0' ,'42.0' ,'20.0'); 
insert into profil_zamykajacy values ('34' ,'Plastik 4A' ,'555' ,'0' ,'30.0' ,'0.0'); 
insert into profil_zamykajacy values ('35' ,'plastik 4M' ,'3000' ,'0' ,'18.0' ,'10.0'); 
insert into profil_zamykajacy values ('36' ,'plastik 4M' ,'2000' ,'0' ,'12.0' ,'10.0'); 

---------------------ramka---------------------
CREATE TABLE `ramka` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rodzaj` varchar(50) DEFAULT NULL,
  `typ` varchar(20) DEFAULT NULL,
  `wymiar` varchar(20) DEFAULT NULL,
  `ilosc` decimal(10,1) DEFAULT NULL,
  `margines` decimal(10,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8
 
insert into ramka values ('16' ,'metal' ,'25' ,'428-287' ,'127.0' ,'100.0'); 
insert into ramka values ('15' ,'metal' ,'25' ,'287-287' ,'35.0' ,'30.0'); 
insert into ramka values ('14' ,'metal' ,'25' ,'490-287' ,'113.0' ,'30.0'); 
insert into ramka values ('13' ,'metal' ,'25' ,'592-490' ,'143.0' ,'100.0'); 
insert into ramka values ('12' ,'metal' ,'25' ,'490-490' ,'111.0' ,'100.0'); 
insert into ramka values ('11' ,'metal' ,'25' ,'592-287' ,'48.0' ,'100.0'); 
insert into ramka values ('10' ,'metal' ,'25' ,'592-592' ,'52.0' ,'200.0'); 
insert into ramka values ('17' ,'metal' ,'25' ,'428-428' ,'153.0' ,'50.0'); 
insert into ramka values ('18' ,'metal' ,'25' ,'879-287' ,'23.0' ,'20.0'); 
insert into ramka values ('19' ,'metal' ,'25' ,'1195-595' ,'4.0' ,'0.0'); 
insert into ramka values ('20' ,'metal' ,'20' ,'490-490' ,'17.0' ,'0.0'); 
insert into ramka values ('21' ,'metal' ,'20' ,'592-592' ,'2.0' ,'0.0'); 
insert into ramka values ('22' ,'metal' ,'25' ,'592-392' ,'30.0' ,'5.0'); 
insert into ramka values ('24' ,'metal' ,'25' ,'592-892' ,'15.0' ,'5.0'); 
insert into ramka values ('25' ,'metal' ,'25' ,'490-892' ,'15.0' ,'5.0'); 
insert into ramka values ('26' ,'metal' ,'25' ,'287-892' ,'15.0' ,'5.0'); 
insert into ramka values ('28' ,'metal' ,'25' ,'400-500' ,'4.0' ,'4.0'); 

---------------------zamowienie---------------------
CREATE TABLE `zamowienie` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `numer` varchar(20) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `kod_el` varchar(15) DEFAULT NULL,
  `ilosc_el` decimal(10,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=167 DEFAULT CHARSET=utf8
 
insert into zamowienie values ('29' ,'29/01/2016' ,'2016-01-29' ,'ram13' ,'5.0'); 
insert into zamowienie values ('28' ,'29/01/2016' ,'2016-01-29' ,'ram16' ,'10.0'); 
insert into zamowienie values ('27' ,'29/01/2016' ,'2016-01-29' ,'ram15' ,'4.0'); 
insert into zamowienie values ('30' ,'29/01/2016' ,'2016-01-29' ,'ram12' ,'10.0'); 
insert into zamowienie values ('31' ,'29/01/2016' ,'2016-01-29' ,'mat8' ,'10.3'); 
insert into zamowienie values ('32' ,'29/01/2016' ,'2016-01-29' ,'prn10' ,'20.0'); 
insert into zamowienie values ('34' ,'29/01/2016' ,'2016-01-29' ,'prn13' ,'48.0'); 
insert into zamowienie values ('35' ,'29/01/2016' ,'2016-01-29' ,'prz27' ,'24.0'); 
insert into zamowienie values ('36' ,'29/01/2016' ,'2016-01-29' ,'prz23' ,'24.0'); 
insert into zamowienie values ('37' ,'29/01/2016' ,'2016-01-29' ,'prz24' ,'32.0'); 
insert into zamowienie values ('38' ,'29/01/2016' ,'2016-01-29' ,'prz22' ,'20.0'); 
insert into zamowienie values ('39' ,'29/01/2016' ,'2016-01-29' ,'prz31' ,'12.0'); 
insert into zamowienie values ('40' ,'29/01/2016' ,'2016-01-29' ,'prz20' ,'8.0'); 
insert into zamowienie values ('52' ,'01/02/2016' ,'2016-02-01' ,'mat6' ,'83.7'); 
insert into zamowienie values ('51' ,'01/02/2016' ,'2016-02-01' ,'mat8' ,'9.7'); 
insert into zamowienie values ('53' ,'01/02/2016' ,'2016-02-01' ,'mat7' ,'123.1'); 
insert into zamowienie values ('54' ,'01/02/2016' ,'2016-02-01' ,'prn13' ,'131.0'); 
insert into zamowienie values ('55' ,'01/02/2016' ,'2016-02-01' ,'prn10' ,'240.0'); 
insert into zamowienie values ('56' ,'01/02/2016' ,'2016-02-01' ,'prn12' ,'6.0'); 
insert into zamowienie values ('57' ,'01/02/2016' ,'2016-02-01' ,'prz24' ,'8.0'); 
insert into zamowienie values ('58' ,'01/02/2016' ,'2016-02-01' ,'prz31' ,'4.0'); 
insert into zamowienie values ('59' ,'01/02/2016' ,'2016-02-01' ,'prz22' ,'54.0'); 
insert into zamowienie values ('60' ,'01/02/2016' ,'2016-02-01' ,'prz20' ,'146.0'); 
insert into zamowienie values ('61' ,'01/02/2016' ,'2016-02-01' ,'prz21' ,'96.0'); 
insert into zamowienie values ('62' ,'01/02/2016' ,'2016-02-01' ,'ram16' ,'2.0'); 
insert into zamowienie values ('63' ,'01/02/2016' ,'2016-02-01' ,'ram17' ,'2.0'); 
insert into zamowienie values ('64' ,'01/02/2016' ,'2016-02-01' ,'ram11' ,'25.0'); 
insert into zamowienie values ('65' ,'01/02/2016' ,'2016-02-01' ,'ram10' ,'48.0'); 
insert into zamowienie values ('66' ,'02/02/2016' ,'2016-02-02' ,'mat8' ,'10.0'); 
insert into zamowienie values ('160' ,'22/02/2016' ,'2016-02-22' ,'prn13' ,'182.0'); 
insert into zamowienie values ('68' ,'02/03/2016' ,'2016-02-03' ,'mat20' ,'20.0'); 
insert into zamowienie values ('69' ,'03/02/2016' ,'2016-02-03' ,'mat27' ,'9.7'); 
insert into zamowienie values ('70' ,'3/02/2016' ,'2016-02-03' ,'mat8' ,'30.4'); 
insert into zamowienie values ('71' ,'3/02/2016' ,'2016-02-03' ,'mat7' ,'50.6'); 
insert into zamowienie values ('72' ,'3/02/2016' ,'2016-02-03' ,'prn11' ,'48.0'); 
insert into zamowienie values ('73' ,'3/02/2016' ,'2016-02-03' ,'prn10' ,'79.0'); 
insert into zamowienie values ('74' ,'03/02/2016' ,'2016-02-03' ,'ram12' ,'12.0'); 
insert into zamowienie values ('75' ,'3/02/2016' ,'2016-02-03' ,'ram13' ,'12.0'); 
insert into zamowienie values ('76' ,'3/02/2016' ,'2016-02-03' ,'ram10' ,'5.0'); 
insert into zamowienie values ('77' ,'3/02/2016' ,'2016-02-03' ,'ram11' ,'3.0'); 
insert into zamowienie values ('78' ,'3/02/2016' ,'2016-02-03' ,'prz27' ,'48.0'); 
insert into zamowienie values ('79' ,'3/02/2016' ,'2016-02-03' ,'prz21' ,'40.0'); 
insert into zamowienie values ('80' ,'3/02/2016' ,'2016-02-03' ,'prz23' ,'24.0'); 
insert into zamowienie values ('81' ,'3/02/2016' ,'2016-02-03' ,'prz20' ,'10.0'); 
insert into zamowienie values ('82' ,'08/02/2016' ,'2016-02-08' ,'mat21' ,'20.0'); 
insert into zamowienie values ('83' ,'08/02/2016' ,'2016-02-08' ,'mat27' ,'10.3'); 
insert into zamowienie values ('84' ,'08/02/2016' ,'2016-02-08' ,'prn13' ,'191.0'); 
insert into zamowienie values ('85' ,'08/02/2016' ,'2016-02-08' ,'prn10' ,'456.0'); 
insert into zamowienie values ('86' ,'08/02/2016' ,'2016-02-08' ,'prn11' ,'250.0'); 
insert into zamowienie values ('87' ,'08/02/2016' ,'2016-02-08' ,'prn12' ,'6.0'); 
insert into zamowienie values ('88' ,'08/02/2016' ,'2016-02-08' ,'prn15' ,'36.0'); 
insert into zamowienie values ('89' ,'08/02/2016' ,'2016-02-08' ,'ram16' ,'2.0'); 
insert into zamowienie values ('90' ,'08/02/2016' ,'2016-02-08' ,'ram17' ,'2.0'); 
insert into zamowienie values ('91' ,'08/02/2016' ,'2016-02-08' ,'ram11' ,'41.0'); 
insert into zamowienie values ('92' ,'08/02/2016' ,'2016-02-08' ,'ram10' ,'44.0'); 
insert into zamowienie values ('93' ,'08/02/2016' ,'2016-02-08' ,'ram13' ,'52.0'); 
insert into zamowienie values ('94' ,'08/02/2016' ,'2016-02-08' ,'ram12' ,'48.0'); 
insert into zamowienie values ('95' ,'08/02/2016' ,'2016-02-08' ,'ram15' ,'5.0'); 
insert into zamowienie values ('96' ,'08/02/2016' ,'2016-02-08' ,'prz24' ,'8.0'); 
insert into zamowienie values ('97' ,'08/02/2016' ,'2016-02-08' ,'prz31' ,'4.0'); 
insert into zamowienie values ('98' ,'08/02/2016' ,'2016-02-08' ,'prz22' ,'84.0'); 
insert into zamowienie values ('99' ,'08/02/2016' ,'2016-02-08' ,'prz20' ,'202.0'); 
insert into zamowienie values ('100' ,'08/02/2016' ,'2016-02-08' ,'prz21' ,'184.0'); 
insert into zamowienie values ('101' ,'08/02/2016' ,'2016-02-08' ,'prz32' ,'22.0'); 
insert into zamowienie values ('102' ,'08/02/2016' ,'2016-02-08' ,'prz27' ,'180.0'); 
insert into zamowienie values ('103' ,'08/02/2016' ,'2016-02-08' ,'prz23' ,'116.0'); 
insert into zamowienie values ('104' ,'08/02/2016' ,'2016-02-08' ,'prz36' ,'8.0'); 
insert into zamowienie values ('105' ,'08/02/2016' ,'2016-02-08' ,'mat8' ,'160.1'); 
insert into zamowienie values ('106' ,'08/02/2016' ,'2016-02-08' ,'mat6' ,'146.2'); 
insert into zamowienie values ('107' ,'08/02/2016' ,'2016-02-08' ,'mat7' ,'160.1'); 
insert into zamowienie values ('108' ,'08/02/2016' ,'2016-02-08' ,'inn6' ,'266.0'); 
insert into zamowienie values ('109' ,'08/02/2016' ,'2016-02-09' ,'mat8' ,'19.5'); 
insert into zamowienie values ('110' ,'08/02/2016' ,'2016-02-09' ,'mat7' ,'56.2'); 
insert into zamowienie values ('111' ,'08/02/2016' ,'2016-02-09' ,'mat8' ,'9.9'); 
insert into zamowienie values ('112' ,'08/02/2016' ,'2016-02-09' ,'mat9' ,'16.0'); 
insert into zamowienie values ('113' ,'08/02/2016' ,'2016-02-09' ,'prn13' ,'163.0'); 
insert into zamowienie values ('114' ,'08/02/2016' ,'2016-02-09' ,'prn10' ,'93.0'); 
insert into zamowienie values ('115' ,'08/02/2016' ,'2016-02-09' ,'prn11' ,'16.0'); 
insert into zamowienie values ('116' ,'08/02/2016' ,'2016-02-09' ,'prz31' ,'4.0'); 
insert into zamowienie values ('117' ,'08/02/2016' ,'2016-02-09' ,'prz22' ,'72.0'); 
insert into zamowienie values ('118' ,'08/02/2016' ,'2016-02-09' ,'prz20' ,'92.0'); 
insert into zamowienie values ('119' ,'08/02/2016' ,'2016-02-09' ,'prz21' ,'52.0'); 
insert into zamowienie values ('120' ,'08/02/2016' ,'2016-02-09' ,'prz32' ,'24.0'); 
insert into zamowienie values ('121' ,'08/02/2016' ,'2016-02-09' ,'prz27' ,'8.0'); 
insert into zamowienie values ('122' ,'08/02/2016' ,'2016-02-09' ,'prz23' ,'8.0'); 
insert into zamowienie values ('123' ,'08/02/2016' ,'2016-02-09' ,'prz33' ,'8.0'); 
insert into zamowienie values ('124' ,'08/02/2016' ,'2016-02-09' ,'ram16' ,'2.0'); 
insert into zamowienie values ('125' ,'08/02/2016' ,'2016-02-09' ,'ram11' ,'42.0'); 
insert into zamowienie values ('126' ,'08/02/2016' ,'2016-02-09' ,'ram10' ,'11.0'); 
insert into zamowienie values ('127' ,'08/02/2016' ,'2016-02-09' ,'ram13' ,'4.0'); 
insert into zamowienie values ('128' ,'08/02/2016' ,'2016-02-09' ,'ram15' ,'1.0'); 
insert into zamowienie values ('129' ,'08/02/2016' ,'2016-02-09' ,'prz31' ,'176.0'); 
insert into zamowienie values ('130' ,'08/02/2016' ,'2016-02-09' ,'prz27' ,'15.0'); 
insert into zamowienie values ('131' ,'08/02/2016' ,'2016-02-09' ,'prz32' ,'100.0'); 
insert into zamowienie values ('132' ,'10/02/2016' ,'2016-02-10' ,'mat6' ,'3.7'); 
insert into zamowienie values ('133' ,'10/02/2016' ,'2016-02-10' ,'mat7' ,'55.5'); 
insert into zamowienie values ('134' ,'10/02/2016' ,'2016-02-10' ,'mat8' ,'197.5'); 
insert into zamowienie values ('135' ,'10/02/2016' ,'2016-02-10' ,'mat21' ,'5.0'); 
insert into zamowienie values ('136' ,'10/02/2016' ,'2016-02-10' ,'prn10' ,'25.0'); 
insert into zamowienie values ('137' ,'10/02/2016' ,'2016-02-10' ,'prn11' ,'36.0'); 
insert into zamowienie values ('138' ,'10/02/2016' ,'2016-02-10' ,'prz21' ,'10.0'); 
insert into zamowienie values ('139' ,'10/02/2016' ,'2016-02-10' ,'prz23' ,'24.0'); 
insert into zamowienie values ('140' ,'10/02/2016' ,'2016-02-10' ,'prz20' ,'10.0'); 
insert into zamowienie values ('141' ,'10/02/2016' ,'2016-02-10' ,'prz29' ,'24.0'); 
insert into zamowienie values ('142' ,'10/02/2016' ,'2016-02-10' ,'ram10' ,'5.0'); 
insert into zamowienie values ('143' ,'10/02/2016' ,'2016-02-10' ,'ram12' ,'12.0'); 
insert into zamowienie values ('144' ,'12/02/2016' ,'2016-02-12' ,'mat18' ,'36.0'); 
insert into zamowienie values ('155' ,'22/02/2016' ,'2016-02-22' ,'ram11' ,'172.0'); 
insert into zamowienie values ('146' ,'12/02/2016' ,'2016-02-12' ,'mat7' ,'472.5'); 
insert into zamowienie values ('147' ,'12/02/2016' ,'2016-02-12' ,'mat8' ,'142.6'); 
insert into zamowienie values ('148' ,'12/02/2016' ,'2016-02-12' ,'prn13' ,'330.0'); 
insert into zamowienie values ('149' ,'12/02/2016' ,'2016-02-12' ,'prn10' ,'899.0'); 
insert into zamowienie values ('150' ,'12/02/2016' ,'2016-02-12' ,'prz22' ,'89.0'); 
insert into zamowienie values ('151' ,'12/02/2016' ,'2016-02-12' ,'prz21' ,'319.0'); 
insert into zamowienie values ('152' ,'12/02/2016' ,'2016-02-12' ,'prz32' ,'4.0'); 
insert into zamowienie values ('153' ,'12/02/2016' ,'2016-02-12' ,'prz20' ,'447.0'); 
insert into zamowienie values ('156' ,'22/02/2016' ,'2016-02-22' ,'ram10' ,'396.0'); 
insert into zamowienie values ('157' ,'22/02/2016' ,'2016-02-22' ,'ram13' ,'12.0'); 
insert into zamowienie values ('158' ,'22/02/2016' ,'2016-02-22' ,'ram12' ,'4.0'); 
insert into zamowienie values ('159' ,'22/02/2016' ,'2016-02-22' ,'ram15' ,'23.0'); 
insert into zamowienie values ('161' ,'22/02/2016' ,'2016-02-22' ,'prn10' ,'1395.0'); 
insert into zamowienie values ('162' ,'22/02/2016' ,'2016-02-22' ,'prn11' ,'32.0'); 
insert into zamowienie values ('163' ,'22/02/2016' ,'2016-02-22' ,'prz20' ,'238.0'); 
insert into zamowienie values ('164' ,'22/02/2016' ,'2016-02-22' ,'prz20' ,'148.0'); 
insert into zamowienie values ('165' ,'22/02/2016' ,'2016-02-22' ,'prz21' ,'590.0'); 
insert into zamowienie values ('166' ,'22/02/2016' ,'2016-02-22' ,'prz29' ,'8.0'); 
