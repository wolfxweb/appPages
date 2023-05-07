@extends('front.layout')

@section('pagename')
    - {{$package->title}}
@endsection

@section('meta-description', !empty($package) ? $package->meta_keywords : '')
@section('meta-keywords', !empty($package) ? $package->meta_description : '')

@section('breadcrumb-title')
    {{$package->title}}
@endsection
@section('breadcrumb-link')
    {{$package->title}}
@endsection

@section('content')
    <!--====== Start user-form-section ======-->
    <section class="user-form-section pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="user-form">
                        <form action="{{ route('front.checkout.view') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form_group">
                                <span>{{ __('Username') }} *</span>
                                <input type="text" class="form_control" name="username" value="{{ old('username') }}"
                                placeholder="{{ __('Username') }}"  required>
                                @if ($hasSubdomain)
                                    <p class="mb-0">
                                        Your subdomain based profile URL will be:
                                        <strong class="text-primary"><span id="username">{username}</span>.{{env('WEBSITE_HOST')}}</strong>
                                    </p>
                                @endif
                                <p class="text-danger mb-0" id="usernameAvailable"></p>
                                @error('username')
                                    <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form_group">
                                <span>{{ __('Email address') }} *</span>
                                <input type="email" class="form_control" name="email" value="{{ old('email') }}"
                                placeholder="{{ __('Email address') }}" required>
                                @error('email')
                                    <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form_group">
                                <span>{{__('Password')}} *</span>
                                <input type="password" class="form_control" name="password" value="{{ old('password') }}"
                                    placeholder="{{ __('Password') }}" required>
                                @error('password')
                                    <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form_group">
                                <span>{{ __('Confirm Password') }} *</span>
                                <input id="password-confirm" type="password" class="form_control"
                                    placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required
                                    autocomplete="new-password">
                                @error('password')
                                    <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <input type="hidden" name="status" value="{{ $status }}">
                                <input type="hidden" name="id" value="{{ $id }}">
                            </div>
                            <div class="form_group mt-5">
                                <button type="submit" class="main-btn">continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End user-form-section ======-->
@endsection



@section('scripts')
    @if ($hasSubdomain)
        <script>
            $(document).ready(function() {
                $("input[name='username']").on('input', function() {
                    let username = $(this).val();
                    if (username.length > 0) {
                        $("#username").text(username);
                    } else {
                        $("#username").text("{username}");
                    }
                });
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $("input[name='username']").on('change', function() {
                let username = $(this).val();
                if (username.length > 0) {                    
                    $.get("{{url('/')}}/check/" + username + '/username', function(data) {
                        if (data == true) {
                            $("#usernameAvailable").text('This username is already taken.');
                        } else {
                            $("#usernameAvailable").text('');
                        }
                    });
                } else {
                    $("#usernameAvailable").text('');
                }
            });
        });
    </script>
@endsection