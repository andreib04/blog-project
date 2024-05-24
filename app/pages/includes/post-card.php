<div class="col-md-6 col-lg-2 mb-4">
    <div class="card shadow-sm h-100">
        <img class="card-img-top" height="200" src="<?= get_image($row['image']) ?>" alt="Card image cap">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= esc($row['title']) ?></h5>
            <p class="card-text"><?= esc(substr($row['content'], 0, 50)) ?>...</p>
            <a href="<?= ROOT ?>/posts-details/<?= $row['id'] ?>" class="btn btn-primary mt-auto">Continue reading...</a>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <small class="text-muted"><?= date("jS M, Y", strtotime($row['date'])) ?></small>
            <small class="text-danger"><?= esc($row['category'] ?? 'Unknown') ?></small>
        </div>
    </div>
</div>
