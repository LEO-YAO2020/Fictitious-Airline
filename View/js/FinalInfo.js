$(document).ready(function (){
    var nameid = $("#name");
    var emailid = $("#email");
    var telid = $("#tel");
    nameid.blur(function () {
        var name = nameid.val()
        if (name === '') {
            $("#nameSpan").text('Please fill out this field')
        }else {
            nameid.val(name.replace(/\s/g,""))
        }
    })
    nameid.focus(function () {
        $("#nameSpan").text('');
    })
    emailid.blur(function () {
        var email = emailid.val()
        if (email === '') {
            $("#emailSpan").text('Please fill out this field')
        }else {
            emailid.val(email.replace(/\s/g,""))
        }
    })
    emailid.focus(function () {
        $("#emailSpan").text('');
    })
    telid.blur(function () {
        var tel = telid.val()
        if (tel === '') {
            $("#telSpan").text('Please fill out this field')
        }else {
            telid.val(tel.replace(/\s/g, ""))
        }
    })
    telid.focus(function () {
        $("#telSpan").text('');
    })
    var submit = $('#submit');
    submit.click(function () {
        nameid.focus();
        nameid.blur();

        emailid.focus();
        emailid.blur();

        telid.focus();
        telid.blur();

        if ($('#nameSpan').text() === "" && $('#emailSpan').text() === "" && $('#telSpan').text() === "") {
            $('#final').submit();
        }
    })
    $("#cancel").click(function () {
        window.location.href = "../View/Index.html"
    })
})