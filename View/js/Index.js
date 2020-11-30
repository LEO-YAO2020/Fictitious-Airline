window.onload = function () {

    var input = document.getElementById('leaveTime')
    var dateError = document.getElementById('dateError')
    input.onblur = function () {
        var date = input.value;
        if (date === "") {
            dateError.innerText = "Please fill out this field"
        }
    }

    input.onfocus = function () {
        dateError.innerText = "";
    }
    var input1 = document.getElementById('returnTime')
    var dateError1 = document.getElementById('dateError2')
    input1.onblur = function () {
        var date1 = input1.value;
        if (date1 === "") {
            dateError1.innerText = "Please fill out this field"
        }
        if (date1 < input.value) {
            dateError1.innerText = "Error Date enter again"
        }
    }
    input1.onfocus = function () {
        dateError1.innerText = "";
    }
    $("input[type='radio'][name='trip']").change(function () {
        if (this.value === "one-way") {
            $('#returnTime').prop('disabled', true);
            if (dateError1.innerText !== ""){
                dateError1.innerText = ""
            }
        } else if (this.value === "return") {
            $('#returnTime').prop('disabled', false);
            input1.onblur = function () {
                var date1 = input1.value;
                if (date1 === "") {
                    dateError1.innerText = "Please fill out this field"
                }
                if (date1 < input.value) {
                    dateError1.innerText = "Error Date enter again"
                }
            }
            input1.onfocus = function () {
                dateError1.innerText = "";
            }
        }
    })

    var submit = document.getElementById('button');
    submit.onclick = function () {
        input.focus();
        input.blur();

        input1.focus();
        input1.blur();

        if($("#dep option:selected").text()==='Airport or city') {
            $("#from").text("Please Choose departure area")
        }else {
            $("#from").text("")
        }

        if (dateError.innerText === "" && dateError1.innerText === "") {
            if($("#dep option:selected").text()!=='Airport or city') {

                var form = document.getElementById('form');
                form.submit();
            }
        }
    }
    var date_now = new Date();
    var year = date_now.getFullYear();

    var month = date_now.getMonth()+1 < 10 ? "0"+(date_now.getMonth()+1) : (date_now.getMonth()+1);

    var date = date_now.getDate() < 10 ? "0"+date_now.getDate() : date_now.getDate();

    $("#leaveTime").attr("min",year+"-"+month+"-"+date);
    $("#returnTime").attr("min",year+"-"+month+"-"+date);

}