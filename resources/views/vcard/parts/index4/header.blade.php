@if (is_array($prefs) && in_array('Header', $prefs))
<div class="page-banner bg_cover" style="background-image: url({{!empty($vcard->cover_image) ? asset('assets/front/img/user/vcard/' . $vcard->cover_image) : asset('assets/front/img/user/vcard/vcard_cover.jpg')}});"></div>
<div class="admin-wrapper">
    <div class="admin-card text-center">
        <div class="thumb">
            <img src="{{!empty($vcard->profile_image) ? asset('assets/front/img/user/vcard/' . $vcard->profile_image) : asset('assets/front/img/user/blank_propic.png')}}" alt="Thumb">
        </div>
        <div class="content">
            <div class="admin-title">
                <h5>{{$vcard->name}}</h5>
                <span class="position">{{$vcard->occupation}}</span>
            </div>
            <p>{{$vcard->introduction}}</p>
            <div class="actions">
                @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Call', $prefs)))
                <div class="action-btn">
                    <a class="call" href="tel:{{$vcard->phone}}" style="background: #{{$vcard->call_button_color}}"><i class="fas fa-mobile-alt"></i></a>
                    <br>
                    <span>{{$keywords["Chamar"] ?? "Telefone"}}</span>
                </div>
                @endif
                @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Whatsapp', $prefs)))
                <div class="action-btn">
                    <a href="https://wa.me/{{$vcard->phone}}?text=Hello" class="whatsapp" style="background: #{{$vcard->whatsapp_button_color}}"><i class="fab fa-whatsapp"></i></a>
                    <br>
                    <span>{{$keywords["Whatsapp"] ?? "Whatsapp"}}</span>
                </div>
                @endif
                @if (!empty($vcard->email) && (is_array($prefs) && in_array('Mail', $prefs)))
                <div class="action-btn">
                    <a class="mail" href="mailto:{{$vcard->email}}" style="background: #{{$vcard->mail_button_color}}"><i class="far fa-envelope"></i></a>
                    <br>
                    <span>{{$keywords["Email"] ?? "Email"}}</span>
                </div>
                @endif
            </div>
            <div class="more-btns text-center mt-3">
                @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Add to Contact', $prefs)))
                <a href="{{route('front.user.vcardImport', [getParam(), $vcard->id])}}" class="add-contact" style="background: #{{$vcard->add_to_contact_button_color}}"><i class="fas fa-plus"></i> {{$keywords["Add_to_Contact"] ?? "Add to Contact"}}</a>
                @endif
                @if (is_array($prefs) && in_array('Share vCard', $prefs))
                <a href="#" data-toggle="modal" data-target="#socialMediaModal" class="share" style="background: #{{$vcard->share_vcard_button_color}}"><i class="fas fa-share-square"></i> {{$keywords["Share_vCard"] ?? "Share vCard"}}</a>
                @endif
            </div>
        </div>
    </div>
</div>

@endif