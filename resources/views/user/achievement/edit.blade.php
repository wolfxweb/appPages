@extends('user.layout')

@if(!empty($achievement->language) && $achievement->language->rtl == 1)
@section('styles')
<style>
    form input,
    form textarea,
    form select {
        direction: rtl;
    }
    form .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif

@section('content')
@include('user.achievement.header')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Edição conquista</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('user.achievement.index') . '?language=' . $achievement->language->code}}">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            Voltar
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="ajaxForm" class="" action="{{route('user.achievement.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="achievement_id" value="{{$achievement->id}}">

                <div class="form-group">
                  <label for="">Titulo **</label>
                  <input type="text" class="form-control" name="title" value="{{$achievement->title}}" placeholder="Enter title">
                  <p id="errtitle" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                    <label for="count">Duração **</label>
                    <input id="count" type="number" class="form-control ltr"
                            name="count" value="{{$achievement->count}}"
                            placeholder="Enter achievement count">
                    <p id="errcount" class="mb-0 text-danger em"></p>
                </div>
                <div class="form-group">
                  <label for="">Numero serial **</label>
                  <input type="number" class="form-control ltr" name="serial_number" value="{{$achievement->serial_number}}" placeholder="Enter Serial Number">
                  <p id="errserial_number" class="mb-0 text-danger em"></p>
                  <p class="text-warning"><small>Quanto maior o número de série, mais tarde a Conquista será exibida.</small></p>
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
