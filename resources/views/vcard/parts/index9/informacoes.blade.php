@if (is_array($prefs) && in_array('Information', $prefs))
<!--====== Start Contact-information  ======-->
<div class="section-widget contact-info-five">
    @if (!empty($vcard->phone))
    <div class="info-box d-flex">
        <div class="icon" style="color: #{{$vcard->base_color}};background-color: #{{$vcard->base_color}}1A;">
            <i class="fas fa-phone"></i>
        </div>
        <div class="text">
            <h3>{{$keywords["Telefone"] ?? "Telefone"}}</h3>
            <p><a href="tel:{{$vcard->phone}}">{{$vcard->phone}}</a></p>
        </div>
    </div>
    @endif
    @if (!empty($vcard->email))
    <div class="info-box d-flex">
        <div class="icon" style="color: #{{$vcard->base_color}};background-color: #{{$vcard->base_color}}1A;">
            <i class="fas fa-paper-plane"></i>
        </div>
        <div class="text">
            <h3>{{$keywords["Email"] ?? "Email"}}</h3>
            <p><a href="mailto:{{$vcard->email}}">{{$vcard->email}}</a></p>
        </div>
    </div>
    @endif
    @if (!empty($vcard->address))
    <div class="info-box d-flex">
        <div class="icon" style="color: #{{$vcard->base_color}};background-color: #{{$vcard->base_color}}1A;">
            <i class="fas fa-map-marker-alt"></i>
        </div>
        <div class="text">
            <h3>{{$keywords["Endereço"] ?? "Endereço"}}</h3>
            <p>{{$vcard->address}}</p>
        </div>
    </div>
    @endif
    @if (!empty($vcard->website_url))
    <div class="info-box d-flex">
        <div class="icon" style="color: #{{$vcard->base_color}};background-color: #{{$vcard->base_color}}1A;">
            <i class="fas fa-link"></i>
        </div>
        <div class="text">
            <h3>{{$keywords["Website_URL"] ?? "Website"}}</h3>
            <p><a href="{{$vcard->website_url}}">{{$vcard->website_url}}</a></p>
        </div>
    </div>
    @endif
    @foreach ($infos as $info)
        <div class="info-box d-flex">
            <div class="icon" style="color: #{{$vcard->base_color}};background-color: #{{$vcard->base_color}}1A;">
                <i class="{{$info['icon']}}"></i>
            </div>
            <div class="text">
                <h3>{{$info['label']}}</h3>
                <p><a @if ($info['link'] == 1) target="_blank" href="{{$info['value']}}" @endif>{{$info['value']}}</a></p>
            </div>
        </div>
    @endforeach
</div><!--====== End Contact-information  ======-->
@endif