<div class="admin-box-two">
    <div class="admin-info-box text-center" style="background-color: #{{$vcard->summary_background_color}};">
        <div class="user-thumb">
            <img class="lazy" data-src="{{!empty($vcard->profile_image) ? asset('assets/front/img/user/vcard/' . $vcard->profile_image) : asset('assets/front/img/user/blank_propic.png')}}" alt="user thumb">
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
            @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Add to Contact', $prefs)))
                <a href="{{route('front.user.vcardImport', [getParam(), $vcard->id])}}" class="user-btn"><i class="fas fa-plus"></i>{{$keywords["Adicionar_contato"] ?? "Adicionar contato "}}</a>
            @endif
            <div class="user-social d-flex justify-content-between">
                <ul>
                    @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Call', $prefs)))
                    <li><a href="tel:{{$vcard->phone}}"><i class="fas fa-phone"></i></a></li>
                    @endif
                    @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Whatsapp', $prefs)))
                    <li><a href="https://wa.me/{{$vcard->phone}}?text=Hello"><i class="fab fa-whatsapp"></i></a></li>
                    @endif
                    @if (!empty($vcard->email) && (is_array($prefs) && in_array('Mail', $prefs)))
                    <li><a href="mailto:{{$vcard->email}}"><i class="fas fa-envelope"></i></a></li>
                    @endif
                </ul>
                @if (is_array($prefs) && in_array('Share vCard', $prefs))
                    <a href="#" data-toggle="modal" data-target="#socialMediaModal" class="share-btn"><i class="fas fa-share-alt"></i></a>
                @endif
            </div>
        </div>
    </div>
</div><!--====== End Admin ======-->