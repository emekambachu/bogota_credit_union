<?php

namespace App\Http\Controllers;

use App\BankCharge;
use App\Transaction;
use App\Image;
use App\User;
use App\Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;

// Add for authentication to work
use Illuminate\Support\Facades\Auth;

//Add for mail class to work
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

// add for flash session
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $transactions = Transaction::where([
            ['user_id', '=', Auth::user()->id]
        ])->orderBy('updated_at', 'desc')->limit(6)->get();

        $transfers = Transfer::where([
            ['user_id', '=', Auth::user()->id]
        ])->orderBy('updated_at', 'desc')->limit(6)->get();

        return view('users.index', compact('transfers', 'transactions'));
    }

    public function accountStatementPage(){

        $transactions = Transaction::where([
            ['user_id', '=', Auth::user()->id]
        ])->orderBy('updated_at', 'desc')->get();

        return view('users.account-statement', compact('transactions'));
    }

    public function fundsTransferPage(){
        return view('users.funds-transfer');
    }

    public function startFundsTransfer(Request $request){

        //Request all fields
        $input = $request->all();
        $user = Auth::user();

        if($input['amount'] >= $user->accbal){

            Session::flash('warning', 'Insufficient Funds');
            return redirect()->back();

        }

        session()->put('recaccnum', $input['recaccnum']);
        session()->put('recaccname', $input['recaccname']);
        session()->put('recbank', $input['recbank']);
        session()->put('amt', $input['amount']);
        session()->put('select_method', $input['select_method']);
        session()->put('description', $input['description']);

        // Generate ref
        function ref($length = 8){
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = 'SFB-';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $ref = ref();

//        // Generate OTP
//        function otp($length = 4){
//            $characters = '0123456789';
//            $charactersLength = strlen($characters);
//            $randomString = 'CON';
//            for ($i = 0; $i < $length; $i++) {
//                $randomString .= $characters[rand(0, $charactersLength - 1)];
//            }
//            return $randomString;
//        }
//
//        $otp = otp();

        $fundsTransfer = Transfer::create([

            'user_id' => Auth::user()->id,
            'recbank' => $input['recbank'],
            'recaccname' => $input['recaccname'],
            'recaccnum' => $input['recaccnum'],
            'amt' => $input['amount'],
            'description' => $input['description'],
            'ref' => $ref

        ]);

//        $data = [
//            'email' => Auth::user()->email,
//            'fname' => Auth::user()->fname,
//            'lname' => Auth::user()->lname,
//            'amount' => $fundsTransfer->amt,
//            'otp' => $otp,
//        ];
//
//        Mail::send('emails.otp', $data, static function ($message) use ($data) {
//            $message->from('info@bogotacreditunion.com', 'Bogota Credit Union');
//            $message->to($data['email'], $data['fname'].' '.$data['lname'])->cc('info@bogotacreditunion.com');
//            $message->replyTo('info@bogotacreditunion.com', 'Bogota Credit Union');
//            $message->subject('Your OTP');
//        });

        return redirect('users/funds-transfer-pin/' . $fundsTransfer->id);
    }

    public function fundsTransferOtpPage($id){

        $transfer = Transfer::find($id);
        return view('users.funds-transfer-otp', compact('transfer'));
    }

    public function fundsTransferOtp(Request $request, $id){

        $otp = $request->input('otp');

        $transfer = Transfer::find($id);
        $user = Auth::user();

        if($otp !== $transfer->otp){
            Session::flash('warning', 'Incorrect OTP');
            return redirect()->back();
        }

        if(!Auth::user()->payment_status){
            Session::flash('warning', 'You are currently unable to make payments, Contact  info@bogotacreditunion.com');
            return redirect()->back();
        }

        $transfer->status = 'complete';
        $transfer->save();

        $currentBalance = $user->accbal - $transfer->amt;

        $user->accbal = $currentBalance;
        $user->save();

        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'currbal' => $currentBalance,
            'ref' => $transfer->ref,
            'description' => 'Fund Transfer of '.$transfer->amt.' From '.$user->accnum.'/'.$user->fname.' '.$user->lname.' To '.$transfer->recaccname.'/'.$transfer->recaccnum.' Reference: '.$transfer->ref,
            'debit' => $transfer->amt,
        ]);

        // current date using laravel carbon
        $now = Carbon::now();
        $time = $now->toDayDateTimeString();

        $data = [
            'name' => $user->fname.' '.$user->lname,
            'email' => $user->email,
            'accnum' => $user->accnum,
            'amt' => $transfer->amt,
            'accbal' => $user->accbal,
            'recaccname' => $transfer->recaccname,
            'recaccnum' => $transfer->recaccnum,
            'recbank' => $transfer->recbank,
            'description' => $transfer->description,
            'ref' => $transfer->ref,
            'time' => $time,
            'trans_desc' => $transaction->description,
        ];

        Mail::send('emails.fund-account', $data, static function ($message) use ($data) {
            $message->from('info@bogotacreditunion.com', 'Bogota Credit Union');
            $message->to($data['email'], $data['name'])->cc('info@bogotacreditunion.com');
            $message->replyTo('info@bogotacreditunion.com', 'Bogota Credit Union');
            $message->subject('Debit Transaction of $' . number_format($data['amt'],0) . ' to '. $data['recaccname'] . ' / ' . $data['recaccnum']);
        });

        return redirect('users/funds-transfer-complete/'.$id);
    }


    public function fundsTransferCompletePage($id){
        $transfer = Transfer::find($id);
        return view('users.funds-transfer-complete', compact('transfer'));
    }

    public function fundsTransferPinPage($id){
        $transfer = Transfer::find($id);
        return view('users.funds-transfer-pin', compact('transfer'));
    }

    public function fundsTransferPin(Request $request, $id){

        $pin = $request->input('pin');

        if( $pin !== Auth::user()->pin ){

            Session::flash('warning', 'Incorrect Pin, Try again');
            return redirect()->back();

        }

        // Generate OTP
        function otp($length = 4){
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = 'BCB';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $otp = otp();

        // save OTP to current transaction
        $transfer = Transfer::find($id);
        $transfer->otp = $otp;
        $transfer->save();

        $data = [
            'email' => Auth::user()->email,
            'fname' => Auth::user()->fname,
            'lname' => Auth::user()->lname,
            'otp' => $otp,
        ];

        Mail::send('emails.otp', $data, static function ($message) use ($data) {
            $message->from('info@bogotacreditunion.com', 'Bogota Credit Union');
            $message->to($data['email'], $data['fname'].' '.$data['lname'])->cc('info@bogotacreditunion.com');
            $message->replyTo('info@bogotacreditunion.com', 'Bogota Credit Union');
            $message->subject('Your OTP');
        });
        return redirect('users/funds-transfer-otp/' . $transfer->id);
    }

    public function airtimeBillsPage(){
        return view('users.airtime-bills');
    }

    public function loansInvestmentPage(){
        return view('users.loans-investment');
    }

    public function sportsGamingPage(){
        return view('users.sports-gaming');
    }

    public function creditCardRequestPage(){
        return view('users.credit-card-request');
    }

    public function accountSettingsPage(){
        return view('users.account-settings');
    }

    public function updateAccount(Request $request){

        //Get Image
        if($file = $request->file('image_id')){

            // Add current time in seconds to image
            $name = time() . $file->getClientOriginalName();

            //Move image to photos directory
            $file->move('photos', $name);

            //add image to database
            $photo = Image::create(['img'=>$name]);

            //assign image id to $input array
            $input['image_id'] = $photo->id;
        }

        if(!empty($request->input('password'))){
            $input['password'] = Hash::make($request->input('password'));
        }else{
            $input['password'] = Auth::user()->password;
        }

        $input['fname'] = $request->input('fname');
        $input['lname'] = $request->input('lname');
        $input['mobile'] = $request->input('mobile');
        $input['address'] = $request->input('address');
        $input['country'] = $request->input('country');
        $input['state'] = $request->input('state');
        $input['pin'] = $request->input('pin');

        User::where([
            ['id', '=', Auth::user()->id]
        ])->update($input);

        Session::flash('success', 'Your account has been updated');
        return redirect()->back();
    }
}
