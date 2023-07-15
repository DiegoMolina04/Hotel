<nav class="navbar navbar-light ">
        <div class="container-fluid mx-5">
          <div class="col-8 col-md-10">
            <a {{ $attributes }}>
                <div class="row">
                  <div class="col-2">
                    <img class="headerIcon" src="{{asset('img/palmera.png')}}"/>
                  </div>
                  <p class="col-10 mt-4 d-none d-md-block text-center" id="slog">Dale un respiro a tu vida</p>
                </div>
            </a>
          </div>
          <div class="col-4 col-md-2 align-text-middle d-flex flex-column justify-content-center">
            {{ $slot }}
          </div>
        </div>
      </nav>