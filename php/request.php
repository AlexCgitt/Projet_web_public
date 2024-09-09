<?php
require_once('Database.php');

$requestMethod = $_SERVER['REQUEST_METHOD'];
$request = substr($_SERVER['PATH_INFO'], 1);
$request = explode('/', $request);
$requestRessource = array_shift($request);

$id = array_shift($request);
if ($id == '')
    $id = NULL;
$result = null;

$db = Database::connexionDB();
if (!$db) {
    header('HTTP/1.1 503 Service Unavailable');
    exit;
}

switch ($requestRessource) {
    case "arbres":
        switch($requestMethod){
            case "GET":
                $result= dbRequestArbres($db) ;
                break;
        }
        break;
    case "age":
        switch($requestMethod){
            case "GET":
                $result = dbRequestArbre($db, $id);
                $tab = Array(Array("id_arbre" => $result["id_arbre"], "haut_tot" => $result["haut_tot"], "haut_tronc" => $result["haut_tronc"], "tronc_diam" => $result["tronc_diam"], "clc_nbr_diag" => $result["clc_nbr_diag"], "fk_nomtech" => $result["nomtech"], "fk_stadedev" => $result["nom_stadedev"]));
                
                $fp = fopen('../python/age.json', 'w');
                fwrite($fp, json_encode($tab));
                fclose($fp);

                $result = shell_exec("python ../python/script_age.py ../python/age.json");
                echo $result;
                exit(0);

            }
        break;          
}

if (!empty($result)) {
    
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('HTTP/1.1 200 OK');
    echo json_encode($result);
    exit();
    
}

// Bad request case.
header('HTTP/1.1 400 Bad Request');
?>    