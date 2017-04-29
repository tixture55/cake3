

$(function() {
		$("input[name='ticket_title']").val('');
		$("input[name='detail']").val('');
		$("input[name='target_name']").val('');



		$('.phui-header-header span:first-child').addClass('phui-tag-view phui-tag-type-shade phui-tag-shade phui-tag-shade-indigo phui-tag-icon-view');
		$('.phui-property-list-section span').addClass('phui-tag-view phui-tag-type-shade phui-tag-shade phui-tag-shade-indigo phui-tag-icon-view');
		$('#menu').toggleClass('listitem');
		$('table td').each(function(){
				if($(this).text().indexOf('close') != -1){
				$('.reply').hide();

				}
				});
		$(document).ready(function () {
				$("#commit").click(function () {
						inputText = $(".commit_search").val();
						$('a').each(function(){
							if($(this).text().indexOf(inputText) != -1){

							}else{
								$(this).hide();

							}
						});
				})
		})
		
		$("input[type='submit']").click(function(){
				if($("input[name='detail']").val() == ""){
				alert('空です')

				// 処理を中断
				return false;
				}
		});
		
		$(document).on('click', '.button3', function (){
			$.get('/cake3/tickets/modify', { 
				name:$('#ticket_id').text()     
			}, function(data){      
				$('#read_status').html("既読");   
				$('.button3').hide();
			});
		});


});
