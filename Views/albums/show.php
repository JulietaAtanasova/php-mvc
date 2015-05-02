<?php /** @var \PhotoAlbum\Models\Album $album*/ ?>

<p>Album: <?= $this->name ?></p>
<p>Category: <?= $this->category ?></p>
<p>User: <?= $this->user ?> </p>
<p>Description: <?= $this->description ?></p>
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
<p>Rating: <?= $this->rating ?></p>
<p>Pictures: </p>
<?php if($this->pictures): ?>
<ul>
    <?php foreach ($this->pictures as $picture): ?>
        <li>Picture name: <?= $picture->getName(); ?>,
            Description: <?= $picture->getDescription(); ?>,
            Created On: <?= date_format($picture->getCreatedOn(), 'j-F-Y'); ?>
        <img src="<?= $picture->getUrl() ?>" alt="picture">
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<?php if($this->error): ?>
    <p>Error:
        <font color="red">
            <?= $this->error; ?>
        </font>
    </p>
<?php endif; ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $this->name ?></h1>
    </div>

    <?php if($this->pictures): ?>
        <?php foreach ($this->pictures as $picture): ?>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <h4><?= $picture->getName(); ?></h4>
                <a class="thumbnail" href="">
                    <img class="img-responsive" src="<?= $picture->getUrl() ?>" alt="picture">
                </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
