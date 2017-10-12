"use strict";

$(document).ready(function(){
	$('.btn-add').click(function(){
		var id = $(this).closest('form').find('input[name=goods_id]').val();
		var _csrf = $(this).closest('form').find('input[name=_csrf]').val();
		// if (localStorage){
		// 	var cart = JSON.parse(localStorage.getItem('cart')) || [];
		// 	var i = 0; 
		// 	for(i = 0 ; i < cart.length ; i++){
		// 		if (cart[i].goods_id == id){
		// 			cart[i].count++;
		// 			break;
		// 		}
		// 	}
		// 	if (i == cart.length){
		// 		window.state.goods[id].count = 1;
		// 		cart.push(window.state.goods[id]);
		// 	}
		// 	localStorage.setItem('cart', JSON.stringify(cart));
		// }
		$.ajax({
			url: '/pizza/yii2/web/'+$(this).closest('form').attr('action'),
			type: 'POST',
			data: {id: id, _csrf: _csrf},
			success: function(response){
				alert('Добавил!');
			},
			error: function(e){
				console.error(e);
			}
		})
	})
});