@extends('layouts.app')

@section('title', __('Tracking App'))

@section('content')
<!-- begin:: Content -->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @lang('Users Management')
                <small class="text-muted">@lang('View')</small>
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#" data-target="#kt_tabs_overview">Details</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="kt_tabs_overview" role="tabpanel">
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <!--begin::Section-->
                        <div class="kt-section">
                            <div class="kt-section__content">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>@lang('Name')</th>
                                            <td>{{ $user->full_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('User Name')</th>
                                            <td>{{ $user->user_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Email')</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Blockchain Address')</th>
                                            <td>
                                                <span class="label label-warning label-pill label-inline mr-2">{{ $user->block_chain_address }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Bank Account No')</th>
                                            <td>
                                                <span class="label label-warning label-pill label-inline mr-2">{{ $user->bank_account_no }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Bank Name')</th>
                                            <td>
                                                <span class="label label-warning label-pill label-inline mr-2">{{ $user->bank_name }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Bank User Title')</th>
                                            <td>
                                                <span class="label label-warning label-pill label-inline mr-2">{{ $user->bank_user_title }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Bank Branch Code')</th>
                                            <td>
                                                <span class="label label-warning label-pill label-inline mr-2">{{ $user->bank_branch_code }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Status')</th>
                                            <td>@include('admin.user.includes.status', ['user' => $user])</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Confirmed')</th>
                                            <td>@include('admin.user.includes.confirm', ['user' => $user])</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Mobile')</th>
                                            <td>{{ $user->profile->mobile_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('Date of Birth')</th>
                                            <td>{{ $user->profile->birthday }}</td>
                                        </tr>

                                        <tr>
                                            <th>@lang('Street')</th>
                                            <td>{{ $user->profile->street }}</td>
                                        </tr>

                                        <tr>
                                            <th>@lang('City')</th>
                                            <td>{{ $user->profile->city }}</td>
                                        </tr>

                                        <tr>
                                            <th>@lang('Post Code')</th>
                                            <td>{{ $user->profile->post_code }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <!--begin::Stats Widget 13-->
                        <a href="javascript::void(0)" class="card card-custom bg-danger bg-hover-state-danger card-stretch gutter-b daily-background">
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5 text-center">Current Balance</div>
                                <div class="font-weight-bold text-inverse-white text-center font-23">${{ $user->payment ? $user->payment->current_balance : '0' }}</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 13-->
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <!--begin::Stats Widget 13-->
                        <a href="javascript::void(0)" class="card card-custom bg-danger bg-hover-state-danger card-stretch gutter-b daily-background">
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5 text-center">Total Tokens</div>
                                <div class="font-weight-bold text-inverse-white text-center font-23">{{ auth()->user() ? auth()->user()->total_tokens : '0' }}
                                    <br>
                                    <small>
                                        Today Token Value: ${{\App\Models\BonusValue::find(3)->value}}
                                    </small>
                                </div>
                                @if( auth()->user()->total_tokens>0)
                                    <button class="transfer-payment-btn pull-right" data-toggle="modal" data-target="#sell">Sell</button>
                                @endif
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 13-->
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-sm-6 col-md-6 col-xl-6">
                        <!--begin::Stats Widget 15-->
                        <a href="javascript::void(0)" class="card card-custom daily-background bg-hover-state-success card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5">Daily ROI</div>
                                <div class="font-weight-bold text-inverse-white font-23">${{ $user->getDailyRoi() }}
                                </div>
                                
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 15-->
                    </div>
                    <div class="col-sm-6 col-md-6 col-xl-6">
                        <!--begin::Stats Widget 14-->
                        <a href="javascript::void(0)" class="card card-custom daily-background bg-hover-state-primary card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                            <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5">Daily Team Bonus</div>
                                <div class="font-weight-bold text-inverse-white font-23">${{ $user->getDailyTeamBonus() }}
                                </div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 14-->
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-sm-6 col-md-6 col-xl-6">
                        <!--begin::Stats Widget 15-->
                        <a href="javascript::void(0)" class="card card-custom total-amount-boxes-background bg-hover-state-success card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5">Total ROI</div>
                                <div class="font-weight-bold text-inverse-white font-23">${{ $user->getTotalRoi() }}</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 15-->
                    </div>           
                    <div class="col-sm-6 col-md-6 col-xl-6">
                        <!--begin::Stats Widget 14-->
                        <a href="javascript::void(0)" class="card card-custom total-amount-boxes-background bg-hover-state-primary card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                            <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5">Total Team Bonus</div>
                                <div class="font-weight-bold text-inverse-white font-23">${{ $user->getTeamBonus() }}</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 14-->
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-sm-6 col-md-6 col-xl-6">
                        <!--begin::Stats Widget 13-->
                        <a href="javascript::void(0)" class="card card-custom total-amount-boxes-background bg-hover-state-danger card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Shopping/Cart3.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5">Total Deposit</div>
                                <div class="font-weight-bold text-inverse-white font-23">${{ $user->totalDeposit() }}</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 13-->
                    </div>
                    <div class="col-sm-6 col-md-6 col-xl-6">
                        <!--begin::Stats Widget 13-->
                        <a href="javascript::void(0)" class="card card-custom total-amount-boxes-background bg-hover-state-danger card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Shopping/Cart3.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5">Total Withdraw</div>
                                <div class="font-weight-bold text-inverse-white font-23">${{ $user->totalWithdraw() }}</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 13-->
                    </div>
                </div>

                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <h4 style="color:blue">Withdraw Requests</h4>
                        <h5 class="pull-right">Total Withdraw: ${{ $user->isCustomer() ? $user->totalWithdraw() : ''}}</h5><hr>
                        <table id="abc" class="table table-striped- table-bordered table-hover table-checkable display table-admin_tables">
                            <thead>
                                <tr>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentRequests->where('type',"withdraw") as $request)
                                <tr>
                                    <td>{{ $request->amount }}</td>
                                    <td>{{ $request->date }}</td>
                                    <td>{!! $request->status_label !!}</td>
                                    <td>
                                        @if($request->status==0)
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                            <a href="{{ route('admin.payment.withdraw.request.action', ['flag'=>encrypt(1),'id'=>encrypt($request->id),'user_id'=>encrypt($request->user->id)]) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="View">Accept</a>
                                            <a href="{{ route('admin.payment.withdraw.request.reject.form', ['flag'=>encrypt(2),'id'=>encrypt($request->id),'user_id'=>encrypt($request->user->id)]) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="View">Reject</a>
                                        </div>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <h4 style="color:blue">Deposit Requests</h4>
                        <h5 class="pull-right">Total Deposit: ${{ $user->isCustomer() ? $user->totalDepositedAmount() : ''}}</h5>
                        <hr>
                        <table id="abc" class="table table-striped- table-bordered table-hover table-checkable display table-admin_tables">
                            <thead>
                                <tr>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Type')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentRequests
                                            ->where('type',"deposit")
                                            ->where('status',1) as $request)
                                <tr>
                                    <td>{{ $request->date }}</td>
                                    <td>{{ $request->amount }}</td>
                                    <td>
                                        @if($request->subType==1)
                                            <span class="badge badge-success">Reinvested</badge> 
                                        @else
                                            <span class="badge badge-warning">Normal</span>

                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-primary" type="submit">@lang('Bsck to List')</a>
        </div>
    </div>
</div>
<!-- end:: Content -->
@endsection