<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('member.index');
    }

    public function data()
    {
        $member = Member::orderBy('kode_member')->get();

        return datatables()
        ->of($member)
        ->addIndexColumn()
        ->addColumn('select_all', function ($member) {
            return '
                <input type="checkbox" name="id_member[]" value="'. $member->id_member .'">
            ';
        })
        ->addColumn('kode_member', function($member) {
            return '<span class="label label-success">'. $member->kode_member .'<span>';
        })
        ->addColumn('aksi', function ($member) {
            return '
            <div class="btn-group">
                <button type="button" onclick="editForm(`'. route('member.update', $member->id_member) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                <button type="button" onclick="deleteData(`'. route('member.destroy', $member->id_member) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
            </div>
            ';
        })
        ->rawColumns(['aksi', 'select_all', 'kode_member'])
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
        $member = Member::latest()->first();
        $kode_member = (int) $member->kode_member +1 ?? 1;


        $member = new Member();
        $member->kode_member = tambah_nol_didepan($kode_member, 5);
        $member->nama = $request->nama;
        $member->telephone = $request->telephone;
        $member->alamat = $request->alamat;
        $member->save();
        

        return response()->json('data berhasil di simpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $member = Member::find($id);

        return response()->json($member);
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
        $member = Member::find($id)->update($request->all());

        return response()->json('data berhasil di simpan', 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();

        return Response(null, 204);
    }

    public function cetakMember(Request $request)
    {
        $dataMember = collect(array());
        foreach ($request->id_member as $id) {
            $member = Member::find($id);
            $dataMember[] = $member;
        }
        $dataMember = $dataMember->chunk(2);
        $no = 1;
        $pdf = PDF::loadView('member.cetak', compact('dataMember', 'no'));
        $pdf->setPaper(array(0, 0, 566.93, 850.39), 'potrait');
        return $pdf->stream('member.pdf');
    }
}

