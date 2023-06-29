@if (is_array($prefs) && in_array('Information', $prefs))
<div class="page-info-widget">
    <div class="rectangle">
        <span></span>
        <span></span>
        <span></span>
    </div>
    @if (!empty($vcard->phone))
    <style>
        .page-content-one .page-info-widget .info-widget .icon-phone:after {
            border: 1px solid #{{$vcard->phone_icon_color}};
        }
    </style>
    <div class="info-widget d-flex align-items-center">
        <a href="tel:{{$vcard->phone}}" class="icon icon-phone" style="background: #{{$vcard->phone_icon_color}};">
            <i class="fas fa-mobile-alt"></i>
        </a>
        <div class="content">
            <span class="title">{{$keywords["Call"] ?? "Telefone"}}</span>
            <h5><a href="tel:{{$vcard->phone}}">{{$vcard->phone}}</a></h5>
        </div>
    </div>
    @endif
    @if (!empty($vcard->email))
    <style>
        .page-content-one .page-info-widget .info-widget .icon-email:after {
            border: 1px solid #{{$vcard->email_icon_color}};
        }
    </style>
    <div class="info-widget d-flex align-items-center">
        <a href="mailto:{{$vcard->email}}" class="icon icon-email" style="background: #{{$vcard->email_icon_color}};">
            <i class="fas fa-at"></i>
        </a>
        <div class="content">
            <span class="title">{{$keywords["Email"] ?? "Email"}}</span>
            <h5><a href="mailto:{{$vcard->email}}">{{$vcard->email}}</a></h5>
        </div>
    </div>
    @endif
    @if (!empty($vcard->address))
    <style>
        .page-content-one .page-info-widget .info-widget .icon-address:after {
            border: 1px solid #{{$vcard->address_icon_color}};
        }
    </style>
    <div class="info-widget d-flex align-items-center">
        <a href="https://www.google.com/maps?q={{$vcard->address}}" class="icon icon-address" style="background: #{{$vcard->address_icon_color}};">
            <i class="fas fa-map-marker-alt"></i>
        </a>
        <div class="content">
            <span class="title">{{$keywords["Address"] ?? "Address"}}</span>
            <h5><a href="https://www.google.com/maps?q={{$vcard->address}}">{{$vcard->address}}</a></h5>
        </div>
    </div>
    @endif
    @if (!empty($vcard->website_url))
    <style>
        .page-content-one .page-info-widget .info-widget .icon-url:after {
            border: 1px solid #{{$vcard->website_url_icon_color}};
        }
    </style>
    <div class="info-widget d-flex align-items-center">
        <a class="icon icon-url" href="{{$vcard->website_url}}" target="_blank" style="background: #{{$vcard->website_url_icon_color}};">
            <i class="fas fa-link"></i>
        </a>
        <div class="content">
            <span class="title">{{$keywords["Website_URL"] ?? "Website_URL"}}</span>
            <h5><a href="{{$vcard->website_url}}" target="_blank">{{$vcard->website_url}}</a></h5>
        </div>
    </div>
    @endif
    @foreach ($infos as $info)
        <style>
            .page-content-one .page-info-widget .info-widget .icon{{$loop->iteration}}:after {
                border: 1px solid #{{$info['color']}};
            }
        </style>
        <div class="info-widget d-flex align-items-center">
            @if ($info['link'] == 1) 
            <a class="icon icon{{$loop->iteration}}" href="{{$info['value']}}" target="_blank" style="background: #{{$info['color']}};">
                <i class="{{$info['icon']}}"></i>
            </a>
            @else
            <div class="icon icon{{$loop->iteration}}" style="background: #{{$info['color']}}">
                <i class="{{$info['icon']}}"></i>
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