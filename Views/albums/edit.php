<form action="" method="POST">
    <table border="1">
        <tr>
            <td>Album name</td>
            <td>
                <input type="text"
                       name="name"
                       value="<?= $this->album; ?>"/>
            </td>
        </tr>
        <tr>
            <td>Category name</td>
            <td>
                <input type="text"
                       name="categoryName"
                       value="<?= $this->category; ?>"/>
            </td>
        </tr>
        <tr>
            <td>Album description</td>
            <td>
                <input type="text"
                       name="description"
                       value="<?= $this->description; ?>"/>
            </td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <input type="submit"
                       name="edit"
                       value="Edit album"
                    />
            </td>
        </tr>
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
    </table>
</form>
