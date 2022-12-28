<footer style="background-color: #001c35;" class="p-0 m-0">
  <div class="container">
    <div class="row p-4">
      @php
        $detail = App\Models\About::first();
        $contacts = App\Models\ContactPerson::get();
      @endphp
      <div class="col-sm p-4">
        <div class="text-center">
          <img
            src="{{ !empty($detail['logo_footer']) ? asset('images/logo/' . $detail['logo_footer']) : asset('template/images/logo-mtd-logo.png') }}"
            alt="Your Happy Family" width="50px">
        </div>
        <div style="margin-top: -60px">
          <h3 class="text-center">MAME TIRTA DEWATA</h3>
          <p class="text-center" style="margin-top: -25px">
            {{ ucwords($detail['alamat']) . ' ' . ucwords($detail['kelurahan']) . ' ' . ucwords($detail['kecamatan']) . ' ' . ucwords($detail['kabupaten']) . ' ' . ucwords($detail['provinsi']) }}
          </p>
          <div class="text-center">
            @if (sizeof($contacts) > 0)
              @foreach ($contacts as $contact)
                <strong>{{ ucwords($contact['contact_media']) }}: </strong>{{ $contact['contact'] }}<br>
              @endforeach
            @endif
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
              <li class="list-group-item" style="background-color: #001c35"><i class="fa-solid fa-pen px-2 py-1"></i>
                {{ ucwords($service['service_name']) }}</li>
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
      Mame Titra Dewata (c) {{ date('Y') }} | <a href="{{ route('home.index') }}">All Right Reserved</a> | Website
      Template Designed by
      TemplateMonster.com
    </div>
  </div>
  </div>
</footer>
