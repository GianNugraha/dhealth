<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Obat;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambah');
    }

    public function create_obat()
    {
        $obat = DB::table('obatalkes_m')->get();
        $signa = DB::table('signa_m')->get();
        return view('tambah-obat', compact('obat', 'signa'));
        
    }

    public function create_resep()
    {
        $obat = DB::table('obatalkes_m')->get();
        $signa = DB::table('signa_m')->get();
        return view('tambah-resep', compact('obat', 'signa'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_obat(Request $request)
    { 
        // dd($request->all());
        $obat_id = $request->input('obat');
        $qty_obat = $request->input('jumlah_obat');
            $results = DB::select('select * from obatalkes_m where obatalkes_id = :obat_id', [
                'obat_id' => $obat_id
            ]);
            if($results[0]->stok > $qty_obat ){
                $namaobat = $request->input('nama_obat');
                $is_resep = 0;
                $user_id = session()->get('userid');
                $signa_id = $request->input('signa');

                $data=array('nama_pesanan'=>$namaobat,'is_resep'=>$is_resep,'obat_id'=>$obat_id, 'user_id'=>$user_id, 'qty_obat'=>$qty_obat, 'signa_id'=>$signa_id);
                DB::table('pesanan_m')->insert($data);
                 
                // update stok //
                $stok_update = ( $results[0]->stok - $qty_obat );
                $kurangi_stok = array('stok'=>$stok_update);
                $resultupdate = DB::table('obatalkes_m')
                                ->where('obatalkes_id', $obat_id)
                                ->update($kurangi_stok);
                //
                return redirect()->route('daftar')
                    ->with('success', 'Pembuatan Obat Berhasil !');
            }
            else{
                // return redirect()->route('daftar')
                //     ->with('error', 'Stok Obat Kurang !');
                session()->flash('error', 'Stok Obat Kurang! , Stok Tersedia untuk saat ini adalah '.$results[0]->stok);
                return redirect()->back();
            }
        // dd(session()->get('userid'));
        
    }

    public function store_resep(Request $request)
    {
        //
        $jumlah_array = count($request->input('obatalkes_id'));
        // dd($request->all());
        $nama_resep = $request->input('nama_resep');
        $signa_id = $request->input('signa_id');
        $user_id = session()->get('userid');
        // untuk cek status stok tersedia / tidak//
        $status_stok = 0;
        $arr_namaobat = array();
        for($i=0; $i<$jumlah_array; $i++){
            $results = DB::select('select * from obatalkes_m where obatalkes_id = :obat_id', [
                'obat_id' => $request->input('obatalkes_id')[$i]
            ]);
            if($results[0]->stok < $request->input('qty_obat')[$i]){
                $status_stok+=1;
                array_push($arr_namaobat, $results[0]->obatalkes_nama);
            }
        }
            if($status_stok == 0){
            // insert data parent (table pesanan) //
                $data=array('nama_pesanan'=>$nama_resep,'is_resep'=>1, 'user_id'=>$user_id, 'signa_id'=>$signa_id);
                DB::table('pesanan_m')->insert($data);
                // get id insert parent
                $id = DB::getPdo()->lastInsertId();
                // end //

                // insert data child (resep) //
                for($a=0; $a<$jumlah_array; $a++){
                    $obat_id = $request->input('obatalkes_id')[$a];
                    $pemesanan_id = $id;
                    $qty_obat = $request->input('qty_obat')[$a];
                    $data_resep=array('obat_id'=>$obat_id,'pemesanan_id'=>$pemesanan_id,'qty_obat'=>$qty_obat);
                    DB::table('resep_m')->insert($data_resep);
                    
                    $resultObat = DB::select('select * from obatalkes_m where obatalkes_id = :obat_id', [
                        'obat_id' => $obat_id
                    ]);
                    // mengurangi stok obat //
                    $stok_update = ( $resultObat[0]->stok - $qty_obat );
                    $kurangi_stok = array('stok'=>$stok_update);
                    $resultupdate = DB::table('obatalkes_m')
                                    ->where('obatalkes_id', $obat_id)
                                    ->update($kurangi_stok);
                }   
                    // end //
                return redirect()->route('daftar')
                    ->with('success', 'Pembuatan Resep Berhasil !');
            }
            else{ 
                session()->flash('error', 'Stok Obat Kurang! , Siahkan Periksa kembali inputan ');
                return redirect()->back();
            }
        // dd(session()->get('userid'));
    }

    public function getObatById($id_obat)
    {
        //
        $results = DB::select('select * from obatalkes_m where obatalkes_id = :obat_id', [
            'obat_id' => $id_obat
        ]);
    }

    public function getObat(Request $request){
        $obat = DB::table('obatalkes_m')->get();
        return view('list-obat', compact('obat'));
        // $signa = DB::table('signa_m')->get();
    }

    public function getSigna(Request $request){
        $signa = DB::table('signa_m')->get();
        return view('list-signa', compact('signa'));
        // $signa = DB::table('signa_m')->get();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get data untuk cek resep atau bukan //
        $results = DB::select('select * from pesanan_m where pesanan_id = :pesanan_id', [
            'pesanan_id' => $id
        ]);

        // jika resep
        if($results[0]->is_resep == 1){
            $detail =  Obat::select('pesanan_m.nama_pesanan','pesanan_m.pesanan_id','tu.fullname','o.obatalkes_nama as namaobat','pesanan_m.pesanan_id','s.signa_nama', 'r.qty_obat', 'r.pemesanan_id')
            ->join('signa_m as s','s.signa_id','pesanan_m.signa_id')
            ->join('tbl_user as tu','tu.id','pesanan_m.user_id')
            ->join('resep_m as r','r.pemesanan_id','pesanan_m.pesanan_id')
            ->join('obatalkes_m as o','o.obatalkes_id','r.obat_id')
            ->where('pesanan_m.pesanan_id',$id)
                ->get();
            
        }
        
        // jika bukan
        else{
            $detail = Obat::select('pesanan_m.nama_pesanan','tu.fullname','pesanan_m.pesanan_id', 'pesanan_m.is_resep','s.signa_nama', 'pesanan_m.qty_obat')
            ->join('signa_m as s','s.signa_id','pesanan_m.signa_id')
            ->join('tbl_user as tu','tu.id','pesanan_m.user_id')
            ->where('tu.id',session()->get('userid'))
            ->where('pesanan_m.pesanan_id',$id)
                // ->groupBy('pesanan_m.pesanan_id')
                ->get();
        }

        return view('details')->with('detail', $detail);
    }

    public function daftar()
    {
        $resep =  Obat::select('pesanan_m.nama_pesanan','tu.fullname','pesanan_m.pesanan_id', 'pesanan_m.is_resep','s.signa_nama', 'pesanan_m.qty_obat')
        ->join('signa_m as s','s.signa_id','pesanan_m.signa_id')
        ->join('tbl_user as tu','tu.id','pesanan_m.user_id')
        ->where('tu.id',session()->get('userid'))
            ->get();
            // dd($resep); 
    

        return view('daftar')->with('obat', $resep);

        //
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
