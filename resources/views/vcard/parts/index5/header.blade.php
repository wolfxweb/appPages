@if (is_array($prefs) && in_array('Header', $prefs))
<div class="admin-box admin-box-one bg_cover lazy" data-bg="{{!empty($vcard->cover_image) ? asset('assets/front/img/user/vcard/' . $vcard->cover_image) : asset('assets/front/img/user/vcard/vcard_cover.jpg')}}">
    <div class="admin-info-box d-flex">
        <div class="user-thumb">
            <img class="lazy" data-src="{{!empty($vcard->profile_image) ? asset('assets/front/img/user/vcard/' . $vcard->profile_image) : asset('assets/front/img/user/blank_propic.png')}}" alt="user thumb">
            <div class="user-social">
                <ul>
                    @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Telefone', $prefs)))
                    <li><a href="tel:{{$vcard->phone}}"><i class="fas fa-phone"></i></a></li>
                    @endif
                    @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Whatsapp', $prefs)))
                    <li><a href="https://wa.me/{{$vcard->phone}}?text=Hello"><i class="fab fa-whatsapp"></i></a></li>
                    @endif
                    @if (!empty($vcard->email) && (is_array($prefs) && in_array('Email', $prefs)))
                    <li><a href="mailto:{{$vcard->email}}"><i class="fas fa-envelope"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="user-info">
            <div class="user-title">
                @if (!empty($vcard->name))
                <h3>{{$vcard->name}}</h3>
                @endif
                @if (!empty($vcard->occupation))
                <p class="position">
                    {{$vcard->occupation}}, 
                    @if (!empty($vcard->company))
                    ({{$vcard->company}})
                    @endif
                </p>
                @endif
            </div>
            <p>{{$vcard->introduction}}</p>
        </div>
        <div class="user-button">
            @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Add to Contact', $prefs)))
                <a href="{{route('front.user.vcardImport', [getParam(), $vcard->id])}}" class="user-btn"><i class="fas fa-plus"></i>{{$keywords["Adicionar_contato"] ?? "Adicionar contato"}}</a>
            @endif
        </div>
        @if (is_array($prefs) && in_array('Share vCard', $prefs))
            <a href="#" data-toggle="modal" data-target="#socialMediaModal" class="share-btn"><i class="fas fa-share-alt"></i></a>
        @endif
    </div>
</div>
@endif