@extends('user.layout')

@section('content')
    <div class="page-header">
        <h4 class="page-title">{{__('Dominíos personalizado')}}</h4>
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
                <a href="#">{{__('Dominíos  & URLs')}}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{__('Dominío personlizado')}}</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Domain Request Modal -->
            <div class="modal fade" id="customDomainModal" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{__('Solicitação cadastro dominío personalizado.')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if (cPackageHasCdomain(Auth::user()))
                                @if (Auth::user()->custom_domains()->where('status', 1)->count() > 0)
                                    <div class="alert alert-warning">
                                        {{__('Você já tem um domínio personalizado ')}}
                                        (<a target="_blank" href="//{{getCdomain(Auth::user())}}">{{getCdomain(Auth::user())}}</a>)
                                        {{__('conectado com o site do seu portfólio.')}} <br>
                                        {{__('se você solicitar outro domínio agora e se ele se conectar ao nosso servidor, então
                                        seu domínio atual ')}}
                                        (<a target="_blank" href="//{{getCdomain(Auth::user())}}">{{getCdomain(Auth::user())}}</a>)
                                        {{__('será removido.')}}
                                    </div>
                                @endif
                            @endif
                            <form action="{{route('user-domain-request')}}" id="customDomainRequestForm" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">{{__('Dominío personalizado')}}</label>
                                    <input type="text" class="form-control" name="custom_domain"
                                           placeholder="example.com" required>
                                    <p class="text-secondary mb-0"><i class="fas fa-exclamation-circle"></i> {{__('Não adicione')}}
                                        <strong class="text-danger">http://</strong> or <strong class="text-danger">https://</strong></p>
                                    <p class="text-secondary mb-0"><i class="fas fa-exclamation-circle"></i>
                                        {{__('O formato válido será exatamente como este')}} - <strong
                                            class="text-danger">www.seudominio.com.br</strong> {{__('ou')}} <strong
                                            class="text-danger">subdomain.domain.tld, www.subdomain.domain.tld</strong></strong>
                                    </p>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Fechar')}}</button>
                            <button type="submit" class="btn btn-primary" form="customDomainRequestForm">
                                {{__('Adicionar')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            @if (session()->has('domain-success'))
                <div class="alert alert-success bg-success text-white">
                    <p class="mb-0">{!! nl2br(session()->get('domain-success')) !!}</p>
                </div>
            @endif

            @if ($errors->has('custom_domain'))
                <div class="alert alert-danger bg-danger text-white">
                    <p class="mb-0">{!! $errors->first('custom_domain') !!}    </p>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title d-inline-block">{{__('Dominíos cadastrados ')}}</div>
                        </div>
                        <div class="offset-lg-4 col-lg-4 text-right">
                            @if (empty($rcDomain) || $rcDomain->status != 0)
                                <button class="btn btn-primary" data-toggle="modal" data-target="#customDomainModal">
                                    {{__('Adicionar')}}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @if (empty($rcDomain))
                                <h3 class="text-center">{{__('DOMÍNIO PERSONALIZADO SOLICITADO/CONECTADO NÃO DISPONÍVEL')}}</h3>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped mt-3">
                                        <thead>
                                        <tr>
                                            <th scope="col">{{__('Requested Domain')}}</th>
                                            <th scope="col">{{__('Current Domain')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                @if ($rcDomain->status == 0)
                                                    <a href="//{{$rcDomain->requested_domain}}"
                                                       target="_blank">{{$rcDomain->requested_domain}}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if (getCdomain(Auth::user()))
                                                    @php
                                                        $cdomain = getCdomain(Auth::user());
                                                    @endphp
                                                    <a target="_blank" href="//{{$cdomain}}">{{$cdomain ?? '-'}}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h4 class="mb-0"><strong>{{ $be->cname_record_section_title }}</strong></h4>
                </div>
                <div class="card-body">
                    {!! $be->cname_record_section_text !!}
                </div>
            </div>
        </div>
    </div>
@endsection
