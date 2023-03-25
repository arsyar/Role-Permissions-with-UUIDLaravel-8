<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;
use Exception;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $value = Permission::all();
        return view('permissions.index', compact('value'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
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
            'addMoreInputFields.*.name' => 'required|unique:permissions,name'
        ]);

        try{
            DB::beginTransaction();
            foreach ($request->addMoreInputFields as $key => $value){
                Permission::create($value);
            }
            DB::commit();
            return back()->with('success', 'Permission Berhasil ditambahkan');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', 'Data gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $value = Permission::find($id);
        if (Empty($value)) {
            return back()->with('error', 'Data tidak ditemukan');
        }
        return view('permissions.show', compact('value'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $value = Permission::find($id);
        if (Empty($value)) {
            return back()->with('error', 'Data tidak ditemukan');
        }
        return view('permissions.edit', compact('value'));
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
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);
        $input = $request->all();
        try{
            DB::beginTransaction();
            $permission = Permission::find($id);
            $permission->update($input);
            DB::commit();

            return redirect()->route('permissions.index')->with('success', 'Permission berhasil diubah');
        }catch(Exception $e){
            Db::rollBack();
            return back()->with('error', 'Permission gagal diproses');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = Permission::find($id);
        if (empty($value)) {
            return back()->with('error', 'Data tidak ditemukan');
        }
        $value->delete();
        return back()->with('success', 'Data berhasil di hapus');
    }
}
