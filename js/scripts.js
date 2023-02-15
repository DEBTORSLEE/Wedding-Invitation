
function toastAction(id){
	
	const toastLive = document.getElementById("liveToast"+id);
	const toastLiveBody = document.getElementById("toast-body"+id);

	const toast = new bootstrap.Toast(toastLive);
	toast.show()
	
	var $temp = $("<input>");
	  $("body").append($temp);
	  $temp.val(toastLiveBody.innerText).select();
	  document.execCommand("copy");
	  $temp.remove();

	
	
}

function postAttendees(){
	var queryString = $("form[name=attendeesForm]").serialize() ;

	$.ajax({ 
		url:"attendees/register.php", 
		type: "POST",
		data : queryString,
		dataType : 'json',
		success:function(request){
			if(request=="1"){
				alert("참석여부를 등록하셨습니다!");
					
				$('#myModal').modal('hide');
				$('.modal-backdrop').hide();
			}
			if(request=="0"){
				alert("이미 등록된 신랑/신부측, 관계와 성함입니다.");					
			}
				},
		error: function(request, status, error){ 
		
		
	}
	}
	);

}
var cntClick = 0;
function clickMain(){
	if(cntClick>5)
		location.href="/wedding/attendees/";
	else
		cntClick+=1;
}

function reloadMessage(){
	
	$.ajax({ 
		url:"/wedding/message/getWeddingMessage.php", 
		type: "GET",
		dataType : 'text',
		success:function(request){

			var $carousel = $('.carousel').flickity('resize');
			$carousel.flickity('destroy');
				$('.carousel').empty();
				
				$(".carousel").append(request);

				$carousel.flickity();
				},
		error: function(request, status, error){ // 통신 실패시 - 로그인 페이지 리다이렉트
		
				console.log(request);
	}
	}
	);
}

function addReply(){
		var queryString = $("form[name=formReply]").serialize() ;
		var getString = queryString.split("&");
		var check = true;
		getString.forEach(element =>{ 
			var sp = element.split("=");
			
			if(sp[1]< 1 && sp[0]=="writer"){
				alert("닉네임을 다시 입력해주세요!");
				check = false;
				return;
			}
			if(sp[1]< 1 && sp[0]=="content"){

				alert("내용을 다시 입력해주세요!");
				check = false;
				return;
			}
			if(sp[1]< 1 && sp[0]=="pwd"){
				alert("비밀번호를 다시 입력해주세요!");
				check = false;
				return;
			}
		} );
		if(check){
			$.ajax({
				url:"/wedding/message/register.php", 
				type: "POST",
				data : queryString,
				dataType : 'json',
				success:function(request){
					
				  reloadMessage();
						},
				error: function(request, status, error){



				},complete: function(data) {

					
				}
			}
			);
		}
	
	
	
}
$('.button-block button').on('click', function(){
  var $this = $(this).parent();
  $this.toggleClass('canceled');
  return false;
});

function deleteMessage(pk){
	const pwd = window.prompt("비밀번호를 입력하세요", "");
	console.log(pwd);
	if(pwd=="")
	{
		alert('비밀번호를 다시 입력하세요');
		return;
	}else{
		
	$.ajax({
		url:"/wedding/message/deleteMessage.php", 
		type: "POST",
		data : {'pwd':pwd,'pk':pk},
		dataType : 'json',
		success:function(request){
			if(request.success)
				reloadMessage();
			else
				alert("비밀번호가 일치하지 않습니다.");

				},
		error: function(request, status, error){
		  
		
		},complete: function(data) {

			
		}
	}
	);
	}
}