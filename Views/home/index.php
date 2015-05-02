<main>
    <h1 id="section-rating-albums" class="text-center">Most highly ranked albums</h1>
    <div class="col-md-12 albums-container">
    </div>
</main>
<div>
    <?php foreach ($this->albums as $album): ?>
        <div class="row col-md-12 album-container">
            <div class="col-md-3">
                <h3 class="album-title">
                    <a href="<?= $this->url('albums', 'show', ['album' => $album->getId()]); ?>"><?= $album->getName(); ?></a>
                </h3>
            </div>
            <div class="col-md-3">
                <h3 class="album-title">
                    <a href="<?= $this->url('categories', 'show', ['name' => $album->getCategory()->getName()]); ?>"> Category: <?= $album->getCategory()->getName(); ?></a>
                </h3>
            </div>
            <?php if($album->getPictures()): ?>
                <ul>
                    <?php foreach ($album->getPictures() as $picture): ?>
                        <div class="col-md-3">
                            <h3 class="album-title"></h3>
                        </div>
                        <div class="col-md-3">
                            <img class="img-responsive" src="<?= $picture->getUrl(); ?>" alt="picture">
                        </div>
                        <?php break; ?>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <div class="col-md-3">
                    <img class="img-responsive" src="http://placehold.it/400x300&text=No%20image" alt="picture">
                </div>
            <?php endif; ?>
            <div class="col-md-3">
                <span>
                    <a class="btn btn-primary btn-m" href="<?= $this->url('albums', 'addvote', [ 'album' => $album->getId()]);?>">
                        Vote
                    </a>
                </span>
                <span>
                    <a class="btn btn-primary btn-m" href="<?= $this->url('albums', 'addcomment', [ 'album' => $album->getId()]);?>">
                        Comment
                    </a>
                </span>
            </div>
        </div>
    <?php endforeach; ?>
</div>


