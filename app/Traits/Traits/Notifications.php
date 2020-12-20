<?php

namespace App\Traits;

use App\Mail\NewInvestment;
use App\Mail\NewNotification;
use App\Mail\NewStakeCard;
use App\Mail\NewTransaction;
use App\Mail\NewWithdrawal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

trait Notifications
{
    /**Send new agent a notification
     * @param  $email ,  wallet ,  $pin
    */
    public function newAgentNotify($email, $wallet , $pin ){
        $this->sendNotificationMail([
            'title' => 'New StakeGuard Agent!',
            'subject' => 'Congrats, you have been promoted to the role of an agent on StakeGuard. Cheers...!',
            'email' => $email,
            'description' => 'Congratulations, you are now an agent on StakeGuard.',
            'message' => 'Your agent wallet has been credit with $'.$wallet.' and your transfer pin is '.$pin,
        ]);
    }
    /**Notify Agent of account balcance modification
     * @param  $email , $pin
    */
    public function accountBalanceAgentNotify($email , $amount){
        $this->sendNotificationMail([
            'title' => 'Account Refilled!',
            'subject' => 'Holla, we detected a change by the admin on you agent account!',
            'email' => $email,
            'description' => 'Your agent wallet balance has been modified!',
            'message' => 'Your agent wallet has been credited with $'.$amount,
        ]);
    }

    public function emailErrorFlash($message){
        $error = collect([$message]);
        Session::flash('notification_errors', $error);
    }


    public function sendTransactionMail($transaction){
        try{
            if($transaction->type == 'Credit'){
                $transaction->title = 'New Credit Transaction';
            }
            else{
                $transaction->title = 'New Debit Transaction';
            }
            $transaction->description = 'Hello , we detected a new transaction on your account. Please find the details below:';
            Mail::to($transaction->user->email)->send(new NewTransaction($transaction));
        }
        catch (\Exception $e) {
            session()->flash('error_msg' , $e->getMessage());
        return false;
    }
    }

    public function sendInvestmentMail($investment){
        try{
            $investment->title = 'New Investment Details';
            $investment->description = 'Hello , we detected a new investment transaction on your account. Please find the details below:';
            Mail::to($investment->user->email)->send(new NewInvestment($investment));
        }
        catch (\Exception $e) {
            session()->flash('error_msg' , $e->getMessage());
            return false;
        }
    }

    public function sendNotificationMail($notification){
        try{
            Mail::to($notification['email'])->send(new NewNotification($notification));
        }
        catch (\Exception $e) {
            session()->flash('error_msg' , $e->getMessage());
            return false;
        }
    }

    public function sendWithdrawalMail($withdrawal){
        try{
            $withdrawal->title = 'New Withdrawal Details';
            $withdrawal->description = 'Hello , we detected a new withdrawal request on your account. Please find the details below:';
            Mail::to($withdrawal->user->email)->send(new NewWithdrawal($withdrawal));
        }
        catch (\Exception $e) {
            session()->flash('error_msg' , $e->getMessage());
            return false;
        }
    }

    public function sendStakeCardMail($card){
        // try{
            Mail::to($card['email'])->send(new NewStakeCard($card));
        // }
        // catch (\Exception $e) {
            // session()->flash('error_msg' , $e->getMessage());
            // return false;
        // }
    }

}
