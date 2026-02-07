@extends('layouts.admin')
@section('title', 'จัดการบทความ')
@section('submission', 'active')

@section('content')
    <div class="container my-4">
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
                        <th>จัดการ</th>
                        <th>ไฟล์</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $i => $submission)
                        <tr>
                            <td class="text-center">
                                {{ $i + 1 }}
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
                            <td class="text-center">
                                <a href="{{ route('admin.submission.view', $submission) }}">
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
    </div>
@endsection