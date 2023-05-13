@extends('user.layout')

@php
    $default = \App\Models\User\Language::where('is_default', 1)->first();
    $user = Auth::guard('web')->user();
    $package = \App\Http\Helpers\UserPermissionHelper::currentPackagePermission($user->id);
    if (!empty($user)) {
      $permissions = \App\Http\Helpers\UserPermissionHelper::packagePermission($user->id);
      $permissions = json_decode($permissions, true);
    }
@endphp

@section('content')
    <div class="mt-2 mb-4">
        <h2 class="pb-2">Seja Bem Vindo , {{Auth::guard('web')->user()->first_name}} {{Auth::guard('web')->user()->last_name}}!</h2>
    </div>
    @if (is_null($package))
        @php
            $pendingMemb = \App\Models\Membership::query()->where([
                ['user_id', '=', Auth::id()],
                ['status',0]
            ])->whereYear('start_date', '<>', '9999')->orderBy('id', 'DESC')->first();
            $pendingPackage = isset($pendingMemb) ? \App\Models\Package::query()->findOrFail($pendingMemb->package_id):null;
        @endphp

        @if ($pendingPackage)
            <div class="alert alert-warning">
                Você solicitou um pacote que precisa de uma ação (Aprovação/Rejeição) por parte do Admin. Você será notificado por e-mail assim que uma ação for tomada.
            </div>
            <div class="alert alert-warning">
                <strong>Plano: </strong> {{$pendingPackage->title}} 
                <span class="badge badge-secondary">{{$pendingPackage->term}}</span>
                <span class="badge badge-warning">Decisão pendente</span>
            </div>
        @else
            <div class="alert alert-warning">
                Sua associação expirou. Adquira um novo pacote/estenda o pacote atual.
            </div>
        @endif
    @else
        <div class="row justify-content-center align-items-center mb-1">
            <div class="col-12">
                <div class="alert border-left border-primary text-dark">
                    @if($package_count >= 2)
                        @if ($next_membership->status == 0)
                            <strong class="text-danger">Você solicitou um pacote que precisa de uma ação (Aprovação/Rejeição) por parte do Admin. Você será notificado por e-mail assim que uma ação for tomada. </strong><br>
                        @elseif ($next_membership->status == 1)
                            <strong class="text-danger">Você tem outro pacote para ativar depois que o pacote atual expirar. Você não pode comprar / estender nenhum pacote, até que o próximo pacote seja ativado </strong><br>
                        @endif
                    @endif

                    <strong>Plano Atual: </strong> {{$current_package->title}} 
                    <span class="badge badge-secondary">{{$current_package->term}}</span>
                    @if ($current_membership->is_trial == 1)
                        (Data expiração plano: {{Carbon\Carbon::parse($current_membership->expire_date)->format('M-d-Y')}})
                        <span class="badge badge-primary">Trial</span>
                    @else
                        (Data expiração plano: {{$current_package->term === 'lifetime' ? "Lifetime" : Carbon\Carbon::parse($current_membership->expire_date)->format('M-d-Y')}})
                    @endif

                    @if($package_count >= 2)
                        <div>
                            <strong>Próximo pacote para ativar: </strong> {{$next_package->title}} <span class="badge badge-secondary">{{$next_package->term}}</span>
                            @if ($current_package->term != 'lifetime' && $current_membership->is_trial != 1) 
                                (
                                Data ativação: 
                                {{Carbon\Carbon::parse($next_membership->start_date)->format('M-d-Y')}}, 
                                Data expiração: {{$next_package->term === 'lifetime' ?  "Lifetime" : Carbon\Carbon::parse($next_membership->expire_date)->format('M-d-Y')}})
                            @endif   
                            @if ($next_membership->status == 0)
                                <span class="badge badge-warning">Decisão Pendente</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        @if (!empty($permissions) && in_array('Skill', $permissions))
        <div class="col-sm-6 col-md-4">
            <a class="card card-stats card-round" href="{{route('user.skill.index')}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-cogs"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Habilidades</p>
                                <h4 class="card-title">{{$skills}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @if (!empty($permissions) && in_array('Portfolio', $permissions))
        <div class="col-sm-6 col-md-4">
            <a class="card card-stats card-warning card-round" href="{{route('user.portfolio.index')}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-address-card"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Portiólios</p>
                                <h4 class="card-title">{{$portfolios}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @if (!empty($permissions) && in_array('Service', $permissions))
        <div class="col-sm-6 col-md-4">
            <a class="card card-stats card-info card-round" href="{{route('user.services.index')}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-user-shield"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Serviços</p>
                                <h4 class="card-title">{{$services}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @if (!empty($permissions) && in_array('Testimonial', $permissions))
        <div class="col-sm-6 col-md-4">
            <a class="card card-stats card-primary card-round" href="{{route('user.testimonials.index')}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="far fa-comment"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Depoimentos</p>
                                <h4 class="card-title">{{$testimonials}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @if (!empty($permissions) && in_array('Blog', $permissions))
            <div class="col-sm-6 col-md-4">
                <a class="card card-stats card-success card-round" href="{{route('user.blog.index')}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Blogs</p>
                                    <h4 class="card-title">{{$blogs}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif
        @if (!empty($permissions) && in_array('Experience', $permissions))
        <div class="col-sm-6 col-md-4">
            <a class="card card-stats card-danger card-round" href="{{route('user.job.experiences.index')}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Experiências</p>
                                <h4 class="card-title">{{$job_experiences}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @if (!empty($permissions) && in_array('Achievements', $permissions))
        <div class="col-sm-6 col-md-4">
            <a class="card card-stats card-secondary card-round" href="{{route('user.achievement.index')}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Conquistas</p>
                                <h4 class="card-title">{{$achievements}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @if (!empty($permissions) && in_array('Follow/Unfollow', $permissions))
        <div class="col-sm-6 col-md-4">
            <a class="card card-stats card-default card-round" href="{{route('user.follower.list')}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Seguidores</p>
                                <h4 class="card-title">{{$followers}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @if (!empty($permissions) && in_array('Follow/Unfollow', $permissions))
        <div class="col-sm-6 col-md-4">
            <a class="card card-stats card-primary card-round" href="{{route('user.following.list')}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Seguidores</p>
                                <h4 class="card-title">{{$followings}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <h4 class="card-title">Registro de pagamento</h4>
                            </div>
                            <p class="card-category">
                                10 ultimos pagamentos
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if (count($memberships) == 0)
                                    <h3 class="text-center">Nenhum pagamento encontrado.</h3>
                                    @else
                                    <div class="table-responsive">
                                        <table class="table table-striped mt-3">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Transação Id</th>
                                                    <th scope="col">Valor</th>
                                                    <th scope="col">Pagamento Status</th>
                                                    <th scope="col">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($memberships as $key => $membership)
                                                <tr>
                                                    <td>{{strlen($membership->transaction_id) > 30 ? mb_substr($membership->transaction_id, 0, 30, 'UTF-8') . '...' : $membership->transaction_id}}</td>
                                                    @php
                                                    $bex = json_decode($membership->settings);
                                                    @endphp
                                                    <td>
                                                        @if($membership->price == 0)
                                                        Free
                                                        @else
                                                        {{format_price($membership->price)}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($membership->status == 1)
                                                        <h3 class="d-inline-block badge badge-success">Sucesso</h3>
                                                        @elseif ($membership->status == 0)
                                                        <h3 class="d-inline-block badge badge-warning">Pendente</h3>
                                                        @elseif ($membership->status == 2)
                                                        <h3 class="d-inline-block badge badge-danger">Rejeitado</h3>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!empty($membership->name !== "anonymous"))
                                                        <a class="btn btn-sm btn-info" href="#" data-toggle="modal"
                                                            data-target="#detailsModal{{$membership->id}}">Detalhes</a>
                                                        @else
                                                        -
                                                        @endif
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="detailsModal{{$membership->id}}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Outros Detalhes
                                                                    
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h3 class="text-warning">Assinante detalhes</h3>
                                                                <label>Nome</label>
                                                                <p>{{$membership->user->first_name.' '.$membership->user->last_name}}</p>
                                                                <label>Email</label>
                                                                <p>{{$membership->user->email}}</p>
                                                                <label>Telefone</label>
                                                                <p>{{$membership->user->phone_number}}</p>
                                                                <h3 class="text-warning">Pagamento detalhes</h3>
                                                                <p><strong
                                                                    >Valor: </strong> {{$membership->price == 0 ? "Free" : $membership->price}}
                                                                </p>
                                                                <p><strong
                                                                    >Moeda: </strong> {{$membership->currency}}
                                                                </p>
                                                                <p><strong
                                                                    >Method: </strong> {{$membership->payment_method}}
                                                                </p>
                                                                <h3 class="text-warning">Package Details</h3>
                                                                <p><strong
                                                                    >Titulo: </strong>{{$membership->package->title}}
                                                                </p>
                                                                <p><strong>Termos: </strong> {{$membership->package->term}}
                                                                </p>
                                                                <p><strong>Data inicio: </strong>
                                                                    @if (\Illuminate\Support\Carbon::parse($membership->start_date)->format('Y') == '9999')
                                                                        <span class="badge badge-danger">Nunca ativado</span>
                                                                    @else
                                                                        {{\Illuminate\Support\Carbon::parse($membership->start_date)->format('M-d-Y')}} 
                                                                    @endif
                                                                </p>
                                                                <p><strong>Data expiração: </strong>
                                                                    
                                                                    @if (\Illuminate\Support\Carbon::parse($membership->start_date)->format('Y') == '9999')
                                                                        -
                                                                    @else
                                                                        @if ($membership->modified == 1)
                                                                            {{\Illuminate\Support\Carbon::parse($membership->expire_date)->addDay()->format('M-d-Y')}}
                                                                            <span class="badge badge-primary btn-xs">modificado pelo adminstrador</span>
                                                                        @else
                                                                            {{$membership->package->term == 'lifetime' ? 'Lifetime' : \Illuminate\Support\Carbon::parse($membership->expire_date)->format('M-d-Y')}}
                                                                        @endif
                                                                    @endif
                                                                </p>
                                                                <p>
                                                                    <strong >Plano selecionado: </strong>
                                                                    @if($membership->is_trial == 1)
                                                                    Trial
                                                                    @else
                                                                    {{$membership->price == 0 ? "Free" : "Regular"}}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                Fechar
                                                                </button>
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
        </div>
        @if (!empty($permissions) && in_array('Follow/Unfollow', $permissions))
        <div class="col-lg-6">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <h4 class="card-title">Novos seguidores</h4>
                            </div>
                            <p class="card-category">
                                10 ultimos seguidores
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped mt-3">
                                            <thead>
                                            <tr>
                                                <th scope="col">Imagem</th>
                                                <th scope="col">Nome usuáro</th>
                                                <th scope="col">Ações</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($users as $key => $user)
                                                <tr>
                                                    <td><img src="{{asset('assets/front/img/user/'.$user->photo)}}" alt="" width="40"></td>
                                                    <td>{{strlen($user->username) > 30 ? mb_substr($user->username, 0, 30, 'UTF-8') . '...' : $user->username}}</td>
                                                    <td>
                                                        <a target="_blank" class="btn btn-secondary btn-sm" href="{{route('front.user.detail.view', $user->username)}}">
                                                          <span class="btn-label">
                                                            <i class="fas fa-eye"></i>
                                                          </span>
                                                            Visualição
                                                        </a>
                                                        <a class="btn btn-danger btn-sm" href="{{route('user.unfollow', $user->id)}}">
                                                          Deixar de seguir
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection


