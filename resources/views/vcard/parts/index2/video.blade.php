@if (is_array($prefs) && in_array('Video', $prefs))
<div class="video-section-widget video-section-three">
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                <h4>{{$keywords["Video"] ?? "Video"}}</h4>
            </div>
        </div>
    </div>
    @if (!empty($vcard->video))
    <div class="row d-flex justify-content-center">
        @php
            echo $vcard->video;
        @endphp
    </div>
    @endif
</div>
@endif