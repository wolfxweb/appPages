@extends('user.layout')
@section('content')
    <div class="page-header">
        <h4 class="page-title">Preferências </h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ route('user-dashboard') }}">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Página</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ $vcard->vcard_name }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Configurações</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-title d-inline-block">Configurações</div>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('user.vcard') }}" class="btn btn-primary btn-sm"><i
                                    class="fas fa-chevron-left"></i> Voltar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <form id="ajaxForm" class="" action="{{ route('user.vcard.prefUpdate', $vcard->id) }}"
                                method="post">
                                {{ csrf_field() }}
                                <div class="form-group">

                                    <span class="">Visibilidade dos botões</span><br>

                                    <div class="selectgroup selectgroup-pills mt-2 justify-content-center">

                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="preferences[]" value="Call"
                                                class="selectgroup-input" @if (is_array($preferences) && in_array('Call', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Telefone</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="preferences[]" value="Whatsapp"
                                                class="selectgroup-input" @if (is_array($preferences) && in_array('Whatsapp', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Whatsapp</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="preferences[]" value="Mail"
                                                class="selectgroup-input" @if (is_array($preferences) && in_array('Mail', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Email</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="preferences[]" value="Add to Contact"
                                                class="selectgroup-input" @if (is_array($preferences) && in_array('Add to Contact', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Adicionar ao contato</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="preferences[]" value="Share vCard"
                                                class="selectgroup-input" @if (is_array($preferences) && in_array('Share vCard', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Compartilhar</span>
                                        </label>

                                    </div>

                                </div>
                                <hr>
                                <span class="">Visibilidade do Conteúdo</span>
                                <div class="form-group">
                                   <div class="selectgroup selectgroup-pills mt-2 justify-content-center">
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="preferences[]" value="Header"
                                                class="selectgroup-input" @if (is_array($preferences) && in_array('Header', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Cabeçalho</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="preferences[]" value="Information"
                                                class="selectgroup-input" @if (is_array($preferences) && in_array('Information', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Informações</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="preferences[]" value="Video"
                                                class="selectgroup-input" @if (is_array($preferences) && in_array('Video', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Vídeo</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="preferences[]" value="About Us"
                                                class="selectgroup-input" @if (is_array($preferences) && in_array('About Us', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Sobre nós</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="preferences[]" value="Services"
                                                class="selectgroup-input" @if (is_array($preferences) && in_array('Services', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Serviços</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="preferences[]" value="Projects"
                                                class="selectgroup-input"
                                                @if (is_array($preferences) && in_array('Projects', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Projetos</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="preferences[]" value="Testimonials"
                                                class="selectgroup-input"
                                                @if (is_array($preferences) && in_array('Testimonials', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Depoimentos</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="preferences[]" value="Enquiry Form"
                                                class="selectgroup-input"
                                                @if (is_array($preferences) && in_array('Enquiry Form', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Formulário de contato</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="preferences[]" value="Google Maps"
                                                class="selectgroup-input"
                                                @if (is_array($preferences) && in_array('Google Maps', $preferences)) checked @endif>
                                            <span class="selectgroup-button">Google Maps</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <hr>
                                    <span class="">Configuração títulos</span><br>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="font_title">Fonte</label>
                                                @include('user.vcard.parts.fontes',["fonte_title"=>$vcard->font_title,'name'=>'font_title','id'=>'font_title'])
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label for="customRange2" class="form-label">Tamanho fonte</label><br>
                                                <input type="range" class="form-range form-control " value="{{$vcard->font_title_size??10}}" name="font_title_size"  id="font_title_size">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleColorInput" class="form-label">Cor título</label>
                                                <input type="color" class="form-control form-control-color" id="font_color" name="font_color" value="{{$vcard->font_color??'#563d7c'}}" title="">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <span class="">Configuração textos</span><br>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="font_title">Fonte</label>
                                                @include('user.vcard.parts.fontes',["fonte_title"=>$vcard->font_content,'name'=>'font_content','id'=>'font_content'])
                                            
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label for="customRange2" class="form-label">Tamanho fonte</label><br>
                                                <input type="range" class="form-range form-control " value="{{$vcard->font_content_size??10}}" name="font_content_size"  id="font_content_size">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="exampleColorInput" class="form-label">Cor título</label>
                                                <input type="color" class="form-control form-control-color" id="font_color_content" name="font_color_content" value="{{$vcard->font_color_content??'#563d7c'}}" title="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <hr>
                                    <span class="">Ordenação</span><br>

                                    <div class="row">
                                        <div class="col-3">
                                            @include('user.vcard.parts.selectPreferences', [
                                                'titulo' => 'Cabeçalho',
                                                'possicao' => $page_order[0]['header']
                                                    ? $page_order[0]['header']
                                                    : '1',
                                                'nome' => 'session_page_order_1',
                                            ])
                                        </div>
                                        <div class="col-3">
                                            @include('user.vcard.parts.selectPreferences', [
                                                'titulo' => 'Informaçãoes',
                                                'possicao' => $page_order[1]['informacoes']
                                                    ? $page_order[1]['informacoes']
                                                    : '2',
                                                'nome' => 'session_page_order_2',
                                            ])
                                        </div>
                                        <div class="col-3">
                                            @include('user.vcard.parts.selectPreferences', [
                                                'titulo' => 'Sobre nós',
                                                'possicao' => $page_order[2]['sobre_nos']
                                                    ? $page_order[2]['sobre_nos']
                                                    : '3',
                                                'nome' => 'session_page_order_3',
                                            ])
                                        </div>
                                        <div class="col-3">
                                            @include('user.vcard.parts.selectPreferences', [
                                                'titulo' => 'Serviços',
                                                'possicao' => $page_order[3]['servicos']
                                                    ? $page_order[3]['servicos']
                                                    : '4',
                                                'nome' => 'session_page_order_4',
                                            ])
                                        </div>
                                        <div class="col-3">
                                            @include('user.vcard.parts.selectPreferences', [
                                                'titulo' => 'Projetos',
                                                'possicao' => $page_order[4]['projetos']
                                                    ? $page_order[4]['projetos']
                                                    : '5',
                                                'nome' => 'session_page_order_5',
                                            ])
                                        </div>
                                        <div class="col-3">
                                            @include('user.vcard.parts.selectPreferences', [
                                                'titulo' => 'Vídeo',
                                                'possicao' => $page_order[5]['video']
                                                    ? $page_order[5]['video']
                                                    : '6',
                                                'nome' => 'session_page_order_6',
                                            ])
                                        </div>
                                        <div class="col-3">
                                            @include('user.vcard.parts.selectPreferences', [
                                                'titulo' => 'Depoimentos',
                                                'possicao' => $page_order[6]['depoimentos']
                                                    ? $page_order[6]['depoimentos']
                                                    : '7',
                                                'nome' => 'session_page_order_7',
                                            ])
                                        </div>
                                        <div class="col-3">
                                            @include('user.vcard.parts.selectPreferences', [
                                                'titulo' => 'Formulário contato',
                                                'possicao' => $page_order[7]['formulario']
                                                    ? $page_order[7]['formulario']
                                                    : '8',
                                                'nome' => 'session_page_order_8',
                                            ])
                                        </div>
                                        <div class="col-3">
                                            @include('user.vcard.parts.selectPreferences', [
                                                'titulo' => 'Google Maps',
                                                'possicao' => $page_order[8]['mapa']
                                                    ? $page_order[8]['mapa']
                                                    : '9',
                                                'nome' => 'session_page_order_9',
                                            ])
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <hr>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Pixel
                                                facebook</label>
                                            <textarea class="form-control" id="pixel_facebook" name="pixel_facebook" rows="3">{{ htmlspecialchars_decode($vcard->pixel_facebook) }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Google
                                                analytics</label>
                                            <textarea class="form-control" id="google_analitics" name="google_analitics" rows="3">{{ htmlspecialchars_decode($vcard->google_analitics) }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form">
                        <div class="form-group from-show-notify row">
                            <div class="col-12 text-center">
                                <button type="submit" id="submitBtn" class="btn btn-success">Atualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
