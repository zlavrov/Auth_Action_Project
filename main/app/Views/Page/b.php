<?php use App\Service\RouterService; if (!$_SESSION["user"]) { header("Location: /login"); } ?>
<!DOCTYPE html>
<html lang="en">
<?php RouterService::ShowComponent("head"); ?>
    <body class="text-center"> <!-- _PAGE-B_ -->
<?php RouterService::ShowComponent("navbar"); ?>
    <div class="container">
        <div id="divDownload" class="bg-light p-5 rounded">
            <h1>Page <q>B</q></h1>
            <p class="lead">B - this is a page for downloading any spreadsheet file of the exe type.</p>
            <input id="download" class="btn btn-lg btn-primary" value="Download" type="button" />
        </div>
    </div>
    <script src="assets/scripts/buyanddownload.js"></script>
<?php RouterService::ShowComponent("footer"); ?>
