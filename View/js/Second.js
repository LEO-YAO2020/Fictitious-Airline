window.onload = function () {
    var submitBtnElt = document.getElementById("submit");
    submitBtnElt.onclick = function() {
        var check1 = document.getElementById("check1");
        var check2 = document.getElementById("check2");
        var form = document.getElementById('form');

        if (check1!=null&&check2!=null){
            form.submit();
        }
    }
}