<?= $this->extend('plantilla') ?>

<?php $empleados = $empleados ?? [] ?>
<?php $rutaBase = $rutaBase ?? 'es/empleados' ?>

<?= $this->section('contenido') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><?= esc(lang('App.employees')) ?></h1>
    <a href="<?= base_url($rutaBase . '/new') ?>" class="btn btn-primary"><?= esc(lang('App.newEmployee')) ?></a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th><?= esc(lang('App.name')) ?></th>
                        <th><?= esc(lang('App.birthDate')) ?></th>
                        <th><?= esc(lang('App.phone')) ?></th>
                        <th>Email</th>
                        <th><?= esc(lang('App.department')) ?></th>
                        <th class="text-end"><?= esc(lang('App.actions')) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($empleados): ?>
                        <?php foreach ($empleados as $empleado): ?>
                            <tr>
                                <td><?= esc((string) $empleado['clave']) ?></td>
                                <td><?= esc((string) $empleado['nombre']) ?></td>
                                <td><?= esc((string) $empleado['fecha_nacimiento']) ?></td>
                                <td><?= esc((string) $empleado['telefono']) ?></td>
                                <td><?= esc((string) $empleado['email']) ?></td>
                                <td><?= esc((string) $empleado['departamento']) ?></td>
                                <td class="text-end">
                                    <a href="<?= base_url($rutaBase . '/' . $empleado['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary"><?= esc(lang('App.edit')) ?></a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal" data-bs-url="<?= base_url($rutaBase . '/' . $empleado['id']) ?>">
                                        <?= esc(lang('App.delete')) ?>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4"><?= esc(lang('App.noEmployees')) ?></td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEliminar" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="DELETE">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarModalLabel"><?= esc(lang('App.deleteEmployee')) ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= esc(lang('App.close')) ?>"></button>
                </div>
                <div class="modal-body">
                    <?= esc(lang('App.confirmDeleteEmployee')) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= esc(lang('App.cancel')) ?></button>
                    <button type="submit" class="btn btn-danger"><?= esc(lang('App.delete')) ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
const eliminarModal = document.getElementById('eliminarModal')

eliminarModal.addEventListener('show.bs.modal', event => {
    const boton = event.relatedTarget
    const url = boton.getAttribute('data-bs-url')
    const form = document.getElementById('formEliminar')

    form.setAttribute('action', url)
})
</script>
<?= $this->endSection() ?>