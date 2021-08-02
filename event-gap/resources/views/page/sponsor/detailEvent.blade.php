@extends('layout.baseUser')

@section('embedcss')
<link rel="stylesheet" href="{{ asset('css/event.css')}}">
@show

@section('content')
<div class="container">
    @if($eventUserId == $userId)
        @if($event[0]->statusDraf == 0)
        @foreach($event as $event)
        <div class="title">{{$event->namaEvent}}</div>
    
        <img src="{{'http://eventgap.id/event-gap/public/images/event/'.$event->gambar}}" alt="gambar event" class="img-fluid banner";
            style="border-radius: 5%;">
        <div class="title2">Event</div>
    
        <div class="desc">
             <p><i class="fa fa-map-marker" aria-hidden="true"></i> &emsp; {{$event->lokasi}}</p>
             @if($event->dateTimeUntil == null)
             <p><i class="fa fa-calendar" aria-hidden="true"></i> &emsp; {{date('m-d-Y', strtotime($event->dateTimeFrom))}}</p>
             @else
             <p><i class="fa fa-calendar" aria-hidden="true"></i> &emsp; {{date('m-d-Y', strtotime($event->dateTimeFrom))}} - {{date('m-d-Y', strtotime($event->dateTimeUntil))}}</p>
             @endif
             <p><i class="fa fa-clock-o" aria-hidden="true"></i> &emsp; {{$event->waktu}}</p>
    
        </div>
        <p style="word-break: break-all;">
        {{$event->deskripsi}}
        </p>
        <div class="title2">Diselenggarakan Oleh</div>
        <p><i class="fa fa-user" aria-hidden="true"></i>&emsp; {{$event->penyelenggara}}</p>
        @endforeach
        @if($isFree != 1)
        @if(!$tiket->isEmpty())
        <div class="title2">Pembelian Ticket</div>
        <div class="ticket">
            <div class="container-fluid">
            @foreach($tiket as $tiket)
                <div class="row m-3">
                    <div>
                            <div class="card">
                                <div class="row card-body">
                                    <img class="col-sm-6" src="{{ asset('event-gap/public/images/tiket/'.$tiket->gambar)}}" alt="sans"/>
                                   <div class="col-sm-6">
                                        <div class="card-body">
                                                <h4 class="card-title">{{$tiket->namaTiket}}</h4>
                                                <p class="card-text">{{$tiket->deskripsi}}</p>
                                                <div class="row">
                                                    <div class="col">
                                                    @if($tiket->dateTimeUntil == null)
                                                    <p> {{date('m-d-Y', strtotime($tiket->dateTimeFrom))}}</p>
                                                    @else
                                                    <p> {{date('m-d-Y', strtotime($tiket->dateTimeFrom))}} - {{date('m-d-Y', strtotime($tiket->dateTimeUntil))}}</p>
                                                    @endif
                                                    </div>
                                                    <div class="col">
                                                        <p>Rp.{{$tiket->harga}}</p>
                                                        <p class="card-text" style="color: red;"> Tiket tersisa {{$tiket->qty}}</p>
                                                    </div>
                                                    <div class="col">
                                                        <a name="" id="" class="btn btn-event float-right btn-lg" href="{{route('deleteTiket',$tiket->id)}}" role="button">Hapus Tiket</a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                    </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="title2">Anda belum membuat tiket</div>
        </div>
        @endif
        <div class="container mb-2">
            <div class="row">
                <div class="col">
                    <a name="" data-toggle="modal" data-target="#editProfile" class="btn btn-event btn-lg" href="#" role="button">Edit Event</a>
                </div>
                <div class="col">
                    <a name="" id="" class="btn btn-event btn-lg" href="{{ url('/make-ticket/'.$event->id)}}" role="button">Buat Tiket</a>
                </div>
                <div class="col">
                    <a name="" id="" class="btn btn-event btn-lg" href="{{ url('/table-acc/'.$event->id)}}" role="button">Pembeli Tiket</a>
                </div>
                <div class="col">
                    <a name="" id="" class="btn btn-event btn-lg" href="{{route('deleteEvent',$event->id)}}" role="button">Hapus Event</a>
                </div>
            </div>
        </div>
        @else
        <div class="btn-grub m-3">
            <div class="row">
                <div class="col">
                    <a name="" data-toggle="modal" data-target="#editProfile" class="btn btn-event btn-lg float-right" href="#" role="button">Edit Event</a>
                </div>
                <div class="col"></div>
                <div class="col">
                    <a name="" id="" class="btn btn-event btn-lg" href="{{route('deleteEvent',$event->id)}}" role="button">Hapus Event</a>
                </div>
            </div>
        </div>
        @endif
    </div>
    @elseif($event[0]->statusDraf == 1)
    @foreach($event as $event)
        <div class="title">{{$event->namaEvent}}</div>
    
        <img src="{{'http://eventgap.id/event-gap/public/images/event/'.$event->gambar}}" alt="gambar event" class="img-fluid banner";
            style="border-radius: 5%;">
        <div class="title2">Event</div>
    
        <div class="desc">
             <p><i class="fa fa-map-marker" aria-hidden="true"></i> &emsp; {{$event->lokasi}}</p>
             @if($event->dateTimeUntil == null)
             <p><i class="fa fa-calendar" aria-hidden="true"></i> &emsp; {{date('m-d-Y', strtotime($event->dateTimeFrom))}}</p>
             @else
             <p><i class="fa fa-calendar" aria-hidden="true"></i> &emsp; {{date('m-d-Y', strtotime($event->dateTimeFrom))}} - {{date('m-d-Y', strtotime($event->dateTimeUntil))}}</p>
             @endif
             <p><i class="fa fa-clock-o" aria-hidden="true"></i> &emsp; {{$event->waktu}}</p>
    
        </div>
        <p style="word-break: break-all;">
        {{$event->deskripsi}}
        </p>
        <div class="title2">Diselenggarakan Oleh</div>
        <p><i class="fa fa-user" aria-hidden="true"></i>&emsp; {{$event->penyelenggara}}</p>
        @endforeach
        @if($isFree != 1)
        @if(!$tiket->isEmpty())
        <div class="title2">Pembelian Ticket</div>
        <div class="ticket">
            <div class="container-fluid">
            @foreach($tiket as $tiket)
                <div class="row m-3">
                    <div>
                            <div class="card">
                                <div class="row card-body">
                                    <img class="col-sm-6" src="{{ asset('event-gap/public/images/tiket/'.$tiket->gambar)}}" alt="sans"/>
                                   <div class="col-sm-6">
                                        <div class="card-body">
                                                <h4 class="card-title">{{$tiket->namaTiket}}</h4>
                                                <p class="card-text">{{$tiket->deskripsi}}</p>
                                                <div class="row">
                                                    <div class="col">
                                                    @if($tiket->dateTimeUntil == null)
                                                    <p> {{date('m-d-Y', strtotime($tiket->dateTimeFrom))}}</p>
                                                    @else
                                                    <p> {{date('m-d-Y', strtotime($tiket->dateTimeFrom))}} - {{date('m-d-Y', strtotime($tiket->dateTimeUntil))}}</p>
                                                    @endif
                                                    </div>
                                                    <div class="col">
                                                        <p>Rp.{{$tiket->harga}}</p>
                                                        <p class="card-text" style="color: red;"> Tiket tersisa {{$tiket->qty}}</p>
                                                    </div>
                                                    <div class="col">
                                                        <a name="" id="" class="btn btn-event float-right btn-lg" href="{{route('deleteTiket',$tiket->id)}}" role="button">Hapus Tiket</a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                    </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="title2">Anda belum membuat tiket</div>
        </div>
        @endif
        <div class="container mb-2">
            <div class="row">
                <div class="col">
                    <a name="" data-toggle="modal" data-target="#editProfile" class="btn btn-event btn-lg" href="#" role="button">Edit Event</a>
                </div>
                <div class="col">
                    <a name="" id="" class="btn btn-event btn-lg" href="{{ url('/make-ticket/'.$event->id)}}" role="button">Buat Tiket</a>
                </div>
                <div class="col">
                    <a name="" id="" class="btn btn-event btn-lg" href="{{route('unDraf',$event->id)}}" role="button">Post Event</a>
                </div>
                <div class="col">
                    <a name="" id="" class="btn btn-event btn-lg" href="{{route('deleteEvent',$event->id)}}" role="button">Hapus Event</a>
                </div>
            </div>
        </div>
        @else
        <div class="btn-grub m-3">
            <div class="row">
                <div class="col">
                    <a name="" data-toggle="modal" data-target="#editProfile" class="btn btn-event btn-lg float-right" href="#" role="button">Edit Event</a>
                </div>
                <div class="col">
                <a name="" id="" class="btn btn-event btn-lg" href="{{route('unDraf',$event->id)}}" role="button">Post Event</a>
            </div>
                <div class="col">
                    <a name="" id="" class="btn btn-event btn-lg" href="{{route('deleteEvent',$event->id)}}" role="button">Hapus Event</a>
                </div>
            </div>
        </div>
        @endif
    </div>
    
    @endif
    @elseif($eventUserId != $userId)
    @foreach($event as $event)
    <div class="title">{{$event->namaEvent}}</div>

    <img src="{{ asset('event-gap/public/images/event/'.$event->gambar)}}" alt="" srcset="" class="img-fluid banner"
        style="border-radius: 5%;">
    <div class="title2">Event</div>

    <div class="desc">
         <p><i class="fa fa-map-marker" aria-hidden="true"></i> &emsp; {{$event->lokasi}}</p>
         @if($event->dateTimeUntil == null)
         <p><i class="fa fa-calendar" aria-hidden="true"></i> &emsp; {{date('m-d-Y', strtotime($event->dateTimeFrom))}}</p>
         @else
         <p><i class="fa fa-calendar" aria-hidden="true"></i> &emsp; {{date('m-d-Y', strtotime($event->dateTimeFrom))}} - {{date('m-d-Y', strtotime($event->dateTimeUntil))}}</p>
         @endif
         <p><i class="fa fa-clock-o" aria-hidden="true"></i> &emsp; {{$event->waktu}}</p>

    </div>
    <p>
    {{$event->deskripsi}}
    </p>
    <div class="title2">Diselenggarakan Oleh</div>
    <p><i class="fa fa-user" aria-hidden="true"></i>&emsp; {{$event->penyelenggara}}</p>
    @endforeach
    @if($isFree != 1)
    @if(!$tiket->isEmpty())
    <div class="title2">Pembelian Ticket</div>
    <div class="ticket">
        <div class="container-fluid">
        <form action="{{ route('buyPembayaran',$event->id) }}" method="post"enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('POST') }}
        @foreach($tiket as $tiket)
            <div class="row m-3">
                <div>
                        <div class="card">

                            <div class="row card-body">
                                <img class="col-sm-6" src="{{ asset('event-gap/public/images/tiket/'.$tiket->gambar)}}" alt="sans"/>
                                <input type="hidden" class="form-control" placeholder="" aria-describedby="helpId" name="tiketId[]" id="" value="{{$tiket->id}}">
                               <div class="col-sm-6">
                                    <div class="card-body">
                                            <h4 class="card-title">{{$tiket->namaTiket}}</h4>
                                            <p class="card-text">{{$tiket->deskripsi}}</p>
                                            <div class="row">
                                            <div class="col">
                                                @if($tiket->dateTimeUntil == null)
                                                <p> {{date('m-d-Y', strtotime($tiket->dateTimeFrom))}}</p>
                                                @else
                                                <p> {{date('m-d-Y', strtotime($tiket->dateTimeFrom))}} - {{date('m-d-Y', strtotime($tiket->dateTimeUntil))}}</p>
                                                @endif
                                                </div>
                                                <div class="col">
                                                    <p class="card-text" style="color: red;"> Tiket tersisa {{$tiket->qty}}</p>
                                                </div>
                                                <div class="col">
                                                    <p>Rp.{{ number_format($tiket->harga,2,',','.') }}</p>
                                                    <input type="hidden" class="form-control" placeholder="" aria-describedby="helpId" name="harga[]" id="" value="{{$tiket->harga}}">
                                                    <input type="number" class="form-control" placeholder="" aria-describedby="helpId" name="qty[]" id="" value="0" required>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                </div>
        </div>
        @endforeach

    </div>
    <div class="btn-grub m-3">
        <div class="row">
            <div class="col">
                <a name="" id="" class="btn btn-event float-right btn-lg" href="{{ url('/sponsori/'.$event->id)}}" role="button">Sponsori</a>
            </div>
            <div class="col">
            <button type="submit" id="" class="btn btn-event btn-lg" role="button">Beli Tiket</button>
            </div>
            </form>
        </div>
    </div>
    @else
    <div class="title2">Event ini berbayar, tetapi belum terdapat Tiket</div>
    <div class="btn-grub m-3">
        <div class="row">
            <div class="col">
                <a name="" id="" class="btn btn-event float-right btn-lg" href="{{ url('/sponsori/'.$event->id)}}" role="button">Sponsori</a>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endif
@else
<div class="title2">Event ini Gratis</div>
    <div class="btn-grub m-3">
        <div class="row">
            <div class="col">
                <a name="" id="" class="btn btn-event float-right btn-lg" href="{{ url('/sponsori/'.$event->id)}}" role="button">Sponsori</a>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endif
</div>
@endif
</div>

@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('updateEvent',$event->id) }}" method="post"enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('POST') }}
            <div class="form-group">
                    <label for="">Banner Event</label>
                    <input type="file" class="form-control-file" id="" placeholder=""
                        aria-describedby="fileHelpId" name="gambar" value="">
                </div>
                <div class="form-group">
                    <label for="">Nama Event</label>
                    <input type="text" id="" class="form-control" placeholder="" aria-describedby="helpId" name="namaEvent" value="{{$event->namaEvent}}">
                </div>
                @if($event->link == null)
                <div class="form-group">
                    <label for="">Lokasi</label>
                    <input type="text" id="" class="form-control" placeholder="" aria-describedby="helpId" name="lokasi"value="{{$event->lokasi}}">
                </div>
                @else
                <div class="form-group">
                    <label for="">Link</label>
                    <input type="text" id="" class="form-control" placeholder="" aria-describedby="helpId" name="link"value="{{$event->link}}">
                </div>
                @endif
                <div class="form-group">
                    <label for="">Tanggal Mulai</label>
                    <input type="date" class="form-control" value="{{$event->dateTimeFrom}}" name="dateTimeFrom"/>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Berakhir</label>
                    <input type="date" class="form-control" value="{{$event->dateTimeUntil}}"  name="dateTimeUntil"/>
                </div>
                <div class="form-group">
                    <label for="">Waktu</label>
                    <input type="text" class="form-control" name="waktu" value="{{$event->waktu}}"/>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi Event</label>
                    <textarea class="form-control" id="" rows="3" name="deskripsi" value="{{$event->deskripsi}}"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Penyelenggara</label>
                    <input type="text" id="" class="form-control" placeholder="" aria-describedby="helpId" name="penyelenggara" value="{{$event->penyelenggara}}">

                </div>
                <div class="form-group">
                    <label for="">Contact Person</label>
                    <input type="text" id="" class="form-control" placeholder="Ex. @contactperson" aria-describedby="helpId" name="cp" value="{{$event->cp}}">
                <div class="form-group">
                    <label for=""><i class="fa fa-file-text" aria-hidden="true"></i> Proposal Event (PDF)</label>
                    <input type="file" class="form-control-file" name="proposal" id="" placeholder=""
                        aria-describedby="fileHelpId" value="">
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
