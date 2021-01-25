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
    public function withdrawRequests() {
        return view('auth.payment.withdraw-requests')
            ->withWithdrawRequests($this->paymentRequest->where('status', PaymentRequest::PENDING)
                ->where('type', PaymentRequest::WITHDRAW)->orderBy('id','desc')->get());
    }

    public function withdrawRequests2() {
        $userIds = auth()->user()->getUserReferralTreeUserIds();

        $withdrawRequests = PaymentRequest::where('status', PaymentRequest::PENDING)
                                    ->where('type', PaymentRequest::WITHDRAW)
                                    ->whereIn('user_id',$userIds)
                                    ->orderBy('id','desc')
                                    ->get();

        return view('auth.payment.withdraw-requests2')
            ->withWithdrawRequests($withdrawRequests);
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

    public function withdrawRequestAction2(Request $request) {
        $flag = decrypt($request->flag);

        $model = $this->paymentRequest->find(decrypt($request->id));


        if ($flag === PaymentRequest::APPROVED) {

            $model->status = PaymentRequest::APPROVED;
            $model->save();

            $user = User::where('id',decrypt($request->user_id))->first();
            $user->notify(new WithdrawApproved());

            $auth = User::find(auth()->user()->id);
            $auth->total_points = $auth->total_points + $model->amount;
            $auth->save(); 

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

    public function withdrawRequestRejectForm2(Request $request) {

        return "ahaha";
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
    public function haseeb(){
        Storage::put('btcresponse.txt', 'haseeb haseeb');
      return;
       
    }
}
