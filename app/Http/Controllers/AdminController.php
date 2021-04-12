<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

use App\Transaction;
use App\Transfer;
use App\User;
use Carbon\Carbon;

// Add for authentication to work
use Illuminate\Support\Facades\Auth;

//Add for mail class to work
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

// add for flash session
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){

        $countUsers = User::where([
            ['is_active', '=', 1],
            ['id', '<>', Auth::user()->id],
        ])->count();

        $transactions = Transaction::orderBy('created_at', 'desc')->limit(10)->get();
        $transfers = Transfer::orderBy('created_at', 'desc')->limit(10)->get();
        $users = User::where([
            ['id', '<>', Auth::user()->id]
        ])->orderBy('id', 'desc')->limit(10)->get();

        return view('admin.index', compact('transactions', 'users', 'transfers', 'countUsers'));

    }

    public function manageUsersPage(){

        $users = User::where([
            ['id', '<>', Auth::user()->id]
        ])->orderBy('created_at', 'desc')->get();

        return view('admin.manage-users', compact('users'));
    }

    public function verifyUser(Request $request, $id){
        // $userId = $request->input('user_id');

        $user = User::find($id);

        if($user->is_active){
            $user->is_active = 0;
            $status = 'Sorry, Your Account Has Been Deactivated';
            Session::flash('warning', $user->fname.' has been deactivated');

        }else{
            $user->is_active = 1;
            $status = 'Congratulations, Your Account Has Been Activated';
            Session::flash('success', $user->fname.' has been activated');
        }
        $user->save();

        $data = [
            'name' => $user->fname.' '.$user->lname,
            'email' => $user->email,
            'status' => $status,
        ];

        Mail::send('emails.verify-account', $data, static function ($message) use ($data) {
            $message->from('info@bogotacreditunion.com', 'Bogota Credit Union');
            $message->to($data['email'], $data['name'])->cc('info@bogotacreditunion.com');
            $message->replyTo('info@bogotacreditunion.com', 'Bogota Credit Union');
            $message->subject($data['status']);
        });

        return redirect()->back();
    }

    public function deleteUser(Request $request, $id){

        // $id = $request->input('user_id');

        $user = User::find($id);

        // Check if image record exists in table
        // Check if file exists
        if($user->image && File::exists(public_path() . '/photos/' . $user->image->img)) {
            FILE::delete(public_path() . '/photos/' . $user->image->img);
//                unlink(public_path() . '/photos/' . $user->image->img);
            $user->delete();
        } else{
            $user->delete();
        }

        //flash notification
        Session::flash('warning', 'Deleted');
        return redirect()->back();
    }

    public function fundUserPage($id){

        $user = User::find($id);
        return view('admin.fund-user', compact('user'));
    }

    public function fundUser(Request $request, $id){

        $amt = $request->input('amt');
        $sendAccName = $request->input('sendaccname');
        $sendAccNum = $request->input('sendaccnum');
        $sendBank = $request->input('sendbank');
        $description = $request->input('description');

        // current date using laravel carbon
        $now = Carbon::now();
        $time = $now->toDayDateTimeString();

        $user = User::find($id);

        $user->accbal += $amt;
        $user->save();

        //Generate Ref
        function ref($length = 8){
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = 'OBB-';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $ref = ref();

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'currbal' => $user->accbal,
            'ref' => $ref,
            'description' => 'Fund Transfer of '.$amt.' From '.$sendAccNum.'/'.$sendAccName.' To '.$user->fname.' '.$user->lname.'/'.$user->accnum.' Reference: '.$ref,
            'credit' => $amt,
        ]);

        $data = [
            'name' => $user->fname.' '.$user->lname,
            'email' => $user->email,
            'accnum' => $user->accnum,
            'amt' => $amt,
            'accbal' => $user->accbal,
            'sendaccname' => $sendAccName,
            'sendaccnum' => $sendAccNum,
            'sendbank' => $sendBank,
            'description' => $description,
            'ref' => $ref,
            'time' => $time,
            'trans_desc' => $transaction->description,
        ];

        Mail::send('emails.fund-account', $data, static function ($message) use ($data) {
            $message->from('info@bogotacreditunion.com', 'Bogota Credit Union');
            $message->to($data['email'], $data['name'])->cc('info@bogotacreditunion.com');
            $message->replyTo('info@bogotacreditunion.com', 'Bogota Credit Union');
            $message->subject('Credit Transfer of $' . number_format($data['amt'],0) . ' from '. $data['sendaccname'] . ' / ' . $data['sendaccnum']);
        });

        Session::flash('success', $user->fname.' account has been funded with $'.$amt);
        return redirect()->back();
    }

    public function fundWithdrawalPage($id){

        $user = User::find($id);
        return view('admin.fund-withdrawal', compact('user'));
    }

    public function fundWithdrawal(Request $request, $id){

        $amt = $request->input('amt');
        $recAccName = $request->input('recaccname');
        $recAccNum = $request->input('recaccnum');
        $recBank = $request->input('recbank');
        $description = $request->input('description');

        // current date using laravel carbon
        $now = Carbon::now();
        $time = $now->toDayDateTimeString();

        $user = User::find($id);

        if($amt >= $user->accbal){
            Session::flash('warning', 'Insufficient Funds');
            return redirect()->back();
        }

        $user->accbal -= $amt;
        $user->save();

        //Generate Ref
        function ref($length = 8){
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = 'OBB-';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $ref = ref();

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'currbal' => $user->accbal,
            'ref' => $ref,
            'description' => 'Fund Transfer of '.$amt.' to '.$recAccNum.'/'.$recAccName.' From '.$user->fname.' '.$user->lname.'/'.$user->accnum.' Reference: '.$ref,
            'debit' => $amt,
        ]);

        $data = [
            'name' => $user->fname.' '.$user->lname,
            'email' => $user->email,
            'accnum' => $user->accnum,
            'amt' => $amt,
            'accbal' => $user->accbal,
            'recaccname' => $recAccName,
            'recaccnum' => $recAccNum,
            'recbank' => $recBank,
            'description' => $description,
            'ref' => $ref,
            'time' => $time,
            'trans_desc' => $transaction->description,
        ];

        Mail::send('emails.funds-transfer', $data, static function ($message) use ($data) {
            $message->from('info@bogotacreditunion.com', 'Bogota Credit Union');
            $message->to($data['email'], $data['name'])->cc('info@bogotacreditunion.com');
            $message->replyTo('info@bogotacreditunion.com', 'Bogota Credit Union');
            $message->subject('Debit Transfer of $' . number_format($data['amt'],0) . ' to '. $data['recaccname'] . ' / ' . $data['recaccnum']);
        });

        Session::flash('success', $user->fname.' account has been debited with $'.$amt);
        return redirect()->back();
    }

    public function blockTransfer(Request $request, $id){

        $user = User::find($id);

        if($user->payment_status){
            $user->payment_status = False;
            Session::flash('warning', 'Payment has been deactivated for '.$user->fname);

        }else{
            $user->payment_status = True;
            Session::flash('success', 'Payment has been activated for '.$user->fname);
        }

        $user->save();

        return redirect()->back();
    }

    public function changeDatePage($id){

        $transaction = Transaction::find($id);
        return view('admin.change-date', compact('transaction'));
    }

    public function changeDate(Request $request, $id){

        $date = $request->input('date');

        $transaction = Transaction::find($id);

        $transaction->created_at = date('Y-m-d H:i:s', strtotime($date));

        $transaction->save();

        Session::flash('success', 'Transaction date has been changed to '.$transaction->created_at);
        return redirect()->back();
    }

    public function fundTransfersPage(){

        $transfers = Transfer::orderBy('created_at', 'desc')->get();

        return view('admin.fund-transfers', compact('transfers'));
    }

    public function allTransactionsPage(){

        $transactions = Transaction::orderBy('created_at', 'desc')->get();

        return view('admin.all-transactions', compact('transactions'));
    }

    public function adminSettingsPage(){

        return view('admin.admin-settings');
    }

    public function updateAdminAccount(Request $request){

        if(!empty($request->input('password'))){
            $input['password'] = bcrypt($request->input('password'));
        }else{
            $input['password'] = Auth::user()->password;
        }

        $input['name'] = $request->input('name');
        $input['email'] = $request->input('email');
        $input['username'] = $request->input('username');

        Admin::where([
            ['id', '=', Auth::user()->id]
        ])->update($input);

        Session::flash('success', 'Your account has been updated');
        return redirect()->back();
    }
}
