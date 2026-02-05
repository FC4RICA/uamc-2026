@extends('layouts.admin')
@section('title', 'Administrator Dashboard')
@section('dashboard', 'active')

@section('content')
    <div class="container my-4">
        <div class="row g-3 mb-2">
            <div class="col-md-3 col-sm-6 mb-3">
                <x-metric-card title="ผู้ใช้งานทั้งหมด" :value="$metrics['users_total']" icon="fa-users" color="primary" class="text-bg-light"/>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <x-metric-card title="ผู้เข้าร่วมทั้งหมด" :value="$metrics['attendees']" icon="fa-user" color="info" class="text-bg-light"/>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <x-metric-card title="ผู้นำเสนอทั้งหมด" :value="$metrics['presenters']" icon="fa-microphone" color="success" class="text-bg-light"/>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <x-metric-card title="ผลงานที่ส่งทั้งหมด" :value="$metrics['submissions']" icon="fa-file-alt" color="warning" class="text-bg-light"/>
            </div>
        </div>

        <div class="row g-3 mb-2">
            <h4 class="fw-bold text-secondary mb-0">ผลงานบทคัดย่อ</h4>
            <div class="col-md-3 col-sm-6 mb-3 mt-0">
                <x-metric-card title="รอตรวจ" :value="$metrics['pending_submission']" icon="fa-hourglass-half" color="warning"/>
            </div>
            <div class="col-md-3 col-sm-6 mb-3 mt-0">
                <x-metric-card title="รอปรับปรุงใหม่" :value="$metrics['revised_submission']" icon="fa-pen" color="primary" />
            </div>
            <div class="col-md-3 col-sm-6 mb-3 mt-0">
                <x-metric-card title="ผ่านการคัดเลือก" :value="$metrics['accepted_submission']" icon="fa-check-circle" color="success" />
            </div>
            <div class="col-md-3 col-sm-6 mb-3 mt-0">
                <x-metric-card title="ไม่ผ่าน" :value="$metrics['rejected_submission']" icon="fa-times-circle" color="secondary" />
            </div>
        </div>

        <div class="row g-3 mb-2">
            <h4 class="fw-bold text-secondary mb-0">การชำระเงิน</h4>
            <div class="col-md-4 col-sm-4 mb-3 mt-0">
                <x-metric-card title="รอการชำระเงิน" :value="$metrics['pending_payment']" icon="fa-money-bill-wave" color="danger"/>
            </div>
            <div class="col-md-4 col-sm-4 mb-3 mt-0">
                <x-metric-card title="รอการยืนยัน" :value="$metrics['submitted_payment']" icon="fa-hourglass-half" color="warning" />
            </div>
            <div class="col-md-4 col-sm-4 mb-3 mt-0">
                <x-metric-card title="ชำระแล้ว" :value="$metrics['verified_payment']" :total="$metrics['required_payment']" icon="fa-check" color="success" />
            </div>
        </div>

        <div class="row g-3">
            <h3 class="fw-bold mb-0">ตั้งค่าสถานะ</h3>
            @foreach($toggles as $toggle)
                <div class="col-12 col-lg-6 col-xl-4">
                    <x-status-toggle-card
                        :label="$toggle['config']['label']"
                        :enabled="$toggle['status']"
                        :action="$toggle['route']"
                    />
                </div>
            @endforeach
        </div>
    </div>
@endsection