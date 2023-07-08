<!-- Create Project Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLongTitle">Cadastro  Projeto</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
 
             <form id="ajaxForm" enctype="multipart/form-data" class="modal-form" action="{{route('user.vcard.projectStore')}}" method="POST">
                @csrf
                <input type="hidden" name="user_vcard_id" value="{{$vcard->id}}">
                <div class="row">
                   <div class="col-lg-12">
                     <div class="form-group">
                       <div class="col-12 mb-2">
                         <label for="image"><strong>Imagem *</strong></label>
                       </div>
                       <div class="col-md-12 showImage mb-3">
                         <img src="{{asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                       </div>
                       <input type="file" name="image" id="image" class="form-control">
                       <p id="errimage" class="mb-0 text-danger em"></p>
                     </div>
                   </div>
                 </div>
                <div class="form-group">
                   <label for="">Titúlo **</label>
                   <input type="text" class="form-control {{$vcard->direction == 2 ? 'rtl' : ''}}" name="title" placeholder="" value="">
                   <p id="errtitle" class="mb-0 text-danger em"></p>
                </div>

                <div id="app">
                  <div class="form-group">
                    <label class="form-label">Link externo status **</label>
                    <div class="selectgroup w-100">
                       <label class="selectgroup-item">
                          <input type="radio" name="external_link_status" value="1" class="selectgroup-input elstatus" data-short_details_id="shortDetails" data-ext_link_id="extLink">
                          <span class="selectgroup-button">Ativo</span>
                       </label>
                       <label class="selectgroup-item">
                          <input type="radio" name="external_link_status" value="0" class="selectgroup-input elstatus" checked data-short_details_id="shortDetails" data-ext_link_id="extLink">
                          <span class="selectgroup-button">Inativo</span>
                       </label>
                    </div>
                 </div>
                 <div class="form-group" id="extLink" style="display: none;">
                    <label for="">Link externo</label>
                    <input type="text" class="form-control" name="external_link">
                    <p class="text-warning mb-0">Se você não deseja nenhum conteúdo de detalhes, deixe este campo em branco</p>
                    <p id="errexternal_link" class="mb-0 text-danger em"></p>
                 </div>
                  <div class="form-group" id="shortDetails">
                     <label for="">Detalhes curto</label>
                     <textarea class="form-control {{$vcard->direction == 2 ? 'rtl' : ''}}" name="short_details" rows="4" cols="80" placeholder=""></textarea>
                     <p class="text-warning mb-0">Se você não deseja nenhum conteúdo de detalhes, deixe este campo em branco</p>
                     <p id="errshort_details" class="mb-0 text-danger em"></p>
                  </div>
                </div>
 
                <div class="form-group">
                   <label for="">Serial **</label>
                   <input type="number" class="form-control ltr" name="serial_number" value="" placeholder="">
                   <p id="errserial_number" class="mb-0 text-danger em"></p>
                  
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