<?php

namespace App\Http\Requests;

use App\Enums\PresentationType;
use Illuminate\Foundation\Http\FormRequest;

class CreateFinalSubmissionRequest extends FormRequest
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

        return $this->user()->can('createFinal', $submission);
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
            'recommendation_letter' => ['required','file','mimes:pdf', 'max:51200'],
        ];

        if ($submission->presentation_type == PresentationType::ORAL) {
            $rules['extended_abstract'] = ['required','file','mimes:pdf', 'max:51200'];
            $rules['poster'] = ['prohibited'];
        }

        if ($submission->presentation_type == PresentationType::POSTER) {
            $rules['poster'] = ['required','file','mimes:pdf', 'max:51200'];
            $rules['extended_abstract'] = ['prohibited'];
        }

        return $rules;
    }
}
