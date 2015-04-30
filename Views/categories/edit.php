<form action="" method="POST">
    <table border="1">
        <tr>
            <td>Category name</td>
            <td>
                <input type="text"
                       name="name"
                       value="<?= $this->category; ?>"/>
            </td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <input type="submit"
                       name="edit"
                       value="Edit category"
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
