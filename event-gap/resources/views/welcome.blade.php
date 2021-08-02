@extends('layout.base')

@section('embedcss')
 <style>
    .card{
        margin: 2rem;
        border: none;
        border-radius: 7px;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
    }
 </style>
@endsection 

@section('content')
<!-- HERO -->
    <section class="hero d-flex justify-content-center align-items-center">
        <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-md-10 col-12 d-flex flex-column justify-content-center align-items-center">
                            <div class="hero-text">

                                <h1 class="text-black" data-aos="fade-up">Make your event come true</h1>
                                <p class="mb-0 c-grey" data-aos="fade-up">
                                    We are creating Indonesia first event based digital solution
                                </p>
                                <a href="{{ url('/register') }}" class="bg-green btn c-white mt-4 ds-green p-2" data-aos="fade-up" data-aos-delay="100">SIGN UP</a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                        <div class="hero-image" data-aos="fade-up" data-aos-delay="300">
                            <img src="{{ asset('images/2.0/ticket-colour.png') }}" class="img-fluid" alt="working girl">
                        </div>
                        </div>

                    </div>
            </div>
    </section>


<!-- ABOUT -->
    <section class="about section-padding" id="about">
        <div class="container">
            <div class="card p-3" data-aos="fade-up" data-aos-delay="200" style="background: #F8F8F8;">
                <div class="row">
                        <div class="col-lg-7 mx-auto col-md-10 col-12">
                            <div class="about-image mb-4">
                                <img src="images/2.0/completed-tasks.png" class="img-fluid" alt="teamwork">
                            </div>
                            
                            <div class="">
                                <h2 class="mb-4 text-center">Get your <strong>sponsorship</strong> !</h2>
    
                                <p class="mb-2 text-center">Kami juga menyediakan layanan penambah dana melalui sponsorship. Dengan adanya bantuan dana tersebut, event anda akan lebih banyak mendapatkan peluang untuk mewujudkan event yang lebih sukses.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

<!-- ABOUT -->
    <section class="about section-padding bg-grey">
        <div class="container">
                <div class="row">

                    <div class="col-lg-7 mx-auto col-md-10 col-12">
                        
                        <div class="about-image mb-4" data-aos="fade-up" data-aos-delay="200">
                            <img src="images/2.0/teamwork.png" class="img-fluid" alt="office">
                        </div>
                        
                        <div class="">

                            <h2 class="mb-4 text-center" data-aos="fade-up">Get your <strong>Event Partner</strong> !</h2>

                            <p class="mb-2 text-center" data-aos="fade-up">Kami juga bekerja sama dengan penyedia jasa penyelenggara event sperti jasa  sound sistem, tenda, konsumsi, make up dan fotografi. Dengan ini event anda akan lebih mudah dalam proses penyelnggaraanya.</p>
                        </div>

                    </div>
                </div>
            </div>
    </section>


 <!--TESTIMONIAL -->
<section class="testimonial section-padding">
   <div class="container">
       <h2 class="mb-4 text-center" data-aos="fade-up">Kind Of Our <strong>Event Partners</strong> !</h2>
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
</section>
@endsection

@section('js')
<script>
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

