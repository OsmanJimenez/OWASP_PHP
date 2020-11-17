<?php 
include 'log.php';
$log= new Log();
$conditions['where'] = array(
              'user' => $sessData['userID']
          );
$conditions['order_by']='date desc';
$conditions['limit']='5';
$conditions['return_type'] = 'all';
          $consult = $log->getRows($conditions);

 
 ?>

<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Buscar" type="text">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-bell-55"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                <!-- Dropdown header -->
                <div class="px-3 py-3">
                  <h6 class="text-sm text-muted m-0">Tu tienes <strong class="text-primary">5</strong> notificaciones.</h6>
                </div>
                <!-- List group -->
                <?php      foreach ($consult as $eve) { ?>
                <div class="list-group list-group-flush">
                  <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <!-- Avatar -->
                        <img alt="Image placeholder" src="assets/img/theme/team-1.jpg" class="avatar rounded-circle">
                      </div>
                      <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h4 class="mb-0 text-sm"><?php echo $userData['first_name'].' '.$userData['last_name']; ?></h4>
                          </div>
                          <div class="text-right text-muted">
                            <small><?php echo $eve['date']; ?></small>
                          </div>
                        </div>
                        <p class="text-sm mb-0"><?php echo $eve['des']; ?></p>
                      </div>
                    </div>
                  </a>
                </div>
              <?php } ?>
                <!-- View all -->
                <a href="cambios.php" class="dropdown-item text-center text-primary font-weight-bold py-3">Ver todas</a>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="assets/img/theme/team-4.png">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $userData['first_name'].' '.$userData['last_name']; ?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Bienvenido!</h6>
                </div>
                <a href="perfil.php" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>Mi perfil</span>
                </a>
                <a href="config.php" class="dropdown-item">
                  <i class="ni ni-settings-gear-65"></i>
                  <span>Configuración</span>
                </a>
                <a href="cambios.php" class="dropdown-item">
                  <i class="ni ni-calendar-grid-58"></i>
                  <span>Log de Cambios</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="../userAccount.php?logoutSubmit=1" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Cerrar Sesión</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>