@extends('layouts.app')

@section('content')
	<!--Begin::Row-->
	@cannot('view backend')
		<!-- Promotinal notification -->
		<p class="marquee marquee2 sliding-notification">
			<span>{{ $notificationText }} -&nbsp;</span>
		</p>
		<div class="row mt-5">
			<div class="col-sm-12 col-md-12 col-xl-12">
				<!--begin::Stats Widget 13-->
				<a href="javascript::void(0)" class="card card-custom bg-danger bg-hover-state-danger card-stretch gutter-b daily-background">
					<!--begin::Body-->
					<div class="card-body">
						<div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5 text-center">Current Balance</div>
						<div class="font-weight-bold text-inverse-white text-center font-23">${{ auth()->user()->payment ? auth()->user()->payment->current_balance : '0' }}</div>

						@if( auth()->user()->payment 
							&&
							auth()->user()->payment->current_balance>0)
							<button class="transfer-payment-btn pull-right" data-toggle="modal" data-target="#reinvest">Reinvest</button>
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
						<div class="font-weight-bold text-inverse-white font-23">${{ auth()->user()->getDailyRoi() }}
							<button onclick="window.location.href='{{ url('user/payment/roi/transfer') }}'" class="transfer-payment-btn pull-right" >Transfer</button>
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
						<div class="font-weight-bold text-inverse-white font-23">${{ auth()->user()->getDailyTeamBonus() }}
							<button onclick="window.location.href='{{ url('user/payment/team/bonus/transfer') }}'" class="transfer-payment-btn pull-right" >Transfer</button>
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
						<div class="font-weight-bold text-inverse-white font-23">${{ auth()->user()->getTotalRoi() }}</div>
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
						<div class="font-weight-bold text-inverse-white font-23">${{ auth()->user()->getTeamBonus() }}</div>
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
						<div class="font-weight-bold text-inverse-white font-23">${{ auth()->user()->totalDeposit() }}</div>
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
						<div class="font-weight-bold text-inverse-white font-23">${{ auth()->user()->totalWithdraw() }}</div>
					</div>
					<!--end::Body-->
				</a>
				<!--end::Stats Widget 13-->
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1 mt-5">
				<h4>Refferal Link<h4/>
				<input type="text" class="form-control mb-5" readonly value="{{ url('/register') . '?ref=' . encrypt(auth()->user()->id) }}">
			</div>
		</div>
		{{-- <div class="row pull-right">
			<div class="container">
			<button class="btn btn-danger" data-toggle="modal" data-target="#myModal">Refund Amount</button>
			</div>
		</div> --}}
	@endcannot
	@if(auth()->user()->id==1)
	<div class="row">
		<div class="col-sm-12 col-md-12 col-xl-12">
			{{ Form::open(array('route' => 'admin.roi.update','class' => 'kt-form')) }}
		        <div class="form-group row">
		            <div class="col-md-12">
		                <div class="form-group{{ $errors->has('daily_roi_value') ? ' has-error' : '' }}">
		                    {!! Form::label('daily_roi_value', 'Daily ROI') !!}
		                    {!! Form::number('daily_roi_value', App\Models\BonusValue::find(1)->value, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Please enter Roi amount']) !!}
		                    <small class="text-danger">{{ $errors->first('daily_roi_value') }}</small>
		                </div>
		            </div>
		        </div><!--form-group-->
		        <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update')</button>
		    {{ Form::close() }}
		</div>
	</div>
	<div class="row mt-5">
		<div class="col-sm-12 col-md-6 col-xl-4">
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
					<div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5">Total Users</div>
					<div class="font-weight-bold text-inverse-white font-23">{{ totalUsers() }}</div>
				</div>
				<!--end::Body-->
			</a>
			<!--end::Stats Widget 15-->
		</div>
		<div class="col-sm-12 col-md-6 col-xl-4">
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
					<div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5">Total Unpaid Users</div>
					<div class="font-weight-bold text-inverse-white font-23">{{ totalUnpaidUsers() }}</div>
				</div>
				<!--end::Body-->
			</a>
			<!--end::Stats Widget 14-->
		</div>

		<div class="col-sm-12 col-md-6 col-xl-4">
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
					<div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5">Total Deposit</div>
					<div class="font-weight-bold text-inverse-white font-23">{{ totalDeposit() }}</div>
				</div>
				<!--end::Body-->
			</a>
			<!--end::Stats Widget 14-->
		</div>

		
	</div>
	<!--End::Row-->
	<div class="row mt-5">
		<div class="col-sm-12 col-md-6 col-xl-4">
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
					<div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5">Total Withdraw</div>
					<div class="font-weight-bold text-inverse-white font-23">{{ totalWithdraw() }}</div>
				</div>
				<!--end::Body-->
			</a>
			<!--end::Stats Widget 14-->
		</div>

		<div class="col-sm-12 col-md-6 col-xl-4">
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
					<div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5">Total Pending Withdraw Requests</div>
					<div class="font-weight-bold text-inverse-white font-23">{{ totalPendingWithdrawRequests() }}</div>
				</div>
				<!--end::Body-->
			</a>
			<!--end::Stats Widget 14-->
		</div>

		<div class="col-sm-12 col-md-6 col-xl-4">
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
					<div class="text-inverse-white font-weight-bolder font-25 font-size-h5 mb-2 mt-5">Total Approved Withdraw Requests</div>
					<div class="font-weight-bold text-inverse-white font-23">{{ totalApprovedWithdrawRequests() }}</div>
				</div>
				<!--end::Body-->
			</a>
			<!--end::Stats Widget 14-->
		</div>
	</div>
	@endif

	<div id="reinvest" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	    	{{ Form::open(array('route' => array('user.payment.reinvest'),'method' => 'POST')) }}
		      	{{-- <div class="modal-header">
		        	<button type="button" class="pull-right close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Modal Header</h4>
		      	</div> --}}
		      	<div class="modal-body">
		       		<p>Amount:</p>
		       		<input class="form-control" type="number" min="1" max="{{ auth()->user()->payment ? auth()->user()->payment->current_balance : '0' }}" name="amount" required/>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		      		<button type="submit" class="btn btn-primary" >Reinvest</button>
		      	</div>
		  	{{ Form::close() }}
	    </div>

	  </div>
	</div>

	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      {{-- <div class="modal-header">
	        <button type="button" class="pull-right close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Modal Header</h4>
	      </div> --}}
	      <div class="modal-body">
	        <p>You can not refund your amount. You have not completed your 18 months.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
@endsection
