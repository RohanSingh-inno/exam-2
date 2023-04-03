
$(document).ready(function () {
  function loadmoreData(page) {
    $.ajax({
      url: "/dashboardController/loadMore",
      type: "POST",
      data: { page_no: page },
      success: function (data) {
        if(data){
          $(".loadMore").remove();
          $("#page").append(data);
        }else{
          $(".ajaxbtn").prop("disabled",true)
        }
      }
    });
  }
  loadmoreData();

  $(document).on("click",".ajaxbtn",function () {
    $(".ajaxbtn").html("Loading...")
    var pid = $(this).data("id");
    loadmoreData(pid);
  })
});
