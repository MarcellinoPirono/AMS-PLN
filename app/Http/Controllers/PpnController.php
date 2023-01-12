<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpnModel;


class PpnController extends Controller
{

    public function index()
    {
        $ppn = Ppnmodel::select('ppn')->value('ppn');
        return view('pages.ppn', [
            'title' => 'Setting PPN',
            'ppn' => $ppn,
        ]);
    }

    public function edit(Ppnmodel $Ppnmodel, $ppn)
    {
        // dd($ppn);
        $ppn = Ppnmodel::where('ppn', $ppn)->value('ppn');

        return response()->json([
            'result' => $ppn,
        ]);
    }

    public function update(Request $request)
    {


        // dd($request);
        $ppn = (float)$request->ppn;

        $request->validate([


            'ppn' => 'required',

        ]);
        $Ppnmodel = Ppnmodel::where('ppn', $request->old_ppn)->get();
        $Ppnmodel[0]->ppn = $ppn;
        $Ppnmodel[0]->update();

        // $Ppnmodel = Ppnmodel::findOrFail($id);

        // $input = $request->ppn;
        // // dd($input);
        // $Ppnmodel->update();

        return response()->json(['success' => true]);

    }


}
