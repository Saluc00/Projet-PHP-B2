<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\profile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
<<<<<<< HEAD
            'password' => ['required', 'string', 'min:8', 'confirmed'],
=======
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'role' => ['required', 'string'],
            'pseudo' => ['required', 'string'],
            'nom' => ['required', 'string'],
            'prenom' => ['required', 'string'],
            'age' => ['required'],
            'phone' => ['required']
>>>>>>> master
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {
<<<<<<< HEAD
        return User::create([
            'name' => $data['name'],
=======
        var_dump($data);
        echo request();
        $user = User::create([
>>>>>>> master
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        $user->assignRole($data['role']);

        Profile::create([
            'pseudo' => $data['pseudo'],
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'age' => $data['age'],
            'telephone' => $data['phone'],
            'user_id' => $user->id
        ]);
        return $user;
    }


}
