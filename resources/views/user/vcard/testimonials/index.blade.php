@extends('user.layout')

@section('content')
<div class="page-header">
   <h4 class="page-title">vCard Depoimentos</h4>
   <ul class="breadcrumbs">
      <li class="nav-home">
         <a href="{{route('user.vcard')}}">
         <i class="flaticon-home"></i>
         </a>
      </li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
         <a href="#">vCards</a>
      </li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
         <a href="#">{{$vcard->vcard_name}}</a>
      </li>

   </ul>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <div class="row">
               <div class="col-lg-4">
                  <div class="card-title d-inline-block">vCard Depoimentos</div>
               </div>
               <div class="col-lg-4 offset-lg-4 mt-2 mt-lg-0">
                    <a href="{{route('user.vcard')}}" class="btn btn-secondary float-right btn-sm ml-2"><i class="fas fa-chevron-left"></i> Voltar</a>
                    <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Adicionar</a>
                    <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="{{route('user.vcard.bulkTestimonialDelete')}}"><i class="flaticon-interface-5"></i> Delete</button>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-lg-12">
                    @if (count($testimonials) == 0)
                        <h3 class="text-center">NENHUM DEPOIMENTO CADASTRADO</h3>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped mt-3" id="basic-datatables">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <input type="checkbox" class="bulk-check" data-val="all">
                                    </th>
                                    <th scope="col">Imagem</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Nota</th>
                                    <th scope="col">Serial</th>
                                    <th scope="col">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($testimonials as $key => $testimonial)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="bulk-check" data-val="{{$testimonial->id}}">
                                        </td>
                                        <td><img src="{{asset('assets/front/img/user/testimonials/'.$testimonial->image)}}" alt="" width="80"></td>
                                        <td>{{strlen($testimonial->name) > 30 ? mb_substr($testimonial->name, 0, 30, 'UTF-8') . '...' : $testimonial->name}}</td>
                                        <td>
                                            {{$testimonial->rating}}
                                        </td>
                                        <td>
                                            {{$testimonial->serial_number}}
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm editbtn" data-toggle="modal" data-target="#editModal" data-testimonial_id="{{$testimonial->id}}" data-name="{{$testimonial->name}}" data-rating="{{$testimonial->rating}}" data-comment="{{$testimonial->comment}}" data-serial_number="{{$testimonial->serial_number}}" data-image="{{asset('assets/front/img/user/testimonials/' . $testimonial->image)}}">
                                                <span class="btn-label">
                                                <i class="fas fa-edit"></i>
                                                </span>
                                                
                                            </a>
                                            <form class="deleteform d-inline-block" action="{{route('user.vcard.testimonialDelete')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="testimonial_id" value="{{$testimonial->id}}">
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
               </div>
            </div>
         </div>

      </div>
   </div>
</div>

@includeIf('user.vcard.testimonials.create')
@includeIf('user.vcard.testimonials.edit')
@endsection