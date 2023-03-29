<?php use App\Service\RouterService; if (!$_SESSION["user"]) { header("Location: /login"); } ?>
<!DOCTYPE html>
<html lang="en">
<?php RouterService::ShowComponent("head"); ?>
    <body class="text-center"> <!-- _PAGE-A_ -->
<?php RouterService::ShowComponent("navbar"); ?>
    <div class="container">
        <div id="divBuyACow" class="bg-light p-5 rounded">
            <h1>Page <q>A</q></h1>
            <p class="lead">A - this is a page to buy a cow, after which you will be thanked.</p>
            <input id="buyACow" class="btn btn-lg btn-primary" value="Buy a cow" type="button" />
        </div>
    </div>
    <script src="assets/scripts/buyanddownload.js"></script>
<?php RouterService::ShowComponent("footer"); ?>
