<!DOCTYPE html>
<html>
<?php include 'view/header.php'; ?>
<?php session_start(); ?>



<body>
<main>
    <p><a href="http://www.jtemerson.net">jtemerson.net</a></p>
    <div class="container">
        <h1>Recipe List</h1>

        <?php if (!empty($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php
        }
        ?>

        <form action="." method="post">
            <input type="hidden" name="action" value="Logout">
            <input type="submit" value="Logout" class="btn btn-primary">
        </form>
            <br>
        <form>
            <input type="hidden" name="action" value="recipe_list_admin">
            <input type="submit" value="Admin" class="btn btn-primary">
        </form>

        <aside>
            <!-- display a list of categories -->
            <h2>Categories</h2>
            <nav class="col-md-3">
                <div class="list-group">
            <?php foreach ($categories as $category) : ?>
                    <a href="?action=category&category_id=<?php echo $category['category_id']; ?>" class="list-group-item">
                    <?php echo $category['category_name']; ?>
                </a>
            <?php endforeach; ?>
            </div>
            </nav>
        </aside>

        <section>
            <!-- display a table of recipes -->
            <table class="table table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                    </tr>
                <thead>
                <tbody>
                    <?php foreach ($recipes as $recipe) : ?>
                    <tr>
                        <td><?php echo $recipe['recipe_id']; ?></td>
                        <td><?php echo $recipe['recipe_name']; ?></td>

                        <!-- See Recipe Button -->
                        <td>
                            <form action="." method="post">
                                <input type="hidden" name="action" value="recipe_display">
                                <input type="hidden" name="category_id" value="<?php echo $recipe['category_id']; ?>">
                                <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipe_id']; ?>">
                                <input type="hidden" name="recipe_name" value="<?php echo $recipe['recipe_name']; ?>">
                                <input type="hidden" name="recipe_ingredients" value="<?php echo $recipe['recipe_ingredients']; ?>">
                                <input type="hidden" name="recipe_instructions" value="<?php echo $recipe['recipe_instructions']; ?>">
                                <input type="hidden" name="recipe_notes" value="<?php echo $recipe['recipe_notes']; ?>">
                                <input type="submit" value="See Recipe" class="btn btn-primary"><br><br><br>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</main>
</body>
<html>
