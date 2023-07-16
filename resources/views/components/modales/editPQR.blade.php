<form action="{{ route('pqrs.store') }}" method="POST">gestion-pqrs
    <div class="modal fade" id="ModalCreatePQR" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Responder PQRS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Nombre cliente
                    <br>
                    <br>
                    <input type="text" id="nombre_cliente" class="form-control" readonly>
                    <br>
                    <br>
                    Tipo PQRS
                    <br>
                    <br>
                    <input type="text" id="tipo_pqrs" class="form-control" readonly>
                    <br>
                    <br>
                    Descripción
                    <br>
                    <br>
                    <input type="text" id="descripcion" class="form-control" readonly>
                    <br>
                    <br>
                    Nombre trabajador que responde
                    <br>
                    <br>
                    <input type="text" id="nombre_trabajador" class="form-control">
                    <br>
                    <br>
                    Respuesta
                    <br>
                    <br>
                    <input type="text" id="respuesta" class="form-control">
                    <br>
                    <br>
                </div>
                <div sty class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    var modalEdit = document.getElementById('ModalCreatePQR')
    modalEdit.addEventListener('show.bs.modal', function(event) {
        // Botón que activó el modal
        var button = event.relatedTarget

        // Se selecciona el input especifico.
        var modalBodyInputCliente = modalEdit.querySelector('.modal-body #nombre_cliente')
        var modalBodyInputPQR = modalEdit.querySelector('.modal-body #tipo_pqrs')
        var modalBodyInputDescripcion = modalEdit.querySelector('.modal-body #descripcion')
        var modalBodyInputTrabajador = modalEdit.querySelector('.modal-body #nombre_trabajador')
        var modalBodyInputRespuesta = modalEdit.querySelector('.modal-body #respuesta')

        //Se toman los atributos dle propio boton
        var nombre_cliente = button.getAttribute('data-nombre-cliente')
        var pqr = button.getAttribute('data-tipo-pqr')
        var descripcion = button.getAttribute('data-descripcion')
        var trabajador = button.getAttribute('data-nombre-trabajador')
        var respuesta = button.getAttribute('data-respuesta')

        //Se settean los nuevos atributos
        modalBodyInputCliente.value = nombre_cliente
        modalBodyInputPQR.value = pqr
        modalBodyInputDescripcion.value = descripcion
        modalBodyInputTrabajador.value = trabajador
        modalBodyInputRespuesta.value = respuesta

    })
</script>
