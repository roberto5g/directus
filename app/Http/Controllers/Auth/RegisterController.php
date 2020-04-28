<?php

namespace App\Http\Controllers\Auth;

use App\Mail\SendMailUser;
use App\User;
use App\Models\TipoUsuario;
use App\Models\Admin\DadosAdmins;
use App\Models\Admin\PermissoesAdmins;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

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
    protected $redirectTo = '/';

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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('pages.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = User::count();

        if ($user == 0) {
            $usuario = User::create([
                'nome' => inicialMaiuscula($data['nome']),
                'email' => strtolower($data['email']),
                'password' => bcrypt($data['password']),
                'om_id' => 1,
                'tipo' => "administrador",
            ]);

        } else {
            $usuario = User::create([
                'nome' => $data['nome'],
                'email' => strtolower($data['email']),
                'password' => bcrypt($data['password']),
                'om_id' =>  $data['om_id'],
                'tipo' => "usuario",
            ]);
        }

        return $usuario;

    }
}
