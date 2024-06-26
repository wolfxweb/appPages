@extends('vcard.layout')

@if ($vcard->direction == 2)
    @section('rtl', 'dir=rtl')
@endif

@if ($vcard->direction == 2)
@section('rtl-css')
<link rel="stylesheet" href="{{asset('assets/front/css/profile/vcard/template1234/vcard-rtl.css')}}">
@endsection
@endif

@section('base-color')
<link rel="stylesheet" href="{{asset('assets/front/css/profile/vcard/template1234/vcard-base-color.php').'?color='.$vcard->base_color}}">
@endsection

@section('og-image', asset('assets/front/img/user/vcard/' . $vcard->cover_image))
@section('og-title')
    {{$vcard->name}} ({{$vcard->occupation}})
@endsection
@section('og-description')
    {{$vcard->introduction}}
@endsection

@section('body', 'dark-body')

@section('content')
        <!--====== Start Page Wrapper ======-->
        <div class="page-wrapper">
            <div class="container p-0">
                <div class="page-content page-content-four">
                    <div class="page-banner bg_cover" style="background-image: url({{!empty($vcard->cover_image) ? asset('assets/front/img/user/vcard/' . $vcard->cover_image) : asset('assets/front/img/user/vcard/vcard_cover.jpg')}});"></div>
                    <div class="admin-wrapper">
                        <div class="admin-card text-center">
                            <div class="thumb">
                                <img src="{{!empty($vcard->profile_image) ? asset('assets/front/img/user/vcard/' . $vcard->profile_image) : asset('assets/front/img/user/blank_propic.png')}}" alt="Thumb">
                            </div>
                            <div class="content">
                                <div class="admin-title">
                                    <h5>{{$vcard->name}}</h5>
                                    @if (!empty($vcard->occupation))
                                    <span class="position">
                                        {{$vcard->occupation}}
                                        @if (!empty($vcard->company))
                                        ({{$vcard->company}})
                                        @endif
                                    </span>
                                    @endif
                                </div>
                                <p>{{$vcard->introduction}}</p>
                                <div class="actions">
                                    @if (!empty($vcard->phone) && (is_array($prefs) && in_array('Call', $prefs)))
                                    <div class="action-btn">
                                        <a class="call" href="tel:{{$vcard->phone}}" style="background: #{{$vcard->call_button_color}}"><i class="fas fa-mobile-alt"></i></a>
                                        <br>
                                        <span>{{$keywords["Telefone"] ?? "Telefone"}}</span>
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
                                    <a href="{{route('front.user.vcardImport', [getParam(), $vcard->id])}}" class="add-contact" style="background: #{{$vcard->add_to_contact_button_color}}"><i class="fas fa-plus"></i> {{$keywords["Adicionar_contato"] ?? "Adicionar contato"}}</a>
                                    @endif
                                    @if (is_array($prefs) && in_array('Share vCard', $prefs))
                                    <a href="#" data-toggle="modal" data-target="#socialMediaModal" class="share" style="background: #{{$vcard->share_vcard_button_color}}"><i class="fas fa-share-square"></i> {{$keywords["Compartilhar vCard"] ?? "Compartilhar"}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                 @if (is_array($prefs) && in_array('Information', $prefs))
                   @include('vcard.parts.iconesInformacoes',$keywords)
                 @endif
                  
    
                    @if (is_array($prefs) && in_array('Projects', $prefs))
                    <div class="portfolio-section-widget portfolio-section-four">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="section-title">
                                    <h4>{{$keywords["Projects"] ?? "Projects"}}</h4>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="portfolio-arrows"></div>
                            </div>
                        </div>
                        @php
                            $projects = !empty($vcard->user_vcard_projects) ? $vcard->user_vcard_projects : [];
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
                                    <a href="{{$project->external_link}}" target="_blank" class="main-btn btn-color-three">Details</a>
                                    @elseif ($project->external_link_status == 0 && !empty($project->short_details))
                                    <a href="#" data-toggle="modal" data-target="#projectDetails" class="main-btn btn-color-three" data-details="{{$project->short_details}}">{{$keywords["Details"] ?? "Details"}}</a>
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
                                    <h5 class="modal-title" id="exampleModalLongTitle">{{$keywords["Details"] ?? "Details"}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                </div>
                            </div>
                        </div>
                    </div>
    
                  @if (is_array($prefs) && in_array('Video', $prefs))
                    @include('vcard.parts.video',$keywords)
                  @endif 

                    @if (is_array($prefs) && in_array('Testimonials', $prefs))
                      @include('vcard.parts.depoimentosCarrossel',$keywords)
                    @endif           
    
                    @if (is_array($prefs) && in_array('Enquiry Form', $prefs))
                      @include('vcard.parts.form',$keywords)
                    @endif
                    <div class="mb-25 p-5"></div>
                </div>
            </div>
        </div><!--====== End Page Wrapper ======-->
@endsection