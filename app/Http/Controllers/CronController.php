<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Roi;
use App\Models\BonusValue;
use Illuminate\Http\Request;
use DB;

class CronController extends Controller
{
    public function getPercentage() {

        $users = User::where('active', User::ACTIVE)->where('id','!=',1)->get();

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
                $sum += $user->calculateTeamBonus($leveltWOUsers,0.25); 

                $levelThreeUsers = $user->getUsersByRefferalLevel(User::LEVEL_THREE);
                $sum += $user->calculateTeamBonus($levelThreeUsers,0.25);
                
                $levelFourUsers = $user->getUsersByRefferalLevel(User::LEVEL_FOUR);
                $sum += $user->calculateTeamBonus($levelFourUsers,0.25);

                $levelFiveUsers = $user->getUsersByRefferalLevel(User::LEVEL_FIVE);
                $sum += $user->calculateTeamBonus($levelFiveUsers,0.25);



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



                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_ELEVEN);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);

                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_TWELVE);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);

                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_THIRTEEN);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);

                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_FOURTEEN);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);

                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_FIFTEEN);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);



                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_SIXTEEN);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);

                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_SEVENTEEN);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);

                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_EIGHTEEN);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);

                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_NINETEEN);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);

                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_TWENTY);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);



                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_TWENTYONE);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);

                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_TWENTYTWO);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);

                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_TWENTYTHREE);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);

                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_TWENTYFOUR);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);

                $levelNUsers = $user->getUsersByRefferalLevel(User::LEVEL_TWENTYFIVE);
                $sum += $user->calculateTeamBonus($levelNUsers,0.25);
                
                // $user->payment->current_balance += $sum;
                // $user->payment->save();

            } catch (Exception $e) {
                DB::rollBack();
            }

            DB::commit();
        }
    }
}
