<form action="" method="POST">
    <table border="1">
        <tr>
            <td>Category name</td>
            <td>
                <input type="text"
                       name="name" />
            </td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <input type="submit"
                       name="create"
                       value="Create category"
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
