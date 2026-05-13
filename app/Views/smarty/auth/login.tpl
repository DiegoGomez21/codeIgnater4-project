{extends file="plantilla.tpl"}

{block name="contenido"}
<div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="card shadow-lg" style="width: 100%; max-width: 420px;">
        <div class="card-body p-5">
            <h2 class="card-title text-center mb-4 fw-bold">{lang key='Auth.login'}</h2>

            {if $_error}
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {$_error|escape}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            {/if}

            {if $_errors}
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        {foreach $_errors as $error}
                            <li>{$error|escape}</li>
                        {/foreach}
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            {/if}

            <form action="{base_url uri='login'}" method="post">
                {csrf_field}

                <div class="mb-3">
                    <label for="username" class="form-label fw-bold">{lang key='Auth.username'}</label>
                    <input type="text" 
                           class="form-control form-control-lg" 
                           id="username" 
                           name="username" 
                           placeholder="usuario123"
                           value="{old key='username'}"
                           autocomplete="username"
                           required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">{lang key='Auth.password'}</label>
                    <input type="password" 
                           class="form-control form-control-lg" 
                           id="password" 
                           name="password" 
                           placeholder="••••••••"
                           autocomplete="current-password"
                           required>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">
                    {lang key='Auth.login'}
                </button>
            </form>

            <hr class="my-4">

            <div class="text-center">
                <p class="mb-2">¿No tienes cuenta?</p>
                <a href="{base_url uri='register'}" class="btn btn-outline-secondary btn-sm">
                    {lang key='Auth.register'}
                </a>
            </div>
        </div>
    </div>
</div>
{/block}
