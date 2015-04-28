<?php /** @var \PhotoAlbum\Models\Category $category */ ?>
<ul>
<?php foreach ($this->categories as $category): ?>
    <li><?= $category->getName(); ?></li>
<?php endforeach; ?>
</ul>