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
