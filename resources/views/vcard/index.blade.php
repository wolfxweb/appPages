@extends('vcard.layout')
@include('vcard.parts.index'.$vcard->template.'.include',[$vcard,$prefs]) 
@section('content')
@include('vcard.parts.index'.$vcard->template.".page",[$vcard,$prefs]) 
@endsection