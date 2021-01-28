<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <meta http-equiv="refresh" content="5; URL=http://192.168.0.3/cliente/">

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
      $response = file_get_contents('http://192.168.0.3/servidor/conexiones/select.php');
      
      $response = json_decode($response);
      $temperatura =  $response[0][1];
      $pulso = $response[1][1];
      $respiracion = $response[2][1];
    ?>
    <nav class="navbar navbar-expand-lg navbar-info bg-info">
      <div class="container-fluid">
        <a class="navbar-brand" id="logo" href="#"
          ><img src="img/baby-icon.png" width="20%"
        /></a>
        <div class="collapse navbar-collapse" id="navbarNav">
          
        </div>
      </div>
    </nav>

    <section class="container" >
      <div class="row d-flex align-items-between mt-5" style="display:flex; justify-content:space-between ;">
        <div class="col-lg-4 col-sm-12 ">
          <div class="card" style="width: 18rem">
            <img src="img/temperature-icon.png" class="card-img-top" alt="..." />
            <div class="card-body text-center">
              <h5 class="card-title">Temperatura</h5>
              <p class="card-text">
                <?php echo ($temperatura." °") ?>
              </p>
              <?php 
              echo '<a href="http://192.168.0.3/cliente/registro.php?idSensor='.$response[0][0].'" class="btn btn-primary">Últimos registros</a>'
               ?>
              
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12">
          <div class="card" style="width: 18rem">
            <img src="img/pulse-icon.png" class="card-img-top" alt="..." />
            <div class="card-body text-center">
              <h5 class="card-title">Pulso</h5>
              <p class="card-text">
               <?php echo ($pulso." bpm") ?>
              </p>
              <?php 
              echo '<a href="http://192.168.0.3/cliente/registro.php?idSensor='.$response[1][0].'" class="btn btn-primary">Últimos registros</a>'
               ?>
            </div>
          </div>
        </div>
        <div class="col-lg-4 ">
          <div class="card" style="width: 18rem">
            <img src="img/baby-happy-icon.jpg" class="card-img-top" alt="..." />
            <div class="card-body text-center">
              <h5 class="card-title">Respiración</h5>
              <p class="card-text">
                <?php echo ($respiracion." respiraciones/min") ?>
              </p>
              <?php 
              echo '<a href="http://192.168.0.3/cliente/registro.php?idSensor='.$response[2][0].'" class="btn btn-primary">Últimos registros</a>'
               ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
