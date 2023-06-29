@if (is_array($prefs) && in_array('Projects', $prefs))
<!--====== Start Project  ======-->
<div class="section-widget project-area-five mb-25">
    <div class="row">
        <div class="col-8">
            <h3 class="widget-title">{{$keywords["Projetos"] ?? "Projetos"}}</h3>
        </div>
        <div class="col-4">
            <div class="project-arrows"></div>
        </div>
    </div>
    @php
        $projects = !empty($vcard->user_vcard_projects) ? $vcard->user_vcard_projects()->orderBy('serial_number', 'ASC')->get() : [];
    @endphp
    @if (!empty($projects))
    <div class="project-slider-one">
        @foreach ($projects as $project)
            <div class="project-item">
                <div class="img-holder">
                    <img data-src="{{asset('assets/front/img/user/projects/' . $project->image)}}" alt="portfolio" class="w-100 lazy">
                    <a class="img-overlay img-popup" href="{{asset('assets/front/img/user/projects/' . $project->image)}}">
                        <div class="hover-content">
                            <h3>{{$project->title}}</h3>
                        </div>
                    </a>
                </div>
                @if ($project->external_link_status == 1 && !empty($project->external_link))
                    <a href="{{$project->external_link}}" target="_blank" class="btn_link d-block text-center">{{$keywords["Details"] ?? "Details"}}</a>
                @elseif ($project->external_link_status == 0 && !empty($project->short_details))
                    <a href="#" data-toggle="modal" data-target="#projectDetails" class="btn_link d-block text-center" data-details="{{$project->short_details}}">{{$keywords["Details"] ?? "Details"}}</a>
                @endif
            </div>
        @endforeach
    </div>
    @endif
</div><!--====== End Project  ======-->

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
@endif