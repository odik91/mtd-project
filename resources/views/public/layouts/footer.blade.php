<footer style="background-color: #001c35;">
    <div class="container">
      <div class="row p-4">
        <div class="col-sm p-4">
          <div class="text-center">
            <img src="{{ asset('template/images/logo-mtd-logo.png') }}" alt="Your Happy Family" width="50px">
          </div>
          <div style="margin-top: -60px">
            <h3 class="text-center">MAME TIRTA DEWATA</h3>
            <p class="text-center" style="margin-top: -25px">
              Ruko Puri Selebriti 1 Blok B No 79 Batu Besar Nongsa Batam
            </p>
            <div class="text-center">
              <strong>Email: </strong>mametirtadewata90@gmail.com <br>
              <strong>Phone: </strong>+62 813 7788 7790 <br>
                {{-- <div class="socials text-center" style="float: none; display: flex; justify-content: center">
                  <a href="#" class="fa-brands fa-whatsapp"></a>
                  <a href="#" class="fa-brands fa-facebook"></a>
                  <a href="#" class="fa-brands fa-twitter"></a>
                  <a href="#" class="fa-brands fa-google"></a>
                </div> --}}
            </div>
          </div>
        </div>
        <div class="col-sm p-4">
          <div class="text-center" style="margin-top: -60px">
            <h4>Our Services</h4>
          </div>
          <div class="px-4">
            <ul class="list-group list-group-flush">
              @foreach (App\Models\OurService::get() as $service)
              <li class="list-group-item" style="background-color: #001c35"><i class="fa-solid fa-pen px-2 py-1"></i> {{ ucwords($service['service_name']) }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
    <hr class="bg-secondary">
    <div class="container_12">
        {{-- <div class="socials">
          <a href="#" class="fa-brands fa-facebook"></a>
          <a href="#" class="fa-brands fa-twitter"></a>
          <a href="#" class="fa-brands fa-google"></a>
        </div> --}}
        <div class="copy">
          Mame Titra Dewata (c) 2022 | <a href="#">All Right Reserved</a> | Website Template Designed by
          TemplateMonster.com
        </div>
      </div>
    </div>
  </footer>