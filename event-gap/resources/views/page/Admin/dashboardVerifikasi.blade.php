@extends('layout.baseAdmin')

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
    <h2>Hello Admin,</h2>
    <h3>Daftar Verifikasi User</h3>
    <br>
                <div class="card bg-grey mb-3"  style="border : 1px solid black">
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nama User</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Foto KTP</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                        @foreach($user as $k => $s)
                                        <tr>
                                            <td>{{$s->nama}}</td>
                                            <td>{{$s->email}}</td>
                                            <td>
                                                <img class="img myImg" style="width:100%;max-width:300px" src="{{asset('event-gap/public/images/ktp/'.$s->ktp)}}" alt="">
                                            </td>
                                            <td colspan="2">
                                                <form action="{{route('acceptKtp',$s->id)}}">
                                                    <button type="submit" class="btn btn-success">Accept</button>    
                                               </form>
                                               <form action="{{route('rejectKtp',$s->id)}}">
                                                    <button type="submit" class="btn btn-danger">Reject</button>    
                                               </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
</div>

@for($i = 0; $i < count($user); $i++)
<!--Modal IMG -->
<div class="myModal modal">
  <span class="cls">&times;</span>
  <img class="modal-content" id="{{"img".$i}}">
</div>
@endfor

@for($i = 0; $i < count($user); $i++)
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
            