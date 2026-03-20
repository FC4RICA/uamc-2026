<?php

namespace App\Http\Requests;

use App\Enums\PresentationType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFinalSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $submission = $this->user()->submission;
        if (! $submission) {
            return false;
        }

        return $this->user()->can('updateFinal', $submission);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $submission = $this->user()->submission;

        $rules = [
            'recommendation_letter' => ['nullable', 'file', 'mimes:pdf', 'max:51200'],
        ];
        

        if ($submission->presentation_type == PresentationType::ORAL) {
            $rules['extended_abstract'] = ['nullable','file','mimes:pdf', 'max:51200'];
            $rules['poster'] = ['prohibited'];
            $rules['revised_abstract'] =  ['nullable','file','mimes:pdf', 'max:51200'];
        }

        if ($submission->presentation_type == PresentationType::POSTER) {
            $rules['poster'] = ['nullable','file','mimes:pdf', 'max:51200'];
            $rules['extended_abstract'] = ['prohibited'];
            $rules['revised_abstract'] = ['prohibited'];
        }

        return $rules;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            if (
                !$this->hasFile('extended_abstract') &&
                !$this->hasFile('revised_abstract') &&
                !$this->hasFile('poster') &&
                !$this->hasFile('recommendation_letter')
            ) {
                $validator->errors()->add(
                    'files',
                    'กรุณาอัปโหลดไฟล์อย่างน้อย 1 ไฟล์'
                );
            }

        });
    }
}
