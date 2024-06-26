@extends('user.layout')
@section('content')
    <div class="page-header">
        <h4 class="page-title">Corres botões e icones</h4>
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
                <a href="#">Página</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{$vcard->vcard_name}}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Cor botões e icones</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-title d-inline-block">Botões e Icones</div>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{route('user.vcard')}}" class="btn btn-primary btn-sm"><i class="fas fa-chevron-left"></i> Voltar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <form id="ajaxForm" class="" action="{{route('user.vcard.colorUpdate', $vcard->id)}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Cor primária **</label>
                                            <input type="text" class="form-control jscolor" name="base_color" value="{{$vcard->base_color}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                           <label for="">Cor secundária </label>
                                           <input type="text" class="form-control jscolor" id="summary_background_color" name="summary_background_color"value="#{{$vcard->summary_background_color}}" title="Choose your color">
                                        </div>
                                     </div>
                                     <div class="col-lg-6">
                                        <div class="form-group">
                                           <label for="">Cor Fundo página {{$vcard->page_background_color}} </label>
                                           <input type="text" class="form-control jscolor" id="page_background_color" name="page_background_color"value="#{{$vcard->page_background_color}}" title="Choose your color">
                                        </div>
                                     </div>

                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Cor do fundo seção de resumo **</label>
                                            <input type="text" class="form-control jscolor" name="summary_background_color" value="{{$vcard->summary_background_color}}">
                                        </div>
                                    </div>
                                 
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Botão de chamada **</label>
                                                <input type="text" class="form-control jscolor" name="call_button_color" value="{{$vcard->call_button_color}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Botão Whatsapp  **</label>
                                                <input type="text" class="form-control jscolor" name="whatsapp_button_color" value="{{$vcard->whatsapp_button_color}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Botão Email **</label>
                                                <input type="text" class="form-control jscolor" name="mail_button_color" value="{{$vcard->mail_button_color}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Adicionar contato **</label>
                                                <input type="text" class="form-control jscolor" name="add_to_contact_button_color" value="{{$vcard->add_to_contact_button_color}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Compartilhar  vCard **</label>
                                                <input type="text" class="form-control jscolor" name="share_vcard_button_color" value="{{$vcard->share_vcard_button_color}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Telefone **</label>
                                                <input type="text" class="form-control jscolor" name="phone_icon_color" value="{{$vcard->phone_icon_color}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Email Icone **</label>
                                                <input type="text" class="form-control jscolor" name="email_icon_color" value="{{$vcard->email_icon_color}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Endereço Icone **</label>
                                                <input type="text" class="form-control jscolor" name="address_icon_color" value="{{$vcard->address_icon_color}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Website URL **</label>
                                                <input type="text" class="form-control jscolor" name="website_url_icon_color" value="{{$vcard->website_url_icon_color}}">
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
