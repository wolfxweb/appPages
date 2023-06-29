
@if (is_array($prefs) && in_array('Video', $prefs))
<!--====== Start Video ======-->
<div class="section-widget intro-area-two mb-25">
    <div class="video-slider-one">
        @if (!empty($vcard->video))
        <div class="intro-item">
            <div class="img-holder">
                <div>
                    @php
                        echo $vcard->video;
                    @endphp
                </div>
            </div>
        </div>
    @endif
    </div>
</div><!--====== End Video ======-->
@endif