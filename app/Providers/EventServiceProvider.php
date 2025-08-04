<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Models\ActivitySupport;
use App\Models\ExpenditureCategory;
use App\Models\ExpenditureDetail;
use App\Models\ExpenditureItem;
use App\Models\IncomeActivity;
use App\Models\MemberInvitation;
use App\Models\MemberRegistration;
use App\Models\Organisation;
use App\Models\PasswordReset;
use App\Models\PaymentCategory;
use App\Models\PaymentItem;
use App\Models\Registration;
use App\Models\Session;
use App\Models\StoreYearlyBalance;
use App\Models\TransactionHistory;
use App\Models\User;
use App\Models\UserContribution;
use App\Models\UserSaving;
use App\Observers\ActivitySupportObserver;
use App\Observers\ExpenditureCategoryObserver;
use App\Observers\ExpenditureDetailObserver;
use App\Observers\ExpenditureItemObserver;
use App\Observers\IncomeActivityObserver;
use App\Observers\MemberInvitationObserver;
use App\Observers\MemberRegistrationObserver;
use App\Observers\OrganisationObserver;
use App\Observers\PasswordResetObserver;
use App\Observers\PaymentCategoryObserver;
use App\Observers\PaymentItemObserver;
use App\Observers\RegistrationObserver;
use App\Observers\SessionObserver;
use App\Observers\StoreYealyBalanceObserver;
use App\Observers\TransactionHistoryObserver;
use App\Observers\UserContributionObserver;
use App\Observers\UserObserver;
use App\Observers\UserSavingObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        ActivitySupport::observe(ActivitySupportObserver::class);
        ExpenditureCategory::observe(ExpenditureCategoryObserver::class);
        ExpenditureItem::observe(ExpenditureItemObserver::class);
        ExpenditureDetail::observe(ExpenditureDetailObserver::class);
        IncomeActivity::observe(IncomeActivityObserver::class);
        MemberInvitation::observe(MemberInvitationObserver::class);
        Organisation::observe(OrganisationObserver::class);
        PasswordReset::observe(PasswordResetObserver::class);
        PaymentCategory::observe(PaymentCategoryObserver::class);
        PaymentItem::observe(PaymentItemObserver::class);
        Registration::observe(RegistrationObserver::class);
        Session::observe(SessionObserver::class);
        StoreYearlyBalance::observe(StoreYealyBalanceObserver::class);
        TransactionHistory::observe(TransactionHistoryObserver::class);
        UserContribution::observe(UserContributionObserver::class);
        UserSaving::observe(UserSavingObserver::class);
        MemberRegistration::observe(MemberRegistrationObserver::class);
    }
}
