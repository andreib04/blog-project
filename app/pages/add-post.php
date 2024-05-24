<?php 
    if(!empty($_POST))
    {
      //validate
      $errors = [];

      if(empty($_POST['title']))
      {
        $errors['title'] = "A title is required";
      }

      if(empty($_POST['category_id']))
      {
        $errors['category_id'] = "A category is required";
      }

      //validate image
      $allowed = ['image/jpeg','image/png','image/webp'];
      if(!empty($_FILES['image']['name']))
      {
        $destination = "";
        if(!in_array($_FILES['image']['type'], $allowed))
        {
          $errors['image'] = "Image format not supported";
        }else
        {
          $folder = "uploads/";
          if(!file_exists($folder))
          {
            mkdir($folder, 0777, true);
          }

          $destination = $folder . time() . $_FILES['image']['name'];
          move_uploaded_file($_FILES['image']['tmp_name'], $destination);
          resize_image($destination);
        }

      }else{
        //$errors['image'] = "A featured image is required";
      }

      $slug = str_to_url($_POST['title']);

      $query = "SELECT id from posts where slug = :slug limit 1";
      $slug_row = query($query, ['slug'=>$slug]);

      if($slug_row)
      {
        $slug .= rand(1000,9999);
      }


      if(empty($errors))
      {
        $new_content = remove_images_from_content($_POST['content']);
        
        //save to database
        $data = [];
        $data['title']        = $_POST['title'];
        $data['content']      = $new_content;
        $data['category_id']  = $_POST['category_id'];
        $data['slug']         = $slug;
        $data['user_id']      = user('id');

        $query = "INSERT into posts (title,content,slug,category_id,user_id) values (:title,:content,:slug,:category_id,:user_id)";
        
        if(!empty($destination))
        {
          $data['image']     = $destination;
          $query = "INSERT into posts (title,content,slug,category_id,user_id,image) values (:title,:content,:slug,:category_id,:user_id,:image)";
        }

        query($query, $data);

        redirect('home');

      }
    }
?>

<?php
    include '../app/pages/includes/header.php';
?>

<div class="col-md-6 mx-auto my-5">
  <form method="post" enctype="multipart/form-data">

    <h1 class="h3 mb-3 fw-normal">Create post</h1>

    <?php if (!empty($errors)):?>
      <div class="alert alert-danger">Please fix the errors below</div>
    <?php endif;?>

    <div class="my-2">
        <label class="d-block">
            <img class="mx-auto d-block image-preview-edit" src="<?=get_image('')?>" style="cursor: pointer;width: 150px;height: 150px;object-fit: cover;">
            <input onchange="display_image_edit(this.files[0])" type="file" name="image" class="d-none">
        </label>
        <?php if(!empty($errors['image'])):?>
          <div class="text-danger"><?=$errors['image']?></div>
        <?php endif;?>

        <script>
            
            function display_image_edit(file)
            {
                document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
            }
        </script>
    </div>


    <div class="form-floating">
      <input value="<?=old_value('title')?>" name="title" type="text" class="form-control mb-2" id="floatingInput" placeholder="Username">
      <label for="floatingInput">Title</label>
    </div>
      <?php if(!empty($errors['title'])):?>
      <div class="text-danger"><?=$errors['title']?></div>
      <?php endif;?>

    
      <div class="">
            <textarea row="8" for="floatingInput" placeholder="Content" name="content" type="content" class="form-control mb-2" id="floatingInput"><?=old_value('content')?></textarea>
      </div>
      <?php if(!empty($errors['content'])):?>
      <div class="text-danger"><?=$errors['content']?></div>
      <?php endif;?>

    <div class="form-floating my-3">
      <select name="category_id" class="form-select">

          <?php  

              $query = "select * from categories order by id desc";
            $categories = query($query);
          ?>
          <option value="">--Select--</option>
          <?php if(!empty($categories)):?>
              <?php foreach($categories as $cat):?>
                  <option <?=old_select('category_id',$cat['id'])?> value="<?=$cat['id']?>"><?=$cat['category']?></option>
              <?php endforeach;?>
          <?php endif;?>

      </select>
      <label for="floatingInput">Category</label>
    </div>
      <?php if(!empty($errors['category'])):?>
      <div class="text-danger"><?=$errors['category']?></div>
      <?php endif;?>

    <a href="<?=ROOT?>/home">
        <button class="mt-4 btn btn-lg btn-primary" type="button">Back</button>
    </a>
    <button class="mt-4 btn btn-lg btn-primary float-end" type="submit">Create</button>
   
  </form>
</div>

<script src="<?=ROOT?>/assets/js/jquery.js"></script>

<?php
    include '../app/pages/includes/footer.php';
?>

