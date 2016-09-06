<!DOCTYPE html>
<html>
<?php include 'view/header.php'; ?>
<?php session_start(); ?>
    <body>
        <main>
            <p><a href="http://www.jtemerson.net">jtemerson.net</a></p>
            <div class="container">
                <h1>Edit Recipe</h1>

                <form action="." method="post" id="edit_recipe_form">

                    <input type="hidden" name="action" value="send_edit_recipe">

                    <label>Category:</label><br>
                    <input type="text" name="category_id" value="<?php echo $category_id ?>" readonly class="form-control"><br>

                    <input type="hidden" name="recipe_id" value="<?php echo $recipe_id ?>">

                    <label>Name:</label><br>
                    <input type="text" name="recipe_name" value="<?php echo $recipe_name ?>" class="form-control"><br>

                    <label>Ingredients:</label><br>
                    <label>(Use a "-" for each bullet in a bulleted list)</label>
                    <textarea rows="10" cols="100" type="text" name="recipe_ingredients" class="form-control"><?php echo $recipe_ingredients ?></textarea><br>

                    <label>Instructions:</label><br>
                    <label>(Use a "#" for each number in a numbered list)</label>
                    <textarea rows="10" cols="100" type="text" name="recipe_instructions" class="form-control"><?php echo $recipe_instructions ?></textarea><br>

                    <label>Notes:</label><br>
                    <label>(Not Required)</label><br>
                    <textarea rows="10" cols="100" name="recipe_notes" class="form-control" placeholder="Enter Notes"></textarea>
                    <br>

                    <br>
                    <label>&nbsp;</label>
                    <input type="submit" value="Save Changes" class="btn btn-success"><br>
                </form><br>
                <p><a href="?action=recipe_list_admin">View recipe List</a></p><br>
            </div>
        </main>
    </body>
</html>
