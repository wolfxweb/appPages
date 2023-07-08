@extends('user.layout')

@section('content')
@include('user.vcard.parts.header')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block">Minhas páginas</div>
                    <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="{{route('user.vcard.bulk.delete')}}"><i class="flaticon-interface-5"></i> Excluir</button>
                    <a href="{{route('user.vcard.create')}}" class="btn btn-sm btn-primary float-right">Adicionar</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @if (count($vcards) == 0)
                                <h3 class="text-center">NENHUM VCARD ENCONTRADO</h3>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped mt-3" id="basic-datatables">
                                        <thead>
                                        <tr>
                                            <th scope="col">
                                                <input type="checkbox" class="bulk-check" data-val="all">
                                            </th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Visualização</th>
                                            <th scope="col">Direção</th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($vcards as $key => $vcard)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="bulk-check" data-val="{{$vcard->id}}">
                                                </td>
                                                <td>
                                                    {{strlen($vcard->vcard_name) > 20 ? mb_substr($vcard->vcard_name, 0, 20, 'UTF-8') . '...' : $vcard->vcard_name}}
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#urlsModal{{$vcard->id}}"><i class="fas fa-link"></i> URLs</button>
                                                </td>
                                                <td>{{$vcard->direction == 1 ? 'Da esquerda para direita' : 'Da direita para esquerda'}}</td>
                                                <td>
                                                    <div class="dropdown show d-inline-block mr-2">
                                                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          Gerenciar
                                                        </a>
                                                      
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                          <a target="_blank" class="dropdown-item" href="{{route('user.vcard.edit', $vcard->id)}}">Informações</a>
                                                          <a target="_blank" class="dropdown-item" href="{{route('user.vcard.color', $vcard->id)}}">Cores</a>
                                                          <a target="_blank" class="dropdown-item" href="{{route('user.vcard.preferences', $vcard->id)}}">Preferência</a>
                                                          <a target="_blank" class="dropdown-item" href="{{route('user.vcard.services', $vcard->id)}}">Serviços</a>
                                                          <a target="_blank" class="dropdown-item" href="{{route('user.vcard.projects', $vcard->id)}}">Projetos</a>
                                                          <a target="_blank" class="dropdown-item" href="{{route('user.vcard.testimonials', $vcard->id)}}">Depoimentos</a>
                                                          <a target="_blank" class="dropdown-item" href="{{route('user.vcard.about', $vcard->id)}}">Sobre & Vídeo</a>
                                                          <a target="_blank" class="dropdown-item" href="{{route('user.vcard.keywords', $vcard->id)}}">Rótulos</a>
                                                        </div>
                                                    </div>
                                                    <form class="deleteform d-inline-block" action="{{route('user.vcard.delete')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="vcard_id" value="{{$vcard->id}}">
                                                        <button type="submit" class="btn btn-danger btn-sm deletebtn" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
  
                                            <!-- Modal -->
                                            <div class="modal fade" id="urlsModal{{$vcard->id}}" tabindex="-1" role="dialog" aria-labelledby="urlsModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="urlsModalLabel">vCard URLs</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul>
                                                                <li>
                                                                    @php
                                                                        $pathUrl = env('WEBSITE_HOST') . '/' . Auth::user()->username . '/vcard/' . $vcard->id;
                                                                    @endphp
                                                                    <strong class="mr-2">Path Base URL:</strong>
                                                                    <a target="_blank" href="//{{$pathUrl}}">{{$pathUrl}}</a>
                                                                </li>
                                                                @if (cPackageHasSubdomain(Auth::user()))
                                                                    <li>
                                                                        @php
                                                                            $subUrl = Auth::user()->username . '.' . env('WEBSITE_HOST') . '/vcard/' . $vcard->id;
                                                                        @endphp
                                                                        <strong class="mr-2">Subdomínio URL:</strong>
                                                                        <a target="_blank" href="//{{$subUrl}}">{{$subUrl}}</a>
                                                                    </li>
                                                                @endif
                                                                @if (cPackageHasCdomain(Auth::user()))
                                                                    @php
                                                                        $domUrl = Auth::user()->custom_domains()->where('status', 1)->orderBy('id', 'DESC')->first();
                                                                    @endphp
                                                                    @if (!empty($domUrl))
                                                                    <li>
                                                                        <strong class="mr-2">Domínio URL:</strong>
                                                                        <a target="_blank" href="//{{$domUrl->requested_domain}}/vcard/{{$vcard->id}}">{{$domUrl->requested_domain}}/vcard/{{$vcard->id}}</a>
                                                                    </li>
                                                                    @endif
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
