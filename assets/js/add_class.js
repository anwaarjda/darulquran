
$(document).ready(function(){
	$("#btn_save").click(function(e){
		e.preventDefault();
		var error=0;
		if($("class_no").val()==="")
		{
			error=1;
			$("class_no").html(' نمبر درج کریں');
		}

		if (error==0){
			$("#student_form").submit();
		}
	});


});
