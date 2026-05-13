{extends file="plantilla.tpl"}

{block name="contenido"}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">{lang key='App.employees'}</h1>
    <a href="{base_url uri="`$rutaBase`/new"}" class="btn btn-primary">
        {lang key='App.newEmployee'}
    </a>
</div>

<div class="row g-4">

    {* Tabla de empleados *}
    <div class="col-xl-8">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>{lang key='App.name'}</th>
                                {* <th>{lang key='App.birthDate'}</th> *}
                                <th>{lang key='App.phone'}</th>
                                <th>Email</th>
                                <th>{lang key='App.department'}</th>
                                <th class="text-end">{lang key='App.actions'}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {if $empleados}
                                {foreach $empleados as $empleado}
                                    <tr>
                                        <td>{$empleado.clave|escape}</td>
                                        <td>{$empleado.nombre|escape}</td>
                                        {* <td>{$empleado.fecha_nacimiento|escape}</td> *}
                                        <td>{$empleado.telefono|escape}</td>
                                        <td>{$empleado.email|escape}</td>
                                        <td>{$empleado.departamento|escape}</td>
                                        <td class="text-end">
                                            <div class="d-flex gap-2 justify-content-end">
                                                <a href="{base_url uri="`$rutaBase`/{$empleado.id}/edit"}"
                                                   class="btn btn-sm btn-outline-primary"
                                                   title="{lang key='App.edit'}">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#eliminarModal"
                                                        data-bs-url="{base_url uri="`$rutaBase`/{$empleado.id}"}"
                                                        title="{lang key='App.delete'}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                {/foreach}
                            {else}
                                <tr>
                                    <td colspan="7" class="text-center py-4">{lang key='App.noEmployees'}</td>
                                </tr>
                            {/if}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {* Gráfica de empleados por departamento *}
    <div class="col-xl-4">
        <div class="card shadow-sm h-100">
            <div class="card-header fw-semibold bg-transparent">
                {lang key='App.employeesByDepartment'}
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <canvas id="chartDepartamentos" style="max-height: 320px;"></canvas>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEliminar" method="post">
                {csrf_field}
                <input type="hidden" name="_method" value="DELETE">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarModalLabel">{lang key='App.deleteEmployee'}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    {lang key='App.confirmDeleteEmployee'}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{lang key='App.cancel'}</button>
                    <button type="submit" class="btn btn-danger">{lang key='App.delete'}</button>
                </div>
            </form>
        </div>
    </div>
</div>
{/block}

{block name="scripts"}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
{literal}
<script>
const eliminarModal = document.getElementById('eliminarModal')
eliminarModal.addEventListener('show.bs.modal', event => {
    const boton = event.relatedTarget
    const url = boton.getAttribute('data-bs-url')
    document.getElementById('formEliminar').setAttribute('action', url)
})
</script>
{/literal}
<script>
(function () {
    const labels = {$chartLabelsJson};
    const data   = {$chartDataJson};
    const colores = [
        '#0d6efd', '#198754', '#ffc107', '#dc3545',
        '#0dcaf0', '#6f42c1', '#fd7e14', '#20c997'
    ];
    new Chart(document.getElementById('chartDepartamentos'), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: colores.slice(0, labels.length),
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 16, font: { size: 13 } }
                },
                tooltip: {
                    callbacks: {
                        label: ctx => ' ' + ctx.label + ': ' + ctx.parsed + ' empleado(s)'
                    }
                }
            }
        }
    });
})();
</script>
{/block}
