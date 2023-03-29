<?php use App\Service\RouterService; use App\Model\DBActionModel; if ($_SESSION["user"]["role"] != "ROLE_ADMIN") { header("Location: /home"); } ?>
<!DOCTYPE html>
<html lang="en">
<?php RouterService::ShowComponent("head"); ?>
    <body class="text-center"> <!-- _PAGE-REPORT_ -->
<?php RouterService::ShowComponent("navbar"); ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Page with Statistic of users events</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <label>
                        <input class="btn btn-sm btn-outline-secondary start" id="start" value="2023-01-01" name="start" type="date"/> 
                    </label>
                    <label>
                        <input class="btn btn-sm btn-outline-secondary finish" id="finish" value="2023-12-12" name="finish" type="date"/> 
                    </label>
                    <select id="select_user" class="btn btn-sm btn-outline-secondary">
                        <option value="All">All users</option>
                        <?php $result = DBActionModel::UsersList();
                            foreach($result as $row){
                                echo "<option value=" . $row["id"] . ">" . $row["username"] . "</option>";
                            }
                        ?>
                    </select>
                    <input type="button" value="Send" class="btn btn-sm btn-primary" id="send" />
                </div>
            </div>
        </div>
        <div class="block">
            <canvas class="my-4 w-100" id="BUY_COW"></canvas>
        </div>
        <div class="block">
            <canvas class="my-4 w-100" id="DOWNLOAD_EXE"></canvas>
        </div>
    </main>
    <script src="assets/scripts/report.js"></script>
<?php RouterService::ShowComponent("footer"); ?>
