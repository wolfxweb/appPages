@if (is_array($prefs) && in_array('Services', $prefs))
<!--====== Start Service  ======-->
<div class="section-widget service-area-five mb-25">
    <div class="row">
        <div class="col-8">
            <h3 class="widget-title">{{$keywords["Serviços"] ?? "Nossos serviços"}}</h3>
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
            @if ($service->external_link_status == 1 && !empty($service->external_link))

            <a class="d-block service-item" href="{{$service->external_link}}" target="_blank">

            @elseif ($service->external_link_status == 0 && !empty($service->short_details))

            <a href="#" data-toggle="modal" data-target="#serviceDetails" class="d-block no-ext service-item" data-details="{{$service->short_details}}">

            @endif
                <div class="img-holder">
                    <img data-src="{{asset('assets/front/img/user/services/' . $service->image)}}" alt="Image" class="lazy w-100">
                    <div class="img-overlay">
                        <div class="hover-content">
                            <h3>{{$service->title}}</h3>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div><!--====== End Service  ======-->

<!-- Modal -->
<div class="modal fade" id="serviceDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{$keywords["Detalhes"] ?? "Detalhes"}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
@endif