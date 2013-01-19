$(document).ready(function(){


$('input:checkbox').change(function() {
  $.post(base_url + 'index.php/permission/update', {
    id: $(this).attr("id"),
    field : $(this).attr("name"),
    value: $(this).attr("checked")?1:0
  }, function(data){
    if(data.success) {
    } else {
    }
  }, 'json');
  return false;  
});



});