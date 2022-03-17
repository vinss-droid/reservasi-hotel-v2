$(document).ready(function () {

    $('#Alogin').click(function (e) { 
        e.preventDefault();
        $('#login').modal('show');
    });

    $('#register').click(function (e) {
        e.preventDefault();
        $('#login').modal('hide');
        $('#mdlReg').modal('show');
    });

    $('#masuk').click(function (e) {
        e.preventDefault();
        $('#mdlReg').modal('hide');
        $('#login').modal('show');
    });

    $('#nav-log').click(function (e) {
        e.preventDefault();
        $('#mdlReg').modal('hide');
        $('#login').modal('show');
    });

    $('#profile').click(function (e) {
        e.preventDefault();
        $('#mdlPro').modal('show');
    });

    // $('#Kpesan').click(function (e) { 
    //     e.preventDefault();
    //     $('#Cpesan').modal('show');
    // });

    // Profile
    $('#ubahPR').click(function (e) {
        e.preventDefault();
        $('#ubahPR').addClass('d-none');
        $('#PRnama').removeAttr('disabled');
        $('#PRCemail').addClass('d-none');
        $('#PRChp').removeClass('col-lg-6');
        $('#PRChp').addClass('col-lg-12');
        $('#PRhp').removeAttr('disabled');
        $('#PRCpw').removeClass('d-none');
        $('#btnSimpan').removeAttr('disabled');
        $('#batalPR').removeClass('d-none');
        $('#cPW').removeClass('d-none');
    });

    $('#batalPR').click(function (e) {
        e.preventDefault();
        $('#batalPR').addClass('d-none');
        $('#PRnama').attr('disabled', true);
        $('#PRCemail').removeClass('d-none');
        $('#PRChp').removeClass('col-lg-12');
        $('#PRChp').addClass('col-lg-6');
        $('#PRhp').attr('disabled', true);
        $('#PRCpw').addClass('d-none');
        $('#btnSimpan').attr('disabled', true);
        $('#ubahPR').removeClass('d-none');
        $('#cPW').addClass('d-none');
    });

    $('#PRclose').click(function (e) {
        e.preventDefault();
        $('#batalPR').trigger('click');
    });

});




//Password

const prGroup = document.querySelector("#prGroup");
const prEye = document.querySelector("#prEye");
const prPW = document.querySelector("#prPW");

prGroup.addEventListener('click', function () {
    if (prPW.type === 'password') {
        prPW.setAttribute('type', 'text');
        prEye.setAttribute('class', 'fa-solid fa-eye')
    } else {
        prPW.setAttribute('type', 'password');
        prEye.setAttribute('class', 'fa-solid fa-eye-slash')
    }
});

const CprGroup = document.querySelector("#CprGroup");
const CprEye = document.querySelector("#CprEye");
const CprPW = document.querySelector("#CprPW");

CprGroup.addEventListener('click', function () {
    if (CprPW.type === 'password') {
        CprPW.setAttribute('type', 'text');
        CprEye.setAttribute('class', 'fa-solid fa-eye')
    } else {
        CprPW.setAttribute('type', 'password');
        CprEye.setAttribute('class', 'fa-solid fa-eye-slash')
    }
});