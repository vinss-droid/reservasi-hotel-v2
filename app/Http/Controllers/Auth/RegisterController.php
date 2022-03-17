<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pemesan;
use App\Providers\RouteServiceProvider;
use App\Models\User;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:255', 'unique:users,name'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'nohp' => ['required', 'min:10', 'max:13', 'unique:users,nohp'],
            ],
            [
                'name.required' => 'Nama wajib di isi!',
                'name.string' => 'Nama hanya diperbolehkan alphabet saja!',
                'email.required' => 'Email wajib di isi!',
                'email.max' => 'Maksimal email hanya 255 karakter saja.',
                'email.unique' => 'Email sudah digunakan!',
                'password.required' => 'Password wajib di isi!',
                'password.min' => 'Password minimal 6 digit!',
                'password.confirmed' => 'Password konfirmasi tidak sama!',
                'nohp.required' => 'No Handphone wajib di isi!',
                'nohp.min' => 'Minimal No.Handphone 10 digit!',
                'nohp.max' => 'Maksimal No.Handphone 13 digit!',
                'nohp.unique' => 'No.Handphone sudah digunakan!',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        Pemesan::create([
            'nama' => $data['name'],
            'nohp' => $data['nohp'],
            'email' => $data['email'],
        ]);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nohp' => $data['nohp'],
            'level' => 'pemesan',
        ]);

    }
}
