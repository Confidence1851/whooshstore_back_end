<?php

namespace App\Traits;

use App\Repositories\Interfaces\AccountRepositoryInterface;
use App\Repositories\Interfaces\BankAccountRepositoryInterface;
use App\Repositories\Interfaces\CouponRepositoryInterface;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\ActivityRepositoryInterface;
use App\Repositories\Interfaces\AdminLogRepositoryInterface;
use App\Repositories\Interfaces\AdvertMediaRepositoryInterface;
use App\Repositories\Interfaces\AdvertRepositoryInterface;
use App\Repositories\Interfaces\AgentRepositoryInterface;
use App\Repositories\Interfaces\AgentTransactionRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\CountryStateRepositoryInterface;
use App\Repositories\Interfaces\DepositRepositoryInterface;
use App\Repositories\Interfaces\ErrorLogRepositoryInterface;
use App\Repositories\Interfaces\FiatTransferRepositoryInterface;
use App\Repositories\Interfaces\InvestmentRepositoryInterface;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\ReferralRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\VerificationPinRepositoryInterface;
use App\Repositories\Interfaces\WithdrawalRepositoryInterface;

trait ModelIndex
{

    protected $Account;
    protected $Agent;
    protected $AgentTransaction;
    protected $BankAccount;
    protected $Chat;
    protected $ChatMessage;
    protected $Coupon;
    protected $Country;
    protected $CountryState;
    protected $ErrorLog;
    protected $NewsLetterSubscriber;
    protected $User;
    protected $Transaction;
    protected $Investment;
    protected $Withdrawal;
    protected $Activity;
    protected $Referral;
    protected $Setting;
    protected $VerificationPin;
    protected $Deposit;
    protected $FiatTransfer;
    protected $AdminLog;
    protected $Advert;
    protected $AdvertMedia;
    protected $Notification;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface ,
        TransactionRepositoryInterface $transactionRepositoryInterface ,
        CouponRepositoryInterface $couponRepositoryInterface ,
        BankAccountRepositoryInterface $bankAccountRepositoryInterface ,
        AccountRepositoryInterface $accountRepositoryInterface ,
        InvestmentRepositoryInterface $investmentRepositoryInterface ,
        WithdrawalRepositoryInterface $withdrawalRepositoryInterface ,
        ActivityRepositoryInterface $activityRepositoryInterface ,
        ReferralRepositoryInterface $referralRepositoryInterface ,
        AgentRepositoryInterface $agentRepositoryInterface ,
        AgentTransactionRepositoryInterface $agentTransactionRepositoryInterface ,
        SettingRepositoryInterface $settingRepositoryInterface ,
        VerificationPinRepositoryInterface $verificationPinRepositoryInterface ,
        FiatTransferRepositoryInterface $fiatTransferRepositoryInterface ,
        DepositRepositoryInterface $depositRepositoryInterface ,
        AdminLogRepositoryInterface $adminLogRepositoryInterface ,
        AdvertRepositoryInterface $advertRepositoryInterface ,
        AdvertMediaRepositoryInterface $advertMediaRepositoryInterface ,
        CountryRepositoryInterface $countryRepositoryInterface ,
        CountryStateRepositoryInterface $countryStatetateRepositoryInterface ,
        NotificationRepositoryInterface $notificationRepositoryInterface ,
        ErrorLogRepositoryInterface $errorlogRepositoryInterface
    ){
        $this->User = $userRepositoryInterface;
        $this->Transaction = $transactionRepositoryInterface;
        $this->Coupon = $couponRepositoryInterface;
        $this->BankAccount = $bankAccountRepositoryInterface;
        $this->Account = $accountRepositoryInterface;
        $this->Investment = $investmentRepositoryInterface;
        $this->Withdrawal = $withdrawalRepositoryInterface;
        $this->Activity = $activityRepositoryInterface;
        $this->Referral = $referralRepositoryInterface;
        $this->Agent = $agentRepositoryInterface;
        $this->AgentTransaction = $agentTransactionRepositoryInterface;
        $this->Setting = $settingRepositoryInterface;
        $this->VerificationPin = $verificationPinRepositoryInterface;
        $this->FiatTransfer = $fiatTransferRepositoryInterface;
        $this->Deposit = $depositRepositoryInterface;
        $this->AdminLog = $adminLogRepositoryInterface;
        $this->Advert = $advertRepositoryInterface;
        $this->AdvertMedia = $advertMediaRepositoryInterface;
        $this->Country = $countryRepositoryInterface;
        $this->CountryState = $countryStatetateRepositoryInterface;
        $this->Notification = $notificationRepositoryInterface;
        $this->ErrorLog = $errorlogRepositoryInterface;

    }
}
