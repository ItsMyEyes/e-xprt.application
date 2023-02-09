<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Peserta;
use App\Models\Tender;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class PesertaController extends Controller
{

    protected function upload_ijazah(Request $request, Peserta $peserta)
    {
        if ($request->hasfile('file_ijazah')) {
            foreach ($request->file('file_ijazah') as $key => $file) {
                $nama_filez = md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                $file->move(base_path('../public_html/images/'), $nama_filez);
                $path =  "/images/" . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                \App\Models\Ijazah::create([
                    'id_peserta' => $peserta->id,
                    'nama' => $request->name_ijazah[$key],
                    'file' => $path,
                    'tahun_lulus' => $request->tahun_lulus[$key],
                    'tingkat' => $request->tingkat[$key]
                ]);
            }
        }

        if ($request->hasfile('file_ska')) {
            foreach ($request->file('file_ska') as $keyz => $file_ska) {
                $nama_filez_ska = md5($file_ska->getClientOriginalName()) . '.' . $file_ska->getClientOriginalExtension();
                $file_ska->move(base_path('../public_html/images/'), $nama_filez_ska);
                $path_ska =  "/images/" . md5($file_ska->getClientOriginalName()) . '.' . $file_ska->getClientOriginalExtension();
                \App\Models\Ska::create([
                    'id_peserta' => $peserta->id,
                    'file' => $path_ska,
                    'nama' => $request->name_ska[$keyz] ?? '-',
                    'tingkat' => $request->tingkat_ska[$keyz],
                    'berlaku' => $request->berlaku[$keyz],
                    'klasifikasi' => $request->klasifikasi[$keyz],
                ]);
            }
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peserta = Peserta::where('nama', 'like', '%' . request()->name . '%');
        if (isset(request()->kualifikasi)) $peserta->whereHas('kualifikasi', function ($q) {
            $q->where('kualifikasi', 'like', '%' . request()->kualifikasi . '%');
        });
        if (isset(request()->tingkat_ijazah)) $peserta->whereHas('ijazah', function ($q) {
            $q->where('tingkat', 'like', '%' . request()->tingkat_ijazah . '%');
        });
        if (isset(request()->kode_ska)) $peserta->whereHas('ska', function ($q) {
            $q->where('nama', 'like', '%' . request()->kode_ska . '%');
        });
        $peserta = $peserta->with(['ska', 'ijazah'])->get();
        return view('admin.tenagaAhli.index', compact('peserta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tenagaAhli.create');
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
            'name' => 'required',
            'no_ktp' => 'required'
        ]);

        $peserta = Peserta::create([
            'nama' => $request->name,
            'ktp' => $request->no_ktp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tgl_lahir,
            'tanggal_masuk_kerja' => $request->tgl_masuk_kerja,
        ]);
        $this->upload_ijazah($request, $peserta);
        Session::flash('success', 'Berhasil menambahkan Tenaga Ahli');

        return redirect()->route('tenagaAhli.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function show($peserta)
    {
        $peserta = Peserta::find($peserta);
        return view('admin.tenagaAhli.detail', compact('peserta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function edit($peserta)
    {
        $peserta = Peserta::with(['ijazah', 'ska'])->find($peserta);
        $lastIdIj = $lastIdSka = 0;
        $key = 0;
        if (!empty($peserta->ijazah)) foreach ($peserta->ijazah as $key => $ijazh) $lastIdIj = $key;
        if (!empty($peserta->ska)) foreach ($peserta->ska as $key => $ska) $lastIdSka = $key;
        return view('admin.tenagaAhli.show', compact('peserta', 'lastIdIj', 'lastIdSka'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $peserta)
    {
        $this->validate($request, [
            'name' => 'required',
            'no_ktp' => 'required'
        ]);

        $peserta = Peserta::find($peserta);
        $this->upload_ijazah($request, $peserta);
        foreach ($peserta->ijazah as $ij) {
            $path = $ij->file;
            if ($request->hasfile('file_ijazah_' . $ij->id)) {
                $file = $request->file('file_ijazah_' . $ij->id);
                $nama_filez = md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                $file->move(base_path('../public_html/images/'), $nama_filez);
                $path =  "/images/" . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            }
            if (!is_null($request->get("name_ijazah_$ij->id"))) {
                \App\Models\Ijazah::find($ij->id)->update([
                    'id_peserta' => $peserta->id,
                    'nama' => $request->get("name_ijazah_$ij->id"),
                    'file' => $path,
                    'tahun_lulus' => $request->get("tahun_lulus_$ij->id"),
                    'tingkat' => $request->get("tingkat_$ij->id")
                ]);
            }
        }

        foreach ($peserta->ska as $sk) {
            $path_ska = $sk->file;
            if ($request->hasfile('file_ska_' . $sk->id)) {
                $file_ska = $request->file('file_ska_' . $sk->id);
                $nama_filez_ska = md5($file_ska->getClientOriginalName()) . '.' . $file_ska->getClientOriginalExtension();
                $file_ska->move(base_path('../public_html/images/'), $nama_filez_ska);
                $path_ska =  "/images/" . md5($file_ska->getClientOriginalName()) . '.' . $file_ska->getClientOriginalExtension();
            }
            \App\Models\Ska::find($sk->id)->update([
                'id_peserta' => $peserta->id,
                'file' => $path_ska,
                'nama' => $request->get("name_ska_$sk->id"),
                'tingkat' => $request->get("tingkat_ska_$sk->id"),
                'berlaku' => $request->get("berlaku_$sk->id"),
                'klasifikasi' => $request->get("klasifikasi_$sk->id"),
            ]);
        }
        $peserta->update([
            'nama' => $request->name,
            'ktp' => $request->no_ktp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tgl_lahir,
            'tanggal_masuk_kerja' => $request->tgl_masuk_kerja,
        ]);
        Session::flash('success', 'Berhasil merubah Tenaga Ahli');
        return redirect()->route('tenagaAhli.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function destroy($peserta)
    {
        $peserta = Peserta::find($peserta);
        $peserta->delete();
        return redirect()->route('tenagaAhli.index');
    }

    public function changetStatusNotifi($id)
    {
        $notif = Notification::find($id);

        $type =  auth()->user()->role == 'hc' ? 'pemasaran' : 'hc';
        $peserta = Peserta::find($notif->id_peserta);
        $tender = Tender::find($notif->id_tender);

        Peserta::sendWebNotification("Update peserta dengan nama {$peserta->nama} pada tender {$tender->nama_tender}", $type);

        $notif->update([
            'status' => 'clear'
        ]);

        Notification::create([
            'id_peserta' => $notif->id_peserta,
            'text' => 'update peserta tender silahkan dicheck lagi',
            'id_tender' => $notif->id_tender,
            'to' => 'pemasaran'
        ]);

        Session::flash('success', 'Berhasil mengubah status');
        return back();
    }

    public function deleteFile($id)
    {
        if (request()->type == 'ijazah') {
            \App\Models\Ijazah::find($id)->delete();
        }
        if (request()->type == 'ska') {
            \App\Models\Ska::find($id)->delete();
        }
        return back();
    }

    public function exportPeserta($id)
    {
        $tender = Tender::find($id);
        return Excel::download(new \App\Exports\UsersExport($id), $tender->nama_tender . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        // $tender = Tender::find($id);
        // $pesertas = $tender->peserta;
        // return view('export', compact('pesertas'));
    }
}
