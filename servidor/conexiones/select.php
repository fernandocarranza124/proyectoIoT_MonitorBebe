<?php 
	$hostname="localhost";
	$username="root";
	$password="";
	$dbname="monitorBebe";
	$usertable="datos";
	
	
	$conn = mysqli_connect($hostname,$username, $password) or die ("html>script language='JavaScript'>alert('¡No es posible conectarse a la base de datos! Vuelve a intentarlo más tarde.'),history.go(-1)/script>/html>");
	mysqli_select_db($conn, $dbname);
	$sqlTemperatura = "SELECT * FROM `datos`  
				INNER JOIN sensor ON sensor.id = datos.idSensor 
				where idSensor = 1  ORDER BY datos.id DESC LIMIT 1";
	$sqlPulsoCardiaco = "SELECT * FROM `datos` 
				INNER JOIN sensor ON sensor.id = datos.idSensor
				where idSensor = 2 ORDER BY datos.id DESC LIMIT 1";
	$sqlRespiracion = "SELECT * FROM `datos` 
				INNER JOIN sensor ON sensor.id = datos.idSensor
				where idSensor = 3 ORDER BY datos.id DESC LIMIT 1";

				
	
	$resultTemperatura = $conn->query($sqlTemperatura);
	$resultPulsoCardiaco = $conn->query($sqlPulsoCardiaco);
	$resultRespiracion = $conn->query($sqlRespiracion);

	$array = array();

	if ($resultTemperatura->num_rows > 0) {
  // output data of each row
  while($row = $resultTemperatura->fetch_assoc()) {
    
    $deepArray = array($row['idSensor'], $row['valor']);

    array_push($array, $deepArray);
  }
}
	if ($resultPulsoCardiaco->num_rows > 0) {
  // output data of each row
  while($row = $resultPulsoCardiaco->fetch_assoc()) {
    
    $deepArray = array($row['idSensor'], $row['valor']);

    array_push($array, $deepArray);
  }
}
	if ($resultRespiracion->num_rows > 0) {
  // output data of each row
  while($row = $resultRespiracion->fetch_assoc()) {
    
    $deepArray = array($row['idSensor'], $row['valor']);

    array_push($array, $deepArray);
  }
}



 
     echo json_encode($array);

     return $array;

	$conn->close();

	?>