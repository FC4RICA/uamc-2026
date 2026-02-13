@extends('layouts.admin')
@section('title', 'ผู้เข้าร่วมงาน')
@section('profile', 'active')

@section('content')
    <div class="container my-4">
        {{-- filter --}}
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-3">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="ค้นหาชื่อผู้สมัคร / มหาวิทยาลัย"
                    value="{{ request('search') }}"
                >
            </div>
            <div class="col-md-3 col-lg-2">
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
            <div class="col-md-3 col-lg-2">
                <select name="presentationType" class="form-select">
                    <option value="">ทุกประเภทการนำเสนอ</option>
                    @foreach(\App\Enums\PresentationType::cases() as $type)
                        <option value="{{ $type->value }}"
                            @selected(request('presentationType') == $type->value)>
                            {{ $type->minLabel() }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 col-xl-2">
                <select name="payment" class="form-select">
                    <option value="">สถานะการชำระเงินทั้งหมด</option>
                    <option value="not_required" @selected(request('payment') == 'not_required')>
                        ไม่ต้องชำระ
                    </option>
                    <option value="unpaid" @selected(request('payment') == 'unpaid')>
                        ยังไม่ได้ชำระ
                    </option>
                    <option value="submitted" @selected(request('payment') == 'submitted')>
                        ยังไม่ได้ตรวจสอบ
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
                <a href="{{ route('admin.profile.index') }}" class="btn btn-outline-secondary w-100">
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
                        <th>ประเภทการนำเสนอ</th>
                        <th>บทคัดย่อ</th>
                        <th>การชำระเงิน</th>
                        <th>ประเภทโปรไฟล์</th>
                        <th>สร้างเมื่อ</th>
                        <th>แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profiles as $i => $p)
                        <tr>
                            <td class="text-center">
                                {{ $profiles->firstItem() + $i }}
                            </td>
                            <td>
                                {{ implode(' ', [($p->academic_title->acronyms() ?? $p->title->acronyms()), $p->firstname, $p->lastname]) }}
                            </td>
                            <td>
                                {{ $p->organization->name ?? $p->organization_other }}
                            </td>
                            <td>
                                {{ $p->participation_type->label() }}
                            </td>
                            <td>
                                {{ $p->presentation_type?->minLabel() ?? '-' }}
                            </td>
                            <td>
                                @if ($p->submission())
                                    <a href="{{ route('admin.submission.show', $p->submission()) }}">
                                        <span class="badge bg-{{ $p->submission()->status->tone() }}">
                                            {{ $p->submission()->status->label() }}
                                        </span>
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td>
                                {{ $p->creator->paymentStatus() }}
                            </td>
                            <td>
                                @if($p->user_id)
                                    <span class="badge bg-primary">บัญชีผู้ใช้</span>
                                @else
                                    <span class="badge bg-secondary">ผู้ร่วมผลงาน</span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $p->created_at }}</small>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.profile.edit', $p) }}">
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
            {{ $profiles->links() }}
        </div>
    </div>
@endsection