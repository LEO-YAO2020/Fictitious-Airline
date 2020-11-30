$(document).ready(function (){
    var nameid = $("#name");
    var referenceid = $("#reference");

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
   referenceid.blur(function () {
        var reference = referenceid.val()
        if (reference === '') {
            $("#referenceSpan").text('Please fill out this field')
        }else {
            referenceid.val(reference.replace(/\s/g,""))
        }
    })
    referenceid.focus(function () {
        $("#referenceSpan").text('');
    })

    var submit = $('#continue');
    submit.click(function () {
        nameid.focus();
        nameid.blur();

        referenceid.focus();
        referenceid.blur();

        if ($('#nameSpan').text() === "" && $('#referenceSpan').text() === "") {
            $('#form3').submit();
        }
    })
    $("#back").click(function () {
        window.location.href='Index.html';
    });

})