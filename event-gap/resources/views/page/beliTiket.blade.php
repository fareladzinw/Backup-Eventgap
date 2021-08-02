@extends('layout.baseUser')
@section('embedcss')
<link rel="stylesheet" href="{{asset('css/form.css')}}">
<style>
        @media (max-width : 425px){
            .card{
                overflow-x: scroll;
            }
        }
    </style>
@endsection
@section('content')

<div class="container">
    <div class="card bayar">
        <div class="card-body">
            <h2>Metode Pembayaran</h2>
            <h4 class="card-title">Transfer Rekening Penyelenggara Event</h4>
            @foreach($user as $user)
            <p>{{$user->nama}}</p>
            <p class="card-text">{{$user->rekening}}</p>
            @endforeach
            
        </div>
    </div>
    
    <div class="card beli">
        <div class="card-body">
            <h2>Pembelian Kamu</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tiketmu</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <?php $total = 0 ?>
                <tbody>
                @foreach($detail as $d)
                    <tr>
                        <td>{{$d->namaTiket}}</td>
                        <td>{{$d->qty}}</td>
                        <td>Rp.{{ number_format($d->harga,2,',','.') }}</td>
                    </tr>
                    <?php $total += $d->harga ?>
                @endforeach
                    <tr>
                        <th colspan="2">Biaya Administrasi</th>
                        <th>Rp. 3.000,00</th>
                    </tr>
                    <tr>
                        <th colspan="2"></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colspan="2">Total pembayaran</th>
                        <?php $total += 3000 ?>
                        <th>Rp. {{ number_format($total,2,',','.') }}</th>
                    </tr>
                </tbody>
            </table>
            
            
            <input type="hidden" name="total" value="{{$total}}">
            <form action="{{ url("/bayar-nanti/$pembayaran->id")}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('POST') }}
            <input type="hidden" name="total" value="{{$total}}">
            <input type="hidden" name="nama" value="{{$user->nama}}">
            <input type="hidden" name="rekening" value="{{$user->rekening}}">
            @foreach($detail as $k => $r)
                <input type="hidden" name="tikets[{{$k}}][namaTiket]" value="{{$r->namaTiket}}">
                <input type="hidden" name="tikets[{{$k}}][qty]" value="{{$r->qty}}">
                <input type="hidden" name="tikets[{{$k}}][harga]" value="{{$r->harga}}">
            @endforeach
            <button data-toggle="modal" data-target="#uploadBukti" class="btn btn-primary">Upload Bukti Pembayaran</button>
            <button type="submit" class="btn btn-warning float-right">Bayar nanti</button>
            </form>

        </div>
    </div>
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="uploadBukti" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Bukti pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('buyTiket',$pembayaran->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('POST') }}
                    <div class="form-group">
                    <label for="">Bukti Pembayaran</label>
                    <input type="file" class="form-control-file" id="" placeholder=""
                        aria-describedby="fileHelpId" name="buktiPembayaran">
                    <input type="hidden" name="total" value = {{$total}}>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
