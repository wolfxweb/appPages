@extends('user.layout')

@php
    $userDefaultLang = \App\Models\User\Language::where([
       ['user_id',\Illuminate\Support\Facades\Auth::id()],
       ['is_default',1]
    ])->first();
    $userLanguages = \App\Models\User\Language::where('user_id',\Illuminate\Support\Facades\Auth::id())->get();
@endphp

@includeIf('user.partials.rtl-style')

@section('content')
@include('user.user_education.header')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Edit Education</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('user.experience.index')."?language=".request()->input('language')}}">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            Voltar
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="ajaxForm" class="" action="{{route('user.experience.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$education->id}}">
                <div class="form-group">
                  <label for="">Titulo **</label>
                  <input type="text" class="form-control" name="degree_name" value="{{$education->degree_name}}" placeholder="Enter degree name">
                  <p id="errdegree_name" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                    <label for="">Descrição</label>
                    <textarea class="form-control" name="short_description" rows="5">{{$education->short_description}}</textarea>
                </div>
                  <div class="row">
                      <div class="col-lg-6">
                          <div class="form-group">
                              <label for="">Data inicio **</label>
                              <input type="date" class="form-control" name="start_date" value="{{$education->start_date}}">
                              <p id="errstart_date" class="mb-0 text-danger em"></p>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="form-group">
                              <label for="">Data finalização</label>
                              <input type="date" class="form-control" id="myDate" name="end_date" value="{{$education->end_date}}">
                              <p id="errend_date" class="mb-0 text-danger em"></p>
                          </div>
                      </div>
                  </div>
                <div class="form-group">
                  <label for="">Numero serial**</label>
                  <input type="number" class="form-control ltr" name="serial_number" value="{{$education->serial_number}}" placeholder="Enter Serial Number">
                  <p id="errserial_number" class="mb-0 text-danger em"></p>
                  <p class="text-warning"><small>Quanto maior o número de série, mais tarde a experiência será exibida.</small></p>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="form">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit" id="submitBtn" class="btn btn-success">Update</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection
