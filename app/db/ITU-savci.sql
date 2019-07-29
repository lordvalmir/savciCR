use ITU;
set names 'utf8'; 

DROP TABLE IF EXISTS hodnoceni;
DROP TABLE IF EXISTS testovane_zvirata;
DROP TABLE IF EXISTS test;
DROP TABLE IF EXISTS zak;
DROP TABLE IF EXISTS trida;
DROP TABLE IF EXISTS ucitel;
DROP TABLE IF EXISTS zvire;
DROP TABLE IF EXISTS typ_testu;

CREATE TABLE ucitel(
  id_ucitel INT NOT NULL AUTO_INCREMENT,
  login VARCHAR(64) NOT NULL,
  heslo VARCHAR(128) NOT NULL,
  email VARCHAR(320) NOT NULL,
  PRIMARY KEY (id_ucitel)
);

CREATE TABLE trida(
  id_trida INT NOT NULL AUTO_INCREMENT,
  nazev VARCHAR(64) NOT NULL,
  fk_ucitel INT,
  PRIMARY KEY (id_trida),
  FOREIGN KEY (fk_ucitel) REFERENCES ucitel(id_ucitel)
);

CREATE TABLE zak(
  id_zak INT NOT NULL AUTO_INCREMENT,
  jmeno VARCHAR(64) NOT NULL,
  prijmeni VARCHAR(64) NOT NULL,
  fk_trida INT,
  login VARCHAR(320) NOT NULL,
  heslo VARCHAR(128) NOT NULL,
  PRIMARY KEY (id_zak),
  FOREIGN KEY (fk_trida) REFERENCES trida(id_trida)
);

CREATE TABLE zvire(
  id_zvire INT NOT NULL AUTO_INCREMENT,
  nazev VARCHAR(64) NOT NULL,
  popis VARCHAR(3000) NOT NULL, 
  obrazek VARCHAR(320) NOT NULL,
  PRIMARY KEY (id_zvire)
);

CREATE TABLE test(
  id_test INT NOT NULL AUTO_INCREMENT,
  fk_zak INT,
  PRIMARY KEY (id_test),
  FOREIGN KEY (fk_zak) REFERENCES zak(id_zak)
);
CREATE TABLE typ_testu(
  id_typu INT NOT NULL AUTO_INCREMENT,
  typ VARCHAR(64) NOT NULL,
  PRIMARY KEY(id_typu)
);
CREATE TABLE testovane_zvirata(
  id_testovane_zvirata INT NOT NULL AUTO_INCREMENT,
  fk_zvire INT,
  fk_test INT,
  spravne NUMERIC(1),
  fk_typ_testu INT,
  PRIMARY KEY (id_testovane_zvirata),
  FOREIGN KEY (fk_zvire) REFERENCES zvire(id_zvire),
  FOREIGN KEY (fk_test) REFERENCES test(id_test),
  FOREIGN KEY (fk_typ_testu) REFERENCES typ_testu(id_typu)
);
CREATE TABLE hodnoceni(
  id_hodnoceni INT NOT NULL AUTO_INCREMENT,
  vysledek VARCHAR(64) NOT NULL,
  fk_zak INT,
  fk_test INT,
  PRIMARY KEY (id_hodnoceni),
  FOREIGN KEY (fk_zak) REFERENCES zak(id_zak),
  FOREIGN KEY (fk_test) REFERENCES test(id_test)
);

INSERT INTO ucitel (login, heslo, email) VALUES
('ucitel', '2b123ce525db9526e907bd1569009d8d', 'ucitel@ucitel.cz');

INSERT INTO zvire(nazev, popis, obrazek) VALUES
('Rys ostrovid','Středně velká kočkovitá šelma přirozeně se vyskytující v Eurasii. Patří do čtyřdruhového rodu rys. Je největší kočkovitou šelmou Evropy a náleží mezi druhy chráněné Bernskou konvencí. Podle českých zákonů náleží mezi silně ohrožené a chráněné druhy, které nelze lovit.','https://upload.wikimedia.org/wikipedia/commons/6/68/Lynx_lynx_poing.jpg'),
('Zajíc polní','Jeho přirozeným biotopem jsou otevřené krajiny, především pole, louky, okraje lesů aj., kde je díky svému hnědému zbarvení velmi dobře zamaskován. V současné době populace zajíce polního na většině území ČR výrazně klesá.','https://upload.wikimedia.org/wikipedia/commons/3/33/01-sfel-08-009a_-_crop.jpg'),
('Jezevec lesní','Šelma z čeledi lasicovití. Obývá kromě severní Skandinávie celou Evropu, Krétu, Blízký východ a odtud až na Dálný východ. Na jejich lovení byla vyšlechtěna speciální psí plemena - Jezevčíci.','https://upload.wikimedia.org/wikipedia/commons/thumb/1/10/Badger-badger.jpg/1200px-Badger-badger.jpg'),
('Liška obecná','Nejrozšířenější divoce žijící zástupce šelem. Oblast jejího přirozeného výskytu zahrnuje Eurasii, Severní Ameriku a severní Afriku. Jako extrémně nebezpečný invazní druh je vedena v Austrálii, kam byla zavlečena v 19. století, a na ostrově Vancouver.','https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Vulpes_vulpes_standing_in_snow.jpg/1280px-Vulpes_vulpes_standing_in_snow.jpg'),
('Norek americký','Má dlouhé, štíhlé tělo s krátkýma nohama, což mu umožňuje vlézt do nory za kořistí. Tento tvar těla také pomáhá snížit odpor vody při plavání. Lebka norka amerického je podobná lebce norka evropského, ale je masivnější, užší a méně protáhlá.','https://upload.wikimedia.org/wikipedia/commons/0/04/MinkforWiki.jpg'),
('Vlk obecný','Velká psovitá šelma, postupná domestikace tohoto druhu vedla k vydělení poddruhu Canis lupus familiaris – psa domácího. Původně byl rozšířen po celé severní polokouli, nyní je jeho výskyt značně omezen – jeho stavy radikálně poklesly a na mnoha místech byl vyhuben.','https://upload.wikimedia.org/wikipedia/commons/d/db/Canis-lupus.jpg'),
('Kočka divoká','Savec z čeledi kočkovitých. Šelmu vědecky popsal a zařadil německý přírodovědec Johann Schreber v roce 1777. Patří do podčeledi malé kočky a rodu Felis.','https://upload.wikimedia.org/wikipedia/commons/d/d0/Felis_silvestris_silvestris_Luc_Viatour.jpg'),
('Prase divoké','Velký sudokopytník z čeledi prasatovití. Jeho domovinou je velká část Evropy a Asie. Jedná se o typického všežravce, který k životu preferuje staré lesní porosty. Bylo vždy významnou lovnou zvěří. Je také původcem prasete domácího.','https://upload.wikimedia.org/wikipedia/commons/f/f0/Wild_Boar_Habbitat_3.jpg'),
('Jelen lesní','Velký sudokopytník z čeledi jelenovitých (Cervidae). Vyskytuje se na rozsáhlém území Evropy, na Kavkaze, v Malé, západní a střední Asii a izolovaně také na území mezi Marokem a Tuniskem, což z něj činí jediný druh jelena v Africe. Po celá století byl jelen evropský velmi oblíbenou lovnou zvěří.','https://upload.wikimedia.org/wikipedia/commons/0/06/Red_Deer_Stag.jpg');

INSERT INTO typ_testu (typ) VALUES
('poznej obrázek'),
('přiřaď obrázek'),
('poznej popis');
