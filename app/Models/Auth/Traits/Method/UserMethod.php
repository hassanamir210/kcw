<?php

namespace App\Models\Auth\Traits\Method;

use DB;
use App\User;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Message;
use App\Models\TeamBonus;
use App\Models\Auth\Role;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Models\PaymentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Trait UserMethod.
 */
trait UserMethod
{
    /**
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->hasRole('administrator');
    }

    /**
     * @return mixed
     */
    public function isCustomer()
    {
        return $this->hasRole(config('access.users.customer_role'));
    }

    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return mixed
     */
    public function canChangeEmail(): bool
    {
        return config('access.user.change_email');
    }

    /**
     * @param bool $size
     *
     * @throws \Illuminate\Container\EntryNotFoundException
     * @return bool|\Illuminate\Contracts\Routing\UrlGenerator|mixed|string
     */
    public function getPicture($size = false)
    {
        switch ($this->avatar_type) {
            case 'gravatar':
                if (! $size) {
                    $size = config('gravatar.default.size');
                }

                return gravatar()->get($this->email, ['size' => $size]);

            case 'storage':
                return url('storage/'.$this->avatar_location);
        }

        $social_avatar = $this->providers()->where('provider', $this->avatar_type)->first();

        if ($social_avatar && strlen($social_avatar->avatar)) {
            return $social_avatar->avatar;
        }

        return false;
    }

    /**
     * Check users refeerals count
     * 
     * @return int
     */
    public function refferalsCount() {
        return $this->where('referred_by', $this->id)->count();
    }

    /**
     * Check users refeerals count
     * 
     * @return int
     */
    public function getRefferalBonus($refferalUserId) {
        // 
    }

    /**
     * Generate two factor authentication code
     * 
     * @return int
     */
    public function generateTwoFactorCode() {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->save();
    }

    /**
     * Generate two factor authentication code for withdraw requests
     * 
     * @return int
     */
     public function generateWithdrawTwoFactorCode() {
        $this->timestamps = false;
        $this->withdraw_two_factor_code = rand(100000, 999999);
        $this->save();
    }

    /**
     * Reset two factor authentication code
     * 
     * @return int
     */
    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->save();
    }

     /**
     * Reset two factor authentication code
     * 
     * @return int
     */
     public function resetWithdrawTwoFactorCode()
     {
        $this->timestamps = false;
        $this->withdraw_two_factor_code = null;
        $this->save();
     }

    public static function getUsersByRole($type){
        $modelRole = Role::findByType($type);
        if(!empty($modelRole)){
            return self::join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->where('users.payment_status','=',Payment::DEFAULT_BALANCE_ZERO)
                ->where('role_id','=',$modelRole->id)->get();
        }
        return [];
    }

    /**
     * Reset two factor authentication code
     * 
     * @return int
     */
    public function originalReffereName($id) {
        $id = intval($id);
        if ($id) {
            return $this->find($id)->name;
        }
        return '';
    }

    /**
     * Reset two factor authentication code
     * 
     * @return int
     */
    public function totalDeposit() {

        return $this->paymentHistory->where('type', PaymentRequest::DEPOSIT)->where('status', PaymentRequest::APPROVED)->sum('amount');
    }

    /**
     * Reset two factor authentication code
     * 
     * @return int
     */
    public function totalDepositedAmount() {

        return $this->paymentHistory->where('type', PaymentRequest::DEPOSIT)
            ->where('status', PaymentRequest::APPROVED)
            ->where('user_id', $this->id)
            ->where('amount', '!==', '')
            ->sum('amount');
    }

    /**
     * Reset two factor authentication code
     * 
     * @return int
     */
    public function totalWithdraw() {

        return $this->paymentHistory->where('type', PaymentRequest::WITHDRAW)->where('status',PaymentRequest::APPROVED)->sum('amount');
    }

    /**
     * Reset two factor authentication code
     * 
     * @return int
     */
    public function calculateTeamBonus($users, $percentage) {

        $sum = 0;

        foreach($users as $user) {

            $totalDeposit = $user->totalDeposit();
            $roi = $totalDeposit * ($percentage/(30*100));
            $sum += $roi;

            $teamBonus = TeamBonus::create(['to_user_id' => $this->id, 'from_user_id'=>$user->id, 'amount' => $roi]);
        }

        return $sum;
    }

    /**
     * @return int;
     */
    public function getTeamBonus() {

        return $this->teamBonus->sum('amount');
    }

    /**
     * @return int;
     */
    public function getDailyTeamBonus() {

        return $this->teamBonus->where('status',0)->sum('amount');
    }

    /**
     * @return int;
     */
    public function getTotalRoi() {
        return $this->roi->sum('amount');
    }

    /**
     * @return int;
     */
    public function getDailyRoi() {
        return $this->roi->where('status',0)->sum('amount');
    }

    /**
     * @return int;
     */
    public function getTeamBonusByUsersLevel($level) {

        $usersIds = $this->getUsersByRefferalLevel($level)->pluck('id');

        return TeamBonus::where('to_user_id', auth()->user()->id)
            ->whereIn('from_user_id', $usersIds)->sum('amount');
    }

    /**
     * @return string;
     */
    public function getRefferalLevelPercentage($level) {

        switch ($level) {
            case self::LEVEL_ONE:
                return '2%';
            break;

            case self::LEVEL_TWO:
                return '0.25%';
            break;

            case self::LEVEL_THREE:
                return '0.25%';
            break;

            case self::LEVEL_FOUR:
                return '0.25%';
            break;

            case self::LEVEL_FIVE:
                return '0.25%';
            break;

            case self::LEVEL_SIX:
                return '0.25%';
            break;

            case self::LEVEL_SEVEN:
                return '0.25%';
            break;

            case self::LEVEL_EIGHT:
                return '0.25%';
            break;

            case self::LEVEL_NINE:
                return '0.25%';
            break;

            case self::LEVEL_TEN:
                return '0.25%';
            break;

            case self::LEVEL_ELEVEN:
                return '0.25%';
            break;

            case self::LEVEL_TWELVE:
                return '0.25%';
            break;

            case self::LEVEL_THIRTEEN:
                return '0.25%';
            break;

            case self::LEVEL_FOURTEEN:
                return '0.25%';
            break;

            case self::LEVEL_FIFTEEN:
                return '0.25%';
            break;

            case self::LEVEL_SIXTEEN:
                return '0.25%';
            break;

            case self::LEVEL_SEVENTEEN:
                return '0.25%';
            break;

            case self::LEVEL_EIGHTEEN:
                return '0.25%';
            break;

            case self::LEVEL_NINETEEN:
                return '0.25%';
            break;

            case self::LEVEL_TWENTY:
                return '0.25%';
            break;

            case self::LEVEL_TWENTYONE:
                return '0.25%';
            break;

            case self::LEVEL_TWENTYTWO:
                return '0.25%';
            break;

            case self::LEVEL_TWENTYTHREE:
                return '0.25%';
            break;

            case self::LEVEL_TWENTYFOUR:
                return '0.25%';
            break;

            case self::LEVEL_TWENTYFIVE:
                return '0.25%';
            break;
        }
    }

    /**
     * Reset two factor authentication code
     * 
     * @return App\User;
     */
    public function getUsersByRefferalLevelFirstTen($level) {

        $resultArr = [];
        $idsArr = [];

        for($i=1 ; $i<=$level ; $i++)
        {
            if($level==1)
                $idsArr[] = $this->id;
            else
                $idsArr = $resultArr;

            $resultArr = [];

            for($j=0 ; $j<count($idsArr) ; $j++)
            {
                $tempArr    = self::where('referred_by', $idsArr)
                                    ->limit(10)
                                    ->pluck('id')
                                    ->toArray();
                $resultArr  = array_merge($resultArr,$tempArr);
            }
        }
        return self::whereIn('id', $resultArr)
                    ->get();
    }


    public function getUserReferralTree()
    {
        $userIds = [$this->id];
        $resultUserIds = [];
        while(true)
        {

            $userIds = self::whereIn('referred_by', $userIds)
                            ->pluck('id')->toArray();

            if(count($userIds))
                $resultUserIds = array_merge($resultUserIds,$userIds);
            else
                break;
        }

        return self::whereIn('id', $resultUserIds)
                    ->orderBy('id','desc')
                    ->get();
    }
    public function getUserReferralTreeUserIds()
    {
        $userIds = [$this->id];
        $resultUserIds = [];
        while(true)
        {

            $userIds = self::whereIn('referred_by', $userIds)
                            ->pluck('id')->toArray();

            if(count($userIds))
                $resultUserIds = array_merge($resultUserIds,$userIds);
            else
                break;
        }

        return $resultUserIds;
    }

    /**
     * Reset two factor authentication code
     * 
     * @return App\User;
     */
    public function getUsersByRefferalLevel($level) {
        
        switch ($level) {
            case self::LEVEL_ONE:
                return self::where('referred_by', $this->id)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_TWO:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_THREE:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_FOUR:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_FIVE:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_SIX:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_SEVEN:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_EIGHT:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_NINE:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;


            case self::LEVEL_TEN:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_ELEVEN:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_TWELVE:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_THIRTEEN:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_FOURTEEN:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_FIFTEEN:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_SIXTEEN:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_SEVENTEEN:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_EIGHTEEN:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_NINETEEN:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_TWENTY:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_TWENTYONE:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_TWENTYTWO:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_TWENTYTHREE:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_TWENTYFOUR:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;

            case self::LEVEL_TWENTYFIVE:
                $userIds = self::where('referred_by', $this->id)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                $userIds = self::whereIn('referred_by', $userIds)->pluck('id');
                return self::whereIn('referred_by', $userIds)
                    // ->where('payment_status', Payment::PAID)
                    ->get();
            break;
        }
    }

    /**
     * @param void
     *
     * @return Illuminate\Support\Collection
     */
    public function getMessages() {
        
        return Message::where(function($query) {
            $query->where('from_user', 1) // where admin has sent messages to user
                ->where('to_user', $this->id);
        })->orWhere(function($query) {
            $query->where('from_user',  $this->id) // where user has sent messages to admin
                ->where('to_user', 1);
        })->get();
    }

    /**
     * @param void
     *
     * @return Illuminate\Support\Collection
     */
    public function conversations() {
        
        $models = Conversation::all();

        $conversations = array();

        foreach($models as $conversation) {

            if (!empty($conversation->messages->toArray())) {
                $conversations[] = [
                    'id' => $conversation->id,
                    'user_name' => $conversation->user->full_name,
                    'message' =>  $conversation->messages->last()->content,
                ];
            }
        }
        return $conversations;
    }
}