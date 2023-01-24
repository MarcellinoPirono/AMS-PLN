<?php

namespace App\Http\Controllers;
use App\Models\Vendor;
use App\Imports\VendorImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VendorController extends Controller
{
    public function index()
    {
        return view('khs.detail_khs.vendor_khs.vendor_khs', [
            'title' => 'Vendor KHS',
            'vendors' => Vendor::orderby('id', 'DESC')->get(),
            // 'kontrak' => Vendor::all(),
        ]);

    }

    public function create()
    {

        return view(
            'khs.detail_khs.vendor_khs.buat_vendor',
            [
                'title' => 'Buat Vendor',
                'active' => 'Vendor',
                'active1' => 'Tambah Vendor',
                // 'items' => ItemRincianInduk::all(),
            ]
        );
    }

    public function create_xlsx()
    {

        return view(
            'khs.detail_khs.vendor_khs.buat_vendor_via_excel',
            [
                'title' => 'Buat Vendor',
                'active' => 'Vendor',
                'active1' => 'Tambah Vendor',
                // 'items' => ItemRincianInduk::all(),
            ]
        );
    }
    function import(Request $request)
    {
        // dd($request);
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);

    // $file = $request->file('select_file');
    // $nama_file = rand().$file->getClientOriginalName();
    // $file->move('storage/storage/file_vendor', $nama_file);


    // $import = Excel::import(new VendorImport, public_path('/file_vendor/'.$nama_file));
    $import = Excel::import(new VendorImport, $request->file('select_file')->store('temp'));

    // Session::flash('sukses','Data Siswa Berhasil Diimport!');

    //  dd($import);

    //  dd($data);

    //  if($data->count() > 0)
    //  {
    //   foreach($data->toArray() as $key => $value)
    //   {
    //    foreach($value as $row)
    //    {
    //     $insert_data[] = array(
    //      'khs_id'  => $row['khs_id'],
    //      'kategori'   => $row['kategori'],
    //      'nama_item'   => $row['nama_item'],
    //      'satuan_id'    => $row['satuan_id'],
    //      'harga_satuan'  => $row['harga_satuan'],
    //     );
    //    }
    //   }

    //   if(!empty($insert_data))
    //   {
    //    DB::table('rincian_induks')->insert($insert_data);
    //   }
    //  }
    //  dd($insert_data);
    return redirect('/vendor-khs');
    //  return back()->with('success', 'Excel Data Imported successfully.');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([

            'nama_vendor' => 'required',
            'nama_direktur' => 'required',
            'alamat_kantor_1' => 'required',
            'alamat_kantor_2' => 'required',
            'no_rek_1' => 'required',
            'nama_bank_1' => 'required',
            'no_rek_2' => 'required',
            'nama_bank_2' => 'required',
            'npwp' => 'required|numeric',
            'npwp.required.numeric' =>'Harus Angka',

        ]);

        Vendor::create($validatedData);



    }

    public function edit($id)

    {
        $vendors = Vendor::findOrFail($id);

        $data = [
            'vendors'  => $vendors,
            'title' => 'Vendor',
            'active' => 'Vendor',
            'active1' => 'Edit Vendor',
            // 'categories' => ItemRincianInduk::orderBy('id', 'DESC')->get(),
        ];
        return view('khs.detail_khs.vendor_khs.edit_vendor', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'nama_vendor' => 'required',
            'nama_direktur' => 'required',
            'alamat_kantor_1' => 'required',
            'alamat_kantor_2' => 'required',
            'no_rek_1' => 'required',
            'nama_bank_1' => 'required',
            'no_rek_2' => 'required',
            'nama_bank_2' => 'required',
            'npwp' => 'required|numeric',

        ]);

        $vendors = Vendor::findOrFail($id);

        $input = $request->all();
        $vendors->update($input);
    }

   public function destroy(Vendor $Vendor, $id)
    {
        // dd($id);
        $Vendor = Vendor::find($id);
        $Vendor->delete();

        return response()->json([
            'success'   => true
        ]);
    }

    public function searchvendor(Request $request)
    {
        $output ="";


       $vendors = Vendor::where('nama_vendor', 'LIKE', '%'. $request->search.'%')->orWhere('nama_direktur', 'LIKE', '%' . $request->search . '%')->get();

       foreach($vendors as $vendors){
        $output.=
            '<tr>
            <input type="hidden" class="delete_id" value='. $vendors->id .'>
            <td>'. $vendors->id.'</td>
            <td>'. $vendors->nama_vendor.' </td>
            <td>'. $vendors->nama_direktur.' </td>
            <td>'. $vendors->alamat_kantor_1.' </td>
            <td>'. $vendors->alamat_kantor_2.' </td>
            <td>'. $vendors->no_rek_1. ' - ' . $vendors->nama_bank_1.' </td>
            <td>'. $vendors->no_rek_2. ' - ' . $vendors->nama_bank_2.' </td>
            <td>'. $vendors->npwp.' </td>
            <td>'. '
            <div class="d-flex">
            <a href="/vendor-khs/'.$vendors->id.'/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
            <a href="#" data-toggle="modal" data-target="#deleteModal{{ $vendor->id }}"><i class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
            '.'</td>
            </tr>';

       }

       return response($output);
    }

    public function checkVendor(Request $request) {
        $nama_vendor = $request->post('nama_vendor');
        $check_nama_vendor = Vendor::where('nama_vendor', $nama_vendor)->get();

        if(count($check_nama_vendor) > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }
}
