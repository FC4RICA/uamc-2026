let currentTab = 0
let formvalid = true

$(document).ready(function () {
    showTab(currentTab)
    validateRegis()
    validateSignIn()
    validateEditProfile()
    validateSubmission()
    validateEditPaper()
    validateEditCommittee()
    adminEditPaper()
    adminEditSchedule()

    // jQuery.validator.addMethod("notEqual", function (value, element, param) {
    //     return this.positional(element) || value != param;
    // }, "กรุณาเลือกกรรมการใหม่อีกครั้ง");
});

jQuery.validator.addMethod("notEqual", function (value, element, param) {
    return this.positional(element) || value != param
}, "กรุณาเลือกกรรมการใหม่อีกครั้ง")

$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= (param * 1000000))
}, 'File size must be less than {0}');

function showTab(n) {
    let x = $('.tab');
    x.eq(n).css("display", "block")

    if (n == 0) {
        $('#prevBtn').css("display", "none")
    } else {
        $('#prevBtn').css("display", "inline")
    }

    if (n == (x.length - 1)) {
        $('#nextBtn').text("ยืนยัน")
    } else {
        $('#nextBtn').text("ถัดไป")
    }

    realtimeValidForm()
    fixStepIndicator(n)
}

function nextPrev(n) {
    let x = $('.tab');
    let validate_form = (formvalid && validateForm())
    let ex = (n == 1 && !validate_form)
    // console.log("EX"+ex)
    if (ex) return false

    x.eq(currentTab).css("display", "none")
    currentTab = currentTab + n

    if (currentTab >= x.length) {
        $('form[name="registration"]').submit()
        // document.getElementById("registration").submit();
        return false;
    }
    // console.log("FORM"+formvalid)
    showTab(currentTab)
}

function validateForm() {
    let x, y, i, valid = true
    x = $('.tab');
    y = x.eq(currentTab).children().find("input, select")

    for (i = 0; i < y.length; i++) {
        if (y.eq(i).val() == "") {
            // console.log("invalid")
            y.eq(i).addClass("inputerror")
            // console.log(y.eq(i))
            valid = false
        } else {
            y.eq(i).removeClass("inputerror")
        }
    }

    if (valid) {
        $('.step').eq(currentTab).addClass("stepfinish")
    }
    return valid
}

function realtimeValidForm() {
    let x = $('.tab')
    let y = x.eq(currentTab).find("input")
}

function fixStepIndicator(n) {

    let i, x = $('.step')

    for (i = 0; i < x.length; i++) {
        x.eq(i).addClass("stepactive")
    }

    x.eq(n).addClass("stepactive")
}

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
            confirmpassword: {
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
            prefix: {
                required: true
            },
            position: {
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
            type: {
                required: true
            }
        },
        messages: {
            email: {
                email: "email ควรอยู่ในรูปแบบ youremail@domain.domain",
                required: "กรุณาใส่ข้อมูล",
                remote: "email นี้มีการลงทะเบียนไปแล้ว"
            },
            password: {
                required: "กรุณาใส่รหัสผ่าน",
                minlength: "กรุณาตั้งรหัสผ่านอย่างน้อย 8 ตัวอักษร"
            },
            confirmpassword: {
                required: "กรุณาใส่รหัสผ่าน",
                minlength: "กรุณาตั้งรหัสผ่านอย่างน้อย 8 ตัวอักษร",
                equalTo: "รหัสผ่านไม่ตรง"
            },
            firstname: {
                required: "กรุณาระบุชื่อ"
            },
            lastname: {
                required: "กรุณาระบุนามสกุล"
            },
            prefix: {
                required: "กรุณาระบุคำนำหน้า"
            },
            position: {
                required: "กรุณาระบุตำแหน่งทางวิชาการ"
            },
            education: {
                required: "กรุณาระบุระดับการศึกษา"
            },
            occupation: {
                required: "กรุณาระบุอาชีพ"
            },
            organization: {
                required: "กรุณาระบุข้อมูลหน่วยงาน"
            },
            phone: {
                required: "กรุณาระบุเบอร์โทร"
            },
            type: {
                required: "กรุณาระบุประเภทการเข้าร่วม"
            }
        }
    });
}

function validateSignIn() {
    $('form[name="signin"]').validate({
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
                email: "email ควรอยู่ในรูปแบบ youremail@domain.domain",
                required: "กรุณาใส่ข้อมูล"
            },
            password: {
                required: "กรุณาใส่รหัสผ่าน"
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
            confirmpassword: {
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
            prefix: {
                required: true
            },
            position: {
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
            type: {
                required: true
            }
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
            confirmpassword: {
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
            prefix: {
                required: "กรุณาระบุคำนำหน้า"
            },
            position: {
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
            type: {
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
            type: {
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
            type: {
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
            type: {
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
            type: {
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

function validateEditCommittee() {
    $('form[name="editcommittee"]').validate({
        rules: {
            prefix: {
                required: true
            },
            position: {
                required: true
            },
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            organization: {
                required: true
            }
        },
        messages: {
            prefix: {
                required: "กรุณาใส่ข้อมูล"
            },
            position: {
                required: "กรุณาใส่ข้อมูล"
            },
            firstname: {
                required: "กรุณาใส่ข้อมูล"
            },
            lastname: {
                required: "กรุณาใส่ข้อมูล"
            },
            organization: {
                required: "กรุณาใส่ข้อมูล"
            }
        }
    })
}

function adminEditPaper() {
    $('form[name=admineditpaper]').validate({
        rules: {
            type: {
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
            type: {
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

function adminEditSchedule() {
    $('form[name=schedule]').validate({
        rules: {
            sche_name: {
                required: true
            },
            sche_date: {
                required: true
            },
            sche_detail: {
                required: true
            },
            sche_type: {
                required: true
            }
        },
        messages: {
            sche_name: {
                required: "กรุณาใส่ข้อมูล"
            },
            sche_date: {
                required: "กรุณาใส่ข้อมูล"
            },
            sche_detail: {
                required: "กรุณาใส่ข้อมูล"
            },
            sche_type: {
                required: "กรุณาใส่ข้อมูล"
            }
        }
    })
}