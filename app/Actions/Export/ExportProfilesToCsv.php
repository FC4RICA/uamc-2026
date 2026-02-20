<?php

namespace App\Actions\Export;

use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportProfilesToCsv
{
    public function handle($profiles, string $filename): StreamedResponse
    {
        return response()->streamDownload(function () use ($profiles) {

            $handle = fopen('php://output', 'w');

            // UTF-8 BOM for Thai
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, $this->headings());

            foreach ($profiles as $profile) {
                fputcsv($handle, $this->map($profile));
            }

            fclose($handle);

        }, $filename);
    }

    protected function headings(): array
    {
        return [
            'คำนำหน้า',
            'ตำแหน่งทางวิชาการ',
            'ชื่อ',
            'นามสกุล',
            'มหาวิทยาลัย',
            'ประเภทการเข้าร่วม',
            'ประเภทการนำเสนอ',
            'สถานะบทคัดย่อ',
            'สถานะการชำระเงิน',
            'ประเภทโปรไฟล์',
            'สร้างเมื่อ',
            'ข้อจำกัดด้านอาหาร/ข้อมูลสุขภาพ'
        ];
    }

    protected function map($p): array
    {
        return [
            $p->title?->acronyms() ?? '-',

            $p->academic_title?->acronyms() ?? '-',

            $p->firstname,

            $p->lastname,

            $p->organization?->name
                ?? $p->organization_other,

            $p->participation_type->label(),

            $p->presentation_type?->minLabel() ?? '-',

            $p->submission()?->status->label() ?? '-',

            $p->creator?->paymentStatus() ?? '-',

            $p->user_id ? 'บัญชีผู้ใช้' : 'ผู้ร่วมผลงาน',

            $p->created_at->format('Y-m-d H:i'),

            $p->special_requirements ?? '-',
        ];
    }
}