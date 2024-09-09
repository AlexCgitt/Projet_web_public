import pandas as pd
import numpy as np
import json
import pickle
import argparse  # Importez argparse pour la gestion des arguments de ligne de commande

def estimate_age(data_json, model_user ):

    with open("../pkl/dict_modeles.pkl", "rb") as f:
        pkl_dict = pickle.load(f)
        #print(pkl_dict.keys())
    
    with open(data_json, "r") as f:
        data = f.read()

    scaler_X = pkl_dict["scaler_X"]
    scaler_Y = pkl_dict["scaler_Y"]
    model = pkl_dict[model_user]
    encoder_stadedev = pkl_dict["encoder_stadedev"]
    encoder_nomtech = pkl_dict["encoder_nomtech"]

    df = pd.DataFrame(json.loads(data))
    X = df[['tronc_diam','haut_tronc', 'haut_tot', 'clc_nbr_diag', 'fk_stadedev', 'fk_nomtech']]

    # print("O:",ordinal.categories_)
    # print("L:",label.classes_)

    X['fk_stadedev']=pd.DataFrame(encoder_stadedev.transform(X[['fk_stadedev']]))
    X['fk_nomtech'] = pd.DataFrame(encoder_nomtech.transform(X[['fk_nomtech']]))

    X = scaler_X.transform(X)

    pred = model.predict(X) 

    pred = pred.reshape(-1, 1)
    pred = scaler_Y.inverse_transform(pred)
    
    age_estimated = pd.DataFrame(pred, columns=['age_estim'])
    
    age_estimated_json = age_estimated.to_json(orient='records')
    return age_estimated_json


parser = argparse.ArgumentParser(description="Estimation de l'âge à partir d'un fichier JSON.")

parser.add_argument('file_json', type=str, default="Data_Arbre_test.json", help='Chemin vers le fichier JSON contenant les données pour l\'estimation.')

args = parser.parse_args()
models = ["RandomForest", "DecisionTree", "KNN", "Hist"]
age_dict = {}
for model in models:
    age_estimated_json = estimate_age(args.file_json, model)
    age_estimated = json.loads(age_estimated_json)
    model_age = int(age_estimated[0]['age_estim'])
    age_dict[model] = model_age

age_json = json.dumps(age_dict)
print(age_json)

# with open("age_estimated.json", "w") as f:
#     f.write(age_json)