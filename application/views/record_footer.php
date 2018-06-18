



<script>
    // $(function () {
    //   $('[data-toggle="popover"]').popover()
    //    })

  function pad(n){return n<10 ? '0'+n : n}


  function ajaxExecute(url, data, callBack, errorMsg){
		$.ajax({
				 url: url,
				 method: 'post',
				 data: data,
				 //dataType: 'json',
				 success: function(response){
							 var data = JSON.parse(unescape(replaceAll(response, "\\", "%")));  //유니코드를 한글로 변경
               console.log(data);
							 callBack(data);
				 },
         error: function(error){
            console.log(errorMsg+"에러가 발생되었습니다");
         },
         complete:function(){
         }

		 });
	}



  function replaceAll(strTemp, strValue1, strValue2){
              while(1){
                  if( strTemp.indexOf(strValue1) != -1 )
                      strTemp = strTemp.replace(strValue1, strValue2);
                  else
                      break;
              }
              return strTemp;
       }


  function popup_alert(message){
    $.confirm({
          content: message,
          buttons: {
              확인: {

              }
          }
      });

  }



</script>
  </body>

</html>
