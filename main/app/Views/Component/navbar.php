<!-- _NAVBAR_ -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <img src="file/logo/rat_white.svg" alt="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <?php if ($_SESSION["user"]) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/a">A</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/b">B</a>
                </li>
                <?php } ?>
                <?php if ($_SESSION["user"] && $_SESSION["user"]["role"] == "ROLE_ADMIN") { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/report">Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/activity">Activity</a>
                </li>
                <?php } ?>
            </ul>
            <div class="d-flex">
                <div class="bd-example">
                    <div class="btn-group">
                        <?php if (!$_SESSION["user"]) { ?>
                        <a class="btn btn-outline-success" href="/login">Login</a>
                        <a class="btn btn-outline-success" href="/register">Register</a>
                        <?php } else { ?>
                        <a class="btn btn-outline-success" href="/logout">LogOut</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- NAVBAR -->
