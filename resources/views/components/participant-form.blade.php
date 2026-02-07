<div class="card mb-4 participant" data-participant>
    <h4 class="card-header d-flex justify-content-between">
        <div>ผู้ร่วมผลงาน</div>

        @if (! $disabled)
            <button type="button" class="btn btn-sm btn-danger remove-participant">ลบ</button>
        @endif
    </h4>

    <div class="card-body row align-items-end">
        <div class="col-12 col-sm-6 col-xl-2 form-group">
            <label>คำนำหน้า *</label>
            <select name="participants[{{ $index }}][title]" required @disabled($disabled)
                class="form-select @error('participants[{{ $index }}][title]') is-invalid @enderror">
                <option value="" @selected(! old("participants.$index.title", $profile['title'] ?? null)) disabled>เลือก</option>
                @foreach ($titles as $t)
                    <option value="{{ $t->value }}" 
                        @selected(old("participants.$index.title", $profile['title'] ?? '') == $t->value)>
                        {{ $t->label() }}
                    </option>
                @endforeach
            </select>
            @error('participants[{{ $index }}][title]')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="col-12 col-sm-6 col-xl-2 form-group">
            <label>ตำแหน่งทางวิชาการ *</label>
            <select name="participants[{{ $index }}][academic_title]" required @disabled($disabled)
                class="form-select @error('participants[{{ $index }}][academic_title]') is-invalid @enderror">
                <option value="" @selected(! old("participants.$index.academic_title", $profile['academic_title'] ?? null)) disabled>เลือก</option>
                @foreach ($academicTitles as $t)
                    <option value="{{ $t->value }}" 
                        @selected(old("participants.$index.academic_title", $profile['academic_title'] ?? '') == $t->value)>
                        {{ $t->label() }}
                    </option>
                @endforeach
            </select>
            @error('participants[{{ $index }}][academic_title]')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="col-12 col-md-6 col-xl-4 form-group">
            <label>ชื่อ *</label>
            <input type="text" name="participants[{{ $index }}][firstname]" @disabled($disabled)
                value="{{ old("participants.$index.firstname", $profile['firstname'] ?? '') }}" required
                class="form-control @error('participants[{{ $index }}][firstname]') is-invalid @enderror">
            @error('participants[{{ $index }}][firstname]')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="col-12 col-md-6 col-xl-4 form-group">
            <label>นามสกุล *</label>
            <input type="text" name="participants[{{ $index }}][lastname]" @disabled($disabled)
                value="{{ old("participants.$index.lastname", $profile['lastname'] ?? '') }}" required
                class="form-control @error('participants[{{ $index }}][lastname]') is-invalid @enderror">
            @error('participants[{{ $index }}][lastname]')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="col-12 col-md-6 col-xl-3 form-group">
            <label>ระดับการศึกษา *</label>
            <select name="participants[{{ $index }}][education]" required @disabled($disabled)
                class="form-select @error('participants[{{ $index }}][education]') is-invalid @enderror">
                <option value="" @selected(! old("participants.$index.education", $profile['education'] ?? null)) disabled>เลือก</option>
                @foreach ($education as $ed)
                    <option value="{{ $ed->value }}" 
                        @selected(old("participants.$index.education", $profile['education'] ?? '') == $ed->value)>
                        {{ $ed->label() }}
                    </option>
                @endforeach
            </select>
            @error('participants[{{ $index }}][education]')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="col-12 col-md-6 col-xl-3 form-group">
            <label>เบอร์โทร</label>
            <input type="tel" name="participants[{{ $index }}][phone]" @disabled($disabled)
                value="{{ old("participants.$index.phone", $profile['phone'] ?? '') }}"
                class="form-control @error('participants[{{ $index }}][phone]') is-invalid @enderror">
            @error('participants[{{ $index }}][phone]')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="col-12 col-md-6 col-xl-3 form-group">
            <label>อาชีพ *</label>
            <select name="participants[{{ $index }}][occupation_id]" required @disabled($disabled)
                data-toggle-select data-target="[data-occupation-other]" data-value="other"
                class="form-select @error('participants[{{ $index }}][occupation_id]') is-invalid @enderror">
                <option value="" @selected(! old("participants.$index.occupation_id", $profile['occupation_id'] ?? null)) disabled>เลือก</option>
                @foreach ($occupations as $ocu)
                    <option value="{{ $ocu->id }}" 
                        @selected(old("participants.$index.occupation_id", $profile['occupation_id'] ?? '') == $ocu->id)>
                        {{ $ocu->name }}
                    </option>
                @endforeach
                <option value="other"
                    @selected(old("participants.$index.occupation_id", $profile['occupation_id'] ?? '') == 'other')>
                    อื่นๆ
                </option>
            </select>
            @error('participants[{{ $index }}][occupation_id]')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>
        @if (! $disabled || ! empty(old("participants.$index.occupation_other", $profile['occupation_other'] ?? '')))
            <div class="col-12 col-md-6 col-xl-3 form-group">
                <input type="text" name="participants[{{ $index }}][occupation_other]"
                    placeholder="กรุณาระบุอาชีพ" data-occupation-other @disabled($disabled)
                    class="form-control @error('participants[{{ $index }}][occupation_other]') is-invalid @enderror"
                    value="{{ old("participants.$index.occupation_other", $profile['occupation_other'] ?? '') }}">
                @error('participants[{{ $index }}][occupation_other]')
                    <label class="error">{{ $message }}</label>
                @enderror
            </div>
        @endif

        <div class="col-12 col-md-6 col-xl-3 form-group">
            <label>สถานที่ทำงาน/สถาบันการศึกษา/หน่วยงาน *</label>
            <select name="participants[{{ $index }}][organization_id]" required @disabled($disabled)
                data-toggle-select data-target="[data-organization-other]" data-value="other"
                class="form-select @error('participants[{{ $index }}][organization_id]') is-invalid @enderror">
                <option value="" @selected(! old("participants.$index.organization_id", $profile['organization_id'] ?? null)) disabled>เลือก</option>
                @foreach ($organizations as $org)
                    <option value="{{ $org->id }}" 
                        @selected(old("participants.$index.organization_id", $profile['organization_id'] ?? '') == $org->id)>
                        {{ $org->name }}
                    </option>
                @endforeach
                <option value="other"
                    @selected(old("participants.$index.organization_id", $profile['organization_id'] ?? '') == 'other')>
                    อื่นๆ
                </option>
            </select>
            @error('participants[{{ $index }}][organization_id]')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>
        @if (! $disabled || ! empty(old("participants.$index.organization_other", $profile['organization_other'] ?? '')))
            <div class="col-12 col-md-6 col-xl-3 form-group">
                <input name="participants[{{ $index }}][organization_other]" placeholder="กรุณาระบุสถานที่ทำงาน" data-organization-other
                    value="{{ old("participants.$index.organization_other", $profile['organization_other'] ?? '') }}" type="text"
                    class="form-control @error('participants[{{ $index }}][organization_other]') is-invalid @enderror" @disabled($disabled)>
                @error('participants[{{ $index }}][organization_other]')
                    <label class="error">{{ $message }}</label>
                @enderror
            </div>
        @endif
        @if (! $disabled || ! empty(old("participants.$index.special_requirements", $profile['special_requirements'] ?? '')))
            <div class="col-12 col-md-6 form-group">
                <label>ข้อจำกัดด้านอาหาร / ข้อมูลสุขภาพที่ควรทราบ (ถ้ามี)</label>
                <input name="participants[{{ $index }}][special_requirements]" type="text" @disabled($disabled)
                    value="{{ old("participants.$index.special_requirements", $profile['special_requirements'] ?? '') }}" placeholder="เช่น มังสวิรัติ, ฮาลาล, แพ้ถั่ว, เบาหวาน"
                    class="form-control @error('participants[{{ $index }}][special_requirements]') is-invalid @enderror">
                @error('participants[{{ $index }}][special_requirements]')
                    <label class="error">{{ $message }}</label>
                @enderror
            </div>
        @endif
    </div>
</div>
