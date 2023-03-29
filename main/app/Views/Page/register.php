<?php use App\Service\RouterService; if ($_SESSION["user"]) { header("Location: /home"); } ?>
<!DOCTYPE html>
<html lang="en">
<?php RouterService::ShowComponent("head"); ?>
    <body class="text-center"> <!-- _PAGE-REGISTER_ -->
<?php RouterService::ShowComponent("navbar"); ?>
	<main class="form-signin w-100 m-auto">
		<form action="/auth/register" method="POST">
			<img class="mb-4" src="file/logo/rat_black.svg" alt="logo">
			<h1 class="h3 mb-3 fw-normal">Register</h1>
			<div class="form-floating">
				<input type="text" class="form-control" name="username" id="floatingInput" placeholder="Jack" required>
				<label for="floatingInput">Username</label>
			</div>
			<div class="form-floating">
				<input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
				<label for="floatingPassword">Password</label>
			</div>
			<div class="checkbox mb-3">
				<label>
					<input type="checkbox" value="remember-me" required> Remember me
				</label>
			</div>
			<button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
			<p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
		</form>
	</main>
<?php RouterService::ShowComponent("footer"); ?>
