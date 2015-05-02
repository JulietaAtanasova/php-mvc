<form action="" method="POST">
    <table border="1">
        <tr>
            <td>Picture name</td>
            <td>
                <input type="text"
                       name="name"
                       value="<?= $this->picture ?>"/>
            </td>
        </tr>
        <tr>
            <td>Picture description</td>
            <td>
                <input type="text"
                       name="description"
                       value= "<?= $this->description ?>" />
            </td>
        </tr>
        <tr>
            <td>Picture url</td>
            <td>
                <input type="text"
                       name="url"
                       value= "<?= $this->url ?>"/>
            </td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <input type="submit"
                       name="edit"
                       value="Edit picture"
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
