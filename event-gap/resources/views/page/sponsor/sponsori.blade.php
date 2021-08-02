@extends('layout.baseUser')

@section('embedcss')
<link rel="stylesheet" href="{{asset('css/sponsori.css')}}">
@endsection

@section('content')
<div class="container">
    @foreach($event as $event)
    <div class="card m-2">
        <h4 class="card-title text-center">{{$event->namaEvent}}</h4>
        <img class="card-img-top img-fluid w-50" src="{{ asset('event-gap/public/images/event/'.$event->gambar)}}" alt="" style="margin-left :25%">
        <div class="card-body">
        @if(!$event->proposal==null)
            <h4 class="card-title text-center">Persyaratan Proposal</h4>
            <form action="{{route('downloadProposal',$event->id)}}" method="post">
                          {{csrf_field()}}
                          <div class="row">
                             <div class="col-md-6">
                                 <button type="submit" class="btn btn-block btn-primary">Download Proposal</button>
                            </div>
                          <div class="col-md-6">
                              <a href="https://wa.me/+62{{$event->hp}}" class="btn btn-block btn-warning">Konfirmasi langsung ke EO</a>
                          </div>
                          </div>

                                      
            </form>
            @else
            <h4 class="card-title text-center">Event ini tidak mengupload proposalnya</h4>
            @endif
        </div>
    </div>
    @endforeach
</div>
</div>
@endsection
