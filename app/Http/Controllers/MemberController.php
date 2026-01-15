<?php

namespace App\Http\Controllers;

use App\Enums\AcademicTitle;
use App\Enums\Education;
use App\Models\Mock;
use App\Models\Organization;
use App\Enums\ParticipationType;
use App\Enums\PresentationType;
use App\Enums\Title;
use App\Models\Occupation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

class MemberController extends Controller
{
    public function index(): View
    {
        return view('member.welcome');
    }

    public function payment(): View
    {
        return view('member.payment');
    }

    public function profile(): View
    {
        $titles = Title::cases();
        $academicTitles = AcademicTitle::cases();
        $education = Education::cases();
        $participationType = ParticipationType::cases();
        $presentationType = PresentationType::cases();
        $organizations = Organization::all();
        $occupations = Occupation::all();
        
        return view('member.profile', compact('titles', 'academicTitles', 'education', 'participationType', 'presentationType', 'organizations', 'occupations'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        // Update user profile
        // need more logic to check for submission before update participation_type field
        return redirect()->route('member.profile.index');
    }

    public function createSubmission(): View
    {
        return view('member.papersubmission', [
            'categories' => [
                new Mock(['id' => 1, 'title' => 'Numerical Methods and Applications']),
                new Mock(['id' => 2, 'title' => 'Mathematical Modelling']),
                new Mock(['id' => 3, 'title' => 'Mathematics for Industry']),
                new Mock(['id' => 4, 'title' => 'Mathematics for Finance and Insurance']),
                new Mock(['id' => 5, 'title' => 'Computational Mathematics']),
                new Mock(['id' => 6, 'title' => 'Algebra and Analysis with Applications']),
            ],
        ]);
    }

    public function storeSubmission(Request $request): RedirectResponse
    {
        // store logic
        return redirect()->route('member.submission.index');
    }

    public function indexSubmission(): View
    {
        $research = new Mock;
        $research->research_id = 1;
        $research->name_th = 'แบบจำลองทางคณิตศาสตร์ของการลุกลามและการแพร่กระจายของมะเร็งรวมทั้งการรักษาโดยการกำจัดเซลล์ต้นกำเนิดมะเร็ง';
        $research->name_en = 'Mathematical modeling of cancer invasion and spread, including treatment through the elimination of cancer stem cells';
        $research->participation_type = PresentationType::ORAL;
        $research->category = 'Mathematical Modelling';
        $research->created_at = now();

        return view('member.checkstatus', [
            'results' => [
                $research
            ],
            'submission' => [
                $research
            ],
        ]);
    }

    public function editSubmission(string $id): View
    {
        $research = new Mock;
        $research->research_id = 1;
        $research->name_th = 'แบบจำลองทางคณิตศาสตร์ของการลุกลามและการแพร่กระจายของมะเร็งรวมทั้งการรักษาโดยการกำจัดเซลล์ต้นกำเนิดมะเร็ง';
        $research->name_en = 'Mathematical modeling of cancer invasion and spread, including treatment through the elimination of cancer stem cells';
        $research->participation_type = PresentationType::ORAL;
        $research->category = 'Mathematical Modelling';
        $research->category_id = 2;
        $research->category_id2 = 0;
        $research->category_id3 = 0;
        $research->created_at = now();
        $research->keyword = 'ML, modeling';
        $research->agreement = 1;

        return view('member.editpaper', [
            'research' => $research,
            'participation_type' => PresentationType::ORAL,
            'categories' => [
                new Mock(['id' => 1, 'title' => 'Numerical Methods and Applications']),
                new Mock(['id' => 2, 'title' => 'Mathematical Modelling']),
                new Mock(['id' => 3, 'title' => 'Mathematics for Industry']),
                new Mock(['id' => 4, 'title' => 'Mathematics for Finance and Insurance']),
                new Mock(['id' => 5, 'title' => 'Computational Mathematics']),
                new Mock(['id' => 6, 'title' => 'Algebra and Analysis with Applications']),
            ],
        ]);
    }

    public function updateSUbmission(string $id): RedirectResponse
    {
        // update logic

        return redirect()->route('member.submission.index');
    }

    // public function editResearch(Research $research)
    // {
    //     return view('member.editpaper', compact('research'));
    // }

    // public function updateResearch(Request $request, Research $research)
    // {
    //     // update logic
    //     return redirect()->route('member.check');
    // }

    // public function destroyResearch(Research $research)
    // {
    //     $research->delete();

    //     return redirect()->route('member.check');
    // }
}
