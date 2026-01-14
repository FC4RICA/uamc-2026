let mainURL = window.location.origin

$(document).ready(() => {
    $('#attendtype').change(() => {
        var value = $('#attendtype').val()
        let url = mainURL + "/v1/getmemberbytype"
        $.ajax({
            method: "GET",
            url: url,
            data: {
                type: value
            }
        }).done(function (data) {

            var nd = null

            for (i = 0; i < data.length; i++) {
                var count = i + 1
                nd = nd + '<tr><td>' + count + '</td><td>' + data[i].name + ' ' + data[i].lastname + '</td><td>' + data[i].organ + '</td><td>' + data[i].type + '</td><td><a href="#" class="btn btn-outline-secondary"><i class="fa fa-edit"></i></a></td></tr>'
            }
            $('tbody').html("")
            $('tbody').html(nd)
        })
    })
})


function getAttendedData(id) {
    let url = mainURL + "/v1/getmemberbyid"
    $.ajax({
        method: "GET",
        url: url,
        data: {
            id: id
        }
    }).done(function (data) {
        var data = data[0]
        $('#email').val(data.email)
        $('#prefix').val(data.prefix)
        $('#position').val(data.position)
        $('#firstname').val(data.name)
        $('#lastname').val(data.lastname)
        $('#education').val(data.education)
        $('#organization').val(data.organ)
        $('#occupation').val(data.occupation)
        $('#phone').val(data.phone)
        $('#type').val(data.type)

        var food = "ปกติ"

        switch (data.food) {
            case "vegan":
                food = "มังสวิรัติ"
                break
            case "halal":
                food = "ฮาลาล"
                break
            default:
                food = "ปกติ"
        }

        $('#food').val(food)
        // $('')

        showdelete(data.id)
    })
}

function showdelete(id) {
    let url = mainURL + "/v1/getmemberbyid"
    $('#showdeleteBTN').on('click', () => {
        $.ajax({
            method: "GET",
            url: url,
            data: {
                id: id
            }
        }).done(function (data) {
            var data = data[0]
            $('.deleteName').html(data.name)
            $('#id').val(data.id)
        })

        // deleteAttended(id)
    })
}

function onInputFileChangeLabel(id, value) {
    let filename = value.split('\\')[2]
    document.getElementById(`${id}_label`).innerHTML = filename.toString()
}

// var proceedingAgreement = 1
function onProceedingChange() {
    $('document').ready(() => {
        let proceedingAgreement = $('input:radio[name="proceedingAgreement"]:checked').val()
        if (proceedingAgreement == 1) {
            $('#extended_abstract').prop('disabled', true)
            $('#full_text').prop('disabled', false)
        } else if (proceedingAgreement == 0) {
            $('#extended_abstract').prop('disabled', false)
            $('#full_text').prop('disabled', true)
        }
    })
}

// cookie check
function showPdpaBox() {
    $('#pdpa-box').removeClass('d-none')
}

function hidePdpaBox() {
    $('#pdpa-box').addClass('d-none')
}


$(document).ready(function () {
    const consent = localStorage.getItem('acceptCookie')

    if (consent === 'accepted' || consent === 'denied') {
        hidePdpaBox()
    } else {
        showPdpaBox()
    }
})

function onCookieAccept() {
    localStorage.setItem('acceptCookie', 'accepted')
    hidePdpaBox()
}

function onCookieDenied() {
    localStorage.setItem('acceptCookie', 'denied')
    hidePdpaBox()
}

// open zoom link
function openZoomLink(url) {
    $('document').ready(() => {
        window.open(url, '_blank').focus()
    })
}