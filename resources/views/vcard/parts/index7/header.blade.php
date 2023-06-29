<div class="admin-box-three bg_cover lazy" data-bg="{{!empty($vcard->cover_image) ? asset('assets/front/img/user/vcard/' . $vcard->cover_image) : asset('assets/front/img/user/vcard/vcard_cover.jpg')}}">
    <div class="admin-info-box text-center">
        <div class="user-info">
            <div class="user-title">
                <h3>{{$vcard->name}}</h3>
                @if (!empty($vcard->occupation))
                <p class="position">
                    {{$vcard->occupation}}
                    @if (!empty($vcard->company))
                    ({{$vcard->company}})
                    @endif
                </p>
                @endif
            </div>
            <p>{{$vcard->introduction}}</p>
        </div>
    </div>
    <div class="user-thumb">
        <img class="lazy" data-src="{{!empty($vcard->profile_image) ? asset('assets/front/img/user/vcard/' . $vcard->profile_image) : asset('assets/front/img/user/blank_propic.png')}}" alt="user thumb">
    </div>
</div><!--====== End Admin  ======-->
<!--====== Start User Social ======-->
<div class="user-social user-social-one text-center">
    <ul class="d-flex">
        @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Call', $prefs)))
        <li><a style="background: #{{$vcard->call_button_color}}" href="tel:{{$vcard->phone}}"><i class="fas fa-phone"></i></a></li>
        @endif
        @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Whatsapp', $prefs)))
        <li><a style="background: #{{$vcard->whatsapp_button_color}}" href="https://wa.me/{{$vcard->phone}}?text=Hello"><i class="fab fa-whatsapp"></i></a></li>
        @endif
        @if (!empty($vcard->email) && (is_array($prefs) && in_array('Mail', $prefs)))
        <li><a style="background: #{{$vcard->mail_button_color}}" href="mailto:{{$vcard->email}}"><i class="fas fa-envelope"></i></a></li>
        @endif
        @if (is_array($prefs) && in_array('Share vCard', $prefs))
        <li><a href="#" style="background: #{{$vcard->share_vcard_button_color}}" data-toggle="modal" data-target="#socialMediaModal" class="share-btn purple-bg"><i class="fas fa-share-alt"></i></a></li>
        @endif
    </ul>
    @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Add to Contact', $prefs)))
    <a style="background: #{{$vcard->add_to_contact_button_color}}" href="{{route('front.user.vcardImport', [getParam(), $vcard->id])}}" class="user-btn"><i class="fas fa-plus"></i>{{$keywords["Adicionar_contato"] ?? "Adicionar_contato"}}</a>
    @endif
</div><!--====== End User Social ======-->