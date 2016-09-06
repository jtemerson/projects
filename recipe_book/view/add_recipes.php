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
            <?php
            }
            ?>

            <h1>Add Recipe</h1>

            <form action="." method="post" id="add_recipe_form">
                <input type="hidden" name="action" value="add_recipe">

                <label>Category:</label><br>
                <select name="category_id">
                <?php foreach ( $categories as $category ) : ?>
                    <option value="<?php echo $category['category_id']; ?>">
                        <?php echo $category['category_name']; ?>
                    </option>
                <?php endforeach; ?>
                </select>
                <br><br>

                <label>Name:</label><br>
                    <input type="text" name="recipe_name" class="form-control" placeholder="Enter Recipe Name"><br>

                    <label>Ingredients:</label><br>
                    <label>(Use a "-" for each bullet in a bulleted list)</label>
                    <textarea rows="10" cols="100" name="recipe_ingredients" class="form-control" placeholder="Enter Ingredients"></textarea>
                    <br>

                    <label>Instructions:</label><br>
                    <label>(Use a "#" for each number in a numbered list)</label>
                    <textarea rows="10" cols="100" name="recipe_instructions" class="form-control" placeholder="Enter Instructions"></textarea>
                    <br>

                    <label>Notes:</label><br>
                    <label>(Not Required)</label><br>
                    <textarea rows="10" cols="100" name="recipe_notes" class="form-control" placeholder="Enter Notes"></textarea>
                    <br>

                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <br>
                    <input type="submit" value="Add Recipe" class="btn btn-success">
                    <br>

            </form><br>
            <p class="last_paragraph">
                <a href=".?action=recipe_list_admin">View Recipe List</a>
            </p><br>
        </div>
    </main>
</body>
</html>
