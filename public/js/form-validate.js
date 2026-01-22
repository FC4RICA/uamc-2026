let formvalid = true;

$(document).ready(function () {
    validateRegis();
    validateLogin();
    // validateEditProfile();
    // validateSubmission();
    // validateEditPaper();
    // adminEditPaper();
});

$.validator.addMethod("notEqual", function (value, element, param) {
    return this.positional(element) || value != param

}, "กรุณาเลือกกรรมการใหม่อีกครั้ง");
$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= (param * 1000000))
}, 'File size must be less than {0}');

function validateRegis() {
    $('form[name="registration"]').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            },
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            title: {
                required: true
            },
            academic_title: {
                required: true
            },
            education: {
                required: true
            },
            phone: {
                required: true
            },
            occupation_id: {
                required: true
            },
            occupation_other: {
                required: () => $('#occupation_id').val() === 'other'
            },
            organization_id: {
                required: true
            },
            organization_other: {
                required: () => $('#organization_id').val() === 'other'
            },
            participation_type: {
                required: true
            },
            presentation_type: {
                required: () => $('#participation_type').val() == presenterId
            }
        },
        messages: {
            email: {
                email: "รูปแบบอีเมลไม่ถูกต้อง",
                required: "กรุณากรอกอีเมล",
            },
            password: {
                required: "กรุณากรอกรหัสผ่าน",
                minlength: "รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร"
            },
            password_confirmation: {
                required: "กรุณากรอกรหัสผ่าน",
                equalTo: "การยืนยันรหัสผ่านไม่ตรงกัน"
            },
            firstname: {
                required: "กรุณากรอกชื่อ"
            },
            lastname: {
                required: "กรุณากรอกนามสกุล"
            },
            title: {
                required: "กรุณาเลือกคำนำหน้า"
            },
            academic_title: {
                required: "กรุณาเลือกตำแหน่งทางวิชาการ"
            },
            education: {
                required: "กรุณาเลือกระดับการศึกษา"
            },
            phone: {
                required: "กรุณากรอกเบอร์โทร"
            },
            occupation_id: {
                required: "กรุณาเลือกอาชีพ"
            },
            occupation_other: {
                required: "กรุณาระบุอาชีพ"
            },
            organization_id: {
                required: "กรุณาเลือกหน่วยงาน"
            },
            organization_other: {
                required: "กรุณาระบุหน่วยงาน"
            },
            participation_type: {
                required: "กรุณาเลือกประเภทการเข้าร่วม"
            },
            presentation_type: {
                required: "กรุณาเลือกประเภทการนำเสนอ"
            }
        }
    });
}

function validateLogin() {
    $('form[name="login"]').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
            }
        },
        messages: {
            email: {
                email: "รูปแบบอีเมลไม่ถูกต้อง",
                required: "กรุณากรอกอีเมล"
            },
            password: {
                required: "กรุณากรอกรหัสผ่าน"
            }
        }
    })
}

function validateEditProfile() {
    $('form[name="editprofile"]').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            },
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            title: {
                required: true
            },
            academic_title: {
                required: true
            },
            education: {
                required: true
            },
            occupation: {
                required: true
            },
            organization: {
                required: true
            },
            phone: {
                required: true
            },
            participation_type: {
                required: true
            },
            presentation_type: {
                required: true
            },
        },
        messages: {
            email: {
                email: "email ควรอยู่ในรูปแบบ youremail@domain.domain",
                required: "กรุณาใส่ข้อมูล"
            },
            password: {
                required: "กรุณาใส่รหัสผ่าน",
                minlength: "กรุณาตั้งรหัสผ่านอย่างน้อย 8 อักขระ"
            },
            password_confirmation: {
                required: "กรุณาใส่รหัสผ่าน",
                minlength: "กรุณาตั้งรหัสผ่านอย่างน้อย 8 อักขระ",
                equalTo: "รหัสผ่านไม่ตรง"
            },
            firstname: {
                required: "กรุณาระบุชื่อ"
            },
            lastname: {
                required: "กรุณาระบุนามสกุล"
            },
            title: {
                required: "กรุณาระบุคำนำหน้า"
            },
            academic_title: {
                required: "กรุณาระบุตำแหน่งทางวิชาการ"
            },
            education: {
                required: "กรุณาระบุข้อมูล"
            },
            occupation: {
                required: "กรุณาระบุข้อมูล"
            },
            organization: {
                required: "กรุณาระบุข้อมูล"
            },
            phone: {
                required: "กรุณาระบุข้อมูล"
            },
            participation_type: {
                required: "กรุณาระบุข้อมูล"
            },
            presentation_type: {
                required: "กรุณาระบุข้อมูล"
            }
        }
    });
}

function validateSubmission() {
    $('form[name=submitpaper]').validate({
        rules: {
            category: {
                required: true
            },
            presentation_type: {
                required: true
            },
            name_th: {
                required: true
            },
            name_en: {
                required: true
            },
            keyword: {
                required: true
            },
            abstract_th: {
                required: true,
                extension: "pdf",
                filesize: 2
            },
            abstract_en: {
                required: true,
                extension: "pdf",
                filesize: 2
            },
            full_text: {
                extension: "pdf",
                filesize: 2
            },
            extended_abstract: {
                extension: "pdf",
                filesize: 2
            },
            poster: {
                extension: "pdf",
                filesize: 2
            }
        },
        messages: {
            category: {
                required: "กรุณาใส่ข้อมูล"
            },
            presentation_type: {
                required: "กรุณาใส่ข้อมูล"
            },
            name_th: {
                required: "กรุณาใส่ข้อมูล"
            },
            name_en: {
                required: "กรุณาใส่ข้อมูล"
            },
            keyword: {
                required: "กรุณาใส่ข้อมูล"
            },
            abstract_th: {
                required: "กรุณาอัพโหลดไฟล์",
                extension: "กรุณาอัพโหลดไฟล์ .pdf",
                filesize: "ไฟล์มีขนาดมากกว่า 2 MB"
            },
            abstract_en: {
                required: "กรุณาอัพโหลดไฟล์",
                extension: "กรุณาอัพโหลดไฟล์ .pdf",
                filesize: "ไฟล์มีขนาดมากกว่า 2 MB"
            },
            full_text: {
                extension: "กรุณาอัพโหลดไฟล์ .pdf",
                filesize: "ไฟล์มีขนาดมากกว่า 2 MB"
            },
            extended_abstract: {
                extension: "กรุณาอัพโหลดไฟล์ .pdf",
                filesize: "ไฟล์มีขนาดมากกว่า 2 MB"
            },
            poster: {
                extension: "กรุณาอัพโหลดไฟล์ .pdf",
                filesize: "ไฟล์มีขนาดมากกว่า 2 MB"
            }
        }
    })
}

function validateEditPaper() {
    $('form[name=editpaper]').validate({
        rules: {
            category: {
                required: true
            },
            presentation_type: {
                required: true
            },
            name_th: {
                required: true
            },
            name_en: {
                required: true
            },
            keyword: {
                required: true
            },
            abstract_th: {
                extension: "pdf",
                filesize: 2
            },
            abstract_en: {
                extension: "pdf",
                filesize: 2
            },
            full_text: {
                extension: "pdf",
                filesize: 2
            },
            extended_abstract: {
                extension: "pdf",
                filesize: 2
            },
            poster: {
                extension: "pdf",
                filesize: 2
            }
        },
        messages: {
            category: {
                required: "กรุณาใส่ข้อมูล"
            },
            presentation_type: {
                required: "กรุณาใส่ข้อมูล"
            },
            name_th: {
                required: "กรุณาใส่ข้อมูล"
            },
            name_en: {
                required: "กรุณาใส่ข้อมูล"
            },
            keyword: {
                required: "กรุณาใส่ข้อมูล"
            },
            abstract_th: {
                extension: "กรุณาอัพโหลดไฟล์ .pdf",
                filesize: "ไฟล์มีขนาดมากกว่า 2 MB"
            },
            abstract_en: {
                extension: "กรุณาอัพโหลดไฟล์ .pdf",
                filesize: "ไฟล์มีขนาดมากกว่า 2 MB"
            },
            full_text: {
                extension: "กรุณาอัพโหลดไฟล์ .pdf",
                filesize: "ไฟล์มีขนาดมากกว่า 2 MB"
            },
            extended_abstract: {
                extension: "กรุณาอัพโหลดไฟล์ .pdf",
                filesize: "ไฟล์มีขนาดมากกว่า 2 MB"
            },
            poster: {
                extension: "กรุณาอัพโหลดไฟล์ .pdf",
                filesize: "ไฟล์มีขนาดมากกว่า 2 MB"
            }
        }
    })
}

function adminEditPaper() {
    $('form[name=admineditpaper]').validate({
        rules: {
            presentation_type: {
                required: true
            },
            category: {
                required: true
            },
            decision: {
                required: true
            }
        },
        messages: {
            presentation_type: {
                required: "กรุณาใส่ข้อมูล"
            },
            category: {
                required: "กรุณาใส่ข้อมูล"
            },
            decision: {
                required: "กรุณาใส่ข้อมูล"
            }
        }
    })
}
