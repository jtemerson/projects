<!DOCTYPE html>
<html>
<?php include 'view/header.php'; ?>
<?php session_start(); ?>
<body>

            <main>
                <p><a href="http://www.jtemerson.net">jtemerson.net</a></p>
                <br><br><br>
    <div class="container">
            <form action="." method="post"><input type="submit" value="Register" class="btn btn-primary"></form>
                    <h1>Login</h1>
                    <p>All fields are required.</p>

                <?php if (!empty($error)) { ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php } // end if ?>

                <form action="." method="post" class="form-horizontal">
			<fieldset>
                            <div class="form-group">
                                <label for="email"  class="control-label col-md-1">Email</label>
                                <div class="col-md-4">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter E-Mail">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-1">Password</label>
                                <div class="col-md-4">
                                    <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter Password">
                                </div>
                            </div>
				<label>&nbsp;</label>
				<input type="submit" name="action" value="Login" class="btn btn-success">
			</fieldset>
		</form>
	</main>
	<footer>

	</footer>
    </div>
</body>

</html>
