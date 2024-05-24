<?php 
  if(!logged_in()){
    redirect('login');
  }

  $section = $url[1] ?? 'dashboard';
  $action = $url[2] ?? 'view';
  $id = $url[3] ?? 0;

  $filename = "../app/pages/admin/".$section.".php";
  if(!file_exists($filename)){
      $filename = "../app/pages/404.php";
  }

  if($section == 'users')
  {
    require_once "../app/pages/admin/users-controller.php";
  }
  else if($section == "categories")
  {
    require_once "../app/pages/admin/categories-controller.php";
  }
  else if($section == "posts")
  {
    require_once "../app/pages/admin/posts-controller.php";
  }
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Dashboard</title>


<link href="<?=ROOT?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?=ROOT?>/assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>

<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Admin</a>

  <div class="mx-5 dropdown">
              <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?=get_image(user('image'))?>" alt="mdo" style="object-fit: cover;" width="32" height="32" class="rounded-circle">
              </a>
              <ul class="dropdown-menu text-small shadow">
                <li><a class="dropdown-item" href="#">Hi, <?=user('username')?></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?=ROOT?>/logout">Sign out</a></li>
              </ul>
          </div>
  <div id="navbarSearch" class="navbar-search w-100 collapse">
    <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
      <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link px-3" href="<?=ROOT?>/admin">
                <i class="bi bi-speedometer"></i>
                Dashboard
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link px-3" aria-current="page" href="<?=ROOT?>/admin/users">
                <i class="bi bi-person"></i>
                Users
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link px-3" aria-current="page" href="<?=ROOT?>/admin/categories">
                <i class="bi bi-tags"></i>
                Categories
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link px-3" aria-current="page" href="<?=ROOT?>/admin/posts">
                <i class="bi bi-file-earmark-text-fill"></i>
                Posts
              </a>
            </li>
          </ul>

          <hr class="my-3">

          <ul class="nav flex-column mb-auto">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="<?=ROOT?>/home">
              <i class="bi bi-map"></i>
                Go to blog app
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="<?=ROOT?>/logout">Sign out</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>
        <?php
            require_once ($filename);
          
        ?>
    </main>
  </div>
</div>
<script src="<?=ROOT?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?=ROOT?>/assets/js/dashboard.js"></script>

</body>

</html>
