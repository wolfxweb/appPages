@if (is_array($prefs) && in_array('Video', $prefs))
<div class="video-section-widget video-section-three">
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                @include('vcard.includes.titulo', [
                    'titulo' => $keywords["Video"] ?? "Video",
                    'fonte' => $vcard->font_title,
                    'size' => $vcard->font_title_size,
                    'cor' => $vcard->font_color,
                ])
            </div>
        </div>
    </div>
    @if (!empty($vcard->video))
    <div class="embed-responsive embed-responsive-16by9">
        @php
            echo $vcard->video;
        @endphp
    </div>

    @endif
</div>
@endif