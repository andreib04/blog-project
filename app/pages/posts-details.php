<?php
  include '../app/pages/includes/header.php';
?>

<main class="mx-auto col-md-10">
    <div class="container">
        <div class="row my-2 justify-content-center">
            <?php
           
            $id = $url[1] ?? null;

            if($id){
                $query = "SELECT posts.*, categories.category FROM posts JOIN categories on posts.category_id = categories.id WHERE posts.id = :id limit 1";
                $row= query_row($query, ['id'=>$id]);
            }
            

            if (!empty($row)) { ?>
                <div class="container mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title"><?= esc($row['title']) ?></h1>
                            <img class="card-img-top" width="100%" height="500" src="<?= get_image($row['image']) ?>" alt="Card image cap">
                            <h6 class="card-subtitle mb-2 my-2 text-danger"><?= esc($row['category'] ?? 'Unknown') ?> <span class="badge badge-secondary">Category Name</span></h6>
                            <p class="card-text"><?= esc(substr($row['content'], 0, 200)) ?></p>
                            <p class="text-muted"><?= date("jS M, Y", strtotime($row['date'])) ?></p>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

            <?php
            } else {
                echo "No posts available";
            }
            ?>
        </div>
    </div>

</main>

<?php
  include '../app/pages/includes/footer.php';
?>

