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
    <h3>Daftar Event Partner</h3>
    <br>
    <a href="#" data-toggle="modal" data-target="#inputPartner"><button class="btn bg-green c-white mb-3">Tambah Data Event Partner</button></a>
                <div class="card bg-grey mb-3" style="border : 1px solid black">
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
                                    <th scope="col">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                        @foreach($partner as $k => $p)
                                        <tr>
                                            <td>
                                                <img class="img myImg" style="width:300px" src="{{!empty($p->gambar)  ? asset('event-gap/public/images/event-partner/'.$p->gambar) : asset('event-gap/public/images/female-avatar.png')}}" alt="">
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
                                            <td colspan="2" class="d-flex">
                                                <a href="{{route('indexEditPartner',$p->id)}}"><button type="button" class="btn btn-warning mr-3">Edit</button></a>
                                               <form action="{{route('deletePartner',$p->id)}}">
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Menghapus Event Partner?')">Hapus</button>    
                                               </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
</div>

<!-- Modal -->
<div class="modal fade" id="inputPartner" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat Event Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('postPartner') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('POST') }}
                    <div class="form-group">
                        <label for="">Nama Partner</label>
                        <input type="text" class="form-control" name="nama_partner" required>
                    </div>
                    <div class="form-group">
                    <label for="">Tipe Partner</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="1" value=1 name="tipe"
                                checked>
                            <label class="form-check-label" for="1">
                                Perlengkapan Acara
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio"id="2" value=2 name="tipe">
                            <label class="form-check-label" for="2">
                                Kostum dan Makeup
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio"id="3" value=3 name="tipe">
                            <label class="form-check-label" for="3">
                                Konsumsi
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio"id="4" value=4 name="tipe">
                            <label class="form-check-label" for="4">
                                Fotografi
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" required>
                    </div>
                    <div class="form-group">
                        <label for="">Sosmed</label>
                        <input type="text" class="form-control" name="sosmed">
                    </div>
                    <div class="form-group">
                        <label for="">No. HP</label>
                        <p>+62</p><input type="text" class="form-control" name="hp" placeholder="ex. 8123456789 ">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi Event</label>
                        <!-- <input type="text" class="form-control" name="deskripsi"/> -->
                        <textarea class="form-control" id="" rows="3" name="deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <input type="file" class="form-control-file" id="" placeholder=""
                        aria-describedby="fileHelpId" name="gambar" required>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-green c-white">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

@for($i = 0; $i < count($partner); $i++)
<!--Modal IMG -->
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
            