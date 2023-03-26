<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();

        return view('permissions.index',compact('permissions'));
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
        $permissions = Permission::find($id);
        if (Empty($permissions)) {
            return back()->with('error', 'Data tidak ditemukan');
        }
        return view('permissions.edit', compact('permissions'));
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
        $permissions= Permission::find($id);
        if (empty($permissions)) {
            return back()->with('error', 'Data tidak ditemukan');
        }
        $permissions->delete();
        return back()->with('success', 'Data berhasil di hapus');
    }
}
