@extends('admin.layout')
@section('content')
<div class="page-header">
    <h4 class="page-title">{{empty(request()->input('type')) ? 'All' : ucfirst(request()->input('type'))}} Subdomains</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="{{route('admin.dashboard')}}">
            <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Subdomains</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">{{empty(request()->input('type')) ? 'All' : ucfirst(request()->input('type'))}}</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card-title d-inline-block">All Subdomains</div>
                    </div>
                    <div class="col-lg-6 offset-lg-2 mt-2 mt-lg-0">
                        <form action="{{request()->url()}}" class="float-right d-flex">
                            @if (!empty(request()->input('type')))
                                <input type="hidden" name="type" value="{{request()->input('type')}}">
                            @endif
                            <input name="username" style="min-width: 250px;" class="form-control mr-2" type="text" placeholder="Search by Username" value="{{request()->input('username')}}">
                            <button type="submit" class="d-none"></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if (count($subdomains) == 0)
                            <h3 class="text-center">NO SUBDOMAIN FOUND</h3>
                        @else
                        <div class="table-responsive">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Subdomain</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subdomains as $subdomain)
                                    <tr>
                                        <td>{{$subdomain->username}}</td>
                                        <td>
                                            <span>{{strtolower($subdomain->username)}}.{{env('WEBSITE_HOST')}}</span>
                                        </td>
                                        <td>
                                            <form id="statusForm{{$subdomain->id}}" action="{{route('admin.subdomain.status')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{$subdomain->id}}">
                                                <select style="max-width: 130px;" 
                                                    class="form-control form-control-sm
                                                    @if($subdomain->subdomain_status == 0)
                                                    bg-warning text-white
                                                    @elseif($subdomain->subdomain_status == 1)
                                                    bg-success text-white
                                                    @endif
                                                    " name="status" onchange="document.getElementById('statusForm{{$subdomain->id}}').submit();">
                                                <option value="0" {{$subdomain->subdomain_status == 0 ? 'selected' : ''}}>Pending</option>
                                                <option value="1" {{$subdomain->subdomain_status == 1 ? 'selected' : ''}}>Connected</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm editbtn" data-toggle="modal" data-target="#mailModal" data-email="{{$subdomain->email}}">Mail</button>
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

            <div class="card-footer">
                {{$subdomains->appends(['type' => request()->input('type'), 'username' => request()->input('username')])->links()}}
            </div>


            <!-- Send Mail Modal -->
            <div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Send Mail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="ajaxEditForm" class="" action="{{route('admin.custom-domain.mail')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Email Address **</label>
                                    <input id="inemail" type="text" class="form-control" name="email" value="" placeholder="Enter email">
                                    <p id="eerremail" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Subject **</label>
                                    <input id="insubject" type="text" class="form-control" name="subject" value="" placeholder="Enter subject">
                                    <p id="eerrsubject" class="mb-0 text-danger em"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Message **</label>
                                    <textarea id="inmessage" class="form-control summernote" name="message" placeholder="Enter message" data-height="150"></textarea>
                                    <p id="eerrmessage" class="mb-0 text-danger em"></p>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="updateBtn" type="button" class="btn btn-primary">Send Mail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection