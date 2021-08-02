@extends('layout.baseUser')
@section('embedcss')
<link rel="stylesheet" href="{{asset('css/form.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<style>
    .loader {
    position: absolute;
    z-index: 3;
    top: 20%;
    right: 50%;
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
    display: none;
    }

    /* Safari */
    @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
    @media (max-width : 425px){
        .card{
            overflow-x: scroll;
        }
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="card">
        <div class="loader" id="loader"></div>
        <div class="card-body">
            <h2>Table Ticket Approvement</h2>
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Email Pembeli</th>
                    <th scope="col">Tiket</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Bukti Pembayaran</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($pembayaran as $k=>$pembayaran)
                    <tr>
                            <td>{{$pembayaran->email}}</td>
                            <td><a href = "#" data-toggle="modal" data-target="#pembayaran{{$k}}">Detail Tiket</a></td>
                            <td>Rp.{{ number_format($pembayaran->total,2,',','.') }}</td>
                            <form action="{{route('downloadBuktiPembayaran',$pembayaran->id)}}" method="post">
                            {{csrf_field()}}
                            <td><button type="submit" class="btn btn-block btn-primary">download</button></td>
                            </form>
                            <td>
                                <button class="btn btn-info" onclick="sendMail('{{$pembayaran->username}}',{{$detail[$k]}},'{{$pembayaran->email}}','{{$pembayaran->namaEvent}}','{{$pembayaran->id}}','{{$pembayaran->link}}')">Accept</button>
                                <a class="btn btn-danger" href={{"/decline-pembayaran/$pembayaran->id"}} onclick="return confirm('Yakin Menolak pembayaran?')" style="color : white">Decline</a>
                            </td>
                          </tr>
                @endforeach
                </tbody>
              </table>
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
    function sendMail(name,tikets,email,event,id,link) {

        document.getElementById("loader").style.display = "block";
        confirm('Yakin accept tiket dan kirim tiket kepada user?');

        // console.log(tikets);

        var base_url = window.location.origin;

        $.post(base_url + "/api/post-mail",
            {
            'nama' : name,
            'tikets' : tikets,
            'email' : email,
            'event' : event,
            'id' : id,
            'link' : link
            },
            function(data,status){
                alert(data.status);
                location.reload();
            });
    }
</script>
@endsection

@section('modal')
<!-- Modal -->
@foreach($detail as $k => $detail)
<div class="modal fade" id="pembayaran{{$k}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Tiket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Nama Tiket</th>
                    <th scope="col">qty</th>
                    <th scope="col">harga</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($detail as $d)
                    <tr>
                        <td>{{$d->namaTiket}}</td>
                        <td>{{$d->qty}}</td>
                        <td>Rp.{{ number_format($d->harga,2,',','.') }}</td>
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

