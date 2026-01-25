@php
    $p = old("participants.$index", $data ?? []);
@endphp

<div class="card mb-4 participant" data-participant>
    <h4 class="card-header d-flex justify-content-between">
        <div>ผู้ร่วมผลงาน</div>

        <button type="button" class="btn btn-sm btn-danger remove-participant">ลบ</button>
    </h4>

    <div class="card-body row">
        <div class="col-12 col-sm-6 col-xl-2 form-group">
            <label>คำนำหน้า *</label>
            <select name="participants[{{ $index }}][title]" required
                class="form-select @error('participants[{{ $index }}][title]') is-invalid @enderror">
                <option value="" disabled>เลือก</option>
                @foreach ($titles as $t)
                    <option value="{{ $t->value }}" @selected(($p['title'] ?? null) == $t->value)>
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
            <select name="participants[{{ $index }}][academic_title]" required
                class="form-select @error('participants[{{ $index }}][academic_title]') is-invalid @enderror">
                <option value="" disabled>เลือก</option>
                @foreach ($academicTitles as $t)
                    <option value="{{ $t->value }}" @selected(($p['academic_title'] ?? null) == $t->value)>
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
            <input type="text" name="participants[{{ $index }}][firstname]"
                value="{{ $p['firstname'] ?? '' }}" required
                class="form-control @error('participants[{{ $index }}][firstname]') is-invalid @enderror">
            @error('participants[{{ $index }}][firstname]')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="col-12 col-md-6 col-xl-4 form-group">
            <label>นามสกุล *</label>
            <input type="text" name="participants[{{ $index }}][lastname]"
                value="{{ $p['lastname'] ?? '' }}" required
                class="form-control @error('participants[{{ $index }}][lastname]') is-invalid @enderror">
            @error('participants[{{ $index }}][lastname]')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="col-12 col-md-6 col-xl-3 form-group">
            <label>ระดับการศึกษา *</label>
            <select name="participants[{{ $index }}][education]" required
                class="form-select @error('participants[{{ $index }}][education]') is-invalid @enderror">
                <option value="" disabled>เลือก</option>
                @foreach ($education as $ed)
                    <option value="{{ $ed->value }}" @selected(($p['education'] ?? null) == $ed->value)>
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
            <input type="tel" name="participants[{{ $index }}][phone]"
                value="{{ $p['phone'] ?? '' }}"
                class="form-control @error('participants[{{ $index }}][phone]') is-invalid @enderror">
            @error('participants[{{ $index }}][phone]')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>อาชีพ *</label>
            <div class="row g-4">
                <div class="col-12 col-xl-6">
                    <select name="participants[{{ $index }}][occupation_id]" required
                        data-toggle-select data-target="[data-occupation-other]" data-value="other"
                        class="form-select @error('participants[{{ $index }}][occupation_id]') is-invalid @enderror">
                        <option value="" disabled>เลือก</option>
                        @foreach ($occupations as $ocu)
                            <option value="{{ $ocu->id }}" @selected(($p['occupation_id'] ?? null) == $ocu->id)>
                                {{ $ocu->name }}
                            </option>
                        @endforeach
                        <option value="other">อื่นๆ</option>
                    </select>
                    @error('participants[{{ $index }}][occupation_id]')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12 col-xl-6">
                    <input type="text" name="participants[{{ $index }}][occupation_other]"
                        placeholder="กรุณาระบุอาชีพ" value="{{ $p['occupation_other'] ?? '' }}" data-occupation-other
                        class="form-control @error('participants[{{ $index }}][occupation_other]') is-invalid @enderror">
                    @error('participants[{{ $index }}][occupation_other]')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>สถานที่ทำงาน/สถาบันการศึกษา/หน่วยงาน *</label>
            <div class="row g-4">
                <div class="col-12 col-xl-6">
                    <select name="participants[{{ $index }}][organization_id]" required
                        data-toggle-select data-target="[data-organization-other]" data-value="other"
                        class="form-select @error('participants[{{ $index }}][organization_id]') is-invalid @enderror">
                        <option value="" disabled>เลือก</option>
                        @foreach ($organizations as $org)
                            <option value="{{ $org->id }}" @selected(($p['organization_id'] ?? null) == $org->id)>
                                {{ $org->name }}
                            </option>
                        @endforeach
                        <option value="other">อื่นๆ</option>
                    </select>
                    @error('participants[{{ $index }}][organization_id]')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12 col-xl-6">
                    <input name="participants[{{ $index }}][organization_other]" placeholder="กรุณาระบุสถานที่ทำงาน"
                        value="{{ $p['organization_other'] ?? '' }}" class="form-control" type="text" data-organization-other 
                        class="form-control @error('participants[{{ $index }}][organization_other]') is-invalid @enderror">
                    @error('participants[{{ $index }}][organization_other]')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>ข้อจำกัดด้านอาหาร / ข้อมูลสุขภาพที่ควรทราบ (ถ้ามี)</label>
            <input name="participants[{{ $index }}][special_requirements]" type="text"
                value="{{ $p['special_requirements'] ?? '' }}" placeholder="เช่น มังสวิรัติ, ฮาลาล, แพ้ถั่ว, เบาหวาน"
                class="form-control @error('participants[{{ $index }}][special_requirements]') is-invalid @enderror">
            @error('participants[{{ $index }}][special_requirements]')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
</div>
