@extends('layouts.admin')
@section('title', 'รายการบทคัดย่อ')
@section('submission', 'active')

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
                <select name="status" class="form-select">
                    <option value="">ทุกสถานะ</option>
                    @foreach(\App\Enums\SubmissionStatus::filterable() as $status)
                        <option value="{{ $status->value }}"
                            @selected(request('status') == $status->value)>
                            {{ $status->label() }}
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
                        <th>ชื่อบทคัดย่อภาษาไทย</th>
                        <th>ชื่อบทคัดย่อภาษาอังกฤษ</th>
                        <th>ผู้จัดทำ</th>
                        {{-- <th>มหาวิทยาลัย</th> --}}
                        <th>กลุ่มนำเสนอหลัก</th>
                        <th>กลุ่มนำเสนอรอง</th>
                        <th>สถานะ</th>
                        <th>สร้างเมื่อ</th>
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
                            {{-- <td>
                                {{ $submission->user->profile->organization->name ?? $submission->user->profile->organization_other }}
                            </td> --}}
                            <td>
                                {{ $submission->abstractGroups[0]->name }}
                            </td>
                            <td>
                                @if ($submission->abstractGroups[1])
                                    {{ $submission->abstractGroups[1]->name }}
                                @else
                                    ไม่มี
                                @endif
                            </td>
                            <td class="text-center">
                                <h5 class="m-0"><x-status-badge :status="$submission->status" /></h5>
                            </td>
                            <td>
                                <small>{{ $submission->created_at }}</small>
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