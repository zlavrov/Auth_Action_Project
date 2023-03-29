<?php use App\Service\RouterService; if (!$_SESSION["user"]) { header("Location: /login"); } ?>
<!DOCTYPE html>
<html lang="en">
<?php RouterService::ShowComponent("head"); ?>
    <body class="text-center"> <!-- _PAGE-HOME_ -->
<?php RouterService::ShowComponent("navbar"); ?>
    <div class="container">
        <div class="bg-light p-5 rounded">
            <h1>Home</h1>
            <p class="lead">Hello <? echo $_SESSION["user"]["username"]; ?></p>
            <a class="btn btn-lg btn-primary" href="#" role="button">View navbar docs »</a>
        </div>
    </div>
<?php RouterService::ShowComponent("footer"); ?>
