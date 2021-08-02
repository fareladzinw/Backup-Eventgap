@extends('layout.baseUser')

@section('embedcss')
<link rel="stylesheet" href="{{asset('css/profile.css')}}">
@endsection

@section('content')
<div class="profile-banner">
    <img class="img-fluid" src="{{asset('images/profile/bannerP.png')}}"/>
</div>
<div class="container">
    @if ($message = Session::get('alert-success'))
        <div class="alert alert-success m-2" role="alert">
            {{$message}}
        </div>
    @endif
    <div class="profile">
        <div class="profile-pic">
            @foreach($user as $user)
            <img class="img-fluid w-25" src="{{!empty($user->gambar)  ? asset('event-gap/public/images/foto-profil/'.$user->gambar) : asset('event-gap/public/images/female-avatar.png')}}" alt=""
                style="border-radius : 100%;">
            <h3 class="text-center nama ml-4">{{$user->nama}}&emsp;<a href="#" data-toggle="modal"
                    data-target="#editProfile"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></h3>
        </div>
        <div class="profile-body">
            <div class="p-card">
                <div class="p-warp">
                    <div class="p-icon">
                        <img class="img-fluid" src="{{asset('images/profile/house.png')}}"/>
                    </div>
                    <div class="p-desc">
                        <h4>Alamat</h4>
                        <p>{{!empty($user->domisili) ? $user->domisili:'-'}}</p>
                    </div>
                </div>
                <div class="p-warp">
                    <div class="p-icon">
                        <img class="img-fluid" src="{{asset('images/profile/facebook.png')}}"/>
                    </div>
                    <div class="p-desc">
                        <h4>Facebook</h4>
                        <p> {{!empty($user->facebook) ? $user->facebook:'-'}}</p>
                    </div>
                </div>
                <div class="p-warp">
                    <div class="p-icon">
                        <img class="img-fluid" src="{{asset('images/profile/twitter.png')}}"/>
                    </div>
                    <div class="p-desc">
                        <h4>Twitter</h4>
                        <p> {{!empty($user->twitter) ? $user->twitter:'-'}} </p>
                    </div>
                </div>
                <div class="p-warp">
                    <div class="p-icon">
                        <img class="img-fluid" src="{{asset('images/profile/instagram.png')}}"/>
                    </div>
                    <div class="p-desc">
                        <h4>Instagram</h4>
                        <p> {{!empty($user->instagram) ? $user->instagram:'-'}}</p>
                    </div>
                </div>
                <div class="p-warp">
                    <div class="p-icon">
                        <img class="img-fluid" src="{{asset('images/profile/phone-call.png')}}"/>
                    </div>
                    <div class="p-desc">
                        <h4>No Telepon</h4>
                        <p> {{$user->hp}}</p>
                    </div>
                </div>
                <div class="p-warp">
                    <div class="p-icon">
                        <img class="" src="{{asset('images/profile/gmail.png')}}"/>
                    </div>
                    <div class="p-desc">
                        <h4>Email</h4>
                        <p> {{$user->email}}</p>
                    </div>
                </div>                
            </div>
            <br/>
            @if (Auth::user()->ktp == null)
                <h4>Upload verifikasi KTP</h4>
                <button type="button" class="btn bg-green c-white" data-toggle="modal" data-target="#uploadKTP">Upload KTP</button>
            @endif
            <br/>
            <br/>
            @endforeach
            <div class="event">
                @if (count($pembayaran) > 0)
                <h3>Pembelian Tiket</h3>
                <div class="card b-grey ds" style="border:1px solid black">
                    <div class="card-body  table-responsive">
                        <table class="table table-hover" id="pesanTiket">
                            <thead>
                                <tr>
                                    <th scope="col">Event</th>
                                    <th scope="col">Tiket</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tujuan Transfer</th>
                                    <th scope="col">Bukti Pembayaran</th>
                                    <th scope="col">Upload</th>
                                    <th scope="col">Batalkan</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaran as $k => $pembayaran)
                                        <tr>
                                            <td>{{$pembayaran->namaEvent}}</td>
                                            <td><a href = "#" data-toggle="modal" data-target="#pembayaran{{$k}}">Detail Tiket</a></td>
                                            <td>Rp.{{ number_format($pembayaran->total,2,',','.') }}</td>
                                            <td>
                                                @if ($pembayaran->status == 0)
                                                    Belum Dibayar
                                                @elseif($pembayaran->status == 1)
                                                    Menunggu Korfirmasi
                                                @else
                                                    Sudah Dibayar
                                                @endif
                                            </td>
                                            <td>{{$pembayaran->rekening}}</td>
                                                @if ($pembayaran->status == 0)
                                            <td>
                                            <form action="{{ url("/upload-bukti/$pembayaran->id")}}" method="POST" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <input type="file" name="buktiPembayaran">
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-warning">Upload</button>
                                            </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('batalPembayaran',$pembayaran->id)}}" method="POST" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                            <button class="btn btn-danger" type="submit">Batal pesan</button>
                                            </form>
                                            </td>
                                            @else
                                            <td colspan="2">
                                               <button type="button" class="btn bg-green ds-green c-white disabled">Sudah Dibayar</button>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
                <br/>
                @endif
                @if (count($pembelian) > 0)
                <h3>Pembelian Tiket pada Event Anda</h3>
                <div class="card b-grey ds" style="border:1px solid black">
                    <div class="card-body table-responsive">
                        <table class="table table-hover" id="beliTiket">
                            <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Tiket</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembelian as $k => $pembelian)
                                        <tr>
                                            <td>{{$pembelian->namaEvent}}</td>
                                            <td><a href = "#" data-toggle="modal" data-target="#pembelian{{$k}}">Detail Tiket</a></td>
                                            <td>Rp.{{ number_format($pembelian->total,2,',','.') }}</td>
                                            <td>
                                                @if ($pembelian->status == 0)
                                                    Belum Dibayar
                                                @elseif($pembelian->status == 1)
                                                    Menunggu Korfirmasi
                                                @else
                                                    Sudah Dibayar
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
                <br/>
                @endif
                @if(count($draf) > 0)
                <h3>Draft Event Saya</h3>
                <div class="grid m-">
                    @foreach($draf as $draf)
                    <div class="card m-2" id="new" style="width: 18rem; display: inline-block">
                        <img class="card-img-top" src="{{ asset('event-gap/public/images/event/'.$draf->gambar)}}" alt="Card image cap" height="200px";>
                        <div class="card-body">
                            <h5 class="card-title">{{$draf ->namaEvent}}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($draf->deskripsi, 60, '...') }}</p>
                            <a href="{{ url('event/'.$draf->id)}}" class="btn btn-primary">Lihat..</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <br/>
                @endif
                @if(count($event) > 0)
                <br/>
                <h3>Event Saya</h3>
                <div class="grid m-">
                    @foreach($event as $event)
                    <div class="card m-2" id="new" style="width: 18rem; display: inline-block">
                        <img class="card-img-top" src="{{ asset('event-gap/public/images/event/'.$event->gambar)}}" alt="Card image cap" height="200px";>
                        <div class="card-body">
                            <h5 class="card-title">{{$event ->namaEvent}}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($event->deskripsi, 60, '...') }}</p>
                            <a href="{{ url('event/'.$event->id)}}" class="btn btn-primary">Lihat..</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            <br>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-circle-o" aria-hidden="true"></i> &emsp;Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('updateUser') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('POST') }}
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{$user->nama}}">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="">Domisili</label>
                        <input type="text" class="form-control" name="domisili" value="{{$user->domisili}}">
                    </div>
                    <div class="form-group">
                        <label for="">Facebook</label>
                        <input type="text" class="form-control" name="facebook" value="{{$user->facebook}}">
                    </div>
                    <div class="form-group">
                        <label for="">Twitter</label>
                        <input type="text" class="form-control" name="twitter" value="{{$user->twitter}}">
                    </div>
                    <div class="form-group">
                        <label for="">Instagram</label>
                        <input type="text" class="form-control" name="instagram" value="{{$user->instagram}}">
                    </div>
                    <div class="form-group">
                        <label for="">No. HP</label>
                        <input type="text" class="form-control" name="hp" value="{{$user->hp}}">
                    </div>
                    <div class="form-group">
                        <label for="">Rekening</label>
                        <input type="text" class="form-control" name="rekening" value="{{$user->rekening}}" placeholder="ex. BCA - 123456789">
                    </div>
                    <div class="form-group">
                    <label for="">Foto</label>
                    <input type="file" class="form-control-file" id="" placeholder=""
                        aria-describedby="fileHelpId" name="gambar">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-green ds-green c-white">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal KTP -->
@if (Auth::user()->ktp == null)

<div class="modal fade" id="uploadKTP" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi KTP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('postKtp') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('POST') }}
                    <div class="form-group">
                    <label for="">Foto KTP</label>
                    <input type="file" class="form-control-file" id="" placeholder=""
                        aria-describedby="fileHelpId" name="ktp">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-green ds-green c-white">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

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
                        <td>Rp.{{ number_format($d->harga,2,',','.')}}</td>
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

@foreach($detail2 as $k => $detail2)
<div class="modal fade" id="pembelian{{$k}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <th scope="col">Nama Pembeli</th>
                    <th scope="col">Nama Tiket</th>
                    <th scope="col">qty</th>
                    <th scope="col">harga</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($detail2 as $d)
                    <tr>
                        <td>{{$d->nama}}</td>
                        <td>{{$d->namaTiket}}</td>
                        <td>{{$d->qty}}</td>
                        <td>Rp.{{ number_format($d->harga,2,',','.')}}</td>
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

@section('js')
<script>
$(document).ready(function() {
    $('#beliTiket').DataTable();
    $('#pesanTiket').DataTable();
} );
</script>
@endsection
