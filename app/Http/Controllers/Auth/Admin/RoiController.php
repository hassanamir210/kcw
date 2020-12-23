<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BonusValue;
use App\Models\TokenValueHistory;

use Carbon\Carbon;

class RoiController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateRoiAmount(Request $request) {

        $bonusValueRoi      = BonusValue::where('id',1)
        						->update([
        							"value"=>$request->daily_roi_value
        						]);
        $bonusValueDollar   = BonusValue::where('id',2)
                                ->update([
                                    "value"=>$request->daily_dollar_value
                                ]);
        $bonusValueToken    = BonusValue::where('id',3)
                                ->update([
                                    "value"=>$request->daily_token_value
                                ]);
        $now = Carbon::now()->format('Y-m-d');
        $tokenValueHistory = TokenValueHistory::whereDate('created_at',$now)
                                                ->first();
        if(!empty($tokenValueHistory))
            $tokenValueHistory->update(["value"=>$request->daily_token_value]);
        else
            $tokenValueHistory = TokenValueHistory::create(["value"=>$request->daily_token_value]);

        $bonusValueMaxTokenAmount   = BonusValue::where('id',4)
                                            ->update([
                                                "value"=>$request->max_token_amount
                                            ]);

        $tokenValueHistory = TokenValueHistory::whereDate('created_at',Carbon::now()->format('Y-m-d'))->first();

        if(empty($tokenValueHistory))
        {
            $tokenValueHistory = TokenValueHistory::create([
                                    "value"=>$request->daily_token_value
                                ]);
        }


       	return redirect()->back()->withFlashSuccess(__('The daily value are updated successfully.'));
	}
}
