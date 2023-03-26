<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Exception;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
    
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
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
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        try{
            DB::beginTransaction();
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));
            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Role berhasil ditambahkan');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', 'Data tidak dapat diproses');
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
        $roles = Role::find($id);
        //validasi
        if (empty($roles)) {
            return back()->with('error', 'Data tidak ditemukan');
        }
        return view('roles.show',compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::get();
        $roles = Role::find($id);
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();
        //validasi
        if (empty($roles)) {
            return back()->with('error', 'Data tidak ditemukan');
        }
        return view('roles.edit',compact('roles','permission','rolePermissions'));
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
            'name' => 'required',
            'permission' => 'required',
        ]);
        try{
            DB::beginTransaction();
            //proses
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();
            $role->syncPermissions($request->input('permission'));
            DB::commit();
            // feedback
            return redirect()->route('roles.index')->with('succes', 'Data berhasil diubah');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', 'Data gagal diperbaharui');
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
        //validasi
        if (empty($id)) {
            return back()->with('error', 'Data tidak ditemukan');
        }
        DB::table("roles")->where('id',$id)->delete();
        return back()->with('success', 'Data data berhasil dihapus');
    }
}
