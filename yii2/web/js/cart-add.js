"use strict";

$(document).ready(function(){
	$('.btn-add').click(function(){
		var id = $(this).closest('form').find('input[name=goods_id]').val();
		var _csrf = $(this).closest('form').find('input[name=_csrf]').val();
		$.ajax({
			url: '/yii2/web/'+$(this).closest('form').attr('action'),
			type: 'POST',
			data: {id: id, _csrf: _csrf},
			success: function(response){
				//alert('Добавил!');
			},
			error: function(e){
				console.error(e);
			}
		})
	})
	$('.btn-add').click(function(){
		var id = $(this).attr('id');
		$('#'+id).removeClass('btn-info');
		$('#'+id).addClass('btn-success');
	})
});