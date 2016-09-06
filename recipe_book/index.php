    <?php
    session_start();

require_once 'model/model.php';

//find and store the value of action from the request
    if (filter_input(INPUT_POST, 'action')){
        $action = filter_input(INPUT_POST, 'action');
    }else{
        $action = filter_input(INPUT_GET, 'action');
    }



// start the decision tree
switch ($action) {
    case 'Register':
        // Capture and filter the inputs
        $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
        $password = filter_input(INPUT_POST, 'password');
        $verify = filter_input(INPUT_POST, 'verify');

        //validate the inputs

        if(empty($name) || empty($email) || empty($password) || empty($verify)){
            $error = 'Dude, fill in all the fields and try again.';
            include 'view/register.php';
            exit;
        }


        if(strlen($password) <= 7){
            $error =  'Dude, get with the program. Your password has to be be at least 8 characters long.';
            include 'view/register.php';
            exit;
        }

        if($password !== $verify){
            $error = 'Passwords do not match!';
            include 'view/register.php';
            exit;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        //register the user
        $result = register_user($name, $email, $password);

        if($result){
            $message = "$name, you are registered!";
        }else{
            $message = "Sorry $name, please try to register again!";
        }


        include 'view/login.php';
        exit;

        break;

    case 'sign_in':
        include 'view/login.php';
        exit;

        break;


    case 'Login':

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $user = get_user_by_email($email);


        if(password_verify($password, $user['user_password'])){
            $_SESSION['logged_in'] = TRUE;
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['user_id'] = $user['user_id'];
        }else{
            $error = 'Are you ill? Learn to login correctly and try again.';
            include 'view/login.php';
            exit;
        }


    case 'recipe_list':

            $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
            if ($category_id == NULL || $category_id == FALSE) {
                $category_id = 1;
            }
            $category_name = get_category_name($category_id);
            $categories = get_categories();
            $recipes = get_recipes_by_category($category_id);
            include('view/recipe_list.php');

        break;

    case 'Logout':

              session_destroy();
            include 'view/login.php';

        break;

    case 'list_categories':

        $categories = get_categories();
        include 'view/category_list.php';

        break;

    case 'add_category':

        $category_name = filter_input(INPUT_POST, 'category_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Validate inputs
        if ($category_name == NULL) {
            $error = 'Invalid category name. Check name and try again.';
            include 'view/category_list.php';
        } else {
            add_category($category_name);
            header('Location: .?action=list_categories');  // display the Category List page
        }


        break;

    case 'delete_category':

        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        delete_category($category_id);
        header('Location: .?action=list_categories');

        break;

    case 'add_recipe':

        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $recipe_name = filter_input(INPUT_POST, 'recipe_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $recipe_ingredients = filter_input(INPUT_POST, 'recipe_ingredients', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $recipe_instructions = filter_input(INPUT_POST, 'recipe_instructions', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $recipe_notes = filter_input(INPUT_POST, 'recipe_notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user_id = filter_input(INPUT_POST, 'user_id');
        if ($category_id == NULL || $category_id == FALSE ||
                $recipe_name == NULL || $recipe_ingredients == NULL || $recipe_instructions == NULL ||
                $recipe_ingredients == ' ' || $recipe_instructions == ' ' || $recipe_ingredients == '-' ||
                $recipe_ingredients == '#' || $recipe_instructions == '-' || $recipe_instructions == '#') {
            $error = "Invalid recipe data. Check all fields and try again.";
            $categories = get_categories();
            include('view/add_recipes.php');
        }else {
            $result = add_recipe($category_id, $user_id, $recipe_name, $recipe_ingredients, $recipe_instructions, $recipe_notes);
            header("Location: .?action=recipe_list_admin");
        }


        break;

    case 'add_recipe_form':

        $categories = get_categories();
        include('view/add_recipes.php');

        break;

    case 'recipe_list_admin':
        $user_type = $_SESSION['user_type'];
        if ($user_type == 'admin'){
        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
            if ($category_id == NULL || $category_id == FALSE) {
                $category_id = 1;
            }
            $category_name = get_category_name($category_id);
            $categories = get_categories();
            $recipes = get_recipes_by_category($category_id);
            include('view/recipe_list_admin.php');
        }else{
            $error = "Get out of town. You are not an admin!";
            $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
            if ($category_id == NULL || $category_id == FALSE) {
                $category_id = 1;
            }
            $category_name = get_category_name($category_id);
            $categories = get_categories();
            $recipes = get_recipes_by_category($category_id);
            include 'view/recipe_list.php';;
        }

        break;

    case 'delete_recipe';

        $recipe_id = filter_input(INPUT_POST, 'recipe_id', FILTER_VALIDATE_INT);
        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        if ($category_id == NULL || $category_id == FALSE ||
                $recipe_id == NULL || $recipe_id == FALSE) {
            $error = "Missing or incorrect recipe id or category id.";
        } else {
            delete_recipe($recipe_id);
            header("Location: .?action=recipe_list_admin");
        }

        break;

    case 'edit_recipe';

        $category_id = filter_input(INPUT_POST, 'category_id',FILTER_VALIDATE_INT);
        $recipe_id = filter_input(INPUT_POST, 'recipe_id');
        $recipe_name = filter_input(INPUT_POST, 'recipe_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $recipe_ingredients = filter_input(INPUT_POST, 'recipe_ingredients', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $recipe_instructions = filter_input(INPUT_POST, 'recipe_instructions', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $recipe_notes = filter_input(INPUT_POST, 'recipe_notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($category_id == NULL || $category_id == FALSE ||
                $recipe_name == NULL || $recipe_ingredients == NULL || $recipe_instructions == NULL ||
                $recipe_ingredients == ' ' || $recipe_instructions == ' ' || $recipe_ingredients == '-' ||
                $recipe_ingredients == '#' || $recipe_instructions == '-' || $recipe_instructions == '#') {
            $error = "Invalid recipe data. Check all fields and try again.";
            include('view/edit_recipes.php');
        } else {
            $recipe_ingredients = unformat_ingredients($recipe_ingredients);
            $recipe_instructions = unformat_instructions($recipe_instructions);
            include 'view/edit_recipes.php';
        }
        break;

    case 'send_edit_recipe';

        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $recipe_id = filter_input(INPUT_POST, 'recipe_id', FILTER_VALIDATE_INT);
        $recipe_name = filter_input(INPUT_POST, 'recipe_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $recipe_ingredients = filter_input(INPUT_POST, 'recipe_ingredients', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $recipe_instructions = filter_input(INPUT_POST, 'recipe_instructions', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $recipe_notes = filter_input(INPUT_POST, 'recipe_notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        edit_recipe($category_id, $recipe_name, $recipe_ingredients, $recipe_instructions, $recipe_id, $recipe_notes);
        header('Location: .?action=recipe_list_admin');

        break;

    case 'category':

        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
        $recipes = get_recipes_by_category($category_id);
        $categories = get_categories();
        include 'view/recipe_list.php';

        break;

    case 'category2':

        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
        $recipes = get_recipes_by_category($category_id);
        $categories = get_categories();
        include 'view/recipe_list_admin.php';

        break;

    case 'recipe_display':

        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $recipe_id = filter_input(INPUT_POST, 'recipe_id', FILTER_VALIDATE_INT);
        $recipe_name = filter_input(INPUT_POST, 'recipe_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $recipe_ingredients = filter_input(INPUT_POST, 'recipe_ingredients', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $recipe_instructions = filter_input(INPUT_POST, 'recipe_instructions', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $recipe_notes = filter_input(INPUT_POST, 'recipe_notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $recipe_ingredients = format_ingredients($recipe_ingredients);
        $recipe_instructions = format_instructions($recipe_instructions);

        include 'view/recipe_display.php';

        break;

    default:

        $name = '';
        $email = '';
        $password = '';
        $verify = '';

        include_once 'view/register.php';
        break;

}
