@if (is_array($prefs) && in_array('About Us', $prefs))
<div class="about-section-widget about-section-three">
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                <h4>{{$keywords["Sobre_nós"] ?? "Sobre nós"}}</h4>
            </div>
        </div>
    </div>
    <div>
        {!! $vcard->about !!}
    </div>
</div>
@endif