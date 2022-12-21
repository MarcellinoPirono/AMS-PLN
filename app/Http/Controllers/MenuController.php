<?php

namespace App\Http\Controllers;

use App\Models\Khs;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function MenuItemKHS()
    {

        return view('khs.detail_khs.item_khs.menu_item_khs', [
            'title' => 'Pilih Menu Item KHS',
            'title1' => 'Item KHS',
            'jenis_khs' => Khs::all(),

        ]);
    }

    public function PaketPekerjaan()
    {

        return view('paket-pekerjaan.menu', [
            'title' => 'Pilih Menu Paket Pekerjaan KHS',
            'title1' => 'Paket Pekerjaan KHS',
            'jenis_khs' => Khs::all(),

        ]);
    }


}
