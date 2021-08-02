@extends('layout.baseUser')

@section('embedcss')
<style>
.myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

.myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.cls {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.cls:hover,
.cls:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
@endsection

@section('content')

<div class="container event">
    @if ($message = Session::get('alert-success'))
        <div class="alert alert-success m-2" role="alert">
            {{$message}}
        </div>
    @endif
    <br>
    <h3>Daftar Event Partner</h3>
    @if(!empty($partner))
        @if($partner[0]->tipe == 1)
            <h4>Perlengkapan Acara</h4>
        @elseif($partner[0]->tipe == 2)
            <h4>Kostum dan Makeup</h4>
        @elseif($partner[0]->tipe == 3)
            <h4>Konsumsi</h4>
        @elseif($partner[0]->tipe == 4)
            <h4>Fotografi</h4>
        @else
            <h4>Belum ada data event partner</h4>
        @endif
    @endif
                <div class="card  bg-grey mb-3" style="border : 1px solid black">
                    <div class="card-body table-responsive">
                        <table class="table table-hover" id="eventPartner">
                            <thead>
                                <tr>
                                    <th scope="col">Gambar event</th>
                                    <th scope="col">Event Partner</th>
                                    <th scope="col">Tipe</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Sosmed</th>
                                    <th scope="col">Nomor HP</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>
                                        @foreach($partner as $p)
                                        <tr>
                                            <td>
                                                <img class="img myImg" width="300px" src="{{!empty($p->gambar)  ? asset('event-gap/public/images/event-partner/'.$p->gambar) : asset('event-gap/public/images/female-avatar.png')}}" alt="">
                                            </td>
                                            <td>{{$p->nama_partner}}</td>
                                            @if($p->tipe == 1)
                                                <td>Perlengkapan Acara</td>
                                            @elseif($p->tipe == 2)
                                                <td>Kostum dan Makeup</td>
                                            @elseif($p->tipe == 3)
                                                <td>Konsumsi</td>
                                            @elseif($p->tipe == 4)
                                                <td>Fotografi</td>
                                            @endif
                                            <td>{{$p->lokasi}}</td>
                                            <td>{{!empty($p->sosmed) ? $p->sosmed:'-'}}</td>
                                            <td>+62 {{!empty($p->hp) ? $p->hp:'-'}}</td>
                                            <td>{{!empty($p->deskripsi) ? $p->deskripsi:'-'}}</td>
                                        </tr>
                                        @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
</div>

@for($i = 0; $i < count($partner); $i++)
<!-- The Modal -->
<div class="myModal modal">
  <span class="cls">&times;</span>
  <img class="modal-content" id="{{"img".$i}}">
</div>
@endfor

@endsection

@section('js')
<script>
$(document).ready(function() {
    $('#eventPartner').DataTable();
} );
</script>

@for($i = 0; $i < count($partner); $i++)
    <script>
    var modal = document.getElementsByClassName("myModal")[{{$i}}];
    
    var img = document.getElementsByClassName("myImg")[{{$i}}];
    var modalImg = document.getElementById("{{"img".$i}}");
    img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
    }

    var span = document.getElementsByClassName("cls")[{{$i}}];
    
    span.onclick = function() { 
      modal.style.display = "none";
    }
    </script>
@endfor

@endsection