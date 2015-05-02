<div class="bs-component">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav">
                    <li><a href="/photoalbum/home">Home </a></li>
                    <li><a href="<?= $this->url('albums', 'showall'); ?>">Albums</a></li>
                    <li><a href="<?= $this->url('categories', 'showall'); ?>">Categories</a></li>
                    <li><a href="<?= $this->url('home', 'search'); ?>">Search</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?= $this->url('users', $this->buttonAction);?>"><?= $this->button; ?></a></li>
                </ul>
                <?php if($this->canRegister): ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?= $this->url('users', 'register');?>">Register</a></li>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div id="source-button" class="btn btn-primary btn-xs" style="display: none;" >&lt; &gt;</div>
</div>