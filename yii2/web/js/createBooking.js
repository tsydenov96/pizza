"use strict";

$(document).ready(function(){
$('#first-next').click(function(){
	var name = $(this).closest('form').find('input[name="Booking[user_name]"]').val();
	var surname = $(this).closest('form').find('input[name="Booking[user_surname]"]').val();
	var patronymic = $(this).closest('form').find('input[name="Booking[user_patronymic]"]').val();
	var phone = $(this).closest('form').find('input[name="Booking[user_phone]"]').val();
	var street = $(this).closest('form').find('input[name="Booking[user_street]"]').val();
	var house_num = $(this).closest('form').find('input[name="Booking[user_house_number]"]').val();
	var apartment_num = $(this).closest('form').find('input[name="Booking[user_apartment_number]"]').val();
	var entrance_num = $(this).closest('form').find('input[name="Booking[user_entrance_number]"]').val();
	var floor = $(this).closest('form').find('input[name="Booking[user_floor_number]"]').val();
	var intercom = $(this).closest('form').find('input[type="radio"]').val();
	var _csrf = $(this).closest('form').find('input[name=_csrf]').val();
	var data = {name: name, surname: surname, patronymic: patronymic, phone: phone, street: street, house_num: house_num, apartment_num: apartment_num, entrance_num: entrance_num, floor: floor, intercom: intercom, _csrf: _csrf}
	console.log(data);
	$.ajax({
			url: $(this).closest('form').attr('action'),
			type: 'POST',
			data: data,
			success: function(response){
				alert('Работает!');
			},
			error: function(e){
				console.error(e);
			}
		})
	nextScreen();
})
// $('#first-back').click(function(){

// })
});

function nextScreen(){
	$('.form-1').hide();
	$('.form-2').show();
}

function backScreen(){
	$('.form-1').show();
	$('.form-2').hide();
}
