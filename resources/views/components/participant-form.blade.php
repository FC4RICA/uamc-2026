@php
    $p = old("participants.$index", $data ?? []);
@endphp

<div class="card mb-4 participant" data-participant>
    <h4 class="card-header d-flex justify-content-between">
        <div>ผู้ร่วมผลงาน {{ (int)$index + 1 }}</div>

        <button type="button" class="btn btn-sm btn-danger remove-participant">ลบ</button>
    </h4>

    <div class="card-body row align-items-end">
        <div class="col-12 col-sm-6 col-xl-2 form-group">
            <label>คำนำหน้า</label>
            <select name="participants[{{ $index }}][title]"
                class="form-select" required>
                <option value="" disabled>เลือก</option>
                @foreach($titles as $t)
                    <option value="{{ $t->value }}" @selected(($p['title'] ?? null) == $t->value)>
                        {{ $t->label() }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-sm-6 col-xl-2 form-group">
            <label>ตำแหน่งทางวิชาการ</label>
            <select name="participants[{{ $index }}][academic_title]" class="form-select" required>
                <option value="" disabled>เลือก</option>
                @foreach($academicTitles as $t)
                    <option value="{{ $t->value }}" @selected(($p['academic_title'] ?? null) == $t->value)>
                        {{ $t->label() }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-6 col-xl-4 form-group">
            <label>ชื่อ</label>
            <input type="text" name="participants[{{ $index }}][firstname]"
                class="form-control" value="{{ $p['firstname'] ?? '' }}" required>
        </div>

        <div class="col-12 col-md-6 col-xl-4 form-group">
            <label>นามสกุล</label>
            <input type="text" name="participants[{{ $index }}][lastname]"
                class="form-control" value="{{ $p['lastname'] ?? '' }}" required>
        </div>

        <div class="col-12 col-md-6 col-xl-3 form-group">
            <label>ระดับการศึกษา</label>
            <select name="participants[{{ $index }}][education]" 
                class="form-select" required>
                <option value="" disabled>เลือก</option>
                @foreach($education as $ed)
                    <option value="{{ $ed->value }}" @selected(($p['education'] ?? null) == $ed->value)>
                        {{ $ed->label() }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-6 col-xl-3 form-group">
            <label>เบอร์โทร</label>
            <input type="tel" name="participants[{{ $index }}][phone]" 
                class="form-control" value="{{ $p['phone'] ?? '' }}"  required>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>อาชีพ</label>
            <div class="row align-items-end">
                <div class="col-12 col-xl-6">
                    <select name="participants[{{ $index }}][occupation_id]" class="form-select" required
                        data-toggle-select data-target="[data-occupation-other]" data-value="other">
                        <option value="" disabled>เลือก</option>
                        @foreach($occupations as $ocu)
                            <option value="{{ $ocu->id }}" @selected(($p['education'] ?? null) == $ocu->id)>
                                {{ $ocu->name }}
                            </option>
                        @endforeach
                        <option value="other">อื่นๆ</option>
                    </select>
                </div>
                <div class="col-12 col-xl-6">
                    <input type="text" name="participants[{{ $index }}][occupation_other]" placeholder="กรุณาระบุอาชีพ"
                        class="form-control" value="{{ $p['occupation_other'] ?? '' }}" data-occupation-other>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>สถานที่ทำงาน/สถาบันการศึกษา/หน่วยงาน</label>
            <div class="row align-items-end">
                <div class="col-12 col-xl-6">
                    <select name="participants[{{ $index }}][organization_id]" class="form-select" required
                        data-toggle-select data-target="[data-organization-other]" data-value="other">
                        <option value="" disabled>เลือก</option>
                        @foreach($organizations as $org)
                            <option value="{{ $org->id }}" @selected(($p['organization_id'] ?? null) == $org->id)>
                                {{ $org->name }}
                            </option>
                        @endforeach
                        <option value="other">อื่นๆ</option>
                    </select>
                </div>
                <div class="col-12 col-xl-6">
                    <input name="participants[{{ $index }}][organization_other]" value="{{ $p['organization_other'] ?? '' }}" 
                        class="form-control" type="text" placeholder="กรุณาระบุสถานที่ทำงาน" data-organization-other>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>ข้อจำกัดด้านอาหาร / ข้อมูลสุขภาพที่ควรทราบ (ถ้ามี)</label>
            <input name="participants[{{ $index }}][special_requirements]" value="{{ $p['special_requirements'] ?? '' }}"
            class="form-control" placeholder="เช่น มังสวิรัติ, ฮาลาล, แพ้ถั่ว, เบาหวาน" type="text" >
        </div>
    </div>
</div>
