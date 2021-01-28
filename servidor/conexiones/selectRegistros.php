<?php 
	$hostname="localhost";
	$username="root";
	$password="";
	$dbname="monitorBebe";
	$usertable="datos";
	
	
	$conn = mysqli_connect($hostname,$username, $password) or die ("html>script language='JavaScript'>alert('¡No es posible conectarse a la base de datos! Vuelve a intentarlo más tarde.'),history.go(-1)/script>/html>");
	mysqli_select_db($conn, $dbname);

	$idSensor = $_GET['idSensor'];
	$sql = "SELECT * FROM `datos`  
				INNER JOIN sensor ON sensor.id = datos.idSensor 
				where idSensor = ".$idSensor."  ORDER BY datos.id DESC";
	

				
	
	$result = $conn->query($sql);
	

	$array = array();

	if ($result->num_rows > 0) {
  // output data of each row
  $contador=0;
  $estado = "Saludable";
  while($row = $result->fetch_assoc()) {
    $contador++;
    $estado = "Saludable";
    switch ($idSensor) {
    	case '1':
    		# Temperatura...36.5 y 37.5
    		if ($row['valor'] > 37.5) {
    			$estado = "Temperatura alta";
    		}elseif ($row['valor'] < 36.5) {
    			$estado = "Temperatura baja";
    		}
    		break;
    	case '2':
    		# Pulso...80 y 120
    		if ($row['valor'] > 120) {
    			$estado = "Pulso alto";
    		}elseif ($row['valor'] < 80) {
    			$estado = "Pulso bajo";
    		}
    		break;
    	case '3':
    		# Respiracion...40 y 60
    		if ($row['valor'] > 60) {
    			$estado = "Respiracion acelerada";
    		}elseif ($row['valor'] < 40) {
    			$estado = "Respiracion lenta";
    		}
    		break;
    		
    	default:
    		# code...
    		break;
    }
    $deepArray = array($contador, $row['hora'], $row['valor'], $estado);

    array_push($array, $deepArray);
  }
}



 
     echo json_encode($array);

     return $array;

	$conn->close();

	?>