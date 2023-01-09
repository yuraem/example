var resultWrapper = document.querySelector('.spin-result-wrapper');
var wheel = document.querySelector('.wheel-img');
let thxUrl = "https://med-star-inf.art/ruletka_php/thanks/success_mtds/index.php";
let thxParams = {};

function getUrlVars(key) {
    var p = window.location.search;
    p = p.match(new RegExp('[?&]{1}(?:' + key + '=([^&$#]+))'));
    return p ? p[1] : '';
}

function buildQueryString(obj) {
    var str = [];
    for (var p in obj)
        if (obj.hasOwnProperty(p) && obj[p]) {
            str.push(p + "=" + obj[p]);
        }
    return str.join("&");
}

function mapFormDataToObject(form) {
    const data = $(form).serializeArray();
    const result = {};

    $.map(data, function (n, i) {
        result[n['name']] = n['value'];
    });

    return result;
}

function setOrderCookie(){
    let expiryDate = new Date();
    expiryDate.setMonth(expiryDate.getMonth() + 1)
    document.cookie = "ptc=strue; expires=" + expiryDate.toGMTString();
}

$(function () {
    $(document).on('submit', '#order_form', function (e) {
        e.preventDefault();

        const ordParams = $(e.target).serializeArray();
        if (typeof params == 'undefined') {
            params = {};
        }
        let reqData = params['data'] ? params['data'] : getUrlVars('data');
        if (reqData.length === 0 && typeof bdata != 'undefined') {
            reqData = bdata;
        }
        ordParams.push({name: 'data', value: reqData})

        const formData = mapFormDataToObject(e.target);
        thxParams = Object.assign({
            name: formData.name,
            phone: formData.phone,
            offerID: formData.offerID ? formData.offerID : "",
        }, params)

        $.ajax({
            url: 'https://hugidratracker.ru/order',
            // url: 'https://tracker.dev.tracker.techhprof.ru/order',
            // url: 'http://localhost:7081/order',
            method: 'POST',
            data: ordParams,
            cache: false,
            xhrFields: {
                withCredentials: true
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                if (cliIp) {
                    xhr.setRequestHeader("X-Forwarded-For", cliIp);
                }
            },
            success: function (response) {
                setOrderCookie()
                let defaultData = `eyJpZCI6MCwic291cmNlIjoxMSwiY2FtcGFpZ24iOjE4NTksImNvbnRlbnQiOiJbVElEXSIsInByZWxhbmRfaWQiOjgxMzAsImFmZmlsaWF0ZV9pZCI6MTEsIm9mZmVyX2lkIjoxOTI2LCJzdHJlYW1faWQiOjAsInZjb2RlIjoiM2JlM2ViNDYtZjhiNy00YzlmLWExM2EtYzJlNzNlYWFiZWFhIiwid3IiOnRydWUsImRjIjoxLCJzaXRlIjoiW1NJRF0iLCJzbiI6IjEiLCJjb3VudHJ5Ijoi0KDQvtGB0YHQuNGPIiwiY291bnRyeV9jb2RlIjoiUlUiLCJyZWdpb24iOiLQmtGA0LDRgdC90L7QtNCw0YDRgdC60LjQuSDQutGA0LDQuSIsImNpdHkiOiLQmtGA0LDRgdC90L7QtNCw0YAiLCJoYXNoIjoiOGY5NTZhYWFkN2M5MGFjYzIzOGQ2NWZkY2FmM2RkYTgiLCJ1aWQiOiIwIiwiY2xpZW50X2lkIjoiIiwicHJlbGFuZF9mcmFtZSI6ZmFsc2UsImJyb3dzZXIiOiJDaHJvbWUiLCJwbGF0Zm9ybSI6IkxpbnV4Iiwid2lkZ2V0X3R5cGUiOjEsIndpZGdldF91cHBlcl90ZXh0IjoiIiwiYmFja19zY3JpcHQiOnRydWUsInJvdWxldHRlX2JhY2tfcGFnZV90aXRsZSI6IiIsInJvdWxldHRlX2JhY2tfcGFnZV9zdWJfdGl0bGUiOiIiLCJyb3VsZXR0ZV9iYWNrX3BhZ2VfZm9ybV90ZXh0IjoiIiwicm91bGV0dGVfYmFja19wYWdlX3NwaW5faW1hZ2UiOiIiLCJleHAxIjoiIiwiZXhwMiI6IiIsImV4cDMiOiIiLCJzaWQxIjoiW0NJRF0iLCJzaWQyIjoiW05JRF0iLCJzaWQzIjoiW0NPTUlEXSIsInNpZDQiOiJbU0lENF0iLCJzaWQ1IjoiIiwic2lkNiI6IiIsInNpZDciOiIiLCJzaWQ4IjoiIiwic2lkOSI6IiIsImNodW5rX2lkIjoiNGY3MDQzMjEtMTI2ZC00ZmUwLTgzNDEtN2YxNTk3YzhhMDgzIn0=`;
                let data = {};
                if (response.length > 0 && response.includes('success')) {
                    data = JSON.parse(response);
                }

                if (data.redirectRul && data.redirectRul.length > 0) {
                    if (location.href.includes(data.redirectRul)) {
                        thxParams['data'] = defaultData;
                        window.location.href = thxUrl + '?' + buildQueryString(thxParams)
                        return
                    }
                    thxUrl = data.redirectRul
                    if (data.data.length > 0) {
                        thxParams['vcode'] = JSON.parse(atob(data.data))['vcode']
                        defaultData = data.data;
                    }
                }

                thxParams['data'] = defaultData;
                if (!getUrlVars('debug')) {
                    window.location.href = thxUrl + '?' + buildQueryString(thxParams)
                }
                // window.location.href = 'https://medic-true.ru/ruletka_php/omni/success.html?' + buildQueryString(params)
            },
            error: function (data) {
                if (!getUrlVars('debug')) {
                    window.location.href = thxUrl + '?' + buildQueryString(thxParams)
                    return
                }

                console.error(data.responseJSON);
                if (data.status === 400) {
                    alert("Введены неверные данные!");
                } else {
                    alert("Произошла ошибка!");
                }
            }
        });
    })
});

$(function () {
    $("a[href^='#']").click(function () {
        let _href = $(this).attr("href");
        let rul = document.getElementById(_href.slice(1));
        if (!rul) {
            _href = "#order_form";
        }

        $("html, body").animate({scrollTop: $(_href).offset().top + "px"});
        return false;
    });
    $('input[value="Узнать подробнее"], input[value="Принять участие в розыгрыше"]').click(function () {
        $('.eeee, .fadepopup').css('display', 'none');
    });
});

function spin() {
    if (!wheel.classList.contains('rotated')) {
        wheel.classList.add('super-rotation');
        setTimeout(function () {
            resultWrapper.style.display = "block";
        }, 8000);
        setTimeout(function () {
            $('.spin-wrapper').slideUp();
            $('#boxes').slideUp();
            $('.order_block').slideDown();
            start_timer();
        }, 10000);
        wheel.classList.add('rotated');
    }
}

var closePopup = document.querySelector('.close-popup');
$('.close-popup, .pop-up-button').click(function (e) {
    e.preventDefault();
    $('.spin-result-wrapper').fadeOut();

    let el = $('#roulette');
    if (!el) {
        el = $('#order_form')
    }
    let top = el.offset().top;
    $('body,html').animate({scrollTop: top}, 800);
});

var time = 600;
var intr;

function start_timer() {
    intr = setInterval(tick, 1000);
}

function tick() {
    time = time - 1;
    var mins = Math.floor(time / 60);
    var secs = time - mins * 60;
    if (mins == 0 && secs == 0) {
        clearInterval(intr);
    }
    secs = secs >= 10 ? secs : "0" + secs;
    $("#min").html("0" + mins);
    $("#sec").html(secs);
}
