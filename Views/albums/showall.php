<?php /** @var \PhotoAlbum\Models\Album $album*/ ?>
<ul>
    <?php foreach ($this->albums as $album):  ?>
        <li>Album: <?= $album->getName(); ?>,
            Category: <?= $album->getCategory()->getName(); ?>,
            User: <?= $album->getUser()->getUsername();?></li>
        <?php if($album->getComments()): ?>
            <ul>
                <?php foreach ($album->getComments() as $comment): ?>
                <li>Comment text: <?= $comment->getText(); ?>,
                    User: <?= $comment->getUser()->getUsername(); ?>,
                    Created On: <?= date_format($comment->getCreatedOn(), 'j-F-Y'); ?>
                    <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <?php if($album->getVotes()): ?>
                <ul>
                <?php foreach ($album->getVotes() as $vote): ?>
                        <li>Rate: <?= $vote->getRate() ?> </li>
                <?php endforeach; ?>
                </ul>
        <?php endif; ?>
        <?php if($album->getPictures()): ?>
        <ul>
            <?php foreach ($album->getPictures() as $picture): ?>
                <li>Picture name: <?= $picture->getName(); ?>,
                    Url: <?= $picture->getUrl() ?>,
                    Description: <?= $picture->getDescription(); ?>,
                    Created On: <?= date_format($picture->getCreatedOn(), 'j-F-Y'); ?>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>

