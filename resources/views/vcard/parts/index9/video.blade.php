@if (is_array($prefs) && in_array('Video', $prefs))
<!--====== Start Video  ======-->
<div class="section-widget intro-area-five mb-25">
    @if (!empty($vcard->video))
        <div class="intro-item">
            <div class="img-holder">
                <div class="row d-flex justify-content-center">
                    @php
                        echo $vcard->video;
                    @endphp
                </div> 
            </div>
        </div>
    @endif
</div><!--====== End Video  ======-->
@endif