<nav class="navbar navbar-expand-lg navbar-dark bg-indigo fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">Poetry Master</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex">
                <li class="nav-item">
                    <a class="nav-link 
                    <?php if ($page == 'home') {
                        echo 'active';
                    } ?>" aria-current="page" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link
                    <?php if ($page == 'about') {
                        echo 'active';
                    } ?>
                    " href="./about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link
                    <?php if ($page == 'poems') {
                        echo 'active';
                    } ?>" href="./poems.php">Poems</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link
                    <?php if ($page == 'contact') {
                        echo 'active';
                    } ?>
                    " href="./contact.php">Contact Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Accounts
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        if (!$_SESSION['auth']) {
                            echo '
                                <li><a class="dropdown-item" href="./login.php">Login</a></li>
                                <li><a class="dropdown-item" href="./register.php">Register</a></li>
                                ';
                        } else {
                            echo '
                                <li><a class="dropdown-item" href="./dashboard.php">Dashboard</a></li>
                                <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
                            ';
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>