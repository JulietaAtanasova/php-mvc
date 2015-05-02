<?php /** @var \PhotoAlbum\Models\Album $album*/ ?>
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

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= $this->name ?>
            <?php if($this->isOwner): ?>
                <span>
                    <a class="btn btn-primary btn-m" href="<?= $this->url('pictures', 'add', ['album' => $this->album->getId()])?>">
                        Add Picture
                    </a>
                </span>
            <?php endif; ?>
        </h1>
        <a href="<?= '/photoalbum/categories/show/name/'. $this->category ?>"> Category: <?= $this->category ?></a>
        <?php if($this->description): ?>
            <h4 class="page-header">Description: <?= $this->description ?></h4>
        <?php endif; ?>
        <h4 class="page-header">User: <?= $this->user ?></h4>
    </div>

    <?php if($this->pictures): ?>
        <?php foreach ($this->pictures as $picture): ?>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <h4><?= $picture->getName(); ?></h4>
                <a class="thumbnail" href="<?= $this->url('pictures', 'show',['picture' => $picture->getId()])?>">
                    <img class="album-image-avatar" src="<?= $picture->getUrl(); ?>" alt="picture">
                </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="class="row col-md-12 album-container"">
    <p>Created On: <?= $this->createdOn ?></p>
    <p>Comments:</p>
    <?php if($this->comments): ?>
        <ul>
            <?php foreach ($this->comments as $comment): ?>
            <li>Comment text: <?= $comment->getText(); ?>,
                User: <?= $comment->getUser()->getUsername(); ?>,
                Created On: <?= date_format($comment->getCreatedOn(), 'j-F-Y'); ?>
                <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <p>Rating: <?= round($this->rating, 2) ?></p>
    <div class="col-md-3">
        <span>
            <a class="btn btn-primary btn-m" href="<?= '/photoalbum/albums/addvote/album/'. $this->album->getId();?>">
                Vote
            </a>
        </span>
        <span>
            <a class="btn btn-primary btn-m" href="<?= '/photoalbum/albums/addcomment/album/'. $this->album->getId();?>">
                Comment
            </a>
        </span>
    </div>
</div>
