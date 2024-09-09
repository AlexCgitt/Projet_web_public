#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE Utilisateur(
        identifiant Varchar (50) NOT NULL ,
        mdp         Varchar (50) NOT NULL
	,CONSTRAINT Utilisateur_PK PRIMARY KEY (identifiant)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Stadedev
#------------------------------------------------------------

CREATE TABLE Stadedev(
        id_stadedev  Int  Auto_increment  NOT NULL ,
        nom_stadedev Varchar (50) NOT NULL
	,CONSTRAINT Stadedev_PK PRIMARY KEY (id_stadedev)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: NomTech
#------------------------------------------------------------

CREATE TABLE NomTech(
        id_nomtech Int  Auto_increment  NOT NULL ,
        nomtech    Varchar (50) NOT NULL
	,CONSTRAINT NomTech_PK PRIMARY KEY (id_nomtech)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Port
#------------------------------------------------------------

CREATE TABLE Port(
        id_port  Int  Auto_increment  NOT NULL ,
        nom_port Varchar (50) NOT NULL
	,CONSTRAINT Port_PK PRIMARY KEY (id_port)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Villeca
#------------------------------------------------------------

CREATE TABLE Villeca(
        id_villeca  Int  Auto_increment  NOT NULL ,
        nom_villeca Varchar (50) NOT NULL
	,CONSTRAINT Villeca_PK PRIMARY KEY (id_villeca)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Pied
#------------------------------------------------------------

CREATE TABLE Pied(
        id_pied  Int  Auto_increment  NOT NULL ,
        nom_pied Varchar (50) NOT NULL
	,CONSTRAINT Pied_PK PRIMARY KEY (id_pied)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Feuillage
#------------------------------------------------------------

CREATE TABLE Feuillage(
        id_feuillage  Int  Auto_increment  NOT NULL ,
        nom_feuillage Varchar (50) NOT NULL
	,CONSTRAINT Feuillage_PK PRIMARY KEY (id_feuillage)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Situation
#------------------------------------------------------------

CREATE TABLE Situation(
        id_situation  Int  Auto_increment  NOT NULL ,
        nom_situation Varchar (50) NOT NULL
	,CONSTRAINT Situation_PK PRIMARY KEY (id_situation)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ArbreEtat
#------------------------------------------------------------

CREATE TABLE ArbreEtat(
        id_arbreetat  Int  Auto_increment  NOT NULL ,
        nom_arbreetat Varchar (50) NOT NULL
	,CONSTRAINT ArbreEtat_PK PRIMARY KEY (id_arbreetat)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Quartier
#------------------------------------------------------------

CREATE TABLE Quartier(
        id_quartier  Int  Auto_increment  NOT NULL ,
        nom_quartier Varchar (50) NOT NULL
	,CONSTRAINT Quartier_PK PRIMARY KEY (id_quartier)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Secteur
#------------------------------------------------------------

CREATE TABLE Secteur(
        id_secteur  Int  Auto_increment  NOT NULL ,
        nom_secteur Varchar (70) NOT NULL ,
        id_quartier Int NOT NULL
	,CONSTRAINT Secteur_PK PRIMARY KEY (id_secteur)

	,CONSTRAINT Secteur_Quartier_FK FOREIGN KEY (id_quartier) REFERENCES Quartier(id_quartier)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Arbre
#------------------------------------------------------------

CREATE TABLE Arbre(
        id_arbre     Int  Auto_increment  NOT NULL ,
        longitude    Float NOT NULL ,
        latitude     Float NOT NULL ,
        haut_tot     Float NOT NULL ,
        haut_tronc   Float NOT NULL ,
        tronc_diam   Float NOT NULL ,
        clc_nbr_diag Int NOT NULL ,
        remarquable  Varchar (5) NOT NULL ,
        revetement   Varchar (5) NOT NULL ,
        id_stadedev  Int NOT NULL ,
        identifiant  Varchar (50) NOT NULL ,
        id_nomtech   Int NOT NULL ,
        id_port      Int NOT NULL ,
        id_villeca   Int NOT NULL ,
        id_pied      Int NOT NULL ,
        id_feuillage Int NOT NULL ,
        id_situation Int NOT NULL ,
        id_arbreetat Int NOT NULL ,
        id_secteur   Int NOT NULL ,
        id_quartier  Int NOT NULL
	,CONSTRAINT Arbre_PK PRIMARY KEY (id_arbre)

	,CONSTRAINT Arbre_Stadedev_FK FOREIGN KEY (id_stadedev) REFERENCES Stadedev(id_stadedev)
	,CONSTRAINT Arbre_Utilisateur0_FK FOREIGN KEY (identifiant) REFERENCES Utilisateur(identifiant)
	,CONSTRAINT Arbre_NomTech1_FK FOREIGN KEY (id_nomtech) REFERENCES NomTech(id_nomtech)
	,CONSTRAINT Arbre_Port2_FK FOREIGN KEY (id_port) REFERENCES Port(id_port)
	,CONSTRAINT Arbre_Villeca3_FK FOREIGN KEY (id_villeca) REFERENCES Villeca(id_villeca)
	,CONSTRAINT Arbre_Pied4_FK FOREIGN KEY (id_pied) REFERENCES Pied(id_pied)
	,CONSTRAINT Arbre_Feuillage5_FK FOREIGN KEY (id_feuillage) REFERENCES Feuillage(id_feuillage)
	,CONSTRAINT Arbre_Situation6_FK FOREIGN KEY (id_situation) REFERENCES Situation(id_situation)
	,CONSTRAINT Arbre_ArbreEtat7_FK FOREIGN KEY (id_arbreetat) REFERENCES ArbreEtat(id_arbreetat)
	,CONSTRAINT Arbre_Secteur8_FK FOREIGN KEY (id_secteur) REFERENCES Secteur(id_secteur)
	,CONSTRAINT Arbre_Quartier9_FK FOREIGN KEY (id_quartier) REFERENCES Quartier(id_quartier)
)ENGINE=InnoDB;

