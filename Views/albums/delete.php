<form action="" method="POST">
    <table border="1">
        <tr>
            <td>Album name</td>
            <td><?= $this->album; ?></td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <input type="submit"
                       name="delete"
                       value="Delete album"
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
