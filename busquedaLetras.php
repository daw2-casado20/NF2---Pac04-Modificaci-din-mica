<?php

//update_last_activity.php

require('abstract.databoundobject.php');
require('mapping.php');
require('class.pdofactory.php');

$conexion = mysqli_connect('localhost', 'adri', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($conexion, 'buscador') or die(mysqli_error($conexion));
$current_timestamp0 = strtotime(date("Y-m-d H:i:s") . '- 10 second');
$current_timestamp0 = date('Y-m-d H:i:s', $current_timestamp0);
$letra = $_POST['valorCaja1'];
 
$sql = "SELECT * FROM search WHERE paraula = '$letra'";

$result = mysqli_query($conexion, $sql) or die (mysqli_error($conexion));

while ($row =mysqli_fetch_assoc($result)) {
$ids = $row['id'];
} 
if (isset($ids)) {
	$sql1 = "SELECT * FROM search  WHERE paraula LIKE '$letra%' ORDER BY total DESC LIMIT 5;";
	$result1 = mysqli_query($conexion, $sql1) or die (mysqli_error($conexion));
	while ($row =mysqli_fetch_assoc($result1)) {
		$topBusquedas[] = $row['paraula'];
	} 
	$response['uno'] = $topBusquedas[0];
	$response['dos'] = $topBusquedas[1];
	$response['tres'] = $topBusquedas[2];
	$response['cuatro'] = $topBusquedas[3];
	$response['cinco'] = $topBusquedas[4];
	echo json_encode($response);
	//$SectionArray = $topBusquedas[0], $topBusquedas[1], $topBusquedas[2], $topBusquedas[3], $topBusquedas[4];
	$sql = "UPDATE search SET total = total + 1 WHERE id = '$ids'";
	$result = mysqli_query($conexion, $sql) or die (mysqli_error($conexion));
	$sql2 = "UPDATE search SET lastvisit = '$current_timestamp0' WHERE id = '$ids'";
	$result2 = mysqli_query($conexion, $sql2) or die (mysqli_error($conexion));
}else{
	$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
	$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
	echo $current_timestamp;
	$sql = "INSERT INTO search (paraula, total, lastvisit) VALUES ('$letra', 0, '$current_timestamp')";
	$result = mysqli_query($conexion, $sql) or die (mysqli_error($conexion));
}



/*$strDSN = "pgsql:dbname=buscador;host=localhost;port=5432;user=postgres;password=";
        $objPDO = PDOFactory::GetPDO($strDSN, "buscador", "", 
            array());
        $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $reps=0;
        for ($cont=1; $cont < 5; $cont++) { 
        	$objUser = new Search($objPDO, $cont);
        	$letra[$cont] = $objUser->getparaula();
			$objUser->gettotal();
			$objUser->getlastvisit();
			echo $objUser->getID();
			unset($objUser);
        }
        for ($cont2=1; $cont2 < 5; $cont2++) { 
	        if ($letra[$cont2] != $_POST['valorCaja1']) {
					$reps++;
			}
		}
		if($reps==4){
			$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
		 	$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
			$objUser2 = new Search($objPDO);
			$objUser2->setparaula($_POST['valorCaja1']);
			$objUser2->settotal(0);
			$objUser2->setlastvisit($current_timestamp);
			$objUser2->Save();
			unset($objUser2);
		}
*/
		/*$det = new Search($objPDO, $_SESSION["login_details_id"]);
		$det->setis_type($_POST["is_type"]);
		$det->Save();*/
//print_r($_POST);
//$query = "SELECT * FROM search WHERE paraula= ".$letra." ";

/*$objUser->setparaula("Hola");
$objUser->settotal(23);
$objUser->setlastvisit("2001-09-28 01:00:00");
$objUser->Save();

        $id = $objUser->getID();
        
        
        unset($objUser);



        <?php
    if(conficion){
        $data['message'] = "correcto";
    }else{
        $data['message'] = "error";
    }

    echo json_encode($data);

?>

Podrías evaluarlo en el cliente, mediante ajax, de esta manera:

$.ajax({  
    url:"archivo.php",  
    method:"POST",  

    data:
    {
        //================
    },
    dataType:"json",  
    success:function(data)  
    {  
        if(data.message == "correcto"){
            // Sentencias...
        }
        if(data.message == "error"){
            // Sentencias...
        }
    }  
});*/
?>
