import pandas as pd
import mysql.connector


data = pd.read_csv(filepath_or_buffer="Data_Arbre.csv", sep=",", header=0)
print(len(data))

host = 'localhost'
database = 'etu1122'
user = 'etu1122'
password = 'qikqpbvw'

connection = mysql.connector.connect(host=host, database=database, user=user, password=password)

if connection.is_connected():
    cursor = connection.cursor()    
    cursor.execute("SELECT DATABASE();")
    record = cursor.fetchone()
    print("Connecté à la base de données:", record)

    # Remplissage de toutes les tables sauf Arbre
    query1 = """INSERT INTO ArbreEtat (nom_arbreetat) VALUES (%s)"""
    query2 = """INSERT INTO Feuillage (nom_feuillage) VALUES (%s)"""
    query3 = """INSERT INTO Nomtech (nomtech) VALUES (%s)"""
    query4 = """INSERT INTO Pied (nom_pied) VALUES (%s)"""
    query5 = """INSERT INTO Port (nom_port) VALUES (%s)"""
    query6 = """INSERT INTO Quartier (nom_quartier) VALUES (%s)"""
    query7 = """INSERT INTO Secteur (nom_secteur, id_quartier) VALUES (%s, %s)"""
    query8 = """INSERT INTO Situation (nom_situation) VALUES (%s)"""
    query9 = """INSERT INTO Stadedev (nom_stadedev) VALUES (%s)"""
    query10 = """INSERT INTO Villeca (nome_villeca) VALUES (%s)"""

    # Prise en compte des valeurs uniques
    etat = data['fk_arb_etat'].unique()
    feuillage = data['feuillage'].unique()  
    nomtech = data['fk_nomtech'].unique()
    pied = data['fk_pied'].unique()
    port = data['fk_port'].unique()
    quartier = data['clc_quartier'].unique()
    situation = data['fk_situation'].unique()
    stade = data['fk_stadedev'].unique()
    villeca = data['villeca'].unique()

    # Execution des requêtes
    for value in etat:
        cursor.execute(query1, (value,))
    for value in feuillage:
        cursor.execute(query2, (value,))
    for value in nomtech:
        cursor.execute(query3, (value,))
    for value in pied:
        cursor.execute(query4, (value,))
    for value in port:
        cursor.execute(query5, (value,))
    for value in quartier:
        cursor.execute(query6, (value,))
    
    # Trouver l'id du quartier dans la table Secteur
    secteurs = data['clc_secteur'].unique()
    secteur_quartier = {}
    for secteur in secteurs:
        quartier = data[data['clc_secteur'] == secteur]['clc_quartier'].unique()
        secteur_quartier[secteur] = quartier

    for value in secteurs:
        cursor.execute(query7, (value,))
    for value in situation:
        cursor.execute(query8, (value,))
    for value in stade:
        cursor.execute(query9, (value,))
    for value in villeca:
        cursor.execute(query10, (value,))
    

    connection.commit()
    print("Donnée traité correctement.")
    cursor.close()
    connection.close()
else:
    print("Erreur de connexion à la base de donnée.")
