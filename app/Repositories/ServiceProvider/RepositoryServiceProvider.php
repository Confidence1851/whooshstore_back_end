<?php

namespace App\Repositories\ServiceProvider;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\EloquentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {

        $this->app->bind(
            EloquentRepositoryInterface::class,
            BaseRepository::class
        );

        $this->app->bind(
            'App\Repositories\Interfaces\UserRepositoryInterface',
            'App\Repositories\Eloquent\UserRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\PostCategoryRepositoryInterface',
            'App\Repositories\Eloquent\PostCategoryRepository'
        );


        $this->app->bind(
            'App\Repositories\Interfaces\PostRepositoryInterface',
            'App\Repositories\Eloquent\PostRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\PostCommentRepositoryInterface',
            'App\Repositories\Eloquent\PostCommentRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\ContactUsRepositoryInterface',
            'App\Repositories\Eloquent\ContactUsRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\AdvertRepositoryInterface',
            'App\Repositories\Eloquent\AdvertRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\AdvertMediaRepositoryInterface',
            'App\Repositories\Eloquent\AdvertMediaRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\AdminLogRepositoryInterface',
            'App\Repositories\Eloquent\AdminLogRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\ErrorLogRepositoryInterface',
            'App\Repositories\Eloquent\ErrorLogRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\AccountRepositoryInterface',
            'App\Repositories\Eloquent\AccountRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\ActivityRepositoryInterface',
            'App\Repositories\Eloquent\ActivityRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\AgentRepositoryInterface',
            'App\Repositories\Eloquent\AgentRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\AgentTransactionRepositoryInterface',
            'App\Repositories\Eloquent\AgentTransactionRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\BankAccountRepositoryInterface',
            'App\Repositories\Eloquent\BankAccountRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\ChatRepositoryInterface',
            'App\Repositories\Eloquent\ChatRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\ChatMessageRepositoryInterface',
            'App\Repositories\Eloquent\ChatMessageRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\ContactMessageRepositoryInterface',
            'App\Repositories\Eloquent\ContactMessageRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\CouponRepositoryInterface',
            'App\Repositories\Eloquent\CouponRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\InvestmentRepositoryInterface',
            'App\Repositories\Eloquent\InvestmentRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\NewsLetterSubscriberRepositoryInterface',
            'App\Repositories\Eloquent\NewsLetterSubscriberRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\NotificationRepositoryInterface',
            'App\Repositories\Eloquent\NotificationRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\ReferralRepositoryInterface',
            'App\Repositories\Eloquent\ReferralRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\TransactionRepositoryInterface',
            'App\Repositories\Eloquent\TransactionRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\DepositRepositoryInterface',
            'App\Repositories\Eloquent\DepositRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\FiatTransferRepositoryInterface',
            'App\Repositories\Eloquent\FiatTransferRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\CountryRepositoryInterface',
            'App\Repositories\Eloquent\CountryRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\CountryStateRepositoryInterface',
            'App\Repositories\Eloquent\CountryStateRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\SettingRepositoryInterface',
            'App\Repositories\Eloquent\SettingRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\WithdrawalRepositoryInterface',
            'App\Repositories\Eloquent\WithdrawalRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\VerificationPinRepositoryInterface',
            'App\Repositories\Eloquent\VerificationPinRepository'
        );
    }
}
