<div style="position: fixed; bottom: 20px; left: 20px; z-index: 99;" id="sosmed-item">
  <div class="socials text-center" style="float: none; display: flex; flex-direction: column;">
    @php
      $wa = App\Models\ContactPerson::where('contact_media', 'wa')
          ->where('primary', 'primary')
          ->first();
      $detailWa = str_replace(' ', '', $wa['contact']);
    @endphp
    @if (isset($wa))
      <a href="https://wa.me/{{ $detailWa }}" class="fa-brands fa-whatsapp"
        style="margin-left: 0px; margin-bottom: 10px;" target="_blank"></a>
    @endif
    {{-- social media --}}
    @foreach (App\Models\SocialMedia::get() as $socialMedia)
      @if ($socialMedia['name'] == 'fb')
        <a href="{{ $socialMedia['link'] }}" class="fa-brands fa-facebook" target="_blank" title="facebook"
          style="margin-left: 0px; margin-bottom: 10px;"></a>
      @elseif($socialMedia['name'] == 'ig')
        <a href="{{ $socialMedia['link'] }}" target="_blank" title="instagram" class="fa-brands fa-instagram"
          style="margin-left: 0px; margin-bottom: 10px;"></a>
      @elseif($socialMedia['name'] == 'tiktok')
        <a href="{{ $socialMedia['link'] }}" target="_blank" title="tiktok" class="fa-brands fa-circle"
          style="margin-left: 0px; margin-bottom: 10px;"></a>
      @elseif($socialMedia['name'] == 'twitter')
        <a ref="{{ $socialMedia['link'] }}" target="_blank" title="twitter" class="fa-brands fa-twitter"
          style="margin-left: 0px; margin-bottom: 10px;"></a>
      @endif
    @endforeach
  </div>
</div>
