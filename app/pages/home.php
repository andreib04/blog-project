<?php
  include '../app/pages/includes/header.php';
?>

<?php
  include '../app/pages/includes/slider.php';
?>
<main class="mx-auto col-md-10">
    <div class="container">
        <div class="row my-2 justify-content-center">
            <?php
             $limit = 10;
             $offset = ($PAGE['page_number'] - 1) * $limit;     

            $query = "SELECT posts.*, categories.category FROM posts JOIN categories on posts.category_id = categories.id ORDER by id ASC limit $limit offset $offset";
            $rows = query($query);

            if ($rows) {
                foreach ($rows as $row) {
                    include '../app/pages/includes/post-card.php';
                }
            } else {
                echo "No posts available";
            }
            ?>
        </div>
    </div>

    <div class="col-md-12 mb-4">
    <a href="<?=$PAGE['first_link']?>">
        <button class="btn btn-primary">First Page</button>
    </a>
    <a href="<?=$PAGE['prev_link']?>">
        <button class="btn btn-primary">Prev Page</button>
    </a>
    <a href="<?=$PAGE['next_link']?>">
        <button class="btn btn-primary float-end">Next Page</button>
    </a>
</div>
</main>

<?php
  include '../app/pages/includes/footer.php';
?>

