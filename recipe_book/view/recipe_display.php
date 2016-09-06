<!DOCTYPE html>
<html>
<?php include 'view/header.php'; ?>
<?php session_start(); ?>
<body>
    <main>
        <p><a href="http://www.jtemerson.net">jtemerson.net</a></p>
        <div class="container"><br><br>
            <form action=".?action=recipe_list" method="post"><input type="submit" value="Back to User List" class="btn btn-primary"></form><br>
            <form action=".?action=recipe_list_admin" method="post"><input type="submit" value="Back to Admin List" class="btn btn-primary"></form><br><br>

            <h1><?php echo $recipe_name; ?></h1>
            <br>

            <h2>Ingredients:</h2>
            <p><?php echo $recipe_ingredients; ?></p>
            <br>

            <h2>Instructions:</h2>
            <p><?php echo $recipe_instructions; ?></p>

            <h2>Notes from Kiersten</h2>
            <p><?php echo $recipe_notes; ?></p>

        </div>
    </main>
<body>
</html>
