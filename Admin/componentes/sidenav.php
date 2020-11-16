<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="/Admin/index.php">
          <img src="assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <?php if($sessData['permits']!="1" ):?>
            <li class="nav-item">  
              <a class="nav-link active" href="index.php">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Agregar Publicación</span>
              </a>
            </li>
          <?php endif ?>
            <li class="nav-item">
              <a class="nav-link" href="publication.php">
                <i class="ni ni-planet text-orange"></i>
                <span class="nav-link-text">Listar Publicaciones</span>
              </a>
            </li>
            <?php if ($sessData['permits']=="1111"): ?>
            <li class="nav-item">
              <a class="nav-link" href="config.php">
                <i class="ni ni-pin-3 text-primary"></i>
                <span class="nav-link-text">Configuración</span>
              </a>
            </li>
            <?php endif ?>
            <li class="nav-item">
              <a class="nav-link" href="perfil.php">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Perfil</span>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
        </div>
      </div>
    </div>
  </nav>