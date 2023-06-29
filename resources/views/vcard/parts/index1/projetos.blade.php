@if (is_array($prefs) && in_array('Projects', $prefs))
<div class="portfolio-section-widget portfolio-section-three">
    <div class="row align-items-center">
        <div class="col-8">
            <div class="section-title">
                <h4>{{$keywords["Projetos"] ?? "Projetos"}}</h4>
            </div>
        </div>
        <div class="col-4">
            <div class="portfolio-arrows"></div>
        </div>
    </div>
    @php
        $projects = !empty($vcard->user_vcard_projects) ? $vcard->user_vcard_projects()->orderBy('serial_number', 'ASC')->get() : [];
    @endphp
    @if (!empty($projects))
    <div class="portfolio-slider-one">
        @foreach ($projects as $project)
        <div class="portfolio-item">
            <div class="portfolio-img">
                <img data-src="{{asset('assets/front/img/user/projects/' . $project->image)}}" alt="portfolio" class="w-100 lazy">
                <a href="{{asset('assets/front/img/user/projects/' . $project->image)}}" class="portfolio-overlay img-popup">
                    <div class="info">
                        <h4 class="title">{{$project->title}}</h4>
                    </div>
                </a>
            </div>
            <div class="content text-center">
                @if ($project->external_link_status == 1 && !empty($project->external_link))
                <a href="{{$project->external_link}}" target="_blank" class="main-btn btn-color-three">Detalhes</a>
                @elseif ($project->external_link_status == 0 && !empty($project->short_details))
                <a href="#" data-toggle="modal" data-target="#projectDetails" class="main-btn btn-color-three" data-details="{{$project->short_details}}">{{$keywords["Detalhes"] ?? "Detalhes"}}</a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endif

<!-- Modal -->
<div class="modal fade" id="projectDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{$keywords["Detalhes"] ?? "Detalhes"}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>