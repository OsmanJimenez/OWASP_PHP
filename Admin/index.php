<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}else if (empty($sessData)) {
  header("Location:../");
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


  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Default</li>
                </ol>
              </nav>
            </div>
          </div>
          <!-- Card stats -->
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="card">
          <form action="entry.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <h5 class="card-title">Nueva entrada</h5>
              <br>
              <h3 class="card-title">Titulo</h3>
              <input type="text" name="title" class="form-control" placeholder="Digite un titulo">
              <br>
              <h3 class="card-title">Descripción</h3>
              <br>
              <textarea id="summernote" required name="message" placeholder="Digite una descripción"></textarea>
              <br>
              <h2>Imagen</h2>
              <div class="custom-file">
                <input type="file" name="img" class="custom-file-input" id="customFileLang" lang="es">
                <label class="custom-file-label" for="customFileLang">Elegir archivo</label>
              </div>
              <br>
              <br>
              <div class="container">
                <div class="row">
                  <div class="col-sm">
                  </div>
                  <div class="col-sm">
                  </div>
                  <div class="col-sm text-right">
                    <button name="entrySubmit" class="btn btn-primary">Guardar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
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

  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
  <!-- SummerNote JS -->
  <script>
    $('#summernote').summernote({
      codeviewFilter: false,
      codeviewIframeFilter: true,
      height: 300,
      width: 900,
      minHeight: null,
      maxHeight: null,
      focus: true,
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
      ]
    })
  </script>
</body>

</html>