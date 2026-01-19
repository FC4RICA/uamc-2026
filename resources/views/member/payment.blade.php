@extends('layouts.member')
@section('title', 'ชำระค่าลงทะเบียน')

@section('payment', 'active')

@section('content')
    <div class="container px-4 mt-4 mb-5">
        <div class="text-center">
            <h2><strong>ชำระค่าลงทะเบียน</strong></h2>
        </div>
        <hr class="separator">
        <h3 class="mt-4">ข้อมูลบัญชีธนาคาร</h3>
        <div class="d-flex align-items-center">
            <img src="{{ asset('img/42b6009530863843e5f9f628ddf32c4a129c4243.png') }}" style="height: 6rem;" class="rounded"
                alt="krungsri">
            <div class="ms-4 d-flex flex-column w-full">
                <div><strong>ธนาคารกรุงศรีอยุธยา</strong></div>
                <div class="row d-flex">
                    <div>เลขบัญชี 330-1-16927-2</div>
                    <div>มจธ.-บริการวิชาการ</div>
                </div>
            </div>
        </div>
        <hr class="separator">


        <div class="row mt-4 mb-5">
            @if ($user->hasVerifiedPayment())
                <h4 class="text-success fw-bold">
                    การชำระเงินได้รับการยืนยันแล้ว
                </h4>
            @elseif ($activePayment)
                <h4 class="text-warning fw-bold">
                    ส่งหลักฐานแล้ว หากข้อมูลไม่ถูกต้อง สามารถอัพโหลดใหม่ได้
                </h4>
            @else
                <h4 class="fw-bold">
                    ผู้สมัครที่ไม่ได้มาจากมหาวิทยาลัยที่เข้าร่วมต้องชำระค่าลงทะเบียนเป็นจำนวน 100 บาท
                    เพื่อเข้าร่วมหรือส่งผลงาน
                </h4>
            @endif

            @if ($activePayment)
                <div class="mt-4">
                    <strong>ไฟล์ล่าสุด:</strong>
                    <a href="{{ route('member.payment.download', $activePayment) }}">
                        {{ $activePayment->original_file_name }}
                    </a>
                    <span class="badge bg-success @if ($activePayment->status->rejected()) bg-danger @endif ms-2">
                        {{ $activePayment->status->label() }}
                    </span>
                </div>
            @endif
        </div>


        @if (!$user->hasVerifiedPayment())
            <h3 class="mt-4">
                {{ $activePayment ? 'อัพโหลดใหม่เพื่อแก้ไขข้อมูล' : 'อัพโหลดหลักฐานการชำระเงิน' }}
            </h3>
            <form id="uploadPayment" name="uploadPayment" action='{{ route('member.payment.store') }}' method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="payment_at">วันที่และเวลาที่โอนเงินตามหลักฐานการชำระเงิน</label>
                            <input id="payment_at" name="payment_at" value="{{ old('payment_at') }}"
                                class="form-control @error('payment_at') border-danger @enderror" type="datetime-local"
                                placeholder="วันที่โอนเงิน" required>
                            @error('payment_at')
                                <label for="payment_at" class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 ">
                        <div class="form-group">
                            <label for="account_name">ชื่อบัญชีผู้โอน</label>
                            <input id="account_name" name="account_name" value="{{ old('account_name') }}"
                                class="form-control @error('account_name') border-danger @enderror" type="text"
                                placeholder="ชื่อบัญชี" required>
                            @error('account_name')
                                <label for="account_name" class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 ">
                        <div class="form-group">
                            <label for="from_bank">โอนจากบัญชีธนาคาร</label>
                            <input id="from_bank" name="from_bank" value="{{ old('from_bank') }}" type="text"
                                class="form-control @error('from_bank') border-danger @enderror" placeholder="ชื่อธนาคาร"
                                required>
                            @error('from_bank')
                                <label for="from_bank" class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 ">
                        <div class="form-group">
                            <label for="price">จำนวนเงิน (บาท)</label>
                            <input id="price" name="price" type="number" class="form-control" value="100"
                                disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 ">
                        <div class="form-group">
                            <label for="receipt">อัพโหลดหลักฐานการชำระเงิน</label>
                            <input id="receipt" name="file" type="file"
                                class="form-control @error('file') border-danger @enderror" required>
                            @error('file')
                                <label for="receipt" class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 ">
                    <button class="btn btn-warning" type="submit" id="submit-payment">
                    ส่งหลักฐานการชำระเงิน</button>
                    <div>
            </form>
        @endif
    </div>
@endsection
