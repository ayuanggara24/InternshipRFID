?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_daerah";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM `provinsi` WHERE `id_kab`= :id";  //This is where I specify what data to query
$result = mysqli_query($conn, $sql);

$data = array();
while($enr = mysqli_fetch_assoc($result)){
    $a = array($enr['nama'], $enr['id_prov']);
    array_push($data, $a);
}

echo json_encode($data);

?>