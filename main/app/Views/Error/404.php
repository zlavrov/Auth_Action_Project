<?php use App\Service\RouterService; ?>
<!DOCTYPE html>
<html lang="en">
<?php RouterService::ShowComponent("head"); ?>
    <body class="text-center"> <!-- _PAGE 404_ -->
<?php RouterService::ShowComponent("navbar"); ?>
    <div class="container">
        <div class="bg-light p-5 rounded">
            <h1 id="title_error">404 - page not found</h1>
            <p id="message_error" class="lead">404 is a status code that tells a web user that a requested page is not available. 404 and other response status codes are part of the web's Hypertext Transfer Protocol response codes. The 404 code means that a server could not find a client-requested webpage.</p>
            <a class="btn btn-lg btn-primary" href="#" role="button">View navbar docs »</a>
        </div>
    </div>
<?php RouterService::ShowComponent("footer"); ?>
