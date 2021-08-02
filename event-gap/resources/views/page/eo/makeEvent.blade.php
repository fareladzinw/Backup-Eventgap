@extends('layout.baseUser')
@section('embedcss')
<link rel="stylesheet" href="{{asset('css/form.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2>Make Your Event</h2>
            <form enctype="multipart/form-data" action="{{route('postEvent')}}" method="post" >
            {{ csrf_field() }}
            {{ method_field('POST') }}
                <div class="form-group">
                    <label for="">Banner Event</label>
                    <input type="file" class="form-control-file" id="" placeholder=""
                        aria-describedby="fileHelpId" name="gambar" required>
                </div>
                <div class="form-group">
                    <label for="">Nama Event</label>
                    <input type="text" id="" class="form-control" placeholder="" aria-describedby="helpId" name="namaEvent" required>
                </div>
                <label for="">Jenis Event</label>
                <div id="setting">
                  <input type="radio" id="offline" name="view" value="offline" class="setting"> Offline<br>
                  <input type="radio" id="online" name="view" value="online" class="setting"> Online<br>
                </div>
                
                <div id="off">
                    <div class="form-group">
                        <label for="">Lokasi</label>
                        <input type="text" id="" class="form-control" placeholder="Jl.###" aria-describedby="helpId" name="lokasi">
                    </div>
                </div>
                <div id="onl">
                    <div class="form-group">
                        <label for="">Link Meeting</label>
                        <input type="text" id="" class="form-control" placeholder="https:://####.###" aria-describedby="helpId" name="link">
                    </div>
                </div>
                <style>
                  .hidden { display: none; }
                </style>
                
                <script>
                var inputs = document.getElementsByClassName('setting'),
                    setting;
                
                for (var i = 0; i < inputs.length; i++) {
                  var el = inputs[i];
                  el.addEventListener('change', function() {
                    defineSetting(this.value);
                  })
                }
                
                function defineSetting(setting) {
                  if (setting == 'offline') {
                    document.getElementById("onl").classList.add('hidden');
                    document.getElementById("off").classList.remove('hidden');
                  } else {
                    document.getElementById("onl").classList.remove('hidden');
                    document.getElementById("off").classList.add('hidden');
                  }
                }
                </script>
                <div class="form-group">
                    <label for="">Tanggal Mulai</label>
                    <input type="date" class="form-control" placeholder="mm/dd/YYYY" name="dateTimeFrom" required/>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Berakhir</label>
                    <input type="date" class="form-control" placeholder="mm/dd/YYYY"  name="dateTimeUntil"/>
                </div>
                <div class="form-group">
                    <label for="">Waktu</label>
                    <input type="text" class="form-control" name="waktu" required/>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi Event</label>
                    <!-- <input type="text" class="form-control" name="deskripsi"/> -->
                    <textarea class="form-control" id="" rows="3" name="deskripsi" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">Penyelenggara</label>
                    <input type="text" id="" class="form-control" placeholder="" aria-describedby="helpId" name="penyelenggara" required>
                    
                </div>
                <div class="form-group">
                    <label for="">Contact Person</label>
                    <input type="text" id="" class="form-control" placeholder="Ex. @contactperson" aria-describedby="helpId" name="cp" required>
                    
                <div class="form-group">
                    <label for="">Kategori Event</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="1" value=1 name="kategoriId"
                            checked>
                        <label class="form-check-label" for="1">
                            Edukasi
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"id="2" value=2 name="kategoriId">
                        <label class="form-check-label" for="2">
                            Kesehatan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="3" value=3 name="kategoriId">
                        <label class="form-check-label" for="3">
                            Olah Raga
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="4" value=4 name="kategoriId">
                        <label class="form-check-label" for="4">
                            Hiburan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="5" value=5 name="kategoriId">
                        <label class="form-check-label" for="5">
                            Lowongan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="6" value=6 name="kategoriId">
                        <label class="form-check-label" for="6">
                            Pariwisata
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Kategori Tiket</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="1"  value=0 name="isFree"
                            checked>
                        <label class="form-check-label" for="1">
                            Tiket berbayar
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="2" value=1 name="isFree">
                        <label class="form-check-label" for="2">
                            Tiket Gratis
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for=""><i class="fa fa-file-text" aria-hidden="true"></i> Proposal Event (PDF)</label>
                    <input type="file" class="form-control-file" name="proposal" id="" placeholder=""
                        aria-describedby="fileHelpId">
                </div>
                <button class="btn btn-success mt-3 float-right" type="submit" value=0 name="statusDraf">
                    Buat Event
                </button>
                <button class="btn btn-success mt-3" type="submit" value=1 name="statusDraf">
                    Draf
                </button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@section('embedjs')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endsection
@section('js')
<script>
    $(function () {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function (start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                .format('YYYY-MM-DD'));
        });
    });

</script>
@endsection
