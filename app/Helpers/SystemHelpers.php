<?php

use App\Exceptions\GeneralException;
use App\Helpers\SystemHelpers;
use App\Models\PaymentRequest;
use App\Models\TokenBuyHistory;
use App\Models\BonusValue;
use App\User;

use Carbon\Carbon;

if (! function_exists('CurrentBtcRate')) {
    /**
     * @param       $url
     * @param array $attributes
     * @param null  $secure
     *
     * @return mixed
     */
    function CurrentBtcRate()
    {
        $jsnsrc = "https://blockchain.info/ticker";
        $json = file_get_contents($jsnsrc);
        $json = json_decode($json);
        $btcrate = $json->USD->last;
        return $btcrate;
    }
}

if (! function_exists('totalUsers')) {
    
    /**
     * @param  $void
     *
     * @return int
     */
    function totalUsers() {
        return User::count();
    }
}

if (! function_exists('totalUnpaidUsers')) {
    
    /**
     * @param  $void
     *
     * @return int
     */
    function totalUnpaidUsers() {
        return User::where('payment_status', 0)->where('id', '!=', 1)->count();
    }
}

if (! function_exists('totalDeposit')) {
    
    /**
     * @param  $void
     *
     * @return int
     */
    function totalDeposit() {
        return PaymentRequest::where('type', PaymentRequest::DEPOSIT)
            ->where('status', PaymentRequest::APPROVED)->sum('amount');
    }
}

if (! function_exists('totalWithdraw')) {
    
    /**
     * @param  $void
     *
     * @return int
     */
    function totalWithdraw() {
        return PaymentRequest::where('type', PaymentRequest::WITHDRAW)
            ->where('status', PaymentRequest::APPROVED)->sum('amount');
    }
}

if (! function_exists('totalPendingWithdrawRequests')) {
    
    /**
     * @param  $void
     *
     * @return int
     */
    function totalPendingWithdrawRequests() {
        return PaymentRequest::where('type', PaymentRequest::WITHDRAW)
            ->where('status', PaymentRequest::PENDING)->count();
    }
}

if (! function_exists('totalApprovedWithdrawRequests')) {
    
    /**
     * @param  $void
     *
     * @return int
     */
    function totalApprovedWithdrawRequests() {
        return PaymentRequest::where('type', PaymentRequest::WITHDRAW)
            ->where('status', PaymentRequest::APPROVED)->count();
    }
}

if (! function_exists('sumInRupee')) {
    
    /**
     * @param  $void
     *
     * @return int
     */
    function sumInRupee($records) {
        $sum = 0;
        foreach ($records as  $value) {
            $sum = $sum + ($value->amount*$value->dollar_value);
        }
        return $sum;
    }
}

if (! function_exists('user_name')) {
   /**
     * Get the active class if the condition is not falsy.
     *
     * @param        $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function user_name($refId)
    {
        $userId = decrypt($refId);
        $user = User::where('id',$userId)->first();
        if(!empty($user))
            return $user->user_name;
        return "";
    }
}

if (! function_exists('remainingTokenAmount')) {
   /**
     * Get the active class if the condition is not falsy.
     *
     * @param        $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function remainingTokenAmount()
    {
        $today = Carbon::now()->format('Y-m-d');
        $tokenBuyHistorySum = TokenBuyHistory::whereDate('created_at',$today)
                                            ->sum('amount');
        $todayMaxTokenAmount = BonusValue::find(4)->value;
        $remainingAmount = $todayMaxTokenAmount - $tokenBuyHistorySum ;

        return $remainingAmount;
    }
}

if (! function_exists('number_of_tokens')) {
   /**
     * Get the active class if the condition is not falsy.
     *
     * @param        $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function number_of_tokens()
    {
        $today = Carbon::now()->format('Y-m-d');
        
        $tokenValue = BonusValue::find(3)->value;

        $tokenBuyHistorySum = TokenBuyHistory::whereDate('created_at',$today)
                                            ->sum('amount');
        $todayMaxTokenAmount = BonusValue::find(4)->value;
        $remainingAmount = $todayMaxTokenAmount - $tokenBuyHistorySum ;

        return number_format($remainingAmount/$tokenValue, 2, '.', '');
    }
}