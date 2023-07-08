<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Success!</title>
    <link rel="stylesheet" type="text/css" href="{{asset("assets/front/css/plugin.min.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset("assets/front/css/success.css")}}"/>
    <!-- base color change -->
    <link href="{{asset('assets/front/css/style-base-color.php').'?color='.$bs->base_color}}" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto" id="mt">
            <div class="payment">
                <div class="payment_header">
                    <div class="check">
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="content">
                        <h1>{{__('Cadastro realizado com sucesso')}}</h1>
                        <p class="paragraph-text">            
                            {{ __('Enviamos um e-mail com o link de verificação')}} <br>
                            {{ __('Verifique sua caixa de entrada e spam')}}
                        </p>
                        <a href="{{route('front.index')}}">Ir para home</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
