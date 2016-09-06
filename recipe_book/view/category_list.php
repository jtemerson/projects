<!DOCTYPE html>
<html>
<?php include 'view/header.php'; ?>
<?php session_start(); ?>
<body>
    <main>
        <p><a href="http://www.jtemerson.net">jtemerson.net</a></p>
        <div class="container">

            <?php if (!empty($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } // end if ?>

            <h1>Category List</h1>

            <table class="table table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?php echo $category['category_name']; ?></td>

                        <!-----Delete Button------------>
                        <td>
                            <form action="." method="post">
                                <input type="hidden" name="action" value="delete_category" />
                                <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>"/>
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2>Add Category</h2>
            <form id="add_category_form" action="." method="post">
                <input type="hidden" name="action" value="add_category" />

                <div class="form-group">
                    <label class="control-label col-md-1">Name:</label>
                    <div class="col-md-4">
                        <input type="text" name="category_name" />
                        <input type="submit" value="Add" class="btn btn-success">
                    </div>
                </div>
            </form>
            <br><br>
            <p><a href="index.php?action=recipe_list_admin" class="btn btn-link">List Recipes</a></p>
        <div>
    </main>
</body>
</html>
