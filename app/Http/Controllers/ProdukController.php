<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Produk;
use Termwind\Components\Span;

use Barryvdh\DomPDF\Facade\Pdf;
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all()->pluck('nama_produk', 'id_produk');

        return view('produk.index', compact('produk'));
           
    }

    public function data()
    {
        $produk = Produk::leftJoin('categories', 'categories.id_kategori', 'products.id_kategori')
        ->select('products.*', 'nama_kategori')
        ->orderBy('kode_produk', 'asc')
        ->get();

        return datatables()
        ->of($produk)
        ->addIndexColumn()
        ->addColumn('select_all', function ($produk) {
            return '
                <input type="checkbox" name="id_produk[]" value="'. $produk->id_produk .'">
            ';
        })

        ->addColumn('kode_produk', function ($produk) {
            return '<span class="label label-success">'. $produk->kode_produk .'</span>';
        })
        ->addColumn('harga_beli', function ($produk) {
            return format_uang($produk->harga_beli);
        })

        ->addColumn('harga_jual', function ($produk) {
            return format_uang($produk->harga_jual);
        })

        ->addColumn('stok', function ($produk) {
            return format_uang($produk->stok);
        })
        ->addColumn('aksi', function ($produk) {
            return '
            <div class="btn-group">
                <button type="button" onclick="editForm(`'. route('produk.update', $produk->id_produk) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                <button type="button" onclick="deleteData(`'. route('produk.destroy', $produk->id_produk) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
            </div>
            ';
        })
        ->rawColumns(['aksi', 'kode_produk', 'select_all'])
        ->make(true); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $produk = Produk::latest()->first();
        $request['kode_produk'] = 'P'. tambah_nol_didepan((int)$produk->id_produk+1, 6);
        $produk = new Produk();
        $produk->nama_produk = $request->nama_produk;
        $produk->save();
        

        return response()->json('data berhasil di simpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk = Produk::find($id);

        return response()->json($produk);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        
        $produk -> update($request->all());
        

        return response()->json('data berhasil di simpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return Response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_produk as $id) {
           $produk = Produk::find($id);
           $produk ->delete();
        }
        return Response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $dataProduk = array();
        foreach ($request->id_produk as $id) {
            $produk = Produk::find($id);
            $dataProduk[] = $produk;
        }
        $no = 1;
        $pdf = PDF::loadView('produk.barcode', compact('dataProduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('produk.pdf');
    }
}