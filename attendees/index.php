<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
var getpass =prompt('비밀번호를 입력하세요.');

$.ajax({ 
		url:"https://debtolee.pe.kr/wedding/attendees/check_password.php", 
		type: "POST",
		data : {'pwd':getpass},
		dataType : 'json',
		success:function(request){
	
			if(request.success ==true){
				alert("권한이 허용되었습니다.");
				
			}
			else{
				alert("권한이 없습니다.");	
				 $('table').remove();


			}
		},
		error: function(request, status, error){ // 통신 실패시 - 로그인 페이지 리다이렉트
			alert("status : " + request.status + ", message : " + request.responseText + ", error : " + error);
		}
	}
	);
</script>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
	<div class="container">
		<div class="row">
			<button class="col btn btn-light" onclick="getList('')";>전체</button>
			<button class="col btn btn-light" onclick="getList('신랑측');">신랑측</button>
			<button class="col btn btn-light" onclick="getList('신부측')">신부측</button>
		</div>
	</div>
	<div class="container">
		<br>
	
		<table class="table">
				<thead>
				
					<tr class="h2">
					  <th class="col text-center" id="totalTitle" colspan=4>총합</th>
					  
					  <th class="col" colspan=2 id="total"></th>
					</tr>
					<tr>
					  <th class="col">#</th>
					  <th class="col">신랑/신부</th>
					  <th class="col">관계</th>
					  <th class="col">성함</th>
					  <th class="col">식사 명수</th>
					  <th class="col">작성일</th>
					</tr>
				</thead>
				<tbody id="tbody">
					
					
				
				</tbody>
			</table>
	</div>
	<script>
	
function getList(part){
	
$.ajax({ 
		url:"https://debtolee.pe.kr/wedding/attendees/getList.php", 
		type: "POST",
		data : {'part':part},
		dataType : 'json',
		success:function(request){
			console.log(request);
			$("#tbody").html(request.td);
			$("#total").text(request.total);
			$("#totalTitle").text(part+" 총합");
			
		},
		error: function(request, status, error){ // 통신 실패시 - 로그인 페이지 리다이렉트
		}
	}
	);
}
getList("");
</script>
</body>

