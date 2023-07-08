
@if (is_array($prefs) && in_array('Google Maps', $prefs))
<div class="mb-25 contact-section-widget contact-section-three ">
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                <h3><font face="verdana" size="5" color="red">{{$keywords["mapa"] ?? "Onde estamos"}}</font></h3>
            </div>
        </div>
    </div>
    <div class="embed-responsive embed-responsive-16by9">
        @php
            echo $vcard->google_maps;
        @endphp
    </div>
</div>
@endif
