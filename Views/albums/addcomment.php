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
            <td>Comment text</td>
            <td>
                <input type="text"
                       name="comment" />
            </td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <input type="submit"
                       name="create"
                       value="Create comment"
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
