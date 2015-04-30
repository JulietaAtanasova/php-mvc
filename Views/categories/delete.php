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
            <tr>
                <td>Error</td>
                <td>
                    <font color="red">
                        <?= $this->error; ?>
                    </font>
                </td>
            </tr>
        <?php endif; ?>
    </table>
</form>
