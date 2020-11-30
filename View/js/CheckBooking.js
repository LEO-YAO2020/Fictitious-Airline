$(document).ready(function (){

    $('#delete').click(function () {
        if (window.confirm("Are you sure?")) {
            $('#manageBook').submit()
        }
    })

    $("#bookagain").click(function () {
        window.location.href='../View/Bookinginfo.html'
    })
    $("#back").click(function () {
        window.location.href='../View/Index.html';
    });

})