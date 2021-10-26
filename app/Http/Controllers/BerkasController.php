<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Jenjang;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Berkas::orderBy('id', 'DESC')->get();
        $periode = Periode::orderBy('id', 'DESC')->get();
        $jenjang = Jenjang::all();

        return view('berkas', compact('data', 'periode', 'jenjang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = request()->validate([
            'nama' => 'required',
            'nomor_ijazah' => 'required',
            'tanggal_legalisir' => 'required',
            'nama_sekolah' => 'required',
            'file_arsip' => 'required|file|mimes:pdf',
            'id_periode' => 'required',
            'id_jenjang' => 'required',
        ]);

        if ($request->hasFile('file_arsip')) {

            $file = $request->file('file_arsip');
            $lokasi = public_path('arsip');
            $name = time() . '.' . $file->getClientOriginalExtension();

            $file->move($lokasi, $name);
            $request->request->remove('file_arsip');

            $berkas = new Berkas;
            $berkas->nama = $request->nama;
            $berkas->nomor_ijazah = $request->nomor_ijazah;
            $berkas->tanggal_legalisir = $request->tanggal_legalisir;
            $berkas->nama_sekolah = $request->nama_sekolah;
            $berkas->file_arsip = $name;
            $berkas->id_periode = $request->id_periode;
            $berkas->id_jenjang = $request->id_jenjang;
            $berkas->save();
        }

        Alert::alert('Sukses', 'Data berhasil ditambahkan', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $attr = request()->validate([
            'nama' => 'required',
            'nomor_ijazah' => 'required',
            'tanggal_legalisir' => 'required',
            'nama_sekolah' => 'required',
            'id_periode' => 'required',
            'id_jenjang' => 'required',
            'file_arsip' => 'file|mimes:pdf',
        ]);

        if ($request->hasFile('file_arsip')) {

            if (File::exists(public_path('arsip/' . Berkas::find($id)->file_arsip))) {
                File::delete(public_path('arsip/' . Berkas::find($id)->file_arsip));
            }

            $file = $request->file('file_arsip');
            $lokasi = public_path('arsip');
            $name = time() . $file->getClientOriginalExtension();

            $file->move($lokasi, $name);

            $berkas = Berkas::find($id);
            $berkas->nama = $request->nama;
            $berkas->nomor_ijazah = $request->nomor_ijazah;
            $berkas->tanggal_legalisir = $request->tanggal_legalisir;
            $berkas->nama_sekolah = $request->nama_sekolah;
            $berkas->file_arsip = $name;
            $berkas->id_periode = $request->id_periode;
            $berkas->id_jenjang = $request->id_jenjang;
            $berkas->save();
        }

        $berkas = Berkas::find($id);
        $berkas->nama = $request->nama;
        $berkas->nomor_ijazah = $request->nomor_ijazah;
        $berkas->tanggal_legalisir = $request->tanggal_legalisir;
        $berkas->nama_sekolah = $request->nama_sekolah;
        $berkas->id_periode = $request->id_periode;
        $berkas->id_jenjang = $request->id_jenjang;
        $berkas->save();

        Alert::alert('Sukses', 'Data berhasil diubah', 'success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (File::exists(public_path('arsip/' . Berkas::find($id)->file_arsip))) {
            File::delete(public_path('arsip/' . Berkas::find($id)->file_arsip));
        }

        Berkas::find($id)->delete();

        Alert::alert('Sukses', 'Data berhasil dihapus', 'success');
        return back();
    }
}
