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
    // SUBMIT EMAIL
    $('#submit').click(function(){

        var tin_number = $('#tin_number_1').val() + $('#tin_number_2').val() + $('#tin_number_3').val() + $('#tin_number_4').val();
        $('#tin_number').val(tin_number);

        var email = $('.email-address').val() + '@' + $('.email-tld').val();
        $('#email').val(email);
        $('#userform').submit();
    });

    // PHONE NUMBERS VALIDATION
    $('#landline').keyup(function(){
    	var numbers = $(this).val();
    	if(numbers.length > 7)
    	{
    		$(this).val(numbers.substr(0,7));
    	}
    });
    $('#landline,#mobile').blur(function(){
        var v = $(this).val();
        if(v.match(/^\d+$/)){
            return true;
        }else{
            $(this).val("");
        }
    });

    $('#mobile').keyup(function(){
    	var numbers = $(this).val();
    	if(numbers.length > 11)
    	{
    		$(this).val(numbers.substr(0,11));
    	}
    });

    $('#tin_number_1').keyup(function(e){

    	var num = $('#tin_number_1').val();

    	if(num.length == 3)
    	{
    		$('#tin_number_2').focus();
    	}
    	if(num.length > 3)
    	{
    		var val = num.substr(0,3);
	    	$('#tin_number_1').val(val);
	    	$('#tin_number_2').focus();
    	}
        var v = $(this).val();
        if(v.match(/^\d+$/)){
            return true;
        }else{
            $(this).val("");
        }
    });

    $('#tin_number_2').keyup(function(e){

    	var num = $('#tin_number_2').val();
    	
    	if(num.length == 3)
    	{
    		$('#tin_number_3').focus();
    	}
    	if(num.length > 3)
    	{
    		var val = num.substr(0,3);
	    	$('#tin_number_2').val(val);
	    	$('#tin_number_3').focus();
    	}
        var v = $(this).val();
        if(v.match(/^\d+$/)){
            return true;
        }else{
            $(this).val("");
        }
    });

    $('#tin_number_3').keyup(function(e){

    	var num = $('#tin_number_3').val();
    	
    	if(num.length == 3)
    	{
    		$('#tin_number_3').focus();
    	}
    	if(num.length > 3)
    	{
    		var val = num.substr(0,3);
	    	$('#tin_number_3').val(val);
	    	$('#tin_number_4').focus();
    	}
        var v = $(this).val();
        if(v.match(/^\d+$/)){
            return true;
        }else{
            $(this).val("");
        }
    });

    $('#tin_number_4').keyup(function(e){

    	var num = $('#tin_number_4').val();
    	
    	if(num.length > 3)
    	{
    		var val = num.substr(0,3);
	    	$('#tin_number_4').val(val);
    	}
        var v = $(this).val();
        if(v.match(/^\d+$/)){
            return true;
        }else{
            $(this).val("");
        }
    });
    // LOCATION CHANGE
	$('#location').change(function(){
        console.log(1);
		//ajax request
		$.ajax({
			url:'/request_location',
			type:'POST',
			data:'location='+ $(this).val(),
			success:function(data)
			{
				console.log(data);
				// CLEAR ITEMS
				$('#type').html("");
				items = data;
				var id = $('#location').val();
				if(items.count  < 1 && id != "")
				{
					$.notify("The are no properties posted in this location.", "error");
				}

				$.each(items.types, function( index, value ) {
					var node = '<option value="'+index+'">'+value+'</option>';
				  	$('#type').append(node);
				});

			}
		});
	});

    $('#agree').click(function(){
        if($(this).is(':checked'))
        {
            $('#reserve-button').show();
        }else{
            $("#agree").notify("You must agree to our terms and conditions.");
            $('#reserve-button').hide();
        }
    });
});

var calculate = function(){

	var downpayment = numeral().unformat($('#downpayment').val());

	var months = numeral().unformat($('#months').val());

    var conversion = $('#conversion').val();

    var total_contract_price = numeral().unformat($('#total_contract_price').val());

    var reservation_fee = numeral().unformat($('#reservation_fee').val());

    if(conversion == 'fixed')
    {
            
            if(months == 0)
            {
                $('#months').val(12);
                calculate();

            }else{

                if(total_contract_price < downpayment)
                {
                    
                    resetCalc();
                    alert('Invalid Downpayment Amount!');
                }else if(total_contract_price == downpayment)
                {
                    var percentage = downpayment;

                    $('#loanable_amount').val(numeral(0).format('0,0.00'));

                    $('#monthly_fee').val(numeral(0).format('0,0.00'));

                    $('#dp').text(numeral(percentage).format('0,0.00'));  

                    $('#months').val(0);

                }else{

                    var percentage = downpayment;

                    var loanable_amount = total_contract_price - reservation_fee - percentage;

                    var monthly_fee = loanable_amount / months;

                    $('#loanable_amount').val(numeral(loanable_amount).format('0,0.00'));

                    $('#monthly_fee').val(numeral(monthly_fee).format('0,0.00'));

                    $('#dp').text(numeral(percentage).format('0,0.00'));
                }
            }

    }else{

        if(months == 0)
        {
            $('#months').val(12);
            calculate();

        }else{

            var percentage = (downpayment / 100) * total_contract_price;

            if(percentage > total_contract_price)
            {
                resetCalc();
                alert("Invalid Downpayment percentage");
            }else if(percentage == total_contract_price){

                $('#loanable_amount').val(numeral(0).format('0,0.00'));

                $('#monthly_fee').val(numeral(0).format('0,0.00'));

                $('#dp').text(numeral(percentage).format('0,0.00'));  

                $('#months').val(0);
            }else{
                var loanable_amount = total_contract_price - reservation_fee - percentage;

                var monthly_fee = loanable_amount / months;

                $('#loanable_amount').val(numeral(loanable_amount).format('0,0.00'));

                $('#monthly_fee').val(numeral(monthly_fee).format('0,0.00'));

                $('#dp').text(numeral(percentage).format('0,0.00'));
            }
        }
    }
}
var resetCalc = function()
{
    $('#months').val(12);
    $('#downpayment').val(15);
    $('#conversion').val('percentage');
    calculate();
}
var checkNan = function(self)
{
    var val = parseInt(self.value);
    if(isNaN(val) || val == 0)
    {
        self.value = 0;
    }
}

