@extends('layouts.admin')
@section('title', 'การชำระเงิน')
@section('payment', 'active')

@section('content')
    <div class="container my-4">
        {{-- filter --}}
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-3 col-xl-2">
                <select name="payment" class="form-select">
                    <option value="">สถานะการชำระเงินทั้งหมด</option>
                    <option value="unpaid" @selected(request('payment') == 'unpaid')>
                        ยังไม่ได้ชำระ
                    </option>
                    <option value="submitted" @selected(request('payment') == 'submitted')>
                        ยังไม่ได้ตรวจสอบ
                    </option>
                    <option value="verified" @selected(request('payment') == 'verified')>
                        ชำระแล้ว
                    </option>
                    <option value="rejected" @selected(request('payment') == 'rejected')>
                        ถูกปฏิเสธ
                    </option>
                </select>
            </div>
            <div class="col-md-2 col-lg-1">
                <button class="btn btn-primary w-100">ค้นหา</button>
            </div>
            <div class="col-md-2 col-lg-1">
                <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary w-100">
                    ล้างค่า
                </a>
            </div>
        </form>

        {{-- table --}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered fs-6 text table-hover">
                <thead class="table-light align-middle">
                    <tr>
                        <th class="text-center">#</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>มหาวิทยาลัย/หน่วยงาน</th>
                        <th>ประเภทการเข้าร่วม</th>
                        <th>การชำระเงิน</th>
                        <th>สร้างเมื่อ</th>
                        <th>ดูข้อมูล</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $user)
                        <tr>
                            <td class="text-center">
                                {{ $users->firstItem() + $i }}
                            </td>
                            <td>
                                {{ implode(' ', [(
                                        $user->profile->academic_title->acronyms() ?? $user->profile->title->acronyms()), 
                                        $user->profile->firstname, 
                                        $user->profile->lastname
                                    ]) 
                                }}
                            </td>
                            <td>
                                {{ $user->profile->organization->name ?? $user->profile->organization_other }}
                            </td>
                            <td>
                                {{ $user->profile?->participation_type->label() ?? '-' }}
                            </td>
                            <td>
                                {{ $user->paymentStatus() }}
                            </td>
                            <td>
                                <small>{{ $user->created_at->format('j M g:i A') }}</small>
                            </td>
                            <td class="text-center">
                                <a @if ($user->hasPayment()) href="{{ route('admin.payment.show', $user) }}" @endif>
                                    <h5 class="m-0"><i class="fa fa-edit"></i></h5>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- pagination --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }}
        </div>
    </div>
@endsection