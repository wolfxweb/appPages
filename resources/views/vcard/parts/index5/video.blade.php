
@if (is_array($prefs) && in_array('Video', $prefs))
<!--====== Start Video ======-->
<div class="section-widget intro-area-one">
    <div class="row">
        <div class="col-12">
            <h3 class="widget-title">{{$keywords["Video"] ?? "Video"}}</h3>
        </div>
    </div>
    @if (!empty($vcard->video))
    <div>
        <div class="intro-item">
            <div class="img-holder">
                @php
                echo $vcard->video;
            @endphp
            </div>
        </div> 
 
    </div>
    @endif

</div><!--====== End Video ======-->
@endif
