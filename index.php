<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ATOMIX</title>
  <!-- Favicon -->
  <link rel="icon" type="image/png"  href="img/favicon.ico">
  <!-- Font Awesome -->
  <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/1.0.0/mdb.min.css" rel="stylesheet" />
  <!-- style -->
  <link href="css/style.css" rel="stylesheet" />
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Navbar brand -->
      <a class="navbar-brand" href="index.html">ATOMIX</a>

      <!-- Toggle button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left links -->
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0 ">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="login.php">Iniciar Sesión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="registration.php">Registrarse</a>
          </li>

        </ul>
      </div>
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->

  <!--Main-->
  <div class="container ">
    <?php 
include 'Admin/forum.php';
$forum= new Forum();
$condition['where'] = array('users.id' => 'forum.user' );
$forumData= $forum->getRows($condition);

if($forumData){
foreach ($forumData as $col) {
$url=$forum->encode($col['id']);
?>
    <div class="row justify-content-center centro">
      <div class="col-sm">
        <a href="post.php?m=<?php echo $url; ?>">
          <div class="card mb-8 ">
            <div class="row g-0 ">
              <div class="col-md-4 bordes">
                <img src="<?php echo $col['img']; ?>" style="width: 100%; height: 210px;" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $col['title']; ?></h5>
                  <p class="card-text"><?php echo $col['entry']; ?></p>
                  <div class="row align-items-end">
                    <div class="col">
                    </div>
                    <div class="col">
                    </div>
                    <div class="col text-right">
                      <button type="button" class="btn btn-success btn-floating">
                        <i class="fas fa-share-alt"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
<?php }} ?>

  </div>

  <!-- Footer -->
  <footer>
    <div class="text-center p-3" style="background-color: rgba(251, 251, 251, 0.15);">
      © 2020 Copyright:
      <a class="text-dark" href="https://mdbootstrap.com/">ATOMIX</a>
    </div>

  </footer>
  <!-- Footer -->

</body>
<script type="text/javascript" src="js/mdb.min.js"></script>

</html>