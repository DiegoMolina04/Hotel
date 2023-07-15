<!-- Modal Reserva -->
<div
    class="modal fade"
    id="reserveModal"
    tabindex="-1"
    aria-labelledby="reserveModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="reserveModalLabel">
            Reserva tu habitación
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="room" class="form-label">Tipo Habitación</label>
              <select
                id="room"
                name="room"
                class="form-select"
                aria-label="Default select example"
              >
                <option value="1">Individual</option>
                <option value="2">Doble Común</option>
                <option value="3">Doble Twin</option>
                <option value="4">Empresarial</option>
                <option value="5">Matrimonial</option>
              </select>

              <div class="row mt-2">
                <div class="col-6">
                  <label for="dateStart">Fecha Inicio</label>
                  <input
                    class="form-control"
                    type="date"
                    name="dateStart"
                    id="dateStart"
                  />
                </div>
                <div class="col-6">
                  <label for="dateEnd">Fecha Final</label>
                  <input
                    class="form-control"
                    type="date"
                    name="dateEnd"
                    id="dateEnd"
                  />
                </div>
              </div>

              <div class="mt-2">
                <label for="fullname" class="form-label"
                  >Nombre Completo</label
                >
                <input
                  type="text"
                  class="form-control"
                  name="fullname"
                  id="fullname"
                />
              </div>

              <div class="mt-2">
                <label for="email" class="form-label"
                  >Correo Electrónico</label
                >
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                />
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button
            id="dismissReserve"
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Cerrar
          </button>
          <button
            type="button"
            class="btn btn-primary"
            onclick="saveReserve()"
          >
            Reservar
          </button>
        </div>
      </div>
    </div>
  </div>