



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
				 // dataType: 'object',
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
          title: '알려드립니다.',
          content: message,
          buttons: {
              확인: {

              }
          }
      });

  }



         /**
              * 입력 항목의 필수 값을 체크
              * 필수항목 바로 위의 div class 에 essential 을 붙이고 , input, select 에 text 속성으로 이름을 붙여야 한다.
              * @param argObjId : 체크할 최상위 element id
              * @returns {boolean}
              */
        function fnReqiredCheck(argObjId){
              var varRetBoolean = true;
              $('#'+argObjId).find('div').each(function(){
                  var varThClassId = $(this).attr('class');
                  // if(varThClassId !== undefined && varThClassId === 'essential'){
                  if(varThClassId !== undefined && varThClassId.match('essential')){
                      var varInput = $(this).next().find('input');
                      if(varInput !== undefined && varInput.attr('type') === 'text'){
                          if(varInput.val().replace(/(^\s*)|(\s*$)/gi, '') === ''){
                              // popup_alert($(this).text() + '은(는) 필수 입력항목입니다.');
                              popup_alert(varInput.attr('text') + '은(는) 필수 입력항목입니다.');
                              varInput.val('');
                              varInput.focus();
                              varRetBoolean = false;
                              return false;
                          }

                      }
                      var varSelect = $(this).next().find('select');
                      if(varSelect !== undefined && varSelect.val() === ''){
                          // popup_alert($(this).text() + '은(는) 필수 입력항목입니다.');
                          popup_alert(varSelect.attr('text') + '은(는) 필수 입력항목입니다.');
                          varInput.focus();
                          varRetBoolean = false;
                          return false;
                      }
                  }

              });
              return varRetBoolean;
          }



</script>
  </body>

</html>
