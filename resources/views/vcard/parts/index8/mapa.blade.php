@if (is_array($prefs) && in_array('Google Maps', $prefs))
    <div class="mb-25 contact-section-widget contact-section-three ">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    @include('vcard.includes.titulo', [
                        'titulo' => $keywords['mapa'] ?? 'Onde estamos',
                        'fonte' => $vcard->font_title,
                        'size' => $vcard->font_title_size,
                        'cor' => $vcard->font_color,
                    ])
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
