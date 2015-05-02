<form action="" method="POST">
    <table border="1">
        <tr>
            <td>Category name</td>
            <td><?= $this->category; ?></td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <input type="submit"
                       name="delete"
                       value="Delete category"
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
