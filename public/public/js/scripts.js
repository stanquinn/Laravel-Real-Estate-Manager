/**
 * Created with JetBrains WebStorm.
 * User: Erick
 * Date: 2/3/14
 * Time: 12:02 PM
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function(){

    // HOMEPAGE SLIDER
    $('.bxslider').bxSlider({
        mode: 'fade',
        captions: true,
        pager:false,
        auto:true
    });

    // FANCYBOX LIGHTBOX
    $('.fancybox').fancybox();
});

var calculate = function(){

	var downpayment = numeral().unformat($('#downpayment').val());

	var months = numeral().unformat($('#months').val());

	if(months == 0)
	{
		$('#months').val(12);
		calculate();

	}else{
		var total_contract_price = numeral().unformat($('#total_contract_price').val());

		var reservation_fee = numeral().unformat($('#reservation_fee').val());

		var percentage = (downpayment / 100) * total_contract_price;

		var equity = total_contract_price - reservation_fee - percentage;

		var monthly_fee = equity / months;

		$('#equity').val(numeral(equity).format('0,0.00'));

		$('#monthly_fee').val(numeral(monthly_fee).format('0,0.00'));

		$('#dp').text(numeral(percentage).format('0,0.00'));
	}


}