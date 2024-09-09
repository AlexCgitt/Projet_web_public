<?php
$servername = "localhost";
#$username = "etu1105";
#$password = private; not in the public repo
#$dbname = "etu1105";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

$sql = "SELECT latitude, longitude FROM Arbre";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {echo "0 résultats";}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
