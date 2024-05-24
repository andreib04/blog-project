<?php

if(!empty($_POST))
{
  
  $errors = [];

  $query = "SELECT * FROM users WHERE email = :email limit 1";
  $row = query($query, ['email'=>$_POST['email']]);

  if($row)
  {
    $user_id = $row['id'];
    $user_email = $row[0]['email'];
    $user_password = $row[0]['password'];
    $user_role = $row[0]['role'];

    $data = [];
    if(password_verify($_POST['password'], $user_password))
    {
      authenticate($row[0]);
  
      if($user_role === 'admin')
      {
        redirect('admin');
      }
      else
      {
        redirect('home');
      }
    }else
    {
      $errors['email'] = "Wrong email or password";
    }
  }
  else
  {
    $errors['email'] = "Wrong email or password";
  }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Login</title>
  
    <link href="<?=ROOT?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="<?=ROOT?>/assets/css/sign-in.css" rel="stylesheet">
  </head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">

<div class="form-signin w-100 m-auto shadow">
  <form method="post">
    <h1 class="h3 mb-3 fw-normal">Sign in</h1>

    <?php if(!empty($errors['email'])):?>
      <div class="alert alert-danger">
        <?=$errors['email']?>
      </div>
    <?php endif;?>

    <div class="form-floating">
      <input value="<?=old_value('email')?>" name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    
    <div class="form-floating">
      <input value="<?=old_value('password')?>" name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="my-2">Don't have an account?<a href="<?=ROOT?>/signup"> Sign up here</a></div>
    <div class="form-check text-start my-3">
      <input name="remember" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Remember me
      </label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
    
    <p class="d-flex justify-content-center mt-5 mb-3 text-muted">&copy; <?=date("Y")?></p>
    
    <div class="d-flex justify-content-center">
      <a href="<?=ROOT?>/home">
        <button class="btn btn-primary mt-3">Home</button>
      </a>
    </div>
    
</form>
</div>
<script src="../<?=ROOT?>/assets/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
