@extends('user.layout')

@section('content')
<div class="page-header">
    <h4 class="page-title">Histórico pagamentos</h4>
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
            <a href="#">Histórico pagamentos</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card-title d-inline-block">Histórico  pagamento</div>
                    </div>
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                        <form action="{{url()->current()}}" class="d-inline-block float-right">
                            <input class="form-control" type="text" name="search"
                                placeholder="Search by Transaction ID"
                                value="{{request()->input('search') ? request()->input('search') : '' }}">
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if (count($memberships) == 0)
                        <h3 class="text-center">NENHUM PAGAMENTO ENCONTRAD</h3>
                        @else
                        <div class="table-responsive">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Transação Id</th>
                                        <th scope="col">Plano</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Pagamento Status</th>
                                        <th scope="col">Forma de pagamento</th>
                                        <th scope="col">Recibo</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($memberships as $key => $membership)
                                    <tr>
                                        <td>{{strlen($membership->transaction_id) > 30 ? mb_substr($membership->transaction_id, 0, 30, 'UTF-8') . '...' : $membership->transaction_id}}</td>
                                        <td>
                                            @if (!empty($membership->package))
                                                {{$membership->package->title}}
                                                <span class="badge badge-secondary badge-xs">{{$membership->package->term}}</span>
                                            @endif
                                        </td>
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
                                        <td>{{$membership->payment_method}}</td>
                                        <td>
                                            @if (!empty($membership->receipt))
                                            <a class="btn btn-sm btn-info" href="#" data-toggle="modal"
                                                data-target="#receiptModal{{$membership->id}}">Visualizar</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($membership->name !== "anonymous"))
                                            <a class="btn btn-sm btn-info" href="#" data-toggle="modal"
                                                data-target="#detailsModal{{$membership->id}}">Detail</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="receiptModal{{$membership->id}}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Imagem do recibo
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img
                                                        src="{{asset('assets/front/img/membership/receipt/' . $membership->receipt)}}"
                                                        alt="Receipt" width="100%">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Fechar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="detailsModal{{$membership->id}}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Outros detalhes
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h3 class="text-warning">Detalhes Usuário </h3>
                                                    <label>Nome</label>
                                                    <p>{{$membership->user->first_name.' '.$membership->user->last_name}}</p>
                                                    <label>Email</label>
                                                    <p>{{$membership->user->email}}</p>
                                                    <label>Telefone</label>
                                                    <p>{{$membership->user->phone}}</p>
                                                    <h3 class="text-warning">Detalhes Pagamento</h3>
                                                    <p><strong>Valor: </strong> {{$membership->price == 0 ? "Free" : $membership->price}}
                                                    </p>
                                                    <p><strong>Moeda: </strong> {{$membership->currency}}
                                                    </p>
                                                    <p><strong>Forma pagamento: </strong> {{$membership->payment_method}}
                                                    </p>
                                                    <h3 class="text-warning">Detalhes plano</h3>
                                                    <p><strong>Titúlo: </strong>{{$membership->package->title}}
                                                    </p>
                                                    <p><strong>Prazo (Tempo do plano): </strong> {{$membership->package->term}}
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
                                                        <strong>Tipo de compra: </strong>
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
            <div class="card-footer">
                <div class="row">
                    <div class="d-inline-block mx-auto">
                        {{$memberships->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
