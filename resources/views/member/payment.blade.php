@extends('layouts.member')
@section('title', 'ชำระค่าลงทะเบียน')

@section('payment', 'active')

@section('content')
<div class="container px-4 my-5">
    <div class="text-center">
        <h2><strong>ชำระค่าลงทะเบียน</strong></h2>
    </div>
    <hr class="separator">
    <div class="my-5">
        <p>รายละเอียดการชำระเงิน..........</p>
    </div>
    <form id="uploadPayment" name="uploadPayment" action='{{ route('member.payment.store') }}' method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="receipt">ใบเสร็จชำระเงิน</label>
            <input id="receipt" name="file" type="file" class="form-control" >
        </div>
        <button class="btn btn-warning" type="submit">ส่งหลักฐานการชำระเงิน</button>
    </form>
</div>
@endsection