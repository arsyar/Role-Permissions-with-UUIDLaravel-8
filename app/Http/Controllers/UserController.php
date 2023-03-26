<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Exception;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name','asc')->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::pluck('name','name')->all();
        return view('users.create',compact('role'));
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
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
        try{
            DB::beginTransaction();
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
    
            $user = User::create($input);
            $user->assignRole($request->input('roles'));
            DB::commit(); 
        }catch(Exception $e){
            DB::rollback();
        }
        return redirect()->route('users.index')->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //variabel
         $users = User::find($id);
         $role = Role::pluck('name','name')->all();
         //validasi keberadaan data
         if (empty($users)) {
             return back()->with('error', 'Data tidak ditemukan');
         }
         
         return view('users.show', compact('users','role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        $role = Role::pluck('name', 'name')->all();
        $userRole = $users->roles->pluck('name','name')->all();
        if (empty($users)) {
            return back()->with('error', 'Data tidak ditemukan');
        }
        return view('users.edit', compact('users', 'role','userRole'));
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
            'name' => 'required|unique:users,name,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        try{
            DB::beginTransaction();
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            }else{
                $input = Arr::except($input,array('password'));
            }
            $user = User::find($id);
            $user->update($input);
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request->input('roles'));
            DB::commit();

            return redirect()->route('users.index')->with('success', 'Data berhasil diperbaharui');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', 'Data gagal diproses');
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
        try{
            DB::beginTransaction();
            $user = User::find($id)->delete();
            DB::commit();
            return back()->with('success', 'Data berhasil dihapus');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error', 'Data gagal diproses');
        }
    }
}
