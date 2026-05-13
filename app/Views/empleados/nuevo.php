<?= $this->extend('plantilla') ?>

<?php $departamentos = $departamentos ?? [] ?>
<?php $rutaBase = $rutaBase ?? 'es/empleados' ?>

<?= $this->section('contenido') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><?= esc(lang('App.newEmployee')) ?></h1>
    <a href="<?= base_url($rutaBase) ?>" class="btn btn-outline-secondary"><?= esc(lang('App.back')) ?></a>
</div>

<?php if (session('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc((string) $error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="<?= base_url($rutaBase) ?>" method="post">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-4">
                    <label for="clave" class="form-label"><?= esc(lang('App.key')) ?></label>
                    <input type="text" class="form-control" id="clave" name="clave" value="<?= old('clave') ?>" maxlength="10">
                </div>

                <div class="col-md-8">
                    <label for="nombre" class="form-label"><?= esc(lang('App.name')) ?></label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= old('nombre') ?>" maxlength="100">
                </div>

                <div class="col-md-4">
                    <label for="fecha_nacimiento" class="form-label"><?= esc(lang('App.birthDate')) ?></label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= old('fecha_nacimiento') ?>">
                </div>

                <div class="col-md-4">
                    <label for="telefono" class="form-label"><?= esc(lang('App.phone')) ?></label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?= old('telefono') ?>" maxlength="20">
                </div>

                <div class="col-md-4">
                    <label for="email" class="form-label"><?= esc(lang('App.email')) ?></label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" maxlength="100">
                </div>

                <div class="col-md-6">
                    <label for="id_departamento" class="form-label"><?= esc(lang('App.department')) ?></label>
                    <select class="form-select" id="id_departamento" name="id_departamento">
                        <option value=""><?= esc(lang('App.selectDepartment')) ?></option>
                        <?php foreach ($departamentos as $departamento): ?>
                            <option value="<?= esc((string) $departamento['id']) ?>" <?= old('id_departamento') == $departamento['id'] ? 'selected' : '' ?>>
                                <?= esc((string) $departamento['nombre']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><?= esc(lang('App.save')) ?></button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>