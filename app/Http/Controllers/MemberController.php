<?php

namespace App\Http\Controllers;

use App\Models\Mock;
use App\Models\Organization;
use App\Models\User;
use App\Models\Research;
use App\Enums\ParticipationType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class MemberController extends Controller
{
    private function mockAuthUser(): void
    {
        $user = new User();
        $user->id = 999;
        $user->name = 'จิรายุ';
        $user->lastname = 'รัตนประเสริฐ';
        $user->email = 'staging@example.com';
        $user->participation_type = ParticipationType::Oral;
        $user->prefix = 'นาย';
        $user->position = 1;
        $user->education = 1;
        $user->occupation = 'นิสิต นักศึกษา';
        $user->organization = 3;
        $user->phone = '0123456789';

        Auth::setUser($user);
    }

    public function index(): View
    {
        $this->mockAuthUser();
        return view('member.welcome');
    }

    public function indexProfile(): View
    {
        $this->mockAuthUser();

        $orgs = [
            new Organization(['id' => 1, 'title' => 'มหาวิทยาลัยศิลปากร']),
            new Organization(['id' => 2, 'title' => 'สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง']),
            new Organization(['id' => 3, 'title' => 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี']),
            new Organization(['id' => 4, 'title' => 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ']),
            new Organization(['id' => 5, 'title' => 'มหาวิทยาลัยเทคโนโลยีสุรนารี']),
        ];
        

        return view('member.profile', [
            'organ' => $orgs,
            'incorrect' => 0
        ]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        return redirect()->route('member.profile.index');
    }

    public function createSubmission(): View
    {
        $this->mockAuthUser();

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
        $this->mockAuthUser();

        $research = new Mock;
        $research->research_id = 1;
        $research->name_th = 'แบบจำลองทางคณิตศาสตร์ของการลุกลามและการแพร่กระจายของมะเร็งรวมทั้งการรักษาโดยการกำจัดเซลล์ต้นกำเนิดมะเร็ง';
        $research->name_en = 'Mathematical modeling of cancer invasion and spread, including treatment through the elimination of cancer stem cells';
        $research->participation_type = ParticipationType::Oral;
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
        $this->mockAuthUser();

        $research = new Mock;
        $research->research_id = 1;
        $research->name_th = 'แบบจำลองทางคณิตศาสตร์ของการลุกลามและการแพร่กระจายของมะเร็งรวมทั้งการรักษาโดยการกำจัดเซลล์ต้นกำเนิดมะเร็ง';
        $research->name_en = 'Mathematical modeling of cancer invasion and spread, including treatment through the elimination of cancer stem cells';
        $research->participation_type = ParticipationType::Oral;
        $research->category = 'Mathematical Modelling';
        $research->category_id = 2;
        $research->category_id2 = 0;
        $research->category_id3 = 0;
        $research->created_at = now();
        $research->keyword = 'ML, modeling';
        $research->agreement = 1;

        return view('member.editpaper', [
            'research' => $research,
            'participation_type' => ParticipationType::Oral,
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
