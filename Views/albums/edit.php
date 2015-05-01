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
            <td>Category name</td>
            <td>
                <input type="text"
                       name="categoryName"
                       value="<?= $this->category; ?>"/>
            </td>
        </tr>
        <tr>
            <td>Album description</td>
            <td>
                <input type="text"
                       name="description"
                       value="<?= $this->description; ?>"/>
            </td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <input type="submit"
                       name="edit"
                       value="Edit album"
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
