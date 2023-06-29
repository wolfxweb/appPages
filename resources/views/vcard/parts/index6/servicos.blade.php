
@if (is_array($prefs) && in_array('Information', $prefs))
<!--====== Start Contact-information ======-->
<div class="contact-info-two">
    @if (!empty($vcard->phone))
    <div class="info-box d-flex">
        <div class="icon">
            <i class="fas fa-phone"></i>
        </div>
        <div class="text">
            <h3>{{$keywords["Telefone"] ?? "Phone"}}</h3>
            <p><a href="tel:{{$vcard->phone}}">{{$vcard->phone}}</a></p>
        </div>
    </div>
    @endif
    @if (!empty($vcard->email))
    <div class="info-box d-flex">
        <div class="icon">
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
        <div class="icon">
            <i class="fas fa-map-marker-alt"></i>
        </div>
        <div class="text">
            <h3>{{$keywords["Endereço"] ?? "Address"}}</h3>
            <p>{{$vcard->address}}</p>
        </div>
    </div>
    @endif
    @if (!empty($vcard->website_url))
    <div class="info-box d-flex">
        <div class="icon">
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
            <div class="icon">
                <i class="{{$info['icon']}}"></i>
            </div>
            <div class="text">
                <h3>{{$info['label']}}</h3>
                <p><a @if ($info['link'] == 1) target="_blank" href="{{$info['value']}}" @endif>{{$info['value']}}</a></p>
            </div>
        </div>
    @endforeach
</div><!--====== End Contact-information ======-->
@endif

@if (is_array($prefs) && in_array('About Us', $prefs))
    <!--====== Start About ======-->
    <div class="section-widget about-area-two mb-30">
        <h3 class="widget-title">{{$keywords["Sobre_nós"] ?? "Sobre nós"}}</h3>
        <div class="about-content">
            <p>{!! $vcard->about !!}</p>
        </div>
    </div><!--====== End About ======-->
@endif

@if (is_array($prefs) && in_array('Services', $prefs))
    <!--====== Start Service ======-->
    <div class="section-widget service-area-two mb-25">
        <div class="row">
            <div class="col-8">
                <h3 class="widget-title">{{$keywords["Serviços"] ?? "Serviços"}}</h3>
            </div>
            <div class="col-4">
                <div class="service-arrows"></div>
            </div>
        </div>
        <div class="service-slider-one">
            @php
                $services = !empty($vcard->user_vcard_services) ? $vcard->user_vcard_services()->orderBy('serial_number', 'ASC')->get() : [];
            @endphp
            @foreach ($services as $service)
                <div class="service-item">
                    @if ($service->external_link_status == 1 && !empty($service->external_link))

                    <a class="img-holder d-block" href="{{$service->external_link}}" target="_blank">

                    @elseif ($service->external_link_status == 0 && !empty($service->short_details))

                    <a href="#" data-toggle="modal" data-target="#serviceDetails" class="d-block img-holder no-ext" data-details="{{$service->short_details}}">

                    @endif
                        <img class="lazy" data-src="{{asset('assets/front/img/user/services/' . $service->image)}}" alt="Image">
                        <div class="img-overlay">
                            <div class="hover-content">
                                <h3>{{$service->title}}</h3>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div><!--====== End Service ======-->
    <div class="modal fade" id="serviceDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{$keywords["Details"] ?? "Details"}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
@endif