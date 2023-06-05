@extends('user.layout')
@section('content')
@include('user.vcard.parts.header')
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <div class="card-title d-inline-block">Edição vCard</div>
            <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('user.vcard')}}">
               <span class="btn-label">
               <i class="fas fa-backward"></i>
               </span>
               Voltar
            </a>
            
            <a class="btn btn-primary btn-sm float-right mr-2" href="{{route('front.user.vcard', [Auth::user()->username, $vcard->id])}}" target="_blank">
               <span class="btn-label">
                   <i class="fas fa-eye"></i>
               </span>
               Visualizar
           </a>
         </div>
         <div class="card-body pt-5 pb-5">
            <div class="row">
               <div class="col-lg-12">

                  {{-- Featured image upload end --}}
                  <form id="ajaxForm" class="" action="{{route('user.vcard.update')}}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" name="vcard_id" value="{{$vcard->id}}">
                     <div class="row">
                        <div class="col-12">
                           <div class="form-group">
                              <label class="form-label">Selecione o Template</label>
                              <div class="row">
                                 <div class="col-2">
                                    <label class="imagecheck mb-4">
                                       <input name="template" type="radio" value="1" class="imagecheck-input" {{$vcard->template == 1 ? 'checked' : ''}}>
                                       <figure class="imagecheck-figure">
                                          <img src="{{asset('assets/front/img/user/vcard-templates/1.jpg')}}" alt="title" class="imagecheck-image">
                                       </figure>
                                    </label>
                                 </div>
                                 <div class="col-2">
                                    <label class="imagecheck mb-4">
                                       <input name="template" type="radio" value="2" class="imagecheck-input" {{$vcard->template == 2 ? 'checked' : ''}}>
                                       <figure class="imagecheck-figure">
                                          <img src="{{asset('assets/front/img/user/vcard-templates/2.jpg')}}" alt="title" class="imagecheck-image">
                                       </figure>
                                    </label>
                                 </div>
                                 <div class="col-2">
                                    <label class="imagecheck mb-4">
                                       <input name="template" type="radio" value="3" class="imagecheck-input" {{$vcard->template == 3 ? 'checked' : ''}}>
                                       <figure class="imagecheck-figure">
                                          <img src="{{asset('assets/front/img/user/vcard-templates/3.jpg')}}" alt="title" class="imagecheck-image">
                                       </figure>
                                    </label>
                                 </div>
                                 <div class="col-2">
                                    <label class="imagecheck mb-4">
                                       <input name="template" type="radio" value="4" class="imagecheck-input" {{$vcard->template == 4 ? 'checked' : ''}}>
                                       <figure class="imagecheck-figure">
                                          <img src="{{asset('assets/front/img/user/vcard-templates/4.jpg')}}" alt="title" class="imagecheck-image">
                                       </figure>
                                    </label>
                                 </div>
                                 <div class="col-2">
                                    <label class="imagecheck mb-4">
                                       <input name="template" type="radio" value="5" class="imagecheck-input" {{$vcard->template == 5 ? 'checked' : ''}}>
                                       <figure class="imagecheck-figure">
                                          <img src="{{asset('assets/front/img/user/vcard-templates/5.jpg')}}" alt="title" class="imagecheck-image">
                                       </figure>
                                    </label>
                                 </div>
                                 <div class="col-2">
                                    <label class="imagecheck mb-4">
                                       <input name="template" type="radio" value="6" class="imagecheck-input" {{$vcard->template == 6 ? 'checked' : ''}}>
                                       <figure class="imagecheck-figure">
                                          <img src="{{asset('assets/front/img/user/vcard-templates/6.jpg')}}" alt="title" class="imagecheck-image">
                                       </figure>
                                    </label>
                                 </div>
                                 <div class="col-2">
                                    <label class="imagecheck mb-4">
                                       <input name="template" type="radio" value="7" class="imagecheck-input" {{$vcard->template == 7 ? 'checked' : ''}}>
                                       <figure class="imagecheck-figure">
                                          <img src="{{asset('assets/front/img/user/vcard-templates/7.jpg')}}" alt="title" class="imagecheck-image">
                                       </figure>
                                    </label>
                                 </div>
                                 <div class="col-2">
                                    <label class="imagecheck mb-4">
                                       <input name="template" type="radio" value="8" class="imagecheck-input" {{$vcard->template == 8 ? 'checked' : ''}}>
                                       <figure class="imagecheck-figure">
                                          <img src="{{asset('assets/front/img/user/vcard-templates/8.jpg')}}" alt="title" class="imagecheck-image">
                                       </figure>
                                    </label>
                                 </div>
                                 <div class="col-2">
                                    <label class="imagecheck mb-4">
                                       <input name="template" type="radio" value="9" class="imagecheck-input" {{$vcard->template == 9 ? 'checked' : ''}}>
                                       <figure class="imagecheck-figure">
                                          <img src="{{asset('assets/front/img/user/vcard-templates/9.jpg')}}" alt="title" class="imagecheck-image">
                                       </figure>
                                    </label>
                                 </div>
                                 <div class="col-2">
                                    <label class="imagecheck mb-4">
                                       <input name="template" type="radio" value="10" class="imagecheck-input" {{$vcard->template == 10 ? 'checked' : ''}}>
                                       <figure class="imagecheck-figure">
                                          <img src="{{asset('assets/front/img/user/vcard-templates/10.jpg')}}" alt="title" class="imagecheck-image">
                                       </figure>
                                    </label>
                                 </div>
                              </div>
                              <p class="em text-danger em-0" id="errtemplate"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <div class="col-12 mb-2">
                              <label for="image"><strong>Imagem Perfil</strong></label>
                            </div>
                            <div class="col-md-12 showImage mb-3">
                              <img src="{{!empty($vcard->profile_image) ? asset('assets/front/img/user/vcard/' . $vcard->profile_image) : asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                            </div>
                            <input type="file" name="profile_image" class="image" class="form-control image">
                            <p id="errprofile_image" class="mb-0 text-danger em"></p>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <div class="col-12 mb-2">
                              <label for="image"><strong>Cover Imagem</strong></label>
                            </div>
                            <div class="col-md-12 showImage mb-3">
                              <img src="{{!empty($vcard->cover_image) ? asset('assets/front/img/user/vcard/' . $vcard->cover_image) : asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                            </div>
                            <input type="file" name="cover_image" class="image" class="form-control image">
                            <p id="errcover_image" class="mb-0 text-danger em"></p>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="">vCard Nome **</label>
                                 <input type="text" class="form-control {{$vcard->direction == 2 ? 'rtl' : ''}}" name="vcard_name" value="{{$vcard->vcard_name}}" placeholder="Enter vcard name">
                                 <p class="text-warning mb-0">Use this name to identify sepcific vcard from your vcards list.</p>
                                 <p id="errvcard_name" class="mb-0 text-danger em"></p>
                              </div>
                           </div>
                          <div class="col-lg-6">
                              <div class="form-group">
                                  <label for="">Direção **</label>
                                  <select name="direction" class="form-control" id="direction">
                                      <option value="" selected disabled>Selecione a Direcão</option>
                                      <option value="1" {{$vcard->direction == 1 ? 'selected' : ''}}>LTR (Da esquerda para direita)</option>
                                      <option value="2" {{$vcard->direction == 2 ? 'selected' : ''}}>RTL (Da direita para esquerda)</option>
                                  </select>
                                  <p id="errdirection" class="mb-0 text-danger em"></p>
                              </div>
                          </div>
                      </div>

                     <div class="row">
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label for="">Nome</label>
                              <input type="text" class="form-control {{$vcard->direction == 2 ? 'rtl' : ''}}" name="name" value="{{$vcard->name}}" placeholder="Enter name">
                              <p id="errname" class="mb-0 text-danger em"></p>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label for="">Empresa </label>
                              <input type="text" class="form-control {{$vcard->direction == 2 ? 'rtl' : ''}}" name="company" value="{{$vcard->company}}" placeholder="Enter company">
                              <p id="errcompany" class="mb-0 text-danger em"></p>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label for="">Ocupação</label>
                              <input type="text" class="form-control {{$vcard->direction == 2 ? 'rtl' : ''}}" name="occupation" value="{{$vcard->occupation}}" placeholder="Enter occupation">
                              <p id="erroccupation" class="mb-0 text-danger em"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="">Email</label>
                              <input type="text" class="form-control ltr" name="email" value="{{$vcard->email}}" placeholder="Enter email">
                              <p id="erremail" class="mb-0 text-danger em"></p>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="">Telefone</label>
                              <input type="text" class="form-control ltr" name="phone" value="{{$vcard->phone}}" placeholder="Enter phone">
                              <p class="text-warning mb-0">Enter Phone Number with <strong class="text-danger">Country Code</strong></p>
                              <p id="errphone" class="mb-0 text-danger em"></p>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="">Endereço</label>
                              <input type="text" class="form-control {{$vcard->direction == 2 ? 'rtl' : ''}}" name="address" value="{{$vcard->address}}" placeholder="Enter address">
                              <p id="erraddress" class="mb-0 text-danger em"></p>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="">Website URL</label>
                              <input type="text" class="form-control ltr" name="website_url" value="{{$vcard->website_url}}" placeholder="Enter website_url">
                              <p id="errwebsite_url" class="mb-0 text-danger em"></p>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label for="">Cor botão telefone</label>
                              <input type="color" class="form-control form-control-color" id="call_button_color" name="call_button_color" value="#{{$vcard->call_button_color}}" title="Choose your color">
                           </div>
                        </div> 
                          <div class="col-lg-4">
                           <div class="form-group">
                              <label for="">Cor botão whatsapp </label>
                              <input type="color" class="form-control form-control-color" id="whatsapp_button_color" name="whatsapp_button_color"value="#{{$vcard->whatsapp_button_color}}" title="Choose your color">
                           </div>
                        </div> 
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label for="">Cor botão email</label>
                              <input type="color" class="form-control form-control-color" id="mail_button_color" name="mail_button_color"value="#{{$vcard->mail_button_color}}" title="Choose your color">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label for="">Cor botão adicionar contato</label>
                              <input type="color" class="form-control form-control-color" id="add_to_contact_button_color" name="add_to_contact_button_color"value="#{{$vcard->add_to_contact_button_color}}" title="Choose your color">
                           </div>
                        </div> 
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label for="">Cor botão compartinhar</label>
                              <input type="color" class="form-control form-control-color" id="share_vcard_button_color" name="share_vcard_button_color"value="#{{$vcard->share_vcard_button_color}}" title="Choose your color">
                           </div>
                        </div> 
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label for="">Cor botão icone telefone</label>
                              <input type="color" class="form-control form-control-color" id="phone_icon_color" name="phone_icon_color"value="#{{$vcard->phone_icon_color}}" title="Choose your color">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label for="">Cor botão icone email</label>
                              <input type="color" class="form-control form-control-color" id="email_icon_color" name="email_icon_color"value="#{{$vcard->email_icon_color}}" title="Choose your color">
                           </div>
                        </div> 
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label for="">Cor botão icone endereço</label>
                              <input type="color" class="form-control form-control-color" id="address_icon_color" name="address_icon_color"value="#{{$vcard->address_icon_color}}" title="Choose your color">
                           </div>
                        </div> 
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label for="">Cor botão icone site</label>
                              <input type="color" class="form-control form-control-color" id="website_url_icon_color" name="website_url_icon_color"value="#{{$vcard->website_url_icon_color}}" title="Choose your color">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="">Cor base</label>
                              <input type="color" class="form-control form-control-color" id="base_color" name="base_color" value="#{{$vcard->base_color}}" title="Choose your color">
                           </div>
                        </div> 
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label for="">Cor sumario </label>
                              <input type="color" class="form-control form-control-color" id="summary_background_color" name="summary_background_color"value="#{{$vcard->summary_background_color}}" title="Choose your color">
                           </div>
                        </div>
                     </div>


                     <div class="row">

                        <div class="col-lg-12">
                           <div class="form-group">
                              <label for="summary">Introdução</label>
                              <textarea name="introduction" id="introduction" class="form-control {{$vcard->direction == 2 ? 'rtl' : ''}}" rows="4" placeholder="Enter Introduction">{{$vcard->introduction}}</textarea>
                           </div>
                        </div>
                     </div>


                     <div id="app">
                        {{-- Infromation Start --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="d-block mb-2">Outras informções</label>
                                    <button class="btn btn-primary" @click="addInformation">Adicionar informação</button>
                                </div>
                            </div>
                        </div>


                        <div class="row no-gutters" v-for="(information, index) in infromations" :key="information.uniqid">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Icone **</label>
                                    <div class="btn-group d-block">
                                        <button type="button" class="btn btn-primary iconpicker-component"><i :id="'vcard-icp-icon' + index" :class="information.icon"></i></button>
                                        <button type="button" :id="'vcard-icp'+information.uniqid" class="vcard-icp vcard-icp-dd btn btn-primary dropdown-toggle" data-selected="fa-car" data-toggle="dropdown" :data-vue_index="index">
                                        </button>
                                        <div class="dropdown-menu"></div>
                                    </div>
                                    <input type="hidden" name="icons[]" v-model="information.icon">
                                    <p class="em text-danger mb-0" :id="'erricons.'+index"></p>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                   <label for="">Link</label><br>
                                    <input name="links[]" :value="index" type="checkbox" :checked="information.link == 1 ? true : false">
                                    <p class="em text-danger mb-0" :id="'errlinks.'+index"></p>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                   <label for="">Icone Color</label>
                                    <input name="colors[]" :class="'jscolor jscolor' + information.uniqid + ' ltr form-control'" :value="information.color" type="text" @change="setColor($event, index)" >
                                    <p class="em text-danger mb-0" :id="'errcolors.'+index"></p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                   <label for="">Rótulo</label>
                                    <input name="labels[]" class="form-control" :class="{rtl: information.dir == 2}" v-model="information.label" type="text" >
                                    <p class="em text-danger mb-0" :id="'errlabels.'+index"></p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                   <label for="">Valor</label>
                                    <input name="values[]" class="form-control" :class="{rtl: information.dir == 2}" v-model="information.value" type="text" >
                                    <p class="em text-danger mb-0" :id="'errvalues.'+index"></p>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <button class="btn btn-danger text-white mt-4" @click="removeInformation(index)">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        {{-- Infromation End --}}
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="card-footer">
            <div class="form">
               <div class="form-group from-show-notify row">
                  <div class="col-12 text-center">
                     <button type="submit" id="submitBtn" class="btn btn-success">Salvar</button>
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

@section('vuescripts')
<script>
   $(document).on('change', '.image', function (event) {
      let $this = $(this);
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = function (e) {
            $(this).prev('.showImage').find('img').attr('src', e.target.result);
      };
      reader.readAsDataURL(file);
   })
</script>
    <script>
        let app = new Vue({
            el: '#app',
            data() {
                return  {
                    infromations: []
                }
            },
            methods: {
               setIcon(value, index) {
                  let information = this.infromations[index];
                  information.icon = value;
                  this.$set(this.infromations, index, information);
               },
               setColor($event, index) {
                  let information = this.infromations[index];
                  information.color = $event.target.value;
                  console.log(information)
                  this.$set(this.infromations, index, information);
               },
               addIcpEvent() {
                  let _this = this;
                  this.$nextTick(function () {
                     let _this = this;
                     if ($('.vcard-icp').length > 0) {
                        $('.vcard-icp').each(function(i) {
                           let index = i;
                           let vIndex = $(this).data('vue_index');
                           $(this).on('iconpickerSelected', function(event){
                              let val = $("#vcard-icp-icon" + index).attr('class');
                              $("input[name='icons[]']").eq(index).val(val);
                              _this.setIcon(val, vIndex);
                           });
                        });
                     }
                  })
               },
                uniqid() {
                    let n = Math.floor(Math.random() * 11);
                    let k = Math.floor(Math.random() * 1000000);
                    let m = n + k;
                    return m;
                },
                addInformation() {
                    let _this = this;
                    let uniqid = this.uniqid();
                    let dir = document.getElementById('direction').value;
                    this.infromations.push({uniqid: uniqid, icon: 'fas fa-heart', color: '000000', label: '', value: '', dir: dir, link: 0});
                    console.log('informations', this.infromations);

                     // initialize icon picker & color picker for newly added inputs only, also add event to all icon pickers 
                     this.$nextTick(function () {
                        $('#vcard-icp' + uniqid).iconpicker();
                        jscolor.installByClassName("jscolor" + uniqid);
                        _this.addIcpEvent();
                     })
                },
                removeInformation(index) {
                    this.infromations.splice(index, 1);
                }
            },
            mounted() {
               this.$nextTick(function () {

               })
            },
            created() {
                $.get("{{route('user.vcard.information', $vcard->id)}}", (datas) => {
                    let _this = this;
                    for (let i = 0; i < datas.length; i++) {
                        datas[i].dir = {{$vcard->direction}};
                        _this.infromations.push(datas[i]);
                    }
                    // initialize icon picker & color picker, also add event to all icon pickers    
                    setTimeout(function() {
                        $('.vcard-icp').iconpicker();
                        jscolor.installByClassName("jscolor");
                        _this.addIcpEvent();
                    }, 1000);
                });
            }
        });
    </script>
@endsection
