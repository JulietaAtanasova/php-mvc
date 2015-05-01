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
            <td>Rate</td>
            <td>
                <input type="text"
                       name="rate"
                       placeholder="Number between 0 and 10"/>
            </td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <input type="submit"
                       name="vote"
                       value="Vote"
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
