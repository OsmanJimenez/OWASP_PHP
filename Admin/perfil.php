<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>
<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Administración</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="../css/estilos2.css">
</head>

<body>
  <?php
          include '../user.php';
          include 'forum.php';
          $user = new User();
          $forum= new Forum();
          $conditions['where'] = array(
              'id' => $sessData['userID'],
          );
          $conditions['return_type'] = 'single';
          $userData = $user->getRows($conditions);
          $conditionsf['where']= array(
              'forum.user'=>'users.id',
              'users.id'=>$sessData['userID']
          );
          $conditionsf['return_type']='count';
          $forumData= $forum->getRows($conditionsf);
         
  ?>
  <!-- Sidenav -->
  <?php
    include 'componentes/sidenav.php';
  ?>

  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->

    <?php
      include 'componentes/topnav.php';
    ?>

    <!-- Header -->
    <div class="header pb-6 d-flex align-items-center"
      style="min-height: 500px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hola <?php echo $userData['first_name']; ?></h1>
            <p class="text-white mt-0 mb-5">Esta es tu página de perfil. Puede ver el progreso que ha logrado con su
              trabajo y administrar sus proyectos o tareas asignadas</p>
            <a href="#!" class="btn btn-neutral">Editar perfil</a>
          </div>
        </div>
      </div>
    </div>


    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="assets/img/theme/team-4.png" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="assets/img/theme/team-4.png" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info  mr-4 ">Nueva</a>
                <a href="#" class="btn btn-sm btn-default float-right">Todas</a>
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center">
                    <div>
                    </div>
                    <div>
                      <span class="heading"><?php echo $forumData ?></span>
                      <span class="description">Publicaciones</span>
                    </div>
                    <div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h5 class="h3">
                  <?php echo $userData['first_name'].' '.$userData['last_name']; ?><span class="font-weight-light">,
                    27</span>
                </h5>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>Fusagasugá, Colombia
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Administrador del Sistemas
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>Universidad de Cundinamarca
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Editar perfil </h3>
                </div>
                <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Configuración</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="POST" action="../userAccount.php">
                <h6 class="heading-small text-muted mb-4">Información</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Correo Electronico</label>
                        <input type="email" id="input-email" required name="email" class="form-control"
                          placeholder="jesse@example.com" value="<?php echo $userData['email']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" required for="input-first-name">Nombre</label>
                        <input type="text" name="name" required minlength="5" id="input-first-name" class="form-control"
                          pattern="[a-zA-Z ]{5}" required title="Compruebe el nombre" placeholder="First name"
                          value="<?php echo $userData['first_name']; ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Apellido</label>
                        <input type="text" name="ape" required pattern="[a-zA-Z ]{5}" required
                          title="Compruebe el apellido " class="form-control" placeholder="Last name"
                          value="<?php echo $userData['last_name']; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Información de Contacto</h6>
                <div class="pl-lg-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="phone">Telefono</label>
                        <input id="phone" type="number" class="form-control" required pattern="{7}[0-9]" required
                          title="Compruebe el Telefono" required name="phone" placeholder="Home Address"
                          value="<?php echo $userData['phone']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 text-right">
                    <button type="submit" name="pefSubmit" class="btn btn-sm btn-primary">Guardar</button>
                  </div>
              </form>
            </div>
            <hr class="my-4" />
            <!-- Description -->
            <div class="container" id="formulario">
              <form method="POST" action="../userAccount.php">
                <h6 class="heading-small text-muted mb-4">Cambio de Contraseña</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="formulario__grupo" id="grupo__password">
                        <div class="formulario__grupo-input">
                          <label class="form-control-label" for="input-first-name">Contraseña Actual</label>
                          <input type="password" name="pass1" id="password2" required class="formulario__input">
                          <i class="formulario__validacion-estado">
                            <span class="fas fa-eye" id="ver2" onclick="mostrar2()"></span>
                          </i>
                        </div>

                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="formulario__grupo" id="grupo__password">
                        <div class="formulario__grupo-input">
                          <label class="form-control-label" for="input-last-name">Nueva Contraseña</label>
                          <input type="password" minlength="12" name="pass2" id="password" required
                            class="formulario__input">
                          <i class="formulario__validacion-estado ">
                            <span class="fas fa-eye" id="ver" onclick="mostrar()"></span>
                          </i>
                        </div>
                        <p class="formulario__input-error">La contraseña debe tener mas de 12 caracteres.
                        </p>
                        <div class="nivelSeguridad">
                          <span id="nivelseguridad">bajo</span>
                          <input type="hidden" id="nivels" name="nivel">
                          <div class="nivelesColores">
                            <div class="spanNivelesColores"></div>
                          </div>
                          <div class="NivelesColores"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 text-right">
                  <button name="passSubmit" class="btn btn-sm btn-primary">Guardar</button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <?php
        include 'componentes/footer.php';
      ?>
  </div>


  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
  <!-- JS Propios -->
  <script src="../js/fontawesome.min.js" crossorigin="anonymous"></script>
  <!-- Control de contraseñas -->
  <script src='../js/visualizar.js'></script>
  <!-- Medidor -->
  <script src='../js/medidor.js'></script>
  <script type="text/javascript">
    document.getElementById('password').onkeypress = function () {
      document.getElementById('nivels').value = document.getElementById('nivelseguridad').innerHTML;
    }
  </script>
</body>

</html>