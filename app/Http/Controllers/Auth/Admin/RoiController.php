<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BonusValue;

class RoiController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateRoiAmount(Request $request) {

        $bonusValue = BonusValue::where('id',1)
        						->update([
        							"value"=>$request->daily_roi_value
        						]);

       	return redirect()->back()->withFlashSuccess(__('The ROI daily value updated successfully.'));
	}
}
