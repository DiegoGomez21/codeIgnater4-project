<!doctype html>
<html lang="{$localeActual|default:'es'|escape}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$titulo|default:'Empresa'|escape}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{base_url uri=$rutaBase}">{lang key='App.appName'}</a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#menuPrincipal"
                    aria-controls="menuPrincipal" aria-expanded="false"
                    aria-label="{lang key='App.menu'}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link" href="{base_url uri=$rutaBase}">{lang key='App.employees'}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-2" href="{base_url uri='es/empleados'}">ES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-2" href="{base_url uri='en/employees'}">EN</a>
                    </li>
                    <li class="nav-item ms-2">
                        <form action="{base_url uri='logout'}" method="post" class="d-inline">
                            {csrf_field}
                            <button type="submit" class="btn btn-outline-light btn-sm">
                                {lang key='Auth.logout'}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">

        {if $_mensaje}
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {$_mensaje|escape}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        {/if}

        {if $_error}
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {$_error|escape}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        {/if}

        {block name="contenido"}{/block}

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {block name="scripts"}{/block}

</body>
</html>
