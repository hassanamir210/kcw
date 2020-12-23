<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentRequest;
use App\Http\Requests\Auth\WithdrawPaymentRequest;
use App\Http\Requests\Auth\DepositPaymentRequest;
use Illuminate\Support\Facades\Auth;
use App\Notifications\WithdrawApproved;
use App\Notifications\WithdrawRejected;
use App\User;

use Carbon\Carbon;


class PaymentRequestController extends Controller
{
     /**
     * PaymentRequestController constructor.
     *
     * @param  PaymentRequest  $paymentRequest
     */
    public function __construct(PaymentRequest $paymentRequest)
    {
        $this->paymentRequest = $paymentRequest;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function withdrawRequests($type,$filter='w') 
    {

        if(!in_array($filter, ['w','m','y']))
            return abort(404);

        $now = Carbon::now()->format('Y-m-d');
        $type = decrypt($type);
        
        $end = "";
        $start="";
        if($filter=='w')
        {
            $end = Carbon::parse($now)->format('Y-m-d');
            $start = Carbon::parse($now)->subday(6)->format('Y-m-d');
        }
        elseif($filter=='m')
        {
            $end = Carbon::parse($now)->format('Y-m-d');
            $start = Carbon::parse($now)->subday(30)->format('Y-m-d');
        }
        else
        {
            $end = Carbon::parse($now)->format('Y-m-d');
            $start = Carbon::parse($now)->subMonth(12)->format('Y-m-d');
        }
            
        return view('auth.payment.withdraw-requests',compact('type'))
                ->withWithdrawRequests($this->paymentRequest->where('status', PaymentRequest::PENDING)
                    ->where('withdraw_type',$type)
                    ->where('type', PaymentRequest::WITHDRAW)
                    ->where('created_at','>=',$start)
                    ->where('created_at','<=',$end)
                    ->orderBy('id','desc')->get());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function withdrawRequestAction(Request $request) {
        $flag = decrypt($request->flag);

        $model = $this->paymentRequest->find(decrypt($request->id));


        if ($flag === PaymentRequest::APPROVED) {

            $model->status = PaymentRequest::APPROVED;
            $model->save();

            $user = User::where('id',decrypt($request->user_id))->first();
            $user->notify(new WithdrawApproved());

            return redirect()->back()->withFlashInfo(__('Request approved suucessfully'));
        }

        if ($flag === PaymentRequest::REJECTED) {

            $payment = Payment::where('user_id', decrypt($request->user_id))->first();
            $payment->current_balance += $model->amount;
            $payment->save();

            $model->status = PaymentRequest::REJECTED;
            $model->save();

            return redirect()->back()->withFlashInfo(__('Request rejected suucessfully'));
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function withdrawRequestRejectForm(Request $request) {
        $flag = decrypt($request->flag);

        if ($flag === PaymentRequest::REJECTED) {
            $user_id = $request->user_id;
            $flag = $request->flag;
            $id = $request->id;

            return view('auth.payment.reject-form',compact('user_id','flag','id'));

        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function withdrawRequestReject(Request $request) {

        // return $request;

        $model = $this->paymentRequest->find(decrypt($request->id));

        $payment = Payment::where('user_id', decrypt($request->user_id))->first();
        $payment->current_balance += $model->amount;
        $payment->save();

        $user = User::where('id',decrypt($request->user_id))->first();
        $user->notify(new WithdrawRejected($request->reason));

        $model->status = PaymentRequest::REJECTED;
        $model->save();

        return redirect('admin/payment/withdraw/requests')->withFlashInfo(__('Request rejected suucessfully'));
    }
}
