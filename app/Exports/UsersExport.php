<?php

namespace App\Exports;

use App\Models\Peserta;
use App\Models\Tender;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    protected $id;

    function __construct($id = null)
    {
        $this->id = $id;
    }


    public function view(): View
    {
        $tender = Tender::find($this->id);
        $pesertas = $tender->peserta;
        return view('export', compact('pesertas'));
    }
}
