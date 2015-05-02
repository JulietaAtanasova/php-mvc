<?php /** @var \PhotoAlbum\Models\Picture $picture*/ ?>
<div class="album-container">
    <p>Picture name: <?= $this->picture->getName(); ?></p>
    <img class="album-container" src="<?= $this->picture->getUrl(); ?>">
    <p>Album: <?= $this->picture->getAlbum()->getName(); ?></p>
        <p>Description: <?= $this->picture->getDescription(); ?></p>
        <p>Created On: <?= date_format($this->picture->getCreatedOn(), 'j-F-Y'); ?></p>
       <p>User: <?= $this->picture->getAlbum()->getUser()->getUsername(); ?></p>
    <?php if($this->picture->getComments()):  ?>
    <ul>
        <?php foreach ($this->picture->getComments() as $comment): ?>
        <li>Comment text: <?= $comment->getText(); ?>,
            User: <?= $comment->getUser()->getUsername(); ?>,
            Created On: <?= date_format($comment->getCreatedOn(), 'j-F-Y'); ?>
            <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <p>Rating: <?= round($this->rating, 2); ?></p>
    <div class="container">
        <span>
            <a class="btn btn-primary btn-m" href="<?= '/photoalbum/pictures/addvote/picture/'. $this->picture->getId();?>">
                Vote
            </a>
        </span>
        <span>
            <a class="btn btn-primary btn-m" href="<?= '/photoalbum/pictures/addcomment/picture/'. $this->picture->getId();?>">
                Comment
            </a>
        </span>
        <?php if($this->isAdmin): ?>
            <span>
                    <a class="btn btn-primary btn-m" href="<?= $this->url('pictures', 'edit', ['picture' => $this->picture->getId()])?>">
                        Edit
                    </a>
                </span>
            <span>
                    <a class="btn btn-primary btn-m" href="<?= $this->url('pictures', 'delete', ['picture' => $this->picture->getId()])?>">
                        Delete
                    </a>
                </span>
        <?php endif; ?>
    </div>
</div>

<?php if($this->error): ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Error</h3>
        </div>
        <div class="panel-body">
            <?= $this->error; ?>
        </div>
    </div>
<?php endif; ?>