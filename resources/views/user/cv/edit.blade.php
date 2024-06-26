@extends('user.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Edição Curriculo</h4>
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
        <a href="{{route('user.cv')}}">Gerenciamento Curriculo</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{$cv->cv_name}}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Edição</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Edição curriculo</div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('user.cv')}}">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
           Voltar
          </a>
        </div>
        <div class="card-body pt-5 pb-5">
          <div class="row">
            @if ($cv->direction == 2)
              <div class="col-12">
                <div class="alert alert-info text-dark">
                   If you want to enter <strong>LTR word / text</strong> in <strong>Name, Occupation</strong> field, then wrap that <strong>word / text</strong> with <strong><code>{{'<span dir="ltr"></span>'}}</code></strong>
                   <br>
                   For example,
                   <div class="row">
                      <div class="col-6">
                         <ul class="pl-3">
                            <li class="mb-2">
                               <input dir="rtl" class="form-control" value="{{'<span dir="ltr">This is LTR Text</span>'}} هناك حقيقة">
                            </li>
                            <li class="mb-2">
                               <input dir="rtl" class="form-control" value="هناك حقيقة {{'<span dir="ltr">1234567</span>'}}">
                            </li>
                            <li>
                               <input dir="rtl" class="form-control" value="{{'<span dir="ltr">This is LTR Text</span>'}}">
                            </li>
                         </ul>
                      </div>
                   </div>
                </div>
              </div>
            @endif
            <div class="col-lg-8 offset-lg-2">

              <form id="ajaxForm" class="" action="{{route('user.cv.update')}}" method="POST">
                @csrf
                <input type="hidden" name="cv_id" value="{{$cv->id}}">

                <div class="row">
                  <div class="col-12">
                     <div class="form-group">
                        <label class="form-label">Selecione template</label>
                        <div class="row">
                           <div class="col-4">
                              <label class="imagecheck mb-4">
                                 <input name="template" type="radio" value="1" class="imagecheck-input ltr" {{$cv->template == 1 ? 'checked' : ''}}>
                                 <figure class="imagecheck-figure">
                                    <img src="{{asset('assets/front/img/user/cv-templates/1.jpg')}}" alt="title" class="imagecheck-image">
                                 </figure>
                              </label>
                           </div>
                           <div class="col-4">
                              <label class="imagecheck mb-4">
                                 <input name="template" type="radio" value="2" class="imagecheck-input ltr" {{$cv->template == 2 ? 'checked' : ''}}>
                                 <figure class="imagecheck-figure">
                                    <img src="{{asset('assets/front/img/user/cv-templates/2.jpg')}}" alt="title" class="imagecheck-image">
                                 </figure>
                              </label>
                           </div>
                        </div>
                        <p class="em text-danger em-0" id="errtemplate"></p>
                     </div>
                  </div>
               </div>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <div class="col-12 mb-2">
                        <label for="image"><strong>Foto *</strong></label>
                      </div>
                      <div class="col-md-12 showImage mb-3">
                        <img src="{{!empty($cv->image) ? asset('assets/front/img/user/cv/' . $cv->image) : asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                      </div>
                      <input type="file" name="image" id="image" class="form-control ltr">
                      <p id="errimage" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Curriculo nome **</label>
                      <input type="text" class="form-control {{$cv->direction == 2 ? 'rtl' : ''}}" name="cv_name" placeholder="" value="{{$cv->cv_name}}">
                      <p id="errcv_name" class="mb-0 text-danger em"></p>
                      <p class="text-warning mb-0">Isso será usado para identificar esse currículo específico da lista de currículos.</p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Direção **</label>
                      <select name="direction" class="form-control ltr">
                          <option value="" selected disabled>Selecione a direção</option>
                          <option value="1" {{$cv->direction == 1 ? 'selected' : ''}}>LTR (Da esquerda para direita)</option>
                          <option value="2" {{$cv->direction == 2 ? 'selected' : ''}}>RTL (Da direita para esquerda)</option>
                      </select>
                      <p id="errdirection" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Nome **</label>
                      <input type="text" class="form-control {{$cv->direction == 2 ? 'rtl' : ''}}" name="name" placeholder="" value="{{$cv->name}}">
                      <p id="errname" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Cargo **</label>
                      <input type="text" class="form-control {{$cv->direction == 2 ? 'rtl' : ''}}" name="occupation" placeholder="" value="{{$cv->occupation}}">
                      <p id="erroccupation" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">Cor Fundo titúlos **</label>
                      <input type="text" class="form-control jscolor ltr" name="base_color" placeholder="" value="{{$cv->base_color}}">
                      <p id="errbase_color" class="mb-0 text-danger em"></p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">Cor do texto titúlo **</label>
                      <input type="text" class="form-control jscolor ltr" name="base_color_text" placeholder="" value="{{$cv->base_color_text}}">
                      <p id="errbase_color" class="mb-0 text-danger em"></p>
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

@section('scripts')
    <script>
      $(document).ready(function() {
        $("select[name='direction']").on('change', function() {
          val = $(this).val();
          let $formControls = $(".form-control:not(.ltr)");

          // if RTL is selected
          if (val == 2) {
            $formControls.each(function() {
              $(this).addClass('rtl');
            });
          } else {
            $formControls.each(function() {
              $(this).removeClass('rtl');
            });
          }
        });
      });
    </script>
@endsection