<?php

require_once("Constantes.php");
//----------------------------------------------------------------------------
//--- dbConnect --------------------------------------------------------------
//----------------------------------------------------------------------------
// Create the connection to the database.
// \return False on error and the database otherwise.
class Database {
    static $db=null;
    static function connexionDB()
    {
        if (self::$db != null) {
            return self::$db;
        }

        try {
            $db = new PDO(
                "mysql:dbname=".DB_NAME.";host=".DB_SERVER.";port=".DB_PORT,
                DB_USER,
                DB_PASSWORD);
            $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
        }
        catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }

        self::$db = $db;
        return $db;
    }
}

//----------------------------------------------------------------------------
//--- dbRequestPolls ---------------------------------------------------------
//----------------------------------------------------------------------------
// Function to get the polls.
// \param db The connected database.
// \return The list of polls titles.
function dbRequestArbres($db)
{
    try {
        $request = 'SELECT a.id_arbre, a.longitude, a.latitude, a.haut_tot, a.haut_tronc, a.tronc_diam, a.clc_nbr_diag, a.remarquable, a.revetement, a.identifiant , ae.nom_arbreetat, f.nom_feuillage, nt.nomtech, pi.nom_pied, po.nom_port, q.nom_quartier, se.nom_secteur, si.nom_situation, sd.nom_stadedev, vc.nom_villeca
        FROM Arbre a
        JOIN ArbreEtat ae ON a.id_arbreetat = ae.id_arbreetat
        JOIN Feuillage f ON a.id_feuillage = f.id_feuillage
        JOIN NomTech nt ON a.id_nomtech = nt.id_nomtech
        JOIN Pied pi ON a.id_pied = pi.id_pied
        JOIN Port po ON a.id_port = po.id_port
        JOIN Quartier q ON a.id_quartier = q.id_quartier
        JOIN Secteur se ON a.id_secteur = se.id_secteur
        JOIN Situation si ON a.id_situation = si.id_situation
        JOIN Stadedev sd ON a.id_stadedev = sd.id_stadedev
        JOIN Villeca vc ON a.id_villeca = vc.id_villeca
        ORDER BY a.id_arbre ASC
        ';

        $statement = $db->prepare($request);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log('Request error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

function dbRequestArbre($db, $id_arbre){
    try {
        $request = 'SELECT a.id_arbre, a.haut_tot, a.haut_tronc, a.tronc_diam, a.clc_nbr_diag, nt.nomtech, sd.nom_stadedev
        FROM Arbre a
        JOIN NomTech nt ON a.id_nomtech = nt.id_nomtech 
        JOIN Stadedev sd ON a.id_stadedev = sd.id_stadedev
        WHERE a.id_arbre = :id_arbre';
        
        $statement = $db->prepare($request);
        $statement->bindParam(':id_arbre', $id_arbre);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log('Request error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

function dbAddArbres($db, $longitude ,$latitude, $haut_tot, $haut_tronc, $tronc_diam, $clc_nbr_diag, $remarquable, $revetement, $nom_stadedev, $identifiant, $nomtech, $nom_port, $nom_villeca, $nom_pied, $nom_feuillage, $nom_situation, $nom_arbreetat,$nom_secteur,$nom_quartier){

    try {
        $id_stadedev = "SELECT id_stadedev FROM Stadedev WHERE nom_stadedev = '$nom_stadedev'";
        $id_nomtech = "SELECT id_nomtech FROM Nomtech WHERE nomtech = '$nomtech'";
        $id_port = "SELECT id_port FROM Port WHERE nom_port = '$nom_port'";
        $id_villeca = "SELECT id_villeca FROM Villeca WHERE nom_villeca = '$nom_villeca'";
        $id_pied = "SELECT id_pied FROM Pied WHERE nom_pied = '$nom_pied'";
        $id_feuillage = "SELECT id_feuillage FROM Feuillage WHERE nom_feuillage = '$nom_feuillage'";
        $id_situation = "SELECT id_situation FROM Situation WHERE nom_situation = '$nom_situation'";
        $id_arbreetat = "SELECT id_arbreetat FROM ArbreEtat WHERE nom_arbreetat = '$nom_arbreetat'";
        $id_secteur = "SELECT id_secteur FROM Secteur WHERE nom_secteur = '$nom_secteur'";
        $id_quartier = "SELECT id_quartier FROM Quartier WHERE nom_quartier = '$nom_quartier'";

        $request = 'INSERT INTO Arbre (longitude, latitude, haut_tot, haut_tronc, tronc_diam, clc_nbr_diag, remarquable, revetement, id_stadedev, identifiant, id_nomtech, id_port, id_villeca, id_pied, id_feuillage, id_situation, id_arbreetat, id_secteur, id_quartier) VALUES (:longitude, :latitude, :haut_tot, :haut_tronc, :tronc_diam, :clc_nbr_diag, :remarquable, :revetement, :id_stadedev, :identifiant, :id_nomtech, :id_port, :id_villeca, :id_pied, :id_feuillage, :id_situation, :id_arbreetat, :id_secteur, :id_quartier)';
        $statement = $db->prepare($request);
        $statement->bindParam(':longitude', $longitude);
        $statement->bindParam(':latitude', $latitude);
        $statement->bindParam(':haut_tot', $haut_tot);
        $statement->bindParam(':haut_tronc', $haut_tronc);
        $statement->bindParam(':tronc_diam', $tronc_diam);
        $statement->bindParam(':clc_nbr_diag', $clc_nbr_diag);
        $statement->bindParam(':remarquable', $remarquable);
        $statement->bindParam(':revetement', $revetement);
        $statement->bindParam(':id_stadedev', $id_stadedev);
        $statement->bindParam(':identifiant', $identifiant);
        $statement->bindParam(':id_nomtech', $id_nomtech);
        $statement->bindParam(':id_port', $id_port);
        $statement->bindParam(':id_villeca', $id_villeca);
        $statement->bindParam(':id_pied', $id_pied);
        $statement->bindParam(':id_feuillage', $id_feuillage);
        $statement->bindParam(':id_situation', $id_situation);
        $statement->bindParam(':id_arbreetat', $id_arbreetat);
        $statement->bindParam(':id_secteur', $id_secteur);
        $statement->bindParam(':id_quartier', $id_quartier);
        $statement->execute();
    }
    catch (PDOException $exception) {
        error_log('Connection error: '.$exception->getMessage());
        return false;
    }
}
?>