$(document).ready(function () {
    $("#register").on("click",function () {
        var title = $('#title').val();
        var noteBody = $('#noteBody').val();

        $ajax({
            url : "/dashboardController/addNote",
            type : "POST",
            data : {Notetitle: title , body: noteBody} ,
            success : function(data){
            }

        });
      })
    });
    