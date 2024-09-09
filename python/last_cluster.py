import pandas as pd
from sklearn.cluster import KMeans
import mysql.connector

# by emir
# Connexion à la base de données MySQL
conn = mysql.connector.connect(
    host="localhost",
    user="etu1105",
    #password=private, not in the public repo
    database="etu1105"
)

# Préparation de la requête SQL pour le Clustering
query = "SELECT haut_tot, haut_tronc, tronc_diam FROM Arbre"
cursor = conn.cursor(dictionary=True)
cursor.execute(query)
data = pd.DataFrame(cursor.fetchall())

# Clustering KMeans
col_data = data[['haut_tot', 'haut_tronc', 'tronc_diam']]
kmeans = KMeans(n_clusters=5, random_state=42)
data['cluster'] = kmeans.fit_predict(col_data)

# Préparation de la requête SQL pour séléctionner le dernier arbre de la table Arbre
last_tree = "SELECT haut_tot, haut_tronc, tronc_diam FROM Arbre ORDER BY id_arbre DESC"
cursor.execute(last_tree)
data_last = pd.DataFrame(cursor.fetchall())
print(data_last.iloc[0])

# Fonction qui catégorise les arbres selon leur cluster
def categorize(row, stats):
    if row['cluster'] == stats.loc[2, 'cluster']:
        return 'petit'
    elif row['cluster'] == stats.loc[0, 'cluster']:
        return 'petit'
    elif row['cluster'] == stats.loc[3, 'cluster']:
        return 'moyen'
    elif row['cluster'] == stats.loc[1, 'cluster']:
        return 'grand'
    elif row['cluster'] == stats.loc[4, 'cluster']:
        return 'grand'
    else:
        return 'inconnu'

# Déterminer les catégories (petit, moyen, grand)
stats = data.groupby('cluster')[['haut_tot', 'haut_tronc', 'tronc_diam']].mean().reset_index()
data['category'] = data.apply(lambda row: categorize(row, stats), axis=1)
# print(stats, "\n", data['category'].value_counts())

# Fonction qui détermine le cluster de l'arbre ajouté
def new_tree(tree):
    tree_df = pd.DataFrame([tree], columns=['haut_tot', 'haut_tronc', 'tronc_diam'])
    new_cluster = kmeans.predict(tree_df)[0]
    new_category = categorize(pd.Series({'cluster': new_cluster}), stats)
    return new_cluster, new_category

# Calcul du cluster du dernier arbre
tree = data_last.iloc[0]
cluster, category = new_tree(tree)
print(f"Le nouvel arbre appartient au cluster {cluster} et est catégorisé comme {category}.")

conn.close()