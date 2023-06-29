@if (is_array($prefs) && in_array('About Us', $prefs))
<!--====== Start About ======-->
<div class="section-widget about-area-one white-bg">
    <h3 class="widget-title">{{$keywords["Sobre_nós"] ?? "Sobre nós"}}</h3>
    <div class="about-content">
        <p>{!! $vcard->about !!}</p>
    </div>
</div><!--====== End About ======-->
@endif
