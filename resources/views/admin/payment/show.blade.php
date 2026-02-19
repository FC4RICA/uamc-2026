@extends('layouts.admin')
@section('title', 'การชำระเงิน')
@section('payment', 'active')

@section('content')
    <div class="container px-4 mt-4 mb-5">
        <div class="text-center">
            <h2><strong>การชำระค่าลงทะเบียน</strong></h2>
        </div>
        <hr class="separator">

        <h3 class="mt-4">บัญชีผู้ใช้</h3>
        <div class="row align-items-end">
            <div class="col-12 col-sm-6 form-group">
                <input class="form-control-plaintext" disabled
                    value="{{ implode(' ', [(
                        $user->profile->academic_title->acronyms() ?? $user->profile->title->acronyms()), 
                        $user->profile->firstname, 
                        $user->profile->lastname
                    ])}}">
            </div>
            <div class="col-12 col-sm-6 form-group">
                <input class="form-control-plaintext" disabled
                    value="{{ $user->profile->organization->name ?? $user->profile->organization_other }}">
            </div>
        </div>

        <hr class="separator">

        <div class="row mt-4 mb-5">
            @foreach ($user->payments()->latest()->get() as $payment)
            <div class="col-12 col-xxl-6 mb-4">
                <x-payment-card :paymen="$payment" />
            </div>
            @endforeach
        </div>

    </div>
@endsection

@push('scripts')
    @vite('resources/js/pages/admin/payment.js')
@endpush