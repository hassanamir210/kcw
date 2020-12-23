<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Roi;
use App\Models\BonusValue;
use App\Models\TokenValueHistory;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class CronController extends Controller
{
    public function getPercentage() {

        $users = User::where('active', User::ACTIVE)->where('id','!=',1)->get();

        // Daily KCW TOKEN VALUE UPDATE CODE HERE.....
        $dailyTokenValue = BonusValue::find(3)->first();
        $dailyTokenValue->value = rand(9,11);
        $dailyTokenValue->save();

        $now = Carbon::now()->format('Y-m-d');
        $tokenValueHistory = TokenValueHistory::whereDate('created_at',$now)
                                                ->first();
        if(!empty($tokenValueHistory))
            $tokenValueHistory->update(["value"=>$dailyTokenValue->value]);
        else
            $tokenValueHistory = TokenValueHistory::create(["value"=>$dailyTokenValue->value]);
        // Daily KCW TOKEN VALUE UPDATE Ends Here...

        foreach($users as $user) {

            DB::beginTransaction();
            try {
                $sum = 0;

                $totalDeposit = $user->totalDeposit();
                $randomNumber = BonusValue::find(1)->value;//rand(5,7);
                $roi = $totalDeposit * ($randomNumber/(30*100));
                // $sum += $roi;

                $userRoi = Roi::create(['user_id' => $user->id, 'amount' => $roi]);

                $levelOneUsers = $user->getUsersByRefferalLevel(User::LEVEL_ONE);
                $sum += $user->calculateTeamBonus($levelOneUsers,2); 

                $leveltWOUsers = $user->getUsersByRefferalLevel(User::LEVEL_TWO);
                $sum += $user->calculateTeamBonus($leveltWOUsers,1.5); 

                $levelThreeUsers = $user->getUsersByRefferalLevel(User::LEVEL_THREE);
                $sum += $user->calculateTeamBonus($levelThreeUsers,1);
                
                $levelFourUsers = $user->getUsersByRefferalLevel(User::LEVEL_FOUR);
                $sum += $user->calculateTeamBonus($levelFourUsers,0.75);

                $levelFiveUsers = $user->getUsersByRefferalLevel(User::LEVEL_FIVE);
                $sum += $user->calculateTeamBonus($levelFiveUsers,0.5);

                $levelSixUsers = $user->getUsersByRefferalLevel(User::LEVEL_SIX);
                $sum += $user->calculateTeamBonus($levelSixUsers,0.25);

                $levelSevenUsers = $user->getUsersByRefferalLevel(User::LEVEL_SEVEN);
                $sum += $user->calculateTeamBonus($levelSevenUsers,0.25);

                $levelEightUsers = $user->getUsersByRefferalLevel(User::LEVEL_EIGHT);
                $sum += $user->calculateTeamBonus($levelEightUsers,0.25);

                $levelNineUsers = $user->getUsersByRefferalLevel(User::LEVEL_NINE);
                $sum += $user->calculateTeamBonus($levelNineUsers,0.25);

                $levelTenUsers = $user->getUsersByRefferalLevel(User::LEVEL_TEN);
                $sum += $user->calculateTeamBonus($levelTenUsers,0.25);
                
                // $user->payment->current_balance += $sum;
                // $user->payment->save();

            } catch (Exception $e) {
                DB::rollBack();
            }

            DB::commit();
        }
    }
}
