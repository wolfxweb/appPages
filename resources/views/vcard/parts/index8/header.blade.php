@if (is_array($prefs) && in_array('Header', $prefs))
    <div class="admin-box-four">
        <div class="admin-info-box text-center">
            <div class="user-thumb">
                <img class="lazy"
                    data-src="{{ !empty($vcard->profile_image) ? asset('assets/front/img/user/vcard/' . $vcard->profile_image) : asset('assets/front/img/user/blank_propic.png') }}"
                    alt="user thumb">
                @if (is_array($prefs) && in_array('Share vCard', $prefs))
                    <a href="#" style="background: #{{ $vcard->share_vcard_button_color }}" data-toggle="modal"
                        data-target="#socialMediaModal" class="share-btn"><i class="fas fa-share-alt"></i></a>
                @endif
            </div>
            <div class="user-info">
                <div class="user-title">
                    <h3>{{ $vcard->name }}</h3>
                    @if (!empty($vcard->occupation))
                        <p class="position">
                            {{ $vcard->occupation }}
                            @if (!empty($vcard->company))
                                ({{ $vcard->company }})
                            @endif
                        </p>
                    @endif
                </div>
                <p>{{ $vcard->introduction }}</p>
            </div>
            @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Add to Contact', $prefs)))
                <a style="background: #{{ $vcard->add_to_contact_button_color }}"
                    href="{{ route('front.user.vcardImport', [getParam(), $vcard->id]) }}" class="user-btn"><i
                        class="fas fa-plus"></i>{{ $keywords['Adicionar_contato'] ?? 'Adicionar contato' }}</a>
            @endif
        </div>
    </div>
    <!--====== End Admin-box  ======-->
    <!--====== Start User Social  ======-->
    <div class="user-social user-social-two text-center">
        <ul>
            @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Call', $prefs)))
                <li><a style="background: #{{ $vcard->call_button_color }}42;color: #{{ $vcard->call_button_color }}"
                        href="tel:{{ $vcard->phone }}"><i class="fas fa-phone"></i></a></li>
            @endif
            @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Whatsapp', $prefs)))
                <li><a style="background: #{{ $vcard->whatsapp_button_color }}42;color: #{{ $vcard->whatsapp_button_color }};"
                        href="https://wa.me/{{ $vcard->phone }}?text=Hello"><i class="fab fa-whatsapp"></i></a></li>
            @endif
            @if (!empty($vcard->email) && (is_array($prefs) && in_array('Mail', $prefs)))
                <li><a style="background: #{{ $vcard->mail_button_color }}42;color: #{{ $vcard->mail_button_color }}"
                        href="mailto:{{ $vcard->email }}"><i class="fas fa-envelope"></i></a></li>
            @endif
        </ul>
    </div>
@endif
