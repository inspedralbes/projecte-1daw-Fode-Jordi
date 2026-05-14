<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor d'incidències informàtiques</title>
    <link rel="icon" type="png" href="logo.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { box-shadow: 0 2px 8px rgba(0,0,0,0.3); }
        .nav-link { color: rgba(255,255,255,0.75); }
        .nav-link:hover { color: #fff ; }
        .nav-link.active { color: #fff; font-weight: bold; }
    </style>
</head>
<body class="pb-5">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        
        <a class="navbar-brand d-flex align-items-center gap-2">
            <img src="https://www.institutpedralbes.cat/wp-content/uploads/2021/05/logo.jpg" height="45" class="rounded">
            <span class="fw-bold">Gestor d'Incidències</span>
        </a>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="bi bi-house"></i> Inici
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="incidencies.php">
                        <i class="bi bi-exclamation-triangle"></i> Incidències
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">
                        <i class="bi bi-gear"></i> Administració
                    </a>
                </li>
            </ul>
            </div>
        </div>

    </div>
</nav>

<div class="container">