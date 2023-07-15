    <!-- Navbar -->
    <nav class="navbar navbar-light">
        <div class="container-fluid">
          <div class="d-none d-lg-flex">
            <a
              href="https://wa.me/+573173077666?text=Hola,%20estoy%20interesad@%20en%20hacer%20una%20reservación"
              target="_blank"
            >
              <img
                width="45px"
                src="https://img.icons8.com/color/48/000000/whatsapp--v4.png"
              />
            </a>
            <a href="">
              <img
                width="45px"
                src="https://img.icons8.com/fluency/48/000000/facebook-circled.png"
              />
            </a>
            <a href="">
              <img
                src="https://img.icons8.com/fluency/48/000000/instagram-new.png"
              />
            </a>
          </div>
          <div class="row col-12 col-lg-9">
          <div class="col-8 col-md-10">
            <a {{ $attributes }}>
                <div class="row">
                  <div class="col-4">
                    <img class="headerIcon" src="{{asset('img/palmera.png')}}"/>
                  </div>
                  <p class="col-8 mt-4 d-none d-md-block" id="slog">Dale un respiro a tu vida</p>
                </div>
            </a>
          </div>
          <div class="col-4 col-md-2 align-text-middle d-flex flex-column justify-content-center">
            {{ $slot }}
          </div>
        </div>
        </div>
      </nav>