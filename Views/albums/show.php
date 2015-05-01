<?php /** @var \PhotoAlbum\Models\Album $album*/ ?>
<ul>
    <?php foreach ($this->albums as $album): ?>
        <li>Album: <?= $album->getName(); ?>,
            Category: <?= $album->getCategory()->getName(); ?>,
            User: <?= $album->getUser()->getUsername();?></li>
        <?php if($album->getPictures()): ?>
        <ul>
            <?php foreach ($album->getPictures() as $picture): ?>
                <li>Picture name: <?= $picture->getName(); ?>,
                    Url: <?= $picture->getUrl() ?>,
                    Description: <?= $picture->getDescription(); ?>,
                    Created On: <?= date_format($picture->getCreatedOn(), 'j-F-Y'); ?>,
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>