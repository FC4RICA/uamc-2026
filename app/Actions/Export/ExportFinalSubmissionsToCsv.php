<?php

namespace App\Actions\Export;

use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportFinalSubmissionsToCsv
{
    public function handle($submissions, string $filename): StreamedResponse
    {
        return response()->streamDownload(function () use ($submissions) {

            $handle = fopen('php://output', 'w');

            // UTF-8 BOM for Thai
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, $this->headings());

            foreach ($submissions as $submission) {
                fputcsv($handle, $this->map($submission));
            }

            fclose($handle);

        }, $filename);
    }

    protected function headings(): array
    {
        return [
            'ชื่อบทคัดย่อภาษาไทย',
            'ชื่อบทคัดย่อภาษาอังกฤษ',
            'ประเภทการนำเสนอ',
            'คำสำคัญ',
            'ผู้จัดทำ',
            'กลุ่มนำเสนอหลัก',
            'กลุ่มนำเสนอรอง',
            'สถานะการส่งเอกสาร',
            'ส่งเมื่อ',
            'สร้างเมื่อ',
            'ไฟล์',
        ];
    }

    protected function map($s): array
    {
        return [
            $s->title_th,

            $s->title_en,

            $s->presentation_type->minLabel(),

            $s->keywords,

            $s->user->profile->firstname . ' ' . $s->user->profile->lastname,

            $s->abstractGroups[0]->name,

            $s->abstractGroups[1]?->name ?? 'ไม่มี',

            $s->finalSubmitted ? 'ยังไม่ส่ง' : 'ส่งแล้ว',

            $s->finalRound()->created_at->format('j M g:i A'),

            $s->created_at->format('j M g:i A'),

            $this->folderUrl($s),
        ];
    }

    protected function folderUrl($submission): string
    {
        if (! $submission->drive_folder_id) {
            return '-';
        }

        return 'https://drive.google.com/drive/folders/' 
        . $submission->drive_folder_id;
    }
}