@extends('layouts.admin')
@section('title', 'รายการบทคัดย่อ')
@section('final', 'active')

@section('content')
    <div class="container my-4">
        {{-- filter --}}
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-3">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="ค้นหาชื่อบทคัดย่อ / ผู้จัดทำ"
                    value="{{ request('search') }}"
                >
            </div>
            <div class="col-md-2">
                <select name="finalStatus" class="form-select">
                    <option value="">สถานะการส่งเอกสารทั้งหมด</option>

                    <option value="pending"
                        @selected(request('finalStatus') == 'pending')>
                        ยังไม่ส่ง
                    </option>

                    <option value="done"
                        @selected(request('finalStatus') == 'done')>
                        ส่งแล้ว
                    </option>
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
            <div class="col-md-3">
                <select name="group" class="form-select">
                    <option value="">ทุกกลุ่มนำเสนอ</option>
                    @foreach($abstractGroups as $group)
                        <option value="{{ $group->id }}"
                            @selected(request('group') == $group->id)>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-lg-1">
                <button class="btn btn-primary w-100">ค้นหา</button>
            </div>
            <div class="col-md-2 col-lg-1">
                <a href="{{ route('admin.submission.accepted.index') }}" class="btn btn-outline-secondary w-100">
                    ล้างค่า
                </a>
            </div>
            <div class="col-md-2 col-lg-1">
                <a href="{{ route('admin.submission.accepted.export', request()->query()) }}"
                    class="btn btn-success w-100">
                    Export
                </a>
            </div>
        </form>

        {{-- table --}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered fs-6 text table-hover">
                <thead class="table-light align-middle">
                    <tr>
                        <th class="text-center">#</th>
                        <th>ชื่อบทคัดย่อภาษาไทย</th>
                        <th>ชื่อบทคัดย่อภาษาอังกฤษ</th>
                        <th>ผู้จัดทำ</th>
                        <th>ประเภทการนำเสนอ</th>
                        <th>กลุ่มนำเสนอหลัก</th>
                        <th>กลุ่มนำเสนอรอง</th>
                        <th>สถานะการส่งเอกสาร</th>
                        <th>แก้ไข</th>
                        <th>ไฟล์</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $i => $submission)
                        <tr>
                            <td class="text-center">
                                {{ $submissions->firstItem() + $i }}
                            </td>
                            <td>
                                {{ $submission->title_th }}
                            </td>
                            <td>
                                {{ $submission->title_en }}
                            </td>
                            <td>
                                {{ $submission->user->profile->firstname . ' ' . $submission->user->profile->lastname }}
                            </td>
                            <td>
                                {{ $submission->user->profile->presentation_type->minLabel() }}
                            </td>
                            <td>
                                {{ $submission->abstractGroups[0]->name }}
                            </td>
                            <td>
                                @if (! empty($submission->abstractGroups[1]))
                                    {{ $submission->abstractGroups[1]->name }}
                                @else
                                    ไม่มี
                                @endif
                            </td>
                            <td>
                                @if ($submission->finalSubmitted)
                                    ส่งแล้ว
                                @else
                                    ยังไม่ส่ง
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.submission.show', $submission) }}">
                                    <h5 class="m-0"><i class="fa fa-edit"></i></h5>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.submission.folder', $submission) }}">
                                    <h5 class="m-0"><i class="fa fa-folder"></i></h5>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- pagination --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $submissions->links() }}
        </div>
    </div>
@endsection