<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SaveUserRequest;

class UserController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('statusUser');
        $this->middleware('roles');
        $this->middleware('CheckGeneralData');
        $this->middleware('officeIsSelected');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::latest()->get();
        return view('user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $role = role::latest()->get();
        return view('user.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveUserRequest $request)
    {   
        if($request->validated()['confirm_password'] == $request->validated()['password']):
           
            User::create([
                'name' => $request->validated()['name'],
                'email' => $request->validated()['email'],
                'role' => $request->validated()['role'],
                'password' => Hash::make($request->validated()['password']),
                'status' => true
                
            ]);
            return redirect()->route('user.index')->with('status','Usuario creado correctamente');
        else:
            
            return back()->with('error','Las contraseñas no coinciden');
        endif;
        
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
    public function edit(User $user)
    {
        $role = Role::latest()->get();
        return view('user.edit',[
            'role' => $role,
            'user' => $user
        ]);
    }

    public function password (Request $request,User $user){
       $request = $request->validate([
            'password' => 'required'
        ]);
        
       // return Hash::make($request['password']);
        $user->update([
            'password' => Hash::make($request['password'])
        ]);

        return redirect()->route('user.index')->with('status','contraseña actualizada exitosamente');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ]);
        
         $user->update($fields);

        return redirect()->route('user.index')->with('status','El usuario fue actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return true;
       // return redirect()->route('user.index')->with('status','El usuario fue eliminado correctamente');
    }

    public function status(Request $request,User $user){
        
      
        $user->status = !$user->status;
        $user->save();
        return true;
        // return redirect()->route('user.index')->with('status','Usuario actualizado correctamente');
    }
}
