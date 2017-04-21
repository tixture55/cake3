

$(function() {
		$("input[name='ticket_title']").val('');
		$("input[name='detail']").val('');
		$("input[name='target_name']").val('');



		$('.phui-header-header span:first-child').addClass('phui-tag-view phui-tag-type-shade phui-tag-shade phui-tag-shade-indigo phui-tag-icon-view');
		$('#menu').toggleClass('listitem');
		$('table td').each(function(){
				if($(this).text().indexOf('close') != -1){
				$('.reply').hide();

				}
				});

		$("input[type='submit']").click(function(){
				if($("input[name='detail']").val() == ""){
				alert('空です')

				// 処理を中断
				return false;
				}
				});


});
