@if (is_array($prefs) && in_array('About Us', $prefs))
<!--====== Start About ======-->
<div class="section-widget about-area-three mb-25">
    <h3 class="widget-title">{{$keywords["Sobre_nós"] ?? "Sobre nós"}}</h3>
    <div class="about-content">
        {!! $vcard->about !!}
    </div>
</div><!--====== End About ======-->
@endif