<footer style="background-color: #001c35;" class="p-0 m-0">
  <div class="container">
    <div class="row p-4">
      @php
        $detail = App\Models\About::first();
        $contacts = App\Models\ContactPerson::get();
        $was = App\Models\ContactPerson::where('contact_media', 'wa')->get();
        $hps = App\Models\ContactPerson::where('contact_media', 'hp')->get();
        $tgs = App\Models\ContactPerson::where('contact_media', 'telegram')->get();
        $emails = App\Models\ContactPerson::where('contact_media', 'email')->get();
      @endphp
      <div class="col-sm p-4">
        <div class="text-center">
          <img
            src="{{ !empty($detail['logo_footer']) ? asset('images/logo/' . $detail['logo_footer']) : asset('template/images/logo-mtd-logo.png') }}"
            alt="Your Happy Family" style="width: 50px;">
        </div>
        <div style="margin-top: -60px">
          <h3 class="text-center">MAME TIRTA DEWATA</h3>
          <p class="text-center" style="margin-top: -25px">
            {{ ucwords($detail['alamat']) . ' ' . ucwords($detail['kelurahan']) . ' ' . ucwords($detail['kecamatan']) . ' ' . ucwords($detail['kabupaten']) . ' ' . ucwords($detail['provinsi']) }}
          </p>
          <div class="text-center mt-0">
            <span>
              @if (isset($hps) && sizeof($hps) > 0)
                {{ 'HP: ' }}
                @foreach ($hps as $hp)
                  {{ ' ' . $hp['contact'] . ', ' }}
                @endforeach
              @endif
            </span>
            <br>
            <span>
              @if (isset($was) && sizeof($was) > 0)
                {{ 'WA: ' }}
                @foreach ($was as $wa)
                  {{ ' ' . $wa['contact'] . ', ' }}
                @endforeach
              @endif
            </span>
            <br>
            <span>
              @if (isset($telegram) && sizeof($telegram) > 0)
                {{ 'Telegram: ' }}
                @foreach ($telegram as $tg)
                  {{ ' ' . $tg['contact'] . ', ' }}
                @endforeach
              @endif
            </span>
            <span>
              @if (isset($emails) && sizeof($emails) > 0)
                {{ 'Email: ' }}
                @foreach ($emails as $email)
                  {{ ' ' . $email['contact'] . ', ' }}
                @endforeach
              @endif
            </span>
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
