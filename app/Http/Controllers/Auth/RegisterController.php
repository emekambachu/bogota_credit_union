<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\http\Request;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = RouteServiceProvider::REGISTRATIONCOMPLETE;

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
            'fname' => ['required', 'string', 'max:20'],
            'lname' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
            'mobile' => ['nullable', 'min:7', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'pin' => ['required', 'digits:4'],
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
        // Generate Account Number
        function generateAccNum($length = 7) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '394';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $data['accnum'] = generateAccNum();

        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'pin' => $data['pin'],
            'password' => Hash::make($data['password']),
            'password_backup' => $data['password'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'state' => $data['state'],
            'country' => $data['country'],
            'acctype' => $data['acctype'],
            'accnum' => $data['accnum'],
        ]);

        Mail::send('emails.registration', $data, static function ($message) use ($data) {
            $message->from('info@bogotacreditunion.com', 'Bogota Credit Union');
            $message->to($data['email'], $data['fname'].' '.$data['lname'])->cc('info@bogotacreditunion.com');
            $message->replyTo('info@bogotacreditunion.com', 'Bogota Credit Union');
            $message->subject('Registration Complete');
        });

//        $account_sid = getenv("TWILIO_SID");
//        $auth_token = getenv("TWILIO_AUTH_TOKEN");
//        $twilio_number = getenv("TWILIO_NUMBER");
//        $client = new Client($account_sid, $auth_token);
//        $client->messages->create($data['mobile'], ['from' => $twilio_number, 'body' => 'Your Bank Registration has been successfully registered']);

//        // Text message that will be sent to multiple numbers:
//        $message = 'Hello World!';
//
//// Array of mobile phone numbers (starting with the "+" sign and country code):
//        $recipients = ['+2348062201831'];
//
//// Send (broadcast) the $message to $recipients:
//        SmsTo::setMessage($message)
//            ->setRecipients($recipients)
//            ->sendMultiple();
//
//        // add name and email to session
//        session()->put('fname', $data['fname']);
//        session()->put('lname', $data['lname']);

//        Nexmo::message()->send([
//            'to'   => $user->mobile,
//            'from' => '+2348159822416',
//            'text' => $user->email
//        ]);

        return $user;
    }
}
