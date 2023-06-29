@if (is_array($prefs) && in_array('Services', $prefs))
<div class="service-section-widget service-section-three">
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                <h4>{{$keywords["Serviços"] ?? "Serviços"}}</h4>
            </div>
        </div>
    </div>
    @php
        $services = !empty($vcard->user_vcard_services) ? $vcard->user_vcard_services()->orderBy('serial_number', 'ASC')->get() : [];
    @endphp
    @foreach ($services as $service)
        <div class="service-item mb-3">
            <div class="service-img">
                <img class="w-100 lazy" data-src="{{asset('assets/front/img/user/services/' . $service->image)}}" alt="service img">
            </div>
            <div class="content">
                <h4>{{$service->title}}</h4>
                <div class="button text-center">
                    @if ($service->external_link_status == 1 && !empty($service->external_link))
                    <a href="{{$service->external_link}}" target="_blank" class="main-btn btn-color-three">{{$keywords["Details"] ?? "Details"}}</a>
                    @elseif ($service->external_link_status == 0 && !empty($service->short_details))
                    <a href="#" data-toggle="modal" data-target="#serviceDetails{{$service->id}}" class="main-btn btn-color-three">{{$keywords["Detalhes"] ?? "Detalhes"}}</a>
                    @endif
                </div>
            </div>
        </div>

        @if ($service->external_link_status == 0 && !empty($service->short_details))
        <!-- Modal -->
        <div class="modal fade" id="serviceDetails{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{$keywords["Detalhes"] ?? "Detalhes"}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    {{$service->short_details}}
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
</div>
@endif