@extends('user.profile1.theme3.layout')

@section('tab-title')
{{$keywords["Contact"] ?? "Contact"}}
@endsection

@section('meta-description', !empty($userSeo) ? $userSeo->blogs_meta_description : '')
@section('meta-keywords', !empty($userSeo) ? $userSeo->blogs_meta_keywords : '')

@section('content')
    <!--====== Start Main Wrapper ======-->
    <div class="main-wrapper inner">
        <section class="contact-area pt-150 pb-160">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section-title mb-40">
                            <span class="sub-title">{{$home_text->contact_title ??  __('Get in touch')}}</span>
                            <h2><span class="light-text">{{$home_text->contact_subtitle ?? __('Get in touch')}}</span></h2>
                        </div>
                    </div>
                </div>
                <div class="contact-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="contact-form">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="form_group">
                                            <label>{{$keywords["Name"] ?? "Name"}}</label>
                                            <input type="text" class="form_control" name="fullname" placeholder="{{$keywords["Enter_Name"] ?? "Enter Name"}}" required>
                                            @if ($errors->has('fullname'))
                                                <p class="text-danger mb-0">{{$errors->first('fullname')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="form_group">
                                            <label>{{$keywords["Email_Address"] ?? "Email Address"}}</label>
                                            <input type="text" class="form_control" name="email" placeholder="{{$keywords["Enter_Email_Address"] ?? "Enter Email Address"}}" required>
                                            @if ($errors->has('email'))
                                                <p class="text-danger mb-0">{{$errors->first('email')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="form_group">
                                            <label>{{$keywords["Subject"] ?? "Subject"}}</label>
                                            <input type="text" class="form_control" name="subject" placeholder="{{$keywords["Enter_Subject"] ?? "Enter Subject"}}" required>
                                            @if ($errors->has('subject'))
                                                <p class="text-danger mb-0">{{$errors->first('subject')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form_group">
                                            <label>{{$keywords["Message"] ?? "Message"}}</label>
                                            <textarea class="form_control" name="message" placeholder="{{$keywords["Enter_Message"] ?? "Enter Message"}}"></textarea>
                                            @if ($errors->has('message'))
                                                <p class="text-danger mb-0">{{$errors->first('message')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="button text-center">
                                            <button class="main-btn">{{$keywords["Send_Message"] ?? "Send Message"}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection