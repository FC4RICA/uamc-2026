@extends('layouts.admin')
@section('title', 'จัดการผู้ใช้งาน')
@section('user', 'active')

@section('content')
    <div class="container my-4">
        {{-- filter --}}
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-3">
                <select name="role" class="form-select">
                    <option value="">ผู้ใช้งานทั้งหมด</option>
                    <option value="member" @selected(request('role') == 'member')>
                        สมาชิก
                    </option>
                    <option value="admin" @selected(request('role') == 'admin')>
                        แอดมิน
                    </option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="participationType" class="form-select">
                    <option value="">ทุกประเภทการเข้าร่วม</option>
                    @foreach(\App\Enums\ParticipationType::cases() as $type)
                        <option value="{{ $type->value }}"
                            @selected(request('participationType') == $type->value)>
                            {{ $type->label() }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="submission" class="form-select">
                    <option value="">สถานะการส่งบทคัดย่อทั้งหมด</option>
                    <option value="submitted" @selected(request('submission') == 'submitted')>
                        ส่งแล้ว
                    </option>
                    <option value="not_submitted" @selected(request('submission') == 'not_submitted')>
                        ยังไม่ได้ส่ง
                    </option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="payment" class="form-select">
                    <option value="">สถานะการชำระเงินทั้งหมด</option>
                    <option value="not_required" @selected(request('payment') == 'not_required')>
                        ไม่ต้องชำระ
                    </option>
                    <option value="unpaid" @selected(request('payment') == 'unpaid')>
                        ยังไม่ได้ชำระ
                    </option>
                    <option value="submitted" @selected(request('payment') == 'submitted')>
                        ส่งหลักฐานแล้ว
                    </option>
                    <option value="verified" @selected(request('payment') == 'verified')>
                        ชำระแล้ว
                    </option>
                </select>
            </div>
            <div class="col-md-2 col-lg-1">
                <button class="btn btn-primary w-100">ค้นหา</button>
            </div>
            <div class="col-md-2 col-lg-1">
                <a href="{{ route('admin.submission.index') }}" class="btn btn-outline-secondary w-100">
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
                        <th>อีเมล</th>
                        <th>ประเภทผู้ใช้</th>
                        <th>ประเภทการเข้าร่วม</th>
                        <th>ส่งบทคัดย่อ</th>
                        <th>ชำระเงิน</th>
                        <th>สร้างเมื่อ</th>
                        <th>ดูข้อมูลผู้ใช้</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $user)
                        <tr>
                            <td class="text-center">
                                {{ $users->firstItem() + $i }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                {{ $user->isAdmin() ? 'แอดมิน' : 'สมาชิก' }}
                            </td>
                            <td>
                                {{ $user->profile?->participation_type->label() ?? '' }}
                            </td>
                            <td>
                                {{ $user->isPresenter() ? ($user->hasSubmission() ? 'ส่งแล้ว' : 'ยังไม่ได้ส่ง') : '-' }}
                            </td>
                            <td>
                                {{ $user->payment_required ? ($user->hasPayment() ? ($user->hasVerifiedPayment() ? 'ชำระแล้ว' : 'ยังไม่ได้ตรวจสอบ') : 'ยังไม่ได้ชำระ') : 'ไม่ต้องชำระ' }}
                            </td>
                            <td>
                                {{ $user->created_at }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.profile.show', $user) }}">
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