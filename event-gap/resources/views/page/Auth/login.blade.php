
@extends('layout.base')
@section('content')
@if ($message = Session::get('alert-success'))
        <div class="alert alert-success m-2" role="alert">
            {{$message}}
        </div>
    @endif
    @if ($message = Session::get('alert-fail'))
        <div class="alert alert-danger m-2" role="alert">
            {{$message}}
        </div>
    @endif
<div class="container mb-4">
<div class="row">
    <div class="col-md-6">
        <img src="{{ asset('images/auth.png')}}" alt="" class="img-fluid mt-3">
    </div>    
    <div class="col-md-6">
       <div class="registration-form">
            <form action="{{ route('checkLogin') }}" method="POST"> 
            {{ csrf_field() }}
            {{ method_field('POST') }}
                <b><h2 class="mb-3">WELCOME</h2></b>
                <div class="form-group">
                    <input type="text" class="form-control item" id="email" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control item" id="password" placeholder="Password" name="password">
                </div>
                <div class="form-group center-btn">
                    <button type="submit" class="btn bg-green c-white ds-green create-account">Login</button>
                </div>
            </form>
        </div>
    </div> 
</div>    
</div>    

@endsection

@section('embedjs')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js">
</script>
@endsection

@section('embedcss')
<link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css"
    rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
@endsection
