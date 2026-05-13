<!doctype html>
<?php $rutaBase = $rutaBase ?? 'es/empleados' ?>
<?php $localeActual = $localeActual ?? 'es' ?>
<html lang="<?= esc($localeActual) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($titulo ?? 'Empresa') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url($rutaBase) ?>"><?= esc(lang('App.appName')) ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="<?= esc(lang('App.menu')) ?>">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url($rutaBase) ?>"><?= esc(lang('App.employees')) ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('es/empleados') ?>">ES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('en/employees') ?>">EN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <?php if (session('mensaje')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= esc((string) session('mensaje')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?= esc(lang('App.close')) ?>"></button>
            </div>
        <?php endif ?>

        <?php if (session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= esc((string) session('error')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?= esc(lang('App.close')) ?>"></button>
            </div>
        <?php endif ?>

        <?= $this->renderSection('contenido') ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>