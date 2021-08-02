@extends('layout.baseUser')
@section('embedcss')
<link rel="stylesheet" href="{{asset('css/form.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2>Detail Tiket</h2>
            <form enctype="multipart/form-data" action="{{ route('postTiket',$idEvent) }}" method="post" >
            {{ csrf_field() }}
            {{ method_field('POST') }}
                <div class="form-group">
                    <label for="">Nama Tiket</label>
                    <input type="text" name="namaTiket" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                </div>
                <div class="form-group">
                    <label for="">Jumlah Tiket</label>
                    <input type="number" name="qty" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                </div>
                @foreach($event as $event)
                <div class="form-group">
                    <label for="">Tanggal Mulai</label>
                    <input type="date" class="form-control" placeholder="{{date('m-d-Y', strtotime($event->dateTimeFrom))}}" name="dateTimeFrom" required/>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Berakhir</label>
                    <input type="date" class="form-control" placeholder = "{{date('m-d-Y', strtotime($event->dateTimeFrom))}}" name="dateTimeUntil"/>
                </div>
                @endforeach
                <div class="form-group">
                    <label for="">Deskripsi Tiket</label>
                    <textarea class="form-control" name="deskripsi" id="" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">Harga Tiket</label>
                    <input type="text" name="harga" id="" class="form-control" placeholder="Dalam Rupiah" aria-describedby="helpId" required>
                </div>
                <div class="form-group">
                    <label for="">Banner Tiket</label>
                    <input type="file" class="form-control-file" id="" placeholder=""
                        aria-describedby="fileHelpId" name="gambar" required>
                </div>
                <button class="btn btn-success mt-3 float-right" type="submit">
                    Buat Tiket
                </button>
            </form>
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
