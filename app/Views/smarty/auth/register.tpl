{extends file="plantilla.tpl"}

{block name="contenido"}
<div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="card shadow-lg" style="width: 100%; max-width: 500px;">
        <div class="card-body p-5">
            <h2 class="card-title text-center mb-4 fw-bold">{lang key='Auth.register'}</h2>

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

            <form action="{base_url uri='register'}" method="post">
                {csrf_field}

                <div class="mb-3">
                    <label for="username" class="form-label fw-bold">{lang key='Auth.username'}</label>
                    <input type="text" 
                           class="form-control" 
                           id="username" 
                           name="username" 
                           placeholder="usuario123"
                           value="{old key='username'}"
                           minlength="3"
                           maxlength="30"
                           autocomplete="username"
                           required>
                    <small class="text-muted">Min. 3 caracteres, máx. 30</small>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">{lang key='Auth.email'}</label>
                    <input type="email" 
                           class="form-control" 
                           id="email" 
                           name="email" 
                           placeholder="usuario@ejemplo.com"
                           value="{old key='email'}"
                           autocomplete="email"
                           required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">{lang key='Auth.password'}</label>
                    <input type="password" 
                           class="form-control" 
                           id="password" 
                           name="password" 
                           placeholder="••••••••"
                           minlength="8"
                           autocomplete="new-password"
                           required>
                    <small class="text-muted">Mínimo 8 caracteres</small>
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label fw-bold">{lang key='Auth.confirmPassword'}</label>
                    <input type="password" 
                           class="form-control" 
                           id="confirm_password" 
                           name="confirm_password" 
                           placeholder="••••••••"
                           minlength="8"
                           autocomplete="new-password"
                           required>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100 mt-4">
                    {lang key='Auth.register'}
                </button>
            </form>

            <hr class="my-4">

            <div class="text-center">
                <p class="mb-2">¿Ya tienes cuenta?</p>
                <a href="{base_url uri='login'}" class="btn btn-outline-secondary btn-sm">
                    {lang key='Auth.login'}
                </a>
            </div>
        </div>
    </div>
</div>
{/block}
