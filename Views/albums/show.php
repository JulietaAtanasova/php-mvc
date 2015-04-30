<?php /** @var \PhotoAlbum\Models\Album $album*/ ?>
<ul>
    <?php foreach ($this->albums as $album): ?>
        <li>Album: <?= $album->getName(); ?>, Category: <?= $album->getCategory()->getName(); ?>, User: <?= $album->getUser()->getUsername() ?></li>
    <?php endforeach; ?>
</ul>