@extends('layout.baseUser')

@section('embedcss')
<link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
@endsection

@section('content')
<div class="banner mb-4">
    <div class="container">
        <h1 class="title">
           Make Your Event <br/>
           Come True.
       </h1>
       <p>
           we are creating Indonesia first event based digital solution
       </p>
    </div>
</div>
<div class="container mt-4">
    <form enctype="multipart/form-data" action="/search" method="POST" role="search">
    {{ csrf_field() }}
    {{ method_field('POST') }}
        <div class="search">
            <div class="field">
                <input type="text" name="query" id="" class="form-control" placeholder="event yang anda cari ..." aria-describedby="helpId" required>
            </div>
            <div class="button">
                <button class="btn" type="submit" >
                   <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </form>
    @if ($message = Session::get('alert-fail'))
        <div class="alert alert-danger m-2" role="alert">
            {{$message}}
        </div>
    @endif
    @if (Auth::user()->ktp == null && Auth::user()->status_validasi == null)
    <div class="alert alert-warning m-2" role="alert">
        Upload KTP terlebih dahulu, jika ingin membuat event !
    </div>
    @elseif (Auth::user()->ktp != null && Auth::user()->status_validasi == 0)
    <div class="alert alert-warning m-2" role="alert">
        Tunggu data anda diverifikasi oleh admin
    </div>
    @elseif (Auth::user()->ktp == null && Auth::user()->status_validasi == 2)
    <div class="alert alert-danger m-2" role="alert">
        Data anda gagal diverifikasi, mohon upload ulang foto KTP
    </div>
    @endif
</div>
<div class="bg-rev mt-4">
<div class="container categories pt-3 pb-3 ">
    <h2 class="text-center">Kategori <b>Event</b> !</h2>
    <div class="grid">
            <?php
                $title =["Education", "Health","Sport", "Announcement", "Job Vacancy","Tourism" ];
            ?>
            
        @for ($j = 0; $j < 2; $j++)
            <div class="row m-4">
                @for ($i = 0; $i < 3; $i++)
                    <div class="col col-4">
                        @if ($j > 0)
                        <a href="{{ url('event/kategori/'.($i+4))}}">
                        @else
                        <a href="{{ url('event/kategori/'.($i+1))}}">
                        @endif
                                <div class="card card-category">
                                    <div class="card-body">
                                        @if ($j > 0)
                                            <img src="{{asset('images/icon/'.($i+3).'.png')}}" alt="icon" srcset="" class="img-fluid"
                                            style="margin-left: 5%;">
                                        @else
                                            <img src="{{asset('images/icon/'.$i.'.png')}}" alt="icon" srcset="" class="img-fluid"
                                            style="margin-left: 5%;">
                                        @endif
                                    @if ($j > 0)
                                        <h3 class="card-text" style="text-align: center;">{{ $title[$i+3] }}</h3>
                                    @else
                                        <h3 class="card-text" style="text-align: center;">{{ $title[$i] }}</h3>
                                    @endif
                                    </div>
                                </div>
                            </a>
                    </div>
                @endfor
            </div>
        @endfor
    </div>
</div>
</div>
<div class="container event mt-4">
    <h2 class="text-center">Upcoming <b>Event</b> !</h2>
        <div class="owl-carousel owl-theme" id="owl-1">
                @foreach($event as $ev)
                <div class="item">
                    <div class="card" id="new">
                        <img class="card-img-top" src="{{ asset('event-gap/public/images/event/'.$ev->gambar)}}" alt="Card image cap" height= "200px";>
                        <div class="card-body">
                            <h5 class="card-title">{{$ev -> namaEvent}}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($ev->deskripsi, 60, '...') }}</p>
                            <a href="{{ url('event/'.$ev->id)}}" class="btn btn-primary">Lihat..</a>
                        </div>
                    </div>
                </div>
                @endforeach
    </div>
</div>

<div class="testimonial section-padding container">
    <h2 class="text-center mb-3">Choose your <b>Event partner</b> !</h2>
   <div class="container">
         <div class="owl-carousel owl-theme" id="owl-2">
             <div class="item">
                 <a href="{{ url('event-partner/1')}}">
                 <div class="contact-image">
                    <div class="card p-4">
                        <img class="card-img-top" src="{{ asset('images/2.0/Tenda.png')}}" alt="event partner">
                        <div class="card-body">
                            <h6 class="card-title" style="text-align: center; color: black;">Tenda dan Panggung</h6>
                        </div>
                    </div>
                 </div>
                 </a>
             </div>

             <div class="item">
                 <a href="{{ url('event-partner/2')}}">
                <div class="contact-image">
                    <div class="card p-4">
                        <div class="bg">
                            <img class="card-img-top" src="{{ asset('images/2.0/MakeUp.png')}}" alt="event partner">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title" style="text-align: center; color: black;">Kostum dan Makeup</h6>
                        </div>
                    </div>
                 </div>
                 </a>
             </div>

             <div class="item">
                 <a href="{{ url('event-partner/3')}}">
                <div class="contact-image">
                    <div class="card p-4 pb-5">
                        <div class="bg">
                            <img class="card-img-top" src="{{ asset('images/2.0/Dish.png')}}" alt="event partner">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title" style="text-align: center; color: black;">Konsumsi</h6>
                        </div>
                    </div>
                 </div>
                 </a>
             </div>

             <div class="item">
                 <a href="{{ url('event-partner/4')}}">
                <div class="contact-image">
                    <div class="card p-4">
                        <div class="bg">
                            <img class="card-img-top" src="{{ asset('images/2.0/Kamera.png')}}" alt="event partner">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title" style="text-align: center; color: black;">Fotografi dan Videografi</h6>
                        </div>
                    </div>
                 </div>
                 </a>
             </div>
        </div>
   </div>
</div>
@endsection

@section('js')
<script>
$('#owl-1').owlCarousel({
    center: true,
    items:2,
    loop:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});
$('#owl-2').owlCarousel({
    center: false,
    items:2,
    loop:true,
    margin:0,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
});
</script>
@endsection
