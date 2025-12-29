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

class AdminController extends Controller
{
    private function mockAdminUser(): void
    {
        $user = new User();
        $user->id = 999;
        $user->name = 'SuperAdmin';

        Auth::setUser($user);
    }

    public function index(): View
    {
        $this->mockAdminUser();
        return view('admin.dashboard');
    }

    public function indexSubmission(): View
    {
        $this->mockAdminUser();

        $paper = new Mock();
        $paper->id = 1;
        $paper->name = 'จิรายุ';
        $paper->lastname = 'รัตนประเสริฐ';
        $paper->name_th = 'แบบจำลองทางคณิตศาสตร์ของการลุกลามและการแพร่กระจายของมะเร็งรวมทั้งการรักษาโดยการกำจัดเซลล์ต้นกำเนิดมะเร็ง';
        $paper->name_en = 'Mathematical modeling of cancer invasion and spread, including treatment through the elimination of cancer stem cells';
        $paper->organization = 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี';
        $paper->decision = 0;


        return view('admin.managepaper', [
            'search' => null,
            'paper_data' => [$paper, $paper, $paper, $paper, $paper, $paper]
        ]);
    }

    public function showSubmission(string $id): View
    {
        $this->mockAdminUser();

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
        $research->decision = 0;
        $research->commitee1 = null;
        $research->commitee2 = null;
        $research->commitee3 = null;
        $research->commitee4 = null;
        $research->commitee5 = null;

        return view('admin.editpaper', [
            'paper' => $research,
            'types' => ParticipationType::cases(),
            'categories' => [
                new Mock(['id' => 1, 'title' => 'Numerical Methods and Applications']),
                new Mock(['id' => 2, 'title' => 'Mathematical Modelling']),
                new Mock(['id' => 3, 'title' => 'Mathematics for Industry']),
                new Mock(['id' => 4, 'title' => 'Mathematics for Finance and Insurance']),
                new Mock(['id' => 5, 'title' => 'Computational Mathematics']),
                new Mock(['id' => 6, 'title' => 'Algebra and Analysis with Applications']),
            ],
            'committee' => [
                new Mock(['id' => 1, 'name' => 'ธรรมนิตย์', 'lastname' => 'เกษมทรัพย์', 'organization' => 'มหาวิทยาลัยศิลปากร']),
                new Mock(['id' => 2, 'name' => 'ณัท', 'lastname' => 'ศรีทอง', 'organization' => 'สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง']),
                new Mock(['id' => 3, 'name' => 'กิตติ', 'lastname' => 'ประชายุต', 'organization' => 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี']),
                new Mock(['id' => 4, 'name' => 'รัญชนา', 'lastname' => 'กาญจนาศักดาพร', 'organization' => 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ']),
                new Mock(['id' => 5, 'name' => 'จันทราภา', 'lastname' => 'ขวัญแก้ว', 'organization' => 'มหาวิทยาลัยเทคโนโลยีสุรนารี']),
                new Mock(['id' => 6, 'name' => 'กันยา', 'lastname' => 'แสงดารา', 'organization' => 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี']),
            ]
        ]);
    }

    public function indexCommittee(): View
    {
        $this->mockAdminUser();
        return view('admin.committee', [
            'search' => '',
            'committee' => [
                new Mock(['id' => 1, 'title' => 'ศาสตราจารย์', 'name' => 'ธรรมนิตย์', 'lastname' => 'เกษมทรัพย์', 'organization' => 'มหาวิทยาลัยศิลปากร']),
                new Mock(['id' => 2, 'title' => 'ศาสตราจารย์', 'name' => 'ณัท', 'lastname' => 'ศรีทอง', 'organization' => 'สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง']),
                new Mock(['id' => 3, 'title' => 'ศาสตราจารย์', 'name' => 'กิตติ', 'lastname' => 'ประชายุต', 'organization' => 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี']),
                new Mock(['id' => 4, 'title' => 'ศาสตราจารย์', 'name' => 'รัญชนา', 'lastname' => 'กาญจนาศักดาพร', 'organization' => 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ']),
                new Mock(['id' => 5, 'title' => 'ศาสตราจารย์', 'name' => 'จันทราภา', 'lastname' => 'ขวัญแก้ว', 'organization' => 'มหาวิทยาลัยเทคโนโลยีสุรนารี']),
                new Mock(['id' => 6, 'title' => 'ศาสตราจารย์', 'name' => 'กันยา', 'lastname' => 'แสงดารา', 'organization' => 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี']),
            ],

        ]);
    }

    public function createCommittee(): View
    {
        $this->mockAdminUser();
        return view('admin.addcommittee');
    }

    public function showCommittee(): View
    {
        $this->mockAdminUser();

        $committee = new Mock(['id' => 1, 'title' => 2, 'name' => 'ธรรมนิตย์', 'lastname' => 'เกษมทรัพย์', 'organization' => 'มหาวิทยาลัยศิลปากร']);
        $committee->prefix = 'นาย';

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
        $research->decision = 0;

        return view('admin.updatecommittee', [
            'committee' => $committee,
            'paper_data' => [$research]
        ]);
    }

    public function indexAttendee(): View
    {
        $this->mockAdminUser();

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

        return view('admin.attendedlist', [
            'attendee' => [$user, $user, $user, $user, $user]
        ]);
    }
}
