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

    public function MenuAddendum()
    {

        return view('khs.detail_khs.item_khs.menu_addendum_khs', [
            'title' => 'Pilih Menu Addendum KHS',
            'title1' => 'Addendum KHS',
            'rabs' => Khs::orderBy('id', 'DESC')->get(),

        ]);
    }
    
}
