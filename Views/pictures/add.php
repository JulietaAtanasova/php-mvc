<form action="" method="POST">
    <table border="1">
        <tr>
            <td>Album name</td>
            <td>
                <input type="text"
                       name="album"
                       value="<?= $this->album ?>"/>
            </td>
        </tr>
        <tr>
            <td>Picture name</td>
            <td>
                <input type="text"
                       name="name" />
            </td>
        </tr>
        <tr>
            <td>Picture description</td>
            <td>
                <input type="text"
                       name="description" />
            </td>
        </tr>
        <tr>
            <td>Picture url</td>
            <td>
                <input type="text"
                       name="url" />
            </td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <input type="submit"
                       name="create"
                       value="Create picture"
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
