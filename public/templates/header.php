<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titolo ?? 'NON DEFINITO') ?></title>
    <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/common_css.php');
    ?>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/index.php">Almakick</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/home.php">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                        </li>
                    </ul>
                    <div class="ms-auto">
                        <button class="btn btn-outline-secondary btn-sm" id="btn-profile" type="button">
                            <i class="bi bi-person-square"></i>
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" id="btn-theme-toggle" type="button">
                            <i class="bi bi-moon-fill" id="theme-icon"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </header>