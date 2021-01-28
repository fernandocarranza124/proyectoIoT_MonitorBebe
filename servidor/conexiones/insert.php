<?php 
	$hostname="localhost";
	$username="root";
	$password="";
	$dbname="monitorBebe";
	$usertable="datos";
	
	
	$conn = mysqli_connect($hostname,$username, $password) or die ("html>script language='JavaScript'>alert('¡No es posible conectarse a la base de datos! Vuelve a intentarlo más tarde.'),history.go(-1)/script>/html>");
	mysqli_select_db($conn, $dbname);
	/*
	echo $_GET['idSensor'];
	echo $_GET['certificado'];
	echo $_GET['valor'];
	echo $_GET['hora'];
*/
	

	$sql = "SELECT sensorKey FROM sensor WHERE id=".$_GET['idSensor'];
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$sensorKey =  $row['sensorKey'];



	$firma = $sensorKey.''.$_GET['hora'];
	
	$certificado =   (md5($firma));

	if ($certificado == $_GET['certificado']) {
		$sql = "INSERT INTO datos (idSensor, certificado, valor,hora)
			VALUES ('".$_GET['idSensor']."', '".$_GET['certificado']."', '".$_GET['valor']."', '".$_GET['hora']."')";
			$result = $conn->query($sql);
			echo "New record created successfully";
	}
	$conn->close();

/*

	


	if ($conn->query($sql) === TRUE) {
  		
	} else {
  		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	
*/
	?>