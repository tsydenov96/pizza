$(document).ready(function(){
$('#first-next').on('click',nextScreen);
$('#first-back').on('click',backScreen);
// $('#first-next').on('click',nextScreen);
});

function nextScreen(){
	$('.form-1').hide();
	$('.form-2').show();
}

function backScreen(){
	$('.form-1').show();
	$('.form-2').hide();
}