$(document).ready(function (){
    $.ajax({
        url:"../Controller/DepQuery.php",
        dataType:"json",
        success:function (resp) {

            $.each(resp,function (i,n) {
                $("#dep").append("<option value="+ n.dest+">"+ n.region+"</option>");
            })
        }
    })

    $("#dep").change(function (){
        var obj = $("#dep>option:selected");
        var depname = obj.val();

        $.get("../Controller/ArriveQuery.php",{depName:depname},callback,"json");
    })
    function callback(resp){
        $("#arr").empty();
        $.each(resp,function (i,n) {
            $("#arr").append("<option value="+ n.dest+">"+ n.region+"</option>");
        })
    }
})