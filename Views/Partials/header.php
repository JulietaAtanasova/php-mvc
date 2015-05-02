<link rel="stylesheet" type="text/css" href="<?= $this->root; ?>Views/css/style.css">
<link rel="stylesheet" type="text/css" href="<?= $this->root; ?>Views/css/bootstrap-social.css">
<link rel="stylesheet" type="text/css" href="<?= $this->root; ?>Views/css/journal-bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?= $this->root; ?>Views/css/thumbnail-gallery.css">
<link rel="stylesheet" type="text/css" href="<?= $this->root; ?>Views/css/customStyle.css">

<div class="container">

<div class="jumbotron">
    <h1>Photo albums</h1>
    <h4>
        <?= $this->welcomeMessage; ?>
        <span>
            <a class="btn btn-primary btn-m" href="<?= $this->url('users', $this->buttonAction);?>"><?= $this->button; ?></a>
        </span>

        <?php if($this->canRegister): ?>
        <span>
            <a class="btn btn-primary btn-m" href="<?= $this->url('users', 'register');?>">Register</a>
        </span>
        <?php endif; ?>
    </h4>

</div>