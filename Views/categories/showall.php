<?php /** @var \PhotoAlbum\Models\Category $category */ ?>

<div>
    <p></p>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="bs-component">
            <ul class="list-group">
                <?php foreach ($this->categories as $category): ?>
                <li class="list-group-item">
                    <span class="badge"><?= count($category->getAlbums()); ?></span>
                    <a href="<?= '/photoalbum/categories/show/name/' . $category->getName() ?>" >
                        <?= $category->getName(); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div>
        </div>
    </div>
</div>