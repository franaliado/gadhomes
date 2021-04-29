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
    public function index(Request $request)
    {
        $query = trim($request->get('search'));

        $users = User::where('name', 'LIKE', '%'.$query.'%')
        ->orWhere('username', 'LIKE', '%'.$query.'%')
        ->orderBy('name', 'ASC')
        ->paginate(10);
        return view('users.index')->with(['users' => $users]);
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
           'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
           'password' => ['required', 'string', 'min:8', 'confirmed'],
       ]);
   }

   protected function validatoredit(array $data)
   {
       return Validator::make($data, [
           'name' => ['required', 'string', 'max:255'],
           'username' => ['required', 'string', 'max:15'],
           'position' => ['required', 'string', 'max:50'],
           'role' => ['required', 'integer'],
           'phone' => ['required', 'string', 'max:15'],
           'email' => ['required', 'string', 'email', 'max:100'],
           'active' => ['required', 'integer'],
       ]);
   }

   protected function validatorpass(array $data)
   {
       return Validator::make($data, [
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
        return redirect('/users')->with(['success' => 'User successfully registered']);

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
        $user = User::findOrFail($id);
        return view("users.edit")->with(['user' => $user]);
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
        $this->validatoredit($request->all())->validate();

        DB::beginTransaction();
        try {

          $user = User::find($id);
          $user->name = $request->name;
          $user->username = $request->username;
          $user->position = $request->position;
          $user->role = $request->role;
          $user->phone = $request->phone;
          $user->email = $request->email;
          $user->active = $request->active;
          $user->save();
  
          DB::commit();
          return redirect('/users')->with(['success' => 'User edited successfully']);
  
        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function reset($id)
    {

        DB::beginTransaction();
        try {

          $user = User::find($id);
          $user->password = "$2y$10$.CbFRU7FP0S3.ozoY7mAIemmT.K81oXoaXRYTsvLLsYINFAz8EyHC";
          $user->save();
  
          DB::commit();

          return redirect('/users')->with(['success' => 'Password reset successfully']);
  
        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
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
        //
    }


    public function password()
    {
        return view("users.password");
    }

    public function passwordchange(Request $request, $id)
    {
        $this->validatorpass($request->all())->validate();

        DB::beginTransaction();
        try {
            $user = User::find($id);
            $oldpassword = $user->password;
            $actualpassword = Hash::make($request->actualpassword); 
            if (Hash::check($request->actualpassword, $user->password))
            {
                if (Hash::check($request->password, $user->password))
                {
                    return redirect('/users/password')->with(['error' => 'New password is the same as the old password']);
                }else{
                    $user->password = bcrypt($request->password);
                    $user->save();
                    DB::commit();
                    return redirect('/users/password')->with(['success' => 'Password changed successfully']);
                }
            }else{
                return redirect('/users/password')->with(['error' => 'Incorrect current password']);
            }

        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
