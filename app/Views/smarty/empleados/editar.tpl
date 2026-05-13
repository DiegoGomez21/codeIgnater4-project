{extends file="plantilla.tpl"}

{block name="contenido"}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">{lang key='App.editEmployee'}</h1>
    <a href="{base_url uri=$rutaBase}" class="btn btn-outline-secondary">{lang key='App.back'}</a>
</div>

{if $_errors}
    <div class="alert alert-danger">
        <ul class="mb-0">
            {foreach $_errors as $error}
                <li>{$error|escape}</li>
            {/foreach}
        </ul>
    </div>
{/if}

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{base_url uri="`$rutaBase`/{$empleado.id}"}" method="post">
            {csrf_field}
            <input type="hidden" name="_method" value="PUT">

            <div class="row g-3">
                <div class="col-md-4">
                    <label for="clave" class="form-label">{lang key='App.key'}</label>
                    <input type="text" class="form-control" id="clave" name="clave"
                           value="{old key='clave' default=$empleado.clave}" maxlength="10">
                </div>

                <div class="col-md-8">
                    <label for="nombre" class="form-label">{lang key='App.name'}</label>
                    <input type="text" class="form-control" id="nombre" name="nombre"
                           value="{old key='nombre' default=$empleado.nombre}" maxlength="100">
                </div>

                <div class="col-md-4">
                    <label for="fecha_nacimiento" class="form-label">{lang key='App.birthDate'}</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                           value="{old key='fecha_nacimiento' default=$empleado.fecha_nacimiento}">
                </div>

                <div class="col-md-4">
                    <label for="telefono" class="form-label">{lang key='App.phone'}</label>
                    <input type="text" class="form-control" id="telefono" name="telefono"
                           value="{old key='telefono' default=$empleado.telefono}" maxlength="20">
                </div>

                <div class="col-md-4">
                    <label for="email" class="form-label">{lang key='App.email'}</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{old key='email' default=$empleado.email}" maxlength="100">
                </div>

                <div class="col-md-6">
                    <label for="id_departamento" class="form-label">{lang key='App.department'}</label>
                    <select class="form-select" id="id_departamento" name="id_departamento">
                        <option value="">{lang key='App.selectDepartment'}</option>
                        {foreach $departamentos as $departamento}
                            <option value="{$departamento.id|escape}"
                                {old_select key='id_departamento' value=$departamento.id current=$empleado.id_departamento}>
                                {$departamento.nombre|escape}
                            </option>
                        {/foreach}
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">{lang key='App.update'}</button>
            </div>
        </form>
    </div>
</div>
{/block}
