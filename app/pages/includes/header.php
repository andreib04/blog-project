<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="<?=ROOT?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=ROOT?>/assets/css/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="<?=ROOT?>/home" class="nav-link px-2 text-secondary">Home</a></li>
          <li>
            <span class="nav-link px-2 link-dark dropdown text-end">
              <a href="#" class="d-block <?=$url[0] =='category' ? 'link-primary':'link-primary'?> text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Category
              </a>
              <ul class="dropdown-menu text-small">
               
               <?php  

                  $query = "select * from categories order by id desc";
                  $categories = query($query);
                ?>
                <?php if(!empty($categories)):?>
                  <?php foreach($categories as $cat):?>
                    <li><a class="dropdown-item" href="<?=ROOT?>/category/<?=$cat['slug']?>"><?=$cat['category']?></a></li>
                  <?php endforeach;?>
                <?php endif;?>
              </ul>
            </span>
          </li>
        </ul>

        <form action="<?=ROOT?>/search" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <div class="input-group">
            <input value="<?=$_GET['find'] ?? ''?>" name="find" type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
            <button class="btn btn-primary">Go</button>
          </div>
        </form>

        <?php if(logged_in()): ?>
          <div class="flex-shrink-0 dropdown">
              <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?=get_image(user('image'))?>" alt="mdo" style="object-fit: cover;" width="32" height="32" class="rounded-circle">
              </a>
              <ul class="dropdown-menu text-small shadow">
                <li><a class="dropdown-item" href="#">Hi, <?=user('username')?></a></li>
                <li><a class="dropdown-item" href="<?=ROOT?>/add-post">Add new post</a></li> <!-- TODO ADD POST -->
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?=ROOT?>/logout">Sign out</a></li>
              </ul>
          </div>
        <?php endif; ?>

        <?php if(!logged_in()): ?>
          <div class="ms-3 btn btn-light">
            <a class="text-decoration-none text-dark" href="<?=ROOT?>/login">LOGIN</a>
          </div>
        <?php endif; ?>
      </div>
      </div>
    </div>
  </header>