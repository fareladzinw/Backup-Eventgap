@extends('layout.baseUser')

@section('embedcss')
<link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
@endsection

@section('content')
<div class="container event">
    @if(isset($event))
    <br>
        <h2>Hasil pencarian event <b>"{{ $query }}"</b> </h2>
    <h2></h2>
    
            <div class="grid">
            @foreach($event as $event)
                <div class="card" id="new" style="width: 18rem; display: inline-block">
                    <img class="card-img-top" src="{{ asset('event-gap/public/images/event/'.$event->gambar)}}" alt="image cap" height : 200px;>
                    <div class="card-body">
                        <h5 class="card-title">{{$event->namaEvent}}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($event->deskripsi, 60, '...') }}</p>
                        <a href="{{ url('event/'.$event->id)}}" class="btn btn-primary">Lihat..</a>
                    </div>
                </div>        
            @endforeach
    </div>
    @endif
    <a class="btn c-white br-15 btn-primary mr-3" type="submit" href="{{url('dashboard')}}" >Kembali</a>
    <br>
    <br>
</div>
@endsection
