@extends('user.layout')
@php
$userDefaultLang = \App\Models\User\Language::where([
['user_id',\Illuminate\Support\Facades\Auth::id()],
['is_default',1]
])->first();
$userLanguages = \App\Models\User\Language::where('user_id',\Illuminate\Support\Facades\Auth::id())->get();
@endphp

@section('content')
@include('user.achievement.header')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card-title d-inline-block">Conquistas</div>
                    </div>
                    <div class="col-lg-4">
                        <!--
                        @if(!is_null($userDefaultLang))
                        @if (!empty($userLanguages))
                        <select name="userLanguage" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>Select a Language</option>
                            @foreach ($userLanguages as $lang)
                            <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                        @endif
                        @endif
                    -->
                    </div>
                    <div class="col-lg-4 mt-2 mt-lg-0">
                        @if(!is_null($userDefaultLang))
                        <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Adicionar</a>
                        <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="{{route('user.achievement.bulk.delete')}}"><i class="flaticon-interface-5"></i> Excluir</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if(is_null($userDefaultLang))
                        <h3 class="text-center">NENHUM IDIOMA ENCONTRADO</h3>
                        @else
                        @if (count($achievements) == 0)
                        <h3 class="text-center">NENHUMA REALIZAÇÃO ENCONTRADA</h3>
                        @else
                        <div class="table-responsive">
                            <table class="table table-striped mt-3" id="basic-datatables">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <input type="checkbox" class="bulk-check" data-val="all">
                                        </th>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Duração em horas</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($achievements as $key => $achievement)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="bulk-check" data-val="{{$achievement->id}}">
                                        </td>
                                        <td>{{strlen($achievement->title) > 30 ? mb_substr($achievement->title, 0, 30, 'UTF-8') . '...' : $achievement->title}}</td>
                                        <td>{{$achievement->count}}</td>
                                        <td>
                                            <a class="btn btn-secondary btn-sm" href="{{route('user.achievement.edit', $achievement->id) . '?language=' . $achievement->language->code}}">
                                            <span class="btn-label">
                                            <i class="fas fa-edit"></i>
                                            </span>
                                        
                                            </a>
                                            <form class="deleteform d-inline-block" action="{{route('user.achievement.delete')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="achievement_id" value="{{$achievement->id}}">
                                                <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                                <span class="btn-label">
                                                <i class="fas fa-trash"></i>
                                                </span>
                                                
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Create Skill Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Adicionar habilidade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ajaxForm" enctype="multipart/form-data" class="modal-form" action="{{route('user.achievement.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Idioma **</label>
                        <select id="language" name="user_language_id" class="form-control">
                            <option value="" selected disabled>Selecione o idioma</option>
                            @foreach ($userLanguages as $lang)
                            <option value="{{$lang->id}}">{{$lang->name}}</option>
                            @endforeach
                        </select>
                        <p id="erruser_language_id" class="mb-0 text-danger em"></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Titulo **</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter title" value="">
                                <p id="errtitle" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="count">Duração em horas**</label>
                                <input id="count" type="number" class="form-control ltr" name="count" value="" placeholder="" min="1">
                                <p id="errcount" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Numero serial **</label>
                                <input type="number" class="form-control ltr" name="serial_number" value="" placeholder="">
                                <p id="errserial_number" class="mb-0 text-danger em"></p>
                                <p class="text-warning mb-0"><small>Quanto maior o número de série, mais tarde a Habilidade será exibida.</small></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button id="submitBtn" type="button" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>
@endsection
