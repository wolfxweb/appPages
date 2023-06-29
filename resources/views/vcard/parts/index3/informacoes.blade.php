@if (is_array($prefs) && in_array('Information', $prefs))


<div class="page-info-widget">
    @if (!empty($vcard->phone))
    <div class="info-widget d-flex align-items-center">
        <a href="tel:{{$vcard->phone}}" class="icon icon-1" style="background: #{{$vcard->phone_icon_color}}1a;">
            <i class="fas fa-mobile-alt" style="color: #{{$vcard->phone_icon_color}};"></i>
        </a>
        <div class="content">
            <span class="title">{{$keywords["Telefone"] ?? "Telefone"}}</span>
            <h5><a href="tel:{{$vcard->phone}}">{{$vcard->phone}}</a></h5>
        </div>
    </div>
    @endif
    @if (!empty($vcard->email))
    <div class="info-widget d-flex align-items-center">
        <a href="mailto:{{$vcard->email}}" class="icon icon-1" style="background: #{{$vcard->email_icon_color}}1a;">
            <i class="fas fa-at" style="color: #{{$vcard->email_icon_color}};"></i>
        </a>
        <div class="content">
            <span class="title">{{$keywords["Email"] ?? "Email"}}</span>
            <h5><a href="mailto:{{$vcard->email}}">{{$vcard->email}}</a></h5>
        </div>
    </div>
    @endif
    @if (!empty($vcard->address))
    <div class="info-widget d-flex align-items-center">
        <a href="https://www.google.com/maps?q={{$vcard->address}}" class="icon icon-1" style="background: #{{$vcard->address_icon_color}}1a;">
            <i class="fas fa-map-marker-alt" style="color: #{{$vcard->address_icon_color}};"></i>
        </a>
        <div class="content">
            <span class="title">{{$keywords["Endereço"] ?? "Endereço"}}</span>
            <h5><a href="https://www.google.com/maps?q={{$vcard->address}}">{{$vcard->address}}</a></h5>
        </div>
    </div>
    @endif
    @if (!empty($vcard->website_url))
    <div class="info-widget d-flex align-items-center">
        <a class="icon icon-1" href="{{$vcard->website_url}}" target="_blank" style="background: #{{$vcard->website_url_icon_color}}1a;">
            <i class="fas fa-link" style="color: #{{$vcard->website_url_icon_color}};"></i>
        </a>
        <div class="content">
            <span class="title">{{$keywords["Website_URL"] ?? "Website_URL"}}</span>
            <h5><a href="{{$vcard->website_url}}" target="_blank">{{$vcard->website_url}}</a></h5>
        </div>
    </div>
    @endif
    @foreach ($infos as $info)
        <div class="info-widget d-flex align-items-center">
            @if ($info['link'] == 1) 
            <a class="icon icon-1" href="{{$info['value']}}" target="_blank">
                <i class="{{$info['icon']}}" style="color: #{{$info['color']}}"></i>
            </a>
            @else
            <div class="icon icon-1" style="background: #{{$info['color']}}1a">
                <i class="{{$info['icon']}}" style="color: #{{$info['color']}}"></i>
            </div>
            @endif
            <div class="content">
                <span class="title">{{$info['label']}}</span>
                <h5><a @if ($info['link'] == 1) target="_blank" href="{{$info['value']}}" @endif>{{$info['value']}}</a></h5>
            </div>
        </div>
    @endforeach
</div>



@endif