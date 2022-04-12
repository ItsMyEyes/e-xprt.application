<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Peserta;
use App\Models\PesertaTender;
use App\Models\Tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tender = Tender::all();
        return view('admin.tender.index', compact('tender'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tender.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_tender' => 'required',
            'nama_perusahaan' => 'required',
            'divis_count' => 'required'
            
        ]);

        Tender::create($request->only(['nama_tender','nama_perusahaan','divis_count']));
        Session::flash('success', 'Berhasil membuat Tender');
        return redirect()->route('tender.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function show(Tender $tender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function edit($tender)
    {
        $tender = Tender::find($tender);
        return view('admin.tender.show',compact('tender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tender)
    {
        $this->validate($request, [
            'nama_tender' => 'required',
            'nama_perusahaan' => 'required',
            'divis_count' => 'required',
            
        ]);

        Tender::find($tender)->update($request->only(['nama_tender','nama_perusahaan','divis_count','status']));
        Session::flash('success', 'Berhasil merubah Tender');
        return redirect()->route('tender.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function destroy($tender)
    {
        Tender::find($tender)->delete();
        return redirect()->route('tender.index');
    }

    public function pesertaIndex($tender)
    {
        $tender = Tender::find($tender);
        $peserta = Peserta::where('nama','like', '%'.request()->name.'%');
        if (isset(request()->no_ktp)) $peserta->where('ktp', 'like', '%'.request()->no_ktp.'%');
        if (isset(request()->tingkat_ijazah)) $peserta->whereHas('ijazah', function($q){ $q->where('tingkat', request()->tingkat_ijazah); });
        if (isset(request()->tingkat_ska)) $peserta->whereHas('ska', function($q){ $q->where('tingkat', request()->tingkat_ska); });
        $peserta = $peserta->with(['ska','ijazah'])->get();
        return view('admin.tender.tenagaAhli.index', compact('peserta','tender'));
    }

    public function pesertaShow($tender)
    {
        $tender = Tender::find($tender);
        $peserta = Peserta::all();  
        return view('admin.tender.tenagaAhli.show', compact('tender','peserta'));
    }

    public function showPeserta()
    {
        $peserta = Peserta::all();
        return view('admin.tender.tenagaAhli.showAll', compact('peserta'));
    }

    public function storeComment(Request $request)
    {
        $this->validate($request, [
            'id_peserta' => 'required',
            'text' => 'required'
        ]);
        $check = Notification::where('id_peserta', $request->id_peserta)->where('id_tender', $request->id_tender)->first();
        if (isset($check) && !is_null($check) && !empty($check)) {
            $check->update($request->only(['id_peserta','id_tender','text','status','to']));
        } else {
            $check = Notification::create($request->only(['id_peserta','id_tender','text','status','to']));
        }
        $peserta = Peserta::find($request->id_peserta);
        $type =  auth()->user()->role == 'hc' ? 'pemasaran' : 'hc';
        Session::flash('success', 'Berhasil mengirim komentar ke hc');
        Peserta::sendWebNotification("Permintaan perubahan peserta dengan nama {$peserta->nama}", $type);
        return redirect()->back();
    }

    public function choosePeserta($peserta, $tender)
    {
        $peserta = Peserta::find($peserta);
        $tender = Tender::find($tender);
        if (empty($peserta) && empty($tender)) {
            Session::flash('error','Peserta dan tender tidak ditemukan');
        }
        
        $check = PesertaTender::where([
            'id_peserta' => $peserta->id,
            'id_tender' => $tender->id
        ])->first();
        if (!empty($check)) {
            Session::flash('error','Duplicate peserta');
        } else {
            PesertaTender::create([
                'id_peserta' => $peserta->id,
                'id_tender' => $tender->id,
                'divisi' => request()->divisi
            ]);
        }
        
        Session::flash('success', 'Berhasil memilih Tenaga Ahli');
        return redirect()->route('tender.tenagaAhli.show', $tender->id);
    }

    public function unChoosePeserta($peserta, $tender)
    {
        $peserta = Peserta::find($peserta);
        $tender = Tender::find($tender);
        if (empty($peserta) && empty($tender)) {
            Session::flash('error','Peserta dan tender tidak ditemukan');
        }
        $check = PesertaTender::where([
            'id_peserta' => $peserta->id,
            'id_tender' => $tender->id
        ])->first()->delete();
        return back();
    }
}
