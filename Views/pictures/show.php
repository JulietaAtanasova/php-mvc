<?php /** @var \PhotoAlbum\Models\Picture $picture*/ ?>
<ul>
    <?php foreach ($this->pictures as $picture): ?>
        <li>Picture name: <?= $picture->getName(); ?>,
            Url: <?= $picture->getUrl() ?>,
            Album: <?= $picture->getAlbum()->getName(); ?>,
            Description: <?= $picture->getDescription(); ?>,
            Created On: <?= date_format($picture->getCreatedOn(), 'j-F-Y'); ?>,
            User: <?= $picture->getAlbum()->getUser()->getUsername(); ?></li>
    <?php endforeach; ?>
</ul>