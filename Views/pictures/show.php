<?php /** @var \PhotoAlbum\Models\Picture $picture*/ ?>
<ul>
    <?php foreach ($this->pictures as $picture): ?>
        <li>Picture name: <?= $picture->getName(); ?>,
            Url: <?= $picture->getUrl() ?>,
            Album: <?= $picture->getAlbum()->getName(); ?>,
            Description: <?= $picture->getDescription(); ?>,
            Created On: <?= date_format($picture->getCreatedOn(), 'j-F-Y'); ?>,
            User: <?= $picture->getAlbum()->getUser()->getUsername(); ?></li>
        <?php if($picture->getComments()):  ?>
        <ul>
            <?php foreach ($picture->getComments() as $comment): ?>
            <li>Comment text: <?= $comment->getText(); ?>,
                User: <?= $comment->getUser()->getUsername(); ?>,
                Created On: <?= date_format($comment->getCreatedOn(), 'j-F-Y'); ?>
                <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>