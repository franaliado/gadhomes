<?php

namespace App\Http\Controllers;

use DB;
use App\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
    }

    /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator(array $data)
   {
       return Validator::make($data, [
           'name' => ['required', 'string', 'max:255'],
           'username' => ['required', 'string', 'max:15', 'unique:users'],
           'position' => ['required', 'string', 'max:50'],
           'role' => ['required', 'integer'],
           'phone' => ['required', 'string', 'max:15'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
           'password' => ['required', 'string', 'min:8', 'confirmed'],
       ]);
   }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

      $this->validator($request->all())->validate();

      DB::beginTransaction();
      try {

        $data = array(
          'name' => $request->name,
          'username' => $request->username,
          'position' => $request->position,
          'role' => $request->role,
          'phone' => $request->phone,
          'email' => $request->email,
          'password' => bcrypt($request->password)
        );

        User::create($data);
        // User::where('id', $request->id)->update($data);

        DB::commit();
        return redirect('/home')->with(['success' => 'User successfully registered']);

      }catch (\Exception $e) {
        DB::rollback();
        return view('users.create')->with(['error' => $e->getMessage()]);
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
        //
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