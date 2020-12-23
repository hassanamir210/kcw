<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\TokenValueHistory;
use App\Models\TokenBuyHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Charts\TokenChart;

use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $userId = encrypt($userId);

        $notificationText = '';

        foreach (Notification::all()->pluck('notification') as $notification) {
            $notificationText = $notificationText.''.$notification;
        }

        return view('dashboard')->withUserId($userId)->withNotificationText($notificationText);
    }

    public function tokenValueStats($type="w")
    {
        if(!in_array($type, ['w','m','y']))
            return abort(404);

        $now = Carbon::now()->format('Y-m-d');
        $labels = [];
        $values = [];

        if($type=='w')
        {
            for($i=0;$i<7;$i++)
            {   
                $labels[] = Carbon::parse($now)->subday($i)->format('M d');
                $date = Carbon::parse($now)->subday($i)->format('Y-m-d');
                $tokenValueHistory = TokenValueHistory::whereDate('created_at',$date)
                                                    ->first();
                $values[] = !empty($tokenValueHistory)?$tokenValueHistory->value:0; 
            }
        }
        elseif($type=='m')
        {
            for($i=0;$i<30;$i++)
            {   
                $labels[] = Carbon::parse($now)->subday($i)->format('M d');
                $date = Carbon::parse($now)->subday($i)->format('Y-m-d');
                $tokenValueHistory = TokenValueHistory::whereDate('created_at',$date)
                                                    ->first();
                $values[] = !empty($tokenValueHistory)?$tokenValueHistory->value:0; 
            }
        }
        else
        {
            for($i=0;$i<12;$i++)
            {   
                $labels[] = Carbon::parse($now)->subMonth($i)->format('M Y');
                $date = Carbon::parse($now)->subMonth($i)->format('m');
                $tokenValueHistory = TokenValueHistory::whereMonth('created_at',$date)
                                                    ->sum('value');
                $values[] = !empty($tokenValueHistory)?$tokenValueHistory:0; 
            }
        }

        $tokensChart = new TokenChart;
        $tokensChart->labels(array_reverse($labels));
        $tokensChart->dataset('KCW Token Value', 'line', array_reverse($values))
            ->color("rgb(255, 99, 132)")
            ->backgroundcolor("rgb(255, 99, 132)");

        return view('tokenValueStats', [ 'tokensChart' => $tokensChart ] );
    }

    public function tokenBuyStats($type="w")
    {
        if(!in_array($type, ['w','m','y']))
            return abort(404);

        $now = Carbon::now()->format('Y-m-d');
        $labels = [];
        $values = [];

        if($type=='w')
        {
            for($i=0;$i<7;$i++)
            {   
                $labels[] = Carbon::parse($now)->subday($i)->format('M d');
                $date = Carbon::parse($now)->subday($i)->format('Y-m-d');
                $tokenBuyHistory = TokenBuyHistory::whereDate('created_at',$date)
                                                    ->sum('amount');
                $values[] = $tokenBuyHistory; 
            }
        }
        elseif($type=='m')
        {
            for($i=0;$i<30;$i++)
            {   
                $labels[] = Carbon::parse($now)->subday($i)->format('M d');
                $date = Carbon::parse($now)->subday($i)->format('Y-m-d');
                $tokenBuyHistory = TokenBuyHistory::whereDate('created_at',$date)
                                                    ->sum('amount');
                $values[] = $tokenBuyHistory; 
            }
        }
        else
        {
            for($i=0;$i<12;$i++)
            {   
                $labels[] = Carbon::parse($now)->subMonth($i)->format('M Y');
                $date = Carbon::parse($now)->subMonth($i)->format('m');
                $tokenBuyHistory = TokenBuyHistory::whereMonth('created_at',$date)
                                                    ->sum('amount');
                $values[] = $tokenBuyHistory;
            }
        }

        $tokensChart = new TokenChart;
        $tokensChart->labels(array_reverse($labels));
        $tokensChart->dataset('KCW Token Buy Amount', 'line', array_reverse($values))
            ->color("rgb(255, 99, 132)")
            ->backgroundcolor("rgb(255, 99, 132)");

        return view('tokenBuyStats', [ 'tokensChart' => $tokensChart ] );
    }
}
