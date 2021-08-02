<?php
 namespace App\Http\Controllers;
 use Illuminate\Http\Request;
 // Panggil SendMail yang telah dibuat
 use App\Mail\SendMail;
 // Panggil support email dari Laravel
 use Illuminate\Support\Facades\Mail;
 use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    public function index(Request $req)
    {
        $nama = $req->nama;
        $tikets = $req->tikets;
        $event = $req->event;
        $email = $req->email;
        $link = $req->link;
        $kirim = Mail::to($email)->send(new SendMail($nama, $tikets, $event,$link));
        $id = $req->id;

        DB::table('pembayarans')->where('id',$id)->update([
            'status' => 2
        ]);

        $detail = DB::table('detail_pembayarans')->where('pembayaranId',$id)->get();

        foreach ($detail as $key => $d) {

            $tiket = DB::table('tikets')->where('id',$d->tiketId)->first();

            $qty = $tiket->qty - $d->qty;

            if($qty >= 0){
                DB::table('tikets')->where('id',$d->tiketId)->update([
                    'qty' => $qty
                ]);
            }else{
                return response()->json([
                    'code' => 300,
                    'status' => 'Jumlah tiket tidak mencukupi'
                ]);
            }

        }

        return response()->json([
            'code' => 200,
            'status' => 'Berhasil kirim email'
        ]);
     }
}
