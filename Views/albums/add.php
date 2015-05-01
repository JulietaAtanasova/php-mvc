<form action="" method="POST">
    <table border="1">
        <tr>
            <td>Album name</td>
            <td>
                <input type="text"
                       name="name" />
            </td>
        </tr>
        <tr>
            <td>Category name</td>
            <td>
                <input type="text"
                       name="categoryName" />
            </td>
        </tr>
        <tr>
            <td>Album description</td>
            <td>
                <input type="text"
                       name="description" />
            </td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <input type="submit"
                       name="create"
                       value="Create album"
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
