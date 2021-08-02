<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tiket;
use App\Models\Pembayaran;
use App\Models\DetailPembayaran;
use App\Models\DaftarEvent;
use App\Models\Kategori;
use App\Helper\Responses;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


 // Panggil SendMail yang telah dibuat
 use App\Mail\NotifMail;
 use App\Mail\DeclineMail;
 // Panggil support email dari Laravel
 use Illuminate\Support\Facades\Mail;

 use Illuminate\Support\Str;

class UserController extends Controller
{
    //CONTROLLER UPLOAD GAMBAR
    // $image = $request->file('file');
    //     $target = '/public/images';
    //     $image->move(\base_path() . $target, $image->getClientOriginalName());

    public function indexDashboard(){
        $event = DaftarEvent::get()->where('statusDraf','=',0)->sortByDesc('id')->take(3);

        return view('page.dashboard')->with(['event'=>$event]);
    }
    public function indexKategori($idKategori){
        $event = DaftarEvent::where('kategoriId',$idKategori)->where('statusDraf','=',0)->get();
        $kategori = Kategori::where('id',$idKategori)->get();

        return view('page.sponsor.event')->with(['event'=>$event,'kategori'=>$kategori]);
    }

    public function indexDetailEvent($id){
        $event = DaftarEvent::where('daftar_events.id',$id)->get();
        $tiket = Tiket::where('eventId',$id)->get();
        $eventUserId = DaftarEvent::where('daftar_events.id',$id)->first('eventUserId')->eventUserId;
        $userId = Auth::user()->id;

        $isFree = DaftarEvent::where('daftar_events.id',$id)->first()->isFree;

        return view('page.sponsor.detailEvent')->with(['event'=>$event,'tiket'=>$tiket,'eventUserId' => $eventUserId,'userId' => $userId,'isFree' => $isFree]);
    }
    
    public function search(Request $request){
        $query = $request->get('query');
        
        $event = daftarEvent::where('statusDraf','=',0)->where('namaEvent','like','%'.$query.'%')
            ->get();
        
        if(count($event) > 0)
            return view('page.search')->with(['event'=>$event,'query'=>$query]);
        else 
            return redirect()->back()->with('alert-fail', 'Tidak dapat menemukan event yang anda cari, coba cari event yang lain!');
    }

    public function indexMakeEvent(){
        return view('page.eo.makeEvent');
    }

    public function postMakeEvent(Request $request)
    {
        $this->validate($request, [
            'namaEvent' => 'required',
            'deskripsi' => 'required',
            'kategoriId' => 'required',
            'dateTimeFrom' => 'required',
            'penyelenggara' => 'required',
            'gambar' => 'required',
            'cp' => 'required'
        ]);

        $event             = new DaftarEvent;
        $event->eventUserId = Auth::user()->id;
        $event->sponsorUserId = null;
        $event->namaEvent = $request->namaEvent;
        $event->deskripsi = $request->deskripsi;
        $event->lokasi = $request->lokasi;
        $event->kategoriId = $request->kategoriId;
        $event->dateTimeFrom = Carbon::parse($request->dateTimeFrom);
        if(!empty($request->dateTimeUntil)){
            $event->dateTimeUntil = Carbon::parse($request->dateTimeUntil);
        }
        $event->waktu = $request->waktu;
        $event->statusSponsor = 0;
        $event->isFree = $request->isFree;
        $event->statusDraf = $request->statusDraf;
        $event->cp = $request->cp;
        $event->penyelenggara = $request->penyelenggara;
        $event->link = $request->link;
        if(!empty($request->gambar)) {
            $image = $request->file('gambar');
            $target = '/public/images/event';
            $filenameImage = $image->getFilename().'.'.$image->getClientOriginalExtension();
            $image->move(\base_path() . $target, $filenameImage);
            $event->gambar = $filenameImage;
        }
        if(!empty($request->proposal)) {
            $proposal = $request->file('proposal');
            $target = '/public/images/proposal';
            $filename = $proposal->getFilename().'.'.$proposal->getClientOriginalExtension();
            $proposal->move(\base_path() . $target, $filename);
            $event->proposal = $filename;
        }
        $event->save();

        return redirect('/my-profile')->with('alert-success', 'Event telah dibuat');
    }

    public function indexMyProfile(){
        $userId = Auth::user()->id;

        $user = User::where('id',$userId)->get();
        $event = DaftarEvent::where('eventUserId',Auth::user()->id)->where('statusDraf','=',0)->get();
        $draf = DaftarEvent::where('eventUserId',Auth::user()->id)->where('statusDraf','=',1)->get();

        $pembayaran = DB::table('pembayarans')
                        ->where('userId',$userId)
                        ->join('daftar_events','daftar_events.id','=','pembayarans.eventId')
                        ->join('users','users.id','=','daftar_events.eventUserId')
                        ->get(['pembayarans.id','daftar_events.namaEvent', 'pembayarans.total', 'pembayarans.status','users.rekening']);
        $datas = array();
        foreach($pembayaran as $p){

        $detail = DB::table('detail_pembayarans')->join('tikets','tikets.id','=','detail_pembayarans.tiketId')->join('pembayarans','pembayarans.id','=','detail_pembayarans.pembayaranId')
                    ->join('daftar_events','daftar_events.id','=','pembayarans.eventId')->join('users','users.id','=','daftar_events.eventUserId')
                    ->where('pembayaranId',$p->id)
                    ->get(['detail_pembayarans.pembayaranId','tikets.namaTiket','detail_pembayarans.qty','detail_pembayarans.harga','users.rekening']);

                    array_push($datas, $detail);
        };
        $pembelian = DB::table('pembayarans')
                        ->join('daftar_events','daftar_events.id','=','pembayarans.eventId')
                        ->where('daftar_events.eventUserId','=',$userId)
                        ->get(['pembayarans.id','daftar_events.namaEvent', 'pembayarans.total', 'pembayarans.status']);
        
        $datas2 = array();
        foreach($pembelian as $p){

        $detail2 = DB::table('detail_pembayarans')->join('tikets','tikets.id','=','detail_pembayarans.tiketId')->join('pembayarans','pembayarans.id','=','detail_pembayarans.pembayaranId')->join('users','users.id','=','pembayarans.userId')
                    ->where('detail_pembayarans.pembayaranId','=',$p->id)
                    ->get(['users.nama','detail_pembayarans.pembayaranId','tikets.namaTiket','detail_pembayarans.qty','detail_pembayarans.harga']);
                    array_push($datas2, $detail2);
        };

        return view('page.profile')->with(['user'=>$user,'event'=>$event,'draf'=>$draf,'detail'=>$datas, 'pembayaran' => $pembayaran,'detail2'=>$datas2, 'pembelian' => $pembelian]);
    }

    public function indexMakeTiket(Request $request, $idEvent){
        $event = DaftarEvent::where('daftar_events.id',$idEvent)->get();

        return view('page.eo.makeTicket')->with(['idEvent' => $idEvent,'event' => $event]);
    }

    public function postMakeTiket(Request $request, $idEvent){
        $this->validate($request, [
            'namaTiket' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'qty' => 'required',
            'dateTimeFrom' => 'required',
            'gambar' => 'required'
        ]);

        $tiket             = new Tiket;
        $tiket->eventId = $idEvent;
        $tiket->namaTiket = $request->namaTiket;
        $tiket->deskripsi = $request->deskripsi;
        $tiket->harga = $request->harga;
        $tiket->qty = $request->qty;
        $tiket->dateTimeFrom = Carbon::parse($request->dateTimeFrom);
        if(!empty($tiket->dateTimeUntil)) {
            $tiket->dateTimeUntil = Carbon::parse($request->dateTimeUntil);
        }
        if(!empty($request->gambar)) {
            $image = $request->file('gambar');
            $target = '/public/images/tiket';
            $filenameImage = $image->getFilename().'.'.$image->getClientOriginalExtension();
            $image->move(\base_path() . $target, $filenameImage);
            $tiket->gambar = $filenameImage;
        }
        $tiket->save();

        return redirect('/my-profile')->with('alert-success', 'Tiket telah dibuat');
    }

    public function indexSponsor($idEvent){
        $event = DaftarEvent::where('daftar_events.id',$idEvent)->join('users','users.id','=','daftar_events.eventUserId')->get([
            'daftar_events.gambar','daftar_events.proposal','users.hp','daftar_events.id','daftar_events.namaEvent'
        ]);
        $eventUserId = DaftarEvent::where('id',$idEvent)->first('eventUserId');
        $proposal = DaftarEvent::where('id',$idEvent)->first('proposal');
        return view('page.sponsor.sponsori')->with(['event'=>$event,'proposal'=>$proposal]);
    }


    public function downloadProposal($idEvent){
        $filename = DaftarEvent::where('id',$idEvent)->first();
        $target = '/public/images/proposal/';
        $filepath = public_path('/images/proposal/').$filename->proposal;

        return response()->download($filepath);
        return redirect('/my-profile');
    }

    public function updateUser(Request $request){
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'hp' => 'required',
        ]);

        $user = User::find(Auth::user()->id);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->domisili = $request->domisili;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->instagram = $request->instagram;
        $user->hp = $request->hp;
        $user->rekening = $request->rekening;
        if(!empty($request->gambar)) {
            $image = $request->file('gambar');
            $target = '/public/images/foto-profil';
            $filenameImage = $image->getFilename().'.'.$image->getClientOriginalExtension();
            $image->move(\base_path() . $target, $filenameImage);
            $user->gambar = $filenameImage;
        }
        $user->save();

        return redirect('/my-profile')->with('alert-success', 'Berhasil edit Data');
    }
    
    public function postKtp(Request $request){
        $this->validate($request, [
            'ktp' => 'required',
        ]);
        
        $user = User::find(Auth::user()->id);
        if(!empty($request->ktp)) {
            $image = $request->file('ktp');
            $target = '/public/images/ktp';
            $filenameImage = $image->getFilename().'.'.$image->getClientOriginalExtension();
            $image->move(\base_path() . $target, $filenameImage);
            $user->ktp = $filenameImage;
        }
        $user->status_validasi = 0;
        $user->save();

        return redirect('/my-profile')->with('alert-success', 'Berhasil upload KTP, tunggu diverifikasi admin');
    }

    public function updateEvent(Request $request,$id){
        $this->validate($request, [
            'namaEvent' => 'required',
            'penyelenggara' => 'required',
            'cp' => 'required'
        ]);

        $event             = DaftarEvent::find($id);
        $event->eventUserId = Auth::user()->id;
        $event->sponsorUserId = null;
        $event->namaEvent = $request->namaEvent;
        if(!empty($request->deskripsi)){
            $event->deskripsi = $request->deskripsi;
        }
        $event->waktu = $request->waktu;
        $event->lokasi = $request->lokasi;
        if(!empty($request->dateTimeFrom)){
            $event->dateTimeFrom = Carbon::parse($request->dateTimeFrom);
        }
        if(!empty($request->dateTimeUntil)){
            $event->dateTimeUntil = Carbon::parse($request->dateTimeUntil);
        }
        $event->statusSponsor = 0;
        $event->cp = $request->cp;
        $event->penyelenggara = $request->penyelenggara;
        $event->link = $request->link;
        if(!empty($request->gambar)) {
            $image = $request->file('gambar');
            $target = '/public/images/event';
            $filenameImage = $image->getFilename().'.'.$image->getClientOriginalExtension();
            $image->move(\base_path() . $target, $filenameImage);
            $event->gambar = $filenameImage;
        }
        if(!empty($request->proposal)) {
            $proposal = $request->file('proposal');
            $target = '/public/images/proposal';
            $filename = $proposal->getFilename().'.'.$proposal->getClientOriginalExtension();
            $proposal->move(\base_path() . $target, $filename);
            $event->proposal = $filename;
        }
        $event->save();

        return redirect('/my-profile')->with('alert-success', 'Berhasil edit Event');
    }

    public function deleteEvent ($id){
        
        $pembayaranId = DB::table('pembayarans')->where('eventId','=',$id)->get();
        
        if(!empty($pembayaranId)){
            foreach($pembayaranId as $p){
                if(!empty($detail = DetailPembayaran::where('pembayaranId',$p->id))){
                $detail->delete();
            };     
            }
        };
        if(!empty($pembayaran = Pembayaran::where('eventId',$id))){
            $pembayaran->delete();
        };
        if (!empty($tiket = Tiket::where('eventId',$id))){
            $tiket->delete();
        };
        $event = DaftarEvent::find($id);
        $event->delete();

        return redirect('/my-profile')->with('alert-success', 'Berhasil Menghapus Event');
    }

    public function deleteTiket ($id){
        $tiket = Tiket::find($id);
        $tiket->delete();

        return redirect()->back()->with('alert-success', 'Berhasil Menghapus Tiket');
    }
    
    public function unDraf ($id){
        $event = DaftarEvent::find($id);
        $event->statusDraf = 0;
        $event->save();

        return redirect('/my-profile')->with('alert-success', 'Berhasil Memposting Event');
    }

    public function indexBuyTiket($pembayaranId){
        $pembayaran = Pembayaran::where('id',$pembayaranId)->first();
        $detail = DetailPembayaran::where('pembayaranId',$pembayaran->id)->rightJoin('tikets','tikets.id','=','detail_pembayarans.tiketId')
        ->get(['tikets.namaTiket','detail_pembayarans.qty','detail_pembayarans.harga']);

        $details = DetailPembayaran::where('pembayaranId',$pembayaran->id)->first();
        $tiket = Tiket::where('id',$details->tiketId)->first();
        $event = DaftarEvent::where('id',$tiket->eventId)->first();
        $user = User::where('id',$event->eventUserId)->get();

        return view('page.beliTiket')->with(['pembayaran'=> $pembayaran,'detail'=>$detail,'user'=>$user]);
    }

    public function postBuyTiket(Request $request, $idPembayaran){
        $pembayaran = Pembayaran::find($idPembayaran);
        $image = $request->file('buktiPembayaran');
        $target = '/public/images/bukti-pembayaran';
        $filenameImage = $image->getFilename().'.'.$image->getClientOriginalExtension();
        $image->move(\base_path() . $target, $filenameImage);
        $pembayaran->buktiPembayaran = $filenameImage;
        $pembayaran->total = $request->total;
        $pembayaran->status = 1;
        $pembayaran->save();

        return redirect('/my-profile')->with('alert-success', 'Tunggu Tiket Dikirim Ke Emailmu, jika dalam waktu 2 hari tidak ada konfirmasi, hubungi penyelenggara event');
    }

    public function postBuktiBayar(Request $request, $idPembayaran)
    {
        $this->validate($request, [
            'buktiPembayaran' => 'required',
        ]);

        $pembayaran = Pembayaran::find($idPembayaran);
        $image = $request->file('buktiPembayaran');
        $target = '/public/images/bukti-pembayaran';
        $filenameImage = $image->getFilename().'.'.$image->getClientOriginalExtension();
        $image->move(\base_path() . $target, $filenameImage);
        $pembayaran->buktiPembayaran = $filenameImage;
        $pembayaran->status = 1;
        $pembayaran->save();

        return redirect('/my-profile')->with('alert-success', 'Tunggu Tiket Dikirim Ke Emailmu, jika dalam waktu 2 hari tidak ada konfirmasi, hubungi penyelenggara event');
    }

    public function postPembayaran(Request $request, $idEvent){

        $pembayaran             = new Pembayaran;
        $pembayaran->userId = Auth::user()->id;
        $pembayaran->eventId = $idEvent;
        $pembayaran->total = 0;
        $pembayaran->buktiPembayaran = null;
        $pembayaran->status = 0;
        $pembayaran->save();

        $datas = array();
        for($i=0; $i < count($request->tiketId); $i++){

            $data =[
                "pembayaranId" =>  $pembayaran->id,
                "tiketId" => $request->tiketId[$i],
                "harga" => $request->harga[$i] * $request->qty[$i],
                "qty" => $request->qty[$i],
                "status" => 0
            ];
            array_push($datas, $data);
        }

        $detail = DetailPembayaran::insert($datas);

        return redirect('/buy-tiket/'.$pembayaran->id);

    }

    public function indexTable($idEvent){
        $pembayaran = DB::table('pembayarans')
                    ->where('eventId',$idEvent)
                    ->where('buktiPembayaran','!=',null)
                    ->where('status',1)
                    ->join('users','users.id','=','pembayarans.userId')
                    ->join('daftar_events','daftar_events.id','=','pembayarans.eventId')
                    ->get(['pembayarans.id','users.email','users.username','pembayarans.buktiPembayaran','pembayarans.status','pembayarans.total','daftar_events.namaEvent','daftar_events.link','daftar_events.lokasi']);


        $datas = array();
        foreach($pembayaran as $p){

        $detail = DB::table('detail_pembayarans')->join('tikets','tikets.id','=','detail_pembayarans.tiketId')
                    ->where('pembayaranId',$p->id)
                    ->get(['detail_pembayarans.pembayaranId','tikets.namaTiket','detail_pembayarans.qty','detail_pembayarans.harga']);

                    array_push($datas, $detail);
        };

        // dd($datas);
        return view('page.eo.accTicket')->with(['pembayaran'=> $pembayaran,'detail'=>$datas]);
    }

    public function downloadBuktiPembayaran($idPembayaran){
        $filename = Pembayaran::where('id',$idPembayaran)->first();
        $filepath = public_path('/images/bukti-pembayaran/').$filename->buktiPembayaran;

        return response()->download($filepath);;
    }

     public function bayarNanti(Request $req, $idPembayaran)
    {
        
        $email = Auth::user()->email;
        
        //dd($email);
        
        $pembayaran = Pembayaran::find($idPembayaran);

        $pembayaran->total = $req->total;
        $pembayaran->save();
        
        //sendNotifMail
        $nama_rekening = $req->nama;
        $rekening = $req->rekening;
        $tikets = $req->tikets;
        $total = $req->total;
        
        $idEvent = $pembayaran->eventId;
        $event = DaftarEvent::where('id',$idEvent)->first();
        $namaEvent = $event->namaEvent;
        
        
        
        $kirim = Mail::to($email)->send(new NotifMail($nama_rekening, $rekening, $tikets, $namaEvent, $total));
        
        return redirect('/my-profile')->with(['alert-success' => 'Silahkan bayar tiket sebelum event dimulai']);
    }

    public function deletePembayaranA($id)
    {
        $pembayaran = DB::table('pembayarans')->where('id', $id)->first();
        $id_user = $pembayaran->userId;
        $user = DB::table('users')->where('id', $id_user)->first();
        $email = $user->email;
        //dd($user->email);
        
        DB::table('detail_pembayarans')->where('pembayaranId',$id)->delete();
        DB::table('pembayarans')->where('id', $id)->delete();
        
        $kirim = Mail::to($email)->send(new DeclineMail());
        
        return redirect('/my-profile')->with(['alert-success' => 'Berhasil menolak pembayaran']);
    }

    public function deletePembayaranU($id)
    {
        DB::table('detail_pembayarans')->where('pembayaranId',$id)->delete();
        DB::table('pembayarans')->where('id', $id)->delete();

        return redirect('/my-profile')->with(['alert-success' => 'Berhasil membatalkan pembayaran']);
    }
    
    
    public function indexPartner($idTipe){
        $partner = DB::table('event_partners')->where('tipe','=',$idTipe)->get();
        return view('page.eventPartner')->with(['partner' => $partner]);
    }
    
    
    //ADMIN
    
    public function indexDashboardAdmin(){
        $partner = DB::table('event_partners')->get();

        return view('page.Admin.dashboard')->with(['partner' => $partner]);
    }

    public function indexUpdatePartner($id){
        $partner = DB::table('event_partners')->where('id','=',$id)->get();

        return view('page.Admin.indexUpdate')->with(['partner' => $partner]);
    }
    
    public function postMakePartner(Request $request)
    {
        $this->validate($request, [
            'nama_partner' => 'required',
            'tipe' => 'required',
            'lokasi' => 'required',
            'gambar' => 'required'
        ]);

        $image = $request->file('gambar');
        $target = '/public/images/event-partner';
        $filenameImage = $image->getFilename().'.'.$image->getClientOriginalExtension();
        $image->move(\base_path() . $target, $filenameImage);
        
        DB::table('event_partners')->insert([
    		'nama_partner' => $request->nama_partner,
    		'tipe' => $request->tipe,
    		'lokasi' => $request->lokasi,
    		'hp' => $request->hp,
    		'sosmed' => $request->sosmed,
    		'deskripsi' => $request->deskripsi,
    		'gambar' => $filenameImage
	    ]);
	    
	        

        return redirect('/admin-page/dashboard')->with('alert-success', 'Event Partner telah dibuat');
    }
    
    public function updatePartner(Request $request, $id){
        $this->validate($request, [
            'nama_partner' => 'required',
            'tipe' => 'required',
            'lokasi' => 'required',
            'gambar' => 'required'
        ]);

        $image = $request->file('gambar');
        $target = '/public/images/event-partner';
        $filenameImage = $image->getFilename().'.'.$image->getClientOriginalExtension();
        $image->move(\base_path() . $target, $filenameImage);
        
        DB::table('event_partners')->where('id',$id)->update([
    		'nama_partner' => $request->nama_partner,
    		'tipe' => $request->tipe,
    		'lokasi' => $request->lokasi,
    		'hp' => $request->hp,
    		'sosmed' => $request->sosmed,
    		'deskripsi' => $request->deskripsi,
    		'gambar' => $filenameImage
	    ]);

        return redirect('/admin-page/dashboard')->with('alert-success', 'Event Partner berhasil Diedit');
    }
    
    public function deletePartner($id){
        
        DB::table('event_partners')->where('id',$id)->delete();

        return redirect('/admin-page/dashboard')->with('alert-success', 'Event Partner berhasil Dihapus');
    }
    
    public function indexVerifikasiUser(){
        $user = DB::table('users')->where('ktp','!=','null')->where('status_validasi','!=','1')->get();

        return view('page.Admin.dashboardVerifikasi')->with(['user' => $user]);
    }
    
    public function rejectKtp(Request $request, $idUser){
        
        $user = User::find($idUser);
        $user->ktp = null;
        $user->status_validasi = 2;
        $user->save();

        return redirect('/admin-page/dashboard')->with('alert-success', 'Berhasil reject verifikasi User');
    }
    
    public function acceptKtp(Request $request, $idUser){
        
        $user = User::find($idUser);
        $user->status_validasi = 1;
        $user->save();

        return redirect('/admin-page/dashboard')->with('alert-success', 'Berhasil accept verifikasi User');
    }
}
