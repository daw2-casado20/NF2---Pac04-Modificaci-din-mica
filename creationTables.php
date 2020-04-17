<?php

//update_last_activity.php

require('abstract.databoundobject.php');
require('mapping.php');
require('class.pdofactory.php');

$conexion = mysqli_connect('localhost', 'adri', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($conexion, 'buscador') or die(mysqli_error($conexion));

$letra = $_POST['valorCaja1'];
 
$sql = "SELECT * FROM search WHERE paraula = '$letra'";

$result = mysqli_query($conexion, $sql) or die (mysqli_error($conexion));

while ($row =mysqli_fetch_assoc($result)) {
$ids = $row['id'];
} 
if (isset($ids)) {
	$sql1 = "SELECT * FROM search  WHERE paraula LIKE '$letra%' ORDER BY total DESC LIMIT 5;";
	$result1 = mysqli_query($conexion, $sql1) or die (mysqli_error($conexion));
	echo "
   <table
    style border=1>
    <tr>
     <th>ID</th>
     <th>Palabra</th>
     <th>Total de busquedas</th>
     <th>Ultima busqueda</th>
    </tr>";

while ($row = mysqli_fetch_assoc($result1)) {
//$row = mysqli_fetch_assoc($result1);
//extract($row);

 	$id = $row['id'];
    $paraula = $row['paraula'];
    $total = $row['total'];
    $lastvisit = $row['lastvisit'];

echo "
 <tr>
      <td>$id</td>
      <td>$paraula</td>
      <td>$total</td>
      <td>$lastvisit</td>
    </tr>";
}
}
?>

