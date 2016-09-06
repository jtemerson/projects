<?php
// Get your database connection
require ('database.php');


// Getting registering and logging in the user

function register_user($name, $email, $password){
    global $db;
$query = 'INSERT INTO users
                 (user_name, user_email, user_password)
              VALUES (:name, :email, :password)';

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $insertResult = $statement->rowCount();
    $statement->closeCursor();
    return $insertResult;
}

function get_user_by_email($email){
    global $db;
    $query = 'SELECT * FROM users
              WHERE user_email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(":email", $email);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    return $user;
}


////////////////////////////Categories////////////////////////////////////////

function get_categories() {
    global $db;
    $query = 'SELECT * FROM categories
              ORDER BY category_id';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement;
}

function get_category_name($category_id) {
    global $db;
    $query = 'SELECT * FROM categories
              WHERE category_id = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $category = $statement->fetch();
    $statement->closeCursor();
    $category_name = $category['category_name'];
    return $category_name;
}

function add_category($category_name) {
    global $db;
    $query = 'INSERT INTO categories (category_name)
              VALUES (:category_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_name', $category_name);
    $statement->execute();
    $statement->closeCursor();
}

function delete_category($category_id) {
    global $db;
    $query = 'DELETE FROM categories
              WHERE category_id = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}



//////////////////////////////////Recipes//////////////////////////////////////



function get_recipes_by_category($category_id) {
    global $db;
    $query = 'SELECT * FROM recipes
              WHERE category_id = :category_id
              ORDER BY recipe_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $recipes = $statement->fetchAll();
    $statement->closeCursor();
    return $recipes;
}

function get_recipe($recipe_id) {
    global $db;
    $query = 'SELECT * FROM recipes
              WHERE recipe_id = :recipe_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":recipe_id", $recipe_id);
    $statement->execute();
    $recipe = $statement->fetch();
    $statement->closeCursor();
    return $recipe;
}

function delete_recipe($recipe_id) {
    global $db;
    $query = 'DELETE FROM recipes
              WHERE recipe_id = :recipe_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':recipe_id', $recipe_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_recipe($category_id, $user_id, $recipe_name, $recipe_ingredients, $recipe_instructions, $recipe_notes) {
    global $db;
    $query = 'INSERT INTO recipes (category_id, user_id, recipe_name, recipe_ingredients, recipe_instructions, recipe_notes)
              VALUES (:category_id, :user_id, :recipe_name, :recipe_ingredients, :recipe_instructions, :recipe_notes)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':recipe_name', $recipe_name);
    $statement->bindValue(':recipe_ingredients', $recipe_ingredients);
    $statement->bindValue(':recipe_instructions', $recipe_instructions);
    $statement->bindValue(':recipe_notes', $recipe_notes);
    $statement->execute();
    $statement->closeCursor();
}

function edit_recipe($category_id, $recipe_name, $recipe_ingredients, $recipe_instructions, $recipe_id, $recipe_notes) {
    global $db;
    $query = 'UPDATE recipes
                SET category_id = :category_id, recipe_name = :recipe_name, recipe_ingredients = :recipe_ingredients, recipe_instructions = :recipe_instructions, recipe_notes = :recipe_notes
                WHERE recipe_id = :recipe_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':recipe_id', $recipe_id);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':recipe_name', $recipe_name);
    $statement->bindValue(':recipe_ingredients', $recipe_ingredients);
    $statement->bindValue(':recipe_instructions', $recipe_instructions);
    $statement->bindValue(':recipe_notes', $recipe_notes);
    $statement->execute();
    $statement->closeCursor();
}


/////////////////////////////////// TEXT FORMATING ////////////////////////////////

function format_ingredients($recipe_ingredients){
    //convert return characters to the Unix new lines
    $recipe_ingredients = str_replace("\r\n", "\n", $recipe_ingredients);  //convert windows
    $recipe_ingredients = str_replace("\r", "\n", $recipe_ingredients);     //convert mac

    //get array of paragraphs
    $paragraphs = explode("\n\n", $recipe_ingredients);

    //add tags to each paragraph
    $recipe_ingredients = '';
    foreach ($paragraphs as $p){
        $p = ltrim($p);

        $first_char = substr($p, 0, 1);
        if($first_char == '-'){
            $p = '<ul>' . $p . '</li></ul>';
            $p = str_replace("-", '<li>', $p);
            $p = str_replace("\n", '</li>', $p);
        }elseif($first_char == '#'){
            $p = '<ol>' . $p . '</li></ol>';
            $p = str_replace("#", '<li>', $p);
            $p = str_replace("\n", '</li>', $p);
        }else{

        }
        $recipe_ingredients .= $p;
    }
    return $recipe_ingredients;
}

function format_instructions($recipe_instructions){
    //convert return characters to the Unix new lines
    $recipe_ingredients = str_replace("\r\n", "\n", $recipe_ingredients);  //convert windows
    $recipe_ingredients = str_replace("\r", "\n", $recipe_ingredients);     //convert mac

    //get array of paragraphs
    $paragraphs = explode("\n\n", $recipe_instructions);

    //add tags to each paragraph
    $recipe_instructions = '';
    foreach ($paragraphs as $p){
        $p = ltrim($p);

        $first_char = substr($p, 0, 1);
        if($first_char == '-'){
            $p = '<ul>' . $p . '</li></ul>';
            $p = str_replace("-", '<li>', $p);
            $p = str_replace("\n", '</li>', $p);
        }elseif($first_char == '#'){
            $p = '<ol>' . $p . '</li></ol>';
            $p = str_replace("#", '<li>', $p);
            $p = str_replace("\n", '</li>', $p);
        }else{

        }
        $recipe_instructions .= $p;
    }
    return $recipe_instructions;
}

function unformat_ingredients($recipe_ingredients){

    //get array of paragraphs
    $paragraphs = explode("\n\n", $recipe_ingredients);

    //add tags to each paragraph
    $recipe_ingredients = '';
    foreach ($paragraphs as $p){

        $first_char = substr($p, 0, 4);
        if($first_char == '<ul>'){
            $p = str_replace("<ul>", "", $p);
            $p = str_replace("</ul>", "", $p);
            $p = str_replace("<li>", '-', $p);
            $p = str_replace("</li>", "\n", $p);
        }elseif($first_char == '<ol>'){
            $p = str_replace("<ol>", "", $p);
            $p = str_replace("</ol>", "", $p);
            $p = str_replace("<li>", '#', $p);
            $p = str_replace("</li>", "\n", $p);
        }else{

        }
        $recipe_ingredients .= $p;
    }
    return $recipe_ingredients;
}

function unformat_instructions($recipe_instructions){

    //get array of paragraphs
    $paragraphs = explode("\n\n", $recipe_instructions);

    //add tags to each paragraph
    $recipe_instructions = '';
    foreach ($paragraphs as $p){

        $first_char = substr($p, 0, 4);
        if($first_char == '<ul>'){
            $p = str_replace("<ul>", "", $p);
            $p = str_replace("</ul>", "", $p);
            $p = str_replace("<li>", '-', $p);
            $p = str_replace("</li>", "\n", $p);
        }elseif($first_char == '<ol>'){
            $p = str_replace("<ol>", "", $p);
            $p = str_replace("</ol>", "", $p);
            $p = str_replace("<li>", '#', $p);
            $p = str_replace("</li>", "\n", $p);
        }else{

        }
        $recipe_instructions .= $p;
    }
    return $recipe_instructions;
}

?>
