<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $admin = Admin::orderBy('created_at','ASC')->paginate(5);
        return view('admin.admin.index',compact('admin', 'search'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email|unique:admin,email,',
            'phone'=>'required|unique:admin,phone,',
            'password'=>'required',
            'confirm_password'=>'required|same:password',
        ],[
            'email.email'=>'Email không đúng định dạng',
            'email.required'=>'Email không được để trống',
            'password.required'=>'Password không được để trống',
        ]);

        $password = Hash::make($request->password);
        $request->merge(['password' => $password]);
        if(Admin::create($request->all())){
            return redirect()->route('admin.index')->with('success','Create success');
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
        $admin = Admin::find($id);
        return view('admin.admin.edit',compact('admin'));
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
        $admin = Admin::find($id);
        $this->validate($request,[
            Rule::unique('admin','email')->ignore($admin),
            Rule::unique('admin','phone')->ignore($admin),
            'email'=>'required|email',
        ]);
        
        $admin->update($request->only('name','email','phone','birthday','image','status','gender','role'));
        return redirect()->route('admin.index')->with('success','Update success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
