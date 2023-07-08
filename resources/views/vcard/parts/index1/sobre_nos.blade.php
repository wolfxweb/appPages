@if (is_array($prefs) && in_array('About Us', $prefs))
<div class="about-section-widget about-section-three">
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                
                @include('vcard.includes.titulo', [
                    'titulo' => $keywords["Sobre nós"] ?? "Sobre nós",
                    'fonte' => $vcard->font_title,
                    'size' => $vcard->font_title_size,
                    'cor' => $vcard->font_color,
                ])
            </div>
        </div>
    </div>
    <div>
        @include('vcard.includes.text',['vcard'=>$vcard,'titulo'=>$vcard->about])

    </div>
</div>
@endif