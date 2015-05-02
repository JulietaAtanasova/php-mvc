<div class="col-md-8 col-md-offset-2">
    <div class="well bs-component">
        <form action="" method="POST" id="login-form" class="form-horizontal" >
            <fieldset>
                <legend>Search</legend>
                <div class="control-group">
                    <div class="col-lg-10 controls">
                        <input class="form-control"
                               id="inputUserName"
                               required=""
                               type="text"
                               name="text"
                               placeholder="Search in categories and album">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10">
                        <input type="submit" name="search" value="Search">
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
            </fieldset>
        </form>
    </div>

    <?php if($this->isSearching): ?>
    <div class="row">
        <div class="col-lg-4">
            <div class="bs-component">
                <ul class="list-group">
                    <?php if($this->categories): ?>
                        <?php foreach ($this->categories as $category): ?>
                            <li class="list-group-item">
                                <span class="badge"><?= count($category->getAlbums()); ?></span>
                                <a href="<?= $this->url('albums', 'show', ['album' => $category->getId()]); ?>" >
                                    Category: <?=  $category->getName(); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if($this->albums): ?>
                        <?php foreach ($this->albums as $album): ?>
                            <li class="list-group-item">
                                <span class="badge"><?= count($album->getPictures()); ?></span>
                                <a href="<?= $this->url('albums', 'show', ['album' => $album->getId()]); ?>" >
                                    Album: <?= $album->getName(); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>