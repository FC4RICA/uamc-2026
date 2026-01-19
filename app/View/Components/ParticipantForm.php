<?php

namespace App\View\Components;

use App\Enums\AcademicTitle;
use App\Enums\Education;
use App\Enums\ParticipationType;
use App\Enums\PresentationType;
use App\Enums\Title;
use App\Models\Occupation;
use App\Models\Organization;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ParticipantForm extends Component
{
    public array $titles;
    public array $academicTitles;
    public array $education;
    public array $participationType;
    public array $presentationType;
    public Collection $organizations;
    public Collection $occupations;

    public function __construct(
        public int|string $index,
        public ?array $data = null
    ) {
        $this->titles = Title::cases();
        $this->academicTitles = AcademicTitle::cases();
        $this->education = Education::cases();
        $this->participationType = ParticipationType::cases();
        $this->presentationType = PresentationType::cases();
        $this->organizations = Organization::all();
        $this->occupations = Occupation::all();
    }

    
    public function render(): View|Closure|string
    {
        return view('components.participant-form');
    }
}
