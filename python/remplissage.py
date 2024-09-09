import pandas as pd

data = pd.read_csv('Projet_web/csv/Data_Arbre.csv', encoding='utf-8')

print(data.columns)

list_colonnes = ['clc_quartier', 'clc_secteur', 'fk_arb_etat', 'fk_stadedev', 'fk_port',
       'fk_pied', 'fk_situation', 'fk_nomtech', 'villeca', 'feuillage']
tables = {col: [] for col in list_colonnes}

print(tables)
#on parcourt les lignes du tableau
for i in range(len(data)):
    #on parcourt les colonnes du tableau
    for col in data.columns:
        if col in tables.keys():
            if col!='clc_secteur':
                #on récupère la valeur de la colonne
                value = data[col][i]
                #si la valeur n'est pas déjà dans le tableau, on l'ajoute
                if value not in tables[col]:
                    tables[col].append(value)
            else:
                value = (data[col][i])
                #je veux verifier qu'il n'est à aucun des indice 0 de la colonne tableaux[col]
                trouve = False  # Un drapeau pour indiquer si la valeur est trouvée à l'indice 0

                for element in tables[col]:
                    if element[0] == value: 
                        trouve = True
                        break  

                if not trouve:
    
                    quartier = data['clc_quartier'][i]
                    index_quartier = tables['clc_quartier'].index(quartier) + 1
                    tables[col].append((value, index_quartier))

print(tables)


with open("Projet_web/sql/remplissage.sql", "w", encoding="utf-8") as f:

    for clc_quartier in tables['clc_quartier']:
        f.write(f"INSERT INTO Quartier (nom_quartier) VALUES (\"{clc_quartier}\");\n")

    for clc_secteur in tables['clc_secteur']:
        f.write(f"INSERT INTO Secteur (nom_secteur, id_quartier) VALUES (\"{clc_secteur[0]}\", {clc_secteur[1]});\n")

    for fk_arb_etat in tables['fk_arb_etat']:
        f.write(f"INSERT INTO ArbreEtat (nom_arbreetat) VALUES (\"{fk_arb_etat}\");\n")

    for fk_stadedev in tables['fk_stadedev']:
        f.write(f"INSERT INTO Stadedev (nom_stadedev) VALUES (\"{fk_stadedev}\");\n")

    for fk_port in tables['fk_port']:
        f.write(f"INSERT INTO Port (nom_port) VALUES (\"{fk_port}\");\n")

    for fk_pied in tables['fk_pied']:
        f.write(f"INSERT INTO Pied (nom_pied) VALUES (\"{fk_pied}\");\n")

    for fk_situation in tables['fk_situation']:
        f.write(f"INSERT INTO Situation (nom_situation) VALUES (\"{fk_situation}\");\n")

    for fk_nomtech in tables['fk_nomtech']:
        f.write(f"INSERT INTO NomTech (nomtech) VALUES (\"{fk_nomtech}\");\n")

    for villeca in tables['villeca']:
        f.write(f"INSERT INTO Villeca (nom_villeca) VALUES (\"{villeca}\");\n")

    for feuillage in tables['feuillage']:
        f.write(f"INSERT INTO Feuillage (nom_feuillage) VALUES (\"{feuillage}\");\n")

    f.write("INSERT INTO Utilisateur (identifiant, mdp) VALUES (\"user1\", \"mdp\");\n")  


#maintenant, on parcourt chaque ligne du csv
#on rentre chaque ligne du csv dans la base de données, dans la table arbre, en associant les noms des tables à leur id
#on récupère l'id de la table quartier associée à la ligne
#on rentre l'arbre dans la base de données

with open("Projet_web/sql/remplissage.sql", "a", encoding="utf-8") as f:

    for i in range(len(data)):
        clc_quartier = data['clc_quartier'][i]
        index_quartier = tables['clc_quartier'].index(clc_quartier) + 1
        clc_secteur = data['clc_secteur'][i]
        #je veux trouver l'indice du tableau tables['clc_secteur'] qui a pour valeur à l'indice 0 clc_secteur

        for j, element in enumerate(tables['clc_secteur']):
            if element[0] == clc_secteur: 
                index_secteur = j + 1
                break

        fk_arb_etat = data['fk_arb_etat'][i]
        index_arb_etat = tables['fk_arb_etat'].index(fk_arb_etat) + 1
        fk_stadedev = data['fk_stadedev'][i]
        index_stadedev = tables['fk_stadedev'].index(fk_stadedev) + 1
        fk_port = data['fk_port'][i]
        index_port = tables['fk_port'].index(fk_port) + 1
        fk_pied = data['fk_pied'][i]
        index_pied = tables['fk_pied'].index(fk_pied) + 1
        fk_situation = data['fk_situation'][i]
        index_situation = tables['fk_situation'].index(fk_situation) + 1
        fk_nomtech = data['fk_nomtech'][i]
        index_nomtech = tables['fk_nomtech'].index(fk_nomtech) + 1
        villeca = data['villeca'][i]
        index_villeca = tables['villeca'].index(villeca) + 1
        feuillage = data['feuillage'][i]
        index_feuillage = tables['feuillage'].index(feuillage) + 1

        #il faut aussi prendre longitude, latitude, haut_tot, haut_tronc, tronc_diam, clc_nbr_diag, remarquable, revetement qui sont des colonnes de la table arbre
        #elle sont dans les colonnes du csv : 'longitude', 'latitude', 'haut_tot','haut_tronc', 'tronc_diam', 'clc_nbr_diag','remarquable','fk_revetement'],
        longitude = data['longitude'][i]
        latitude = data['latitude'][i]
        haut_tot = data['haut_tot'][i]  
        haut_tronc = data['haut_tronc'][i]
        tronc_diam = data['tronc_diam'][i]
        clc_nbr_diag = data['clc_nbr_diag'][i]
        remarquable = data['remarquable'][i]
        fk_revetement = data['fk_revetement'][i]
        identifiant = "user1"

        f.write(f"INSERT INTO Arbre (longitude, latitude, haut_tot, haut_tronc, tronc_diam, clc_nbr_diag, remarquable, revetement, id_stadedev, identifiant, id_nomtech, id_port, id_villeca, id_pied, id_feuillage, id_situation, id_arbreetat, id_secteur, id_quartier) VALUES ({longitude}, {latitude}, {haut_tot}, {haut_tronc}, {tronc_diam}, {clc_nbr_diag}, \"{remarquable}\", \"{fk_revetement}\", {index_stadedev}, \"{identifiant}\", {index_nomtech}, {index_port}, {index_villeca}, {index_pied}, {index_feuillage}, {index_situation}, {index_arb_etat}, {index_secteur}, {index_quartier});\n")
