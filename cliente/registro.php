<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
    <title>MONITOR SIGNOS VITALES</title>
  </head>
  <body>
    <script src="/javascripts/application.js" type="text/javascript" charset="utf-8" async defer>
      setTimeout(function(){
      window.location.reload(1);
      }, 5000);
    </script>
    <?php 
      $response = file_get_contents('http://192.168.0.3/servidor/conexiones/selectRegistros.php?idSensor='.$_GET['idSensor']);
      
      $response = json_decode($response);
      header( "refresh:5;url=http://192.168.0.3/cliente/registro.php?idSensor=".$_GET['idSensor']);

      
      

      ?>
    <nav class="navbar navbar-expand-lg navbar-info bg-info">
      <div class="container-fluid">
        <a class="navbar-brand" id="logo" href="#"
          ><img src="img/baby-icon.png" width="20%"
        /></a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav" style="padding-left: 85%">
            <li class="nav-item">
              <a
                class="nav-link active nav-bar-text"
                aria-current="page"
                href="http://192.168.0.3/cliente/"
                >Monitor</a
              >
            </li>
            
          </ul>
        </div>
      </div>
    </nav>

    <section class="container">
      <div
        class="row d-flex align-items-between mt-5"
        style="display: flex; justify-content: space-between"
      >
        <div class="col-lg-12">
          <table class="table">

            <thead>
              <tr>
                <th scope="col"># Registro</th>
                <th scope="col">Hora</th>
                <th scope="col">Valor</th>
                <th scope="col">Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              for ($i=0; $i <count($response) ; $i++) { 
                echo "<tr>";
                echo "<th scope=row'>".$response[$i][0]."</th>";
                echo "<td>".$response[$i][1]."</td>";
                echo "<td>".$response[$i][2]."</td>";
                echo "<td>".$response[$i][3]."</td>";
                echo "</tr>";
              }
               ?>
              
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </body>
</html>
