@extends('layout.baseAdmin')

@section('embedcss')
<link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
@endsection

@section('content')
<div class="container event">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Event Partner</h5>
        </div>
        <div class="modal-body">
                @foreach($partner as $partner)
            <form action="{{ route('editPartner',$partner->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('POST') }}
                    <div class="form-group">
                        <label for="">Nama Partner</label>
                        <input type="text" class="form-control" name="nama_partner" value="{{$partner->nama_partner}}"required>
                    </div>
                    <div class="form-group" required>
                    <label for="">Tipe Partner</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="1" value=1 name="tipe">
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
                        <input type="text" class="form-control" name="lokasi" value="{{$partner->lokasi}}"required>
                    </div>
                    <div class="form-group">
                        <label for="">Sosmed</label>
                        <input type="text" class="form-control" name="sosmed" value="{{$partner->sosmed}}">
                    </div>
                    <div class="form-group">
                        <label for="">No. HP</label>
                        <p>+62</p><input type="text" class="form-control" name="hp" value="{{$partner->hp}}">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi Event</label>
                        <!-- <input type="text" class="form-control" name="deskripsi"/> -->
                        <textarea class="form-control" id="" rows="3" name="deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <input type="file" class="form-control-file" id="" placeholder=""
                        aria-describedby="fileHelpId" name="gambar" value = "{{$partner->gambar}}"required>
                    </div>
                </div>
                <div class="modal-footer">
                <a href="{{ url('/admin-page/dashboard')}}"><button type="button" class="btn btn-secondary">Close</button></a>
                <button type="submit" class="btn btn-warning">Edit Data</button>
            </form>
            @endforeach
        </div>
</div>
@endsection
