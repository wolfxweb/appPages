@extends('user.layout')

@php
    $selLang = \App\Models\User\Language::where([
    ['code', \Illuminate\Support\Facades\Session::get('currentLangCode')],
    ['user_id',\Illuminate\Support\Facades\Auth::id()]
    ])->first();
    $userDefaultLang = \App\Models\User\Language::where([
        ['user_id',\Illuminate\Support\Facades\Auth::id()],
        ['is_default',1]
    ])->first();
    $userLanguages = \App\Models\User\Language::where('user_id',\Illuminate\Support\Facades\Auth::id())->get();
@endphp
@if(!empty($selLang) && $selLang->rtl == 1)
@section('styles')
<style>
    form:not(.modal-form) input,
    form:not(.modal-form) textarea,
    form:not(.modal-form) select,
    select[name='userLanguage'] {
        direction: rtl;
    }
    form:not(.modal-form) .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('SEO Informações') }}</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('user-dashboard')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Configurações') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('SEO') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form
          action="{{ route('admin.basic_settings.update_seo_informations') }}"
          method="post"
        >
          @csrf
          <div class="card-header">
            <div class="row">
              <div class="col-lg-9">
                <div class="card-title">{{ __('Atualização informações SEO') }}</div>
              </div>
    
              <div class="col-lg-3">
              
                    @if(!is_null($userDefaultLang)&& false)
                      @if (!empty($userLanguages))
                      <select name="language" class="form-control float-right" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                         <option value="" selected disabled>Select a Language</option>
                         @foreach ($userLanguages as $lang)
                         <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                         @endforeach
                      </select>
                      @endif
                    @endif
                    
              </div>
            </div>
          </div>

          <div class="card-body pt-5 pb-5">
            <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>{{ __('Meta palavras-chave para página inicial') }}</label>
                    <input
                      class="form-control"
                      name="home_meta_keywords"
                      value="{{ $data->home_meta_keywords }}"
                      placeholder="Insira meta palavras-chave"
                      data-role="tagsinput"
                    >
                  </div>

                  <div class="form-group">
                    <label>{{ __('Meta descrição para página inicial') }}</label>
                    <textarea
                      class="form-control"
                      name="home_meta_description"
                      rows="5"
                      placeholder="Insira a meta descrição"
                    >{{ $data->home_meta_description }}</textarea>
                  </div>
                </div>

                @if ($userBs->theme == 3)

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>{{ __('Palavras-chave Meta para a página Sobre') }}</label>
                    <input
                      class="form-control"
                      name="about_meta_keywords"
                      value="{{ $data->about_meta_keywords }}"
                      placeholder="Enter Meta Keywords"
                      data-role="tagsinput"
                    >
                  </div>

                  <div class="form-group">
                    <label>{{ __('Meta descrição para a página Sobre') }}</label>
                    <textarea
                      class="form-control"
                      name="about_meta_description"
                      rows="5"
                      placeholder="Insira meta palavras-chave"
                    >{{ $data->about_meta_description }}</textarea>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>{{ __('Meta palavras-chave para página de experiência') }}</label>
                    <input
                      class="form-control"
                      name="experience_meta_keywords"
                      value="{{ $data->experience_meta_keywords }}"
                      placeholder="Insira meta palavras-chave"
                      data-role="tagsinput"
                    >
                  </div>

                  <div class="form-group">
                    <label>{{ __('Meta descrição para página de experiência') }}</label>
                    <textarea
                      class="form-control"
                      name="experience_meta_description"
                      rows="5"
                      placeholder="Insira a meta descrição"
                    >{{ $data->experience_meta_description }}</textarea>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>{{ __('Meta palavras-chave para página de depoimento') }}</label>
                    <input
                      class="form-control"
                      name="testimonial_meta_keywords"
                      value="{{ $data->testimonial_meta_keywords }}"
                      placeholder="Inserir meta palavras-chave"
                      data-role="tagsinput"
                    >
                  </div>

                  <div class="form-group">
                    <label>{{ __('Meta descrição para página de depoimento') }}</label>
                    <textarea
                      class="form-control"
                      name="testimonial_meta_description"
                      rows="5"
                      placeholder="Insira a meta descrição"
                    >{{ $data->testimonial_meta_description }}</textarea>
                  </div>
                </div>
                    
                @endif

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>{{ __('Meta palavras-chave para página de blogs') }}</label>
                    <input
                      class="form-control"
                      name="blogs_meta_keywords"
                      value="{{ $data->blogs_meta_keywords }}"
                      placeholder="Insira meta palavras-chave"
                      data-role="tagsinput"
                    >
                  </div>

                  <div class="form-group">
                    <label>{{ __('Meta descrição para página de blogs') }}</label>
                    <textarea
                      class="form-control"
                      name="blogs_meta_description"
                      rows="5"
                      placeholder="Insira a meta descrição"
                    >{{ $data->blogs_meta_description }}</textarea>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>{{ __('Palavras-chave meta para página de serviços') }}</label>
                    <input
                      class="form-control"
                      name="services_meta_keywords"
                      value="{{ $data->services_meta_keywords }}"
                      placeholder="Insira meta palavras-chave"
                      data-role="tagsinput"
                    >
                  </div>

                  <div class="form-group">
                    <label>{{ __('Meta descrição para página de serviços') }}</label>
                    <textarea
                      class="form-control"
                      name="services_meta_description"
                      rows="5"
                      placeholder="Insira a meta descrição"
                    >{{ $data->services_meta_description }}</textarea>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>{{ __('Meta palavras-chave para a página de portfólios') }}</label>
                    <input
                      class="form-control"
                      name="portfolios_meta_keywords"
                      value="{{ $data->portfolios_meta_keywords }}"
                      placeholder="Insira meta palavras-chave"
                      data-role="tagsinput"
                    >
                  </div>

                  <div class="form-group">
                    <label>{{ __('Meta descrição para a página de portfólios') }}</label>
                    <textarea
                      class="form-control"
                      name="portfolios_meta_description"
                      rows="5"
                      placeholder="Insira a meta descrição"
                    >{{ $data->portfolios_meta_description }}</textarea>
                  </div>
                </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="form">
              <div class="row">
                <div class="col-12 text-center">
                  <button
                    type="submit"
                    class="btn btn-success {{ $data == null ? 'd-none' : '' }}"
                  >{{ __('Atualizar') }}</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
