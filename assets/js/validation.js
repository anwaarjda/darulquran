$(document).ready(function(){
	$("#btn_sub").click(function(e){
		e.preventDefault();
		var error=0;
		if($("#email").val()=="")
		{
			error=1;
			$("#email_error").html("رکن کا نام درکار ہے");
		}
		if ($("#password").val()=="")
		{
			error=1;
			$("#password_error").html("خفہ کوڈ درکار ہے");
		}
		if (error==0){
			$("#login_form").submit();
		}
	});


});
