<!DOCTYPE html>
<html>
<?php include 'view/header.php'; ?>
<?php session_start(); ?>
<body>
    <main>
        <p><a href="http://www.jtemerson.net">jtemerson.net</a></p>
        <div class="container">
            <div class="jumbotron" style="background: transparent;">
            <h1>Kiersten's Recipe Book</h1>
            <p>Welcome to my recipe book application. This recipe book is a great example of my knowledge of PHP.
            The entire application uses PHP to function. It is programmed using an MVC pattern.</p>

            <p style="color: #c20101;">This recipe book is free for anyone to use. Just register with your e-mail address and see all of my wife
                Kiersten's favorite recipes!</p><br>

           <h2>To see the video better view it in full screen.</h2>
           <p>
               This video explains how the PHP application works and shows
               my knowledge and skill in PHP.
           </p>
            <video controls preload="metadata" style="height: 50%; width: 50%;">
                <source src="../../media/recipe_book.mp4" type="video/mp4">
            </video>
        </div>

            <?php
                $logged_in = $_SESSION['logged_in'];
                $user_type = $_SESSION['user_type'];

                if($logged_in && ($user_type == 'user')){
                    $name = $_SESSION['user_name'];
                    echo '<span>Welcome back '.$name. '. You are still logged in. </span>'
                            . '<br> <form action=".?action=Logout" method="post"><input type="submit" value="Logout" class="btn btn-primary"></form> <br> <form action=".?action=recipe_list" method="post"><input type="submit" value="See Recipes" class="btn btn-primary"></form>';
                } elseif($logged_in && ($user_type == 'admin')){
                    $name = $_SESSION['user_name'];
                    echo '<span>Why hello '.$name. '. Have fun with your recipes babe.</span> <form action=".?action=Logout" method="post"><input type="submit" value="Logout" class="btn btn-primary"></form> <br> <form action=".?action=recipe_list_admin" method="post"><input type="submit" value="Enter Your Kingdom" class="btn btn-primary"></form>';
                } else{
                    echo '<form action=".?action=sign_in" method="post"><input type="submit" value="Login" class="btn btn-primary"></form>';
                }
                ?>

            <h2>Registration</h2>
            <p>All fields are required.</p>

            <?php if(isset($error)){
                echo "<p> $error </p>";
            }?>

            <form action="." method="post" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="control-label col-md-1">Name:</label>
                            <div class="col-md-4">
                                <input type="text" name="name" value="<?php echo htmlspecialchars($name);?>" class="form-control" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1" for="email">E-Mail:</label>
                            <div class="col-md-4">
                                <input type="email" name="email" value="<?php echo htmlspecialchars($email);?>" class="form-control" id="email" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1" for="pwd">Password:</label>
                            <div class="col-md-4">
                                <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter Password">
                                <p>Password must be at least 8 characters long.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1" for="pwd">Password:</label>
                            <div class="col-md-4">
                                <input type="password" name="verify" class="form-control" placeholder="Repete Password">
                                <p>Passwords must match.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-1 col-md-8">
                                <input type="submit" name="action" value="Register" class="btn btn-success">
                            </div>
                        </div>
                    </fieldset>
            </form>
        </div>
    </main>
    <footer>

    </footer>
</body>

</html>
