<div class="mb-25 contact-section-widget contact-section-three">
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                <h3>{{$keywords["Formulário"] ?? "Formulário"}}</h3>
            </div>
        </div>
    </div>
    <div class="contact-form">
        <form action="{{route('front.contact.message', getParam())}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$vcard->user_id}}">
            <input type="hidden" name="type" value="vcard">
            <input type="hidden" name="to_name" value="{{$vcard->name}}">
            <input type="hidden" name="to_mail" value="{{$vcard->email}}">
            <div class="row">
                <div class="col-12">
                    <div class="form_group">
                        <input type="text" class="form_control" placeholder="{{$keywords["Nome"] ?? "Digite seu nome"}}" name="fullname" required>
                        @if ($errors->has('fullname'))
                            <p class="text-danger mb-0">{{$errors->first('fullname')}}</p>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="form_group">
                        <input type="email" class="form_control" placeholder="{{$keywords["Email_formulário"] ?? "Digite se email"}}" name="email" required>
                        @if ($errors->has('email'))
                            <p class="text-danger mb-0">{{$errors->first('email')}}</p>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="form_group">
                        <input type="text" class="form_control" placeholder="{{$keywords["Assunto"] ?? "Assunto"}}" name="subject" required>
                        @if ($errors->has('subject'))
                            <p class="text-danger mb-0">{{$errors->first('subject')}}</p>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="form_group">
                        <textarea class="form_control" placeholder="{{$keywords["Mensagem"] ?? "Digite sua mensagem"}}" name="message"></textarea>
                        @if ($errors->has('message'))
                            <p class="text-danger mb-0">{{$errors->first('message')}}</p>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="form_group">
                        <button class="main-btn btn-color-three" type="submit">{{$keywords["Enviar"] ?? "Enviar"}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="mb-25"></div>
</div>