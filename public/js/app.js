
$("[data-toggle=tooltip").tooltip();


function ValidateEmail(email) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
  {
    return (true)
  }
    return (false)
}

function validatePhonenumber(phoneNumber)
{
  	if(!isNaN(phoneNumber) && !(phoneNumber.replace(' ','') == ''))
	{
		return true;
	}
	else
	{
		return false;
	}
}

$("#domestic").on("click",function(){

        $(".provinceopening").css({'border' : '1px solid #96c8da','color' : '#285363'});
        $(".provinceopening").attr('disabled', false);
        $("#postal-code-add").css({'border' : '1px solid #96c8da','color' : '#285363'});
        $("#postal-code-add").attr('disabled', false);
        $("#opening_city").css({'border' : '1px solid #dededf','color' : '#dededf'});
        $("#opening_city").attr('disabled', true);
        $(".opening_country").css({'border' : '1px solid #dededf','color' : '#dededf'});
        $(".opening_country").prop('disabled', true);

        // $("#domestic-address").css('display' , 'initial');
        // $("#international-address").css('display' , 'none');
    });

$("#international").on("click",function(){
        $(".provinceopening").css({'border' : '1px solid #dededf','color' : '#dededf'});
        $(".provinceopening").attr('disabled', true);
        $("#postal-code-add").css({'border' : '1px solid #dededf','color' : '#dededf'});
        $("#postal-code-add").attr('disabled', true);
        $("#opening_city").css({'border' : '1px solid #96c8da', 'color' : '#285363'});
        $("#opening_city").prop('disabled', false);
        $(".opening_country").css({'border' : '1px solid #96c8da', 'color' : '#285363'});
        $(".opening_country").prop('disabled', false);

        // $('.opening_country').prop('disabled', false);
        // $("#domestic-address").css('display' , 'none');
        // $("#international-address").css('display' , 'initial');        
    });


    // function domesticAddress() {
    //     document.getElementById('country').disabled=true;document.getElementById('city').disabled=true;document.getElementById('provincecreate').disabled=false;document.getElementById('postal').disabled=false;
    // }
    // function internationalAddress() {
    //     document.getElementById('country').disabled=false;
    //     document.getElementById('city').disabled=false;
    //     document.getElementById('provincecreate').disabled=true;
    //     document.getElementById('postal').disabled=true;
    //     }

/*$(document).ready(function() {
    var timeToDisplay = 2000;

    var slideshow = $('.landing-cover-bg');
    var urls = [
       'https://images.unsplash.com/photo-1514996937319-344454492b37?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=61beb42b2efcc73d2901212c163858e3&auto=format&fit=crop&w=1500&q=80ng',
       'https://images.unsplash.com/photo-1508921234172-b68ed335b3e6?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=92e40b3819e4c173debf1500f27c9b60&auto=format&fit=crop&w=1500&q=80',
       'https://images.unsplash.com/photo-1467283492892-4326fa405008?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=27f86143df90b919cafb2f63c33f1a3c&auto=format&fit=crop&w=1567&q=80'
    ];

    var index = 0;
    var transition = function() {
        var url = urls[index];

        slideshow.css('background-image', 'url(' + url + ')');
        slideshow.css('background-color', 'rgba(0, 0, 0, 0.5)');

        index = index + 1;
        if (index > urls.length - 1) {
            index = 0;
        }
    };
    
    var run = function() {
        transition();
        slideshow.fadeIn('slow', function() {
            setTimeout(function() {
                slideshow.fadeOut(3000, run);
            }, timeToDisplay);
        });
    }
        
    run();
});*/

(function($) { 
	
	var bgImageArray = ['photo-1508921234172-b68ed335b3e6?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=92e40b3819e4c173debf1500f27c9b60&auto=format&fit=crop&w=1500&q=80', 'photo-1448932223592-d1fc686e76ea?ixlib=rb-0.3.5&s=990bfb15aef2718e2488c1c36452afc4&auto=format&fit=crop&w=1498&q=80','photo-1497493292307-31c376b6e479?ixlib=rb-0.3.5&s=413bf668e2139f6aae03f6355bcd59a7&auto=format&fit=crop&w=1502&q=80','photo-1508921234172-b68ed335b3e6?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=92e40b3819e4c173debf1500f27c9b60&auto=format&fit=crop&w=750&q=80'],
	base = "https://images.unsplash.com/",
	secs = 4;
	bgImageArray.forEach(function(img){
	    new Image().src = base + img; 
	    // caches images, avoiding white flash between background replacements
	});
	
	function backgroundSequence() {
  	console.log('url(' + base + bgImageArray[0] +')');
		window.clearTimeout();
		var k = 0;
		for (i = 0; i < bgImageArray.length; i++) {
			setTimeout(function(){ 
				$('.tab-content-wrapper').css({
        	'background': "url(" + base + bgImageArray[k] + ") no-repeat center center fixed rgba(0,0,0,.7)"
        });
				$('.tab-content-wrapper').css({
        	'background-size': "cover"
        });				
			if ((k + 1) === bgImageArray.length) { setTimeout(function() { backgroundSequence() }, (secs * 1000))} else { k++; }			
			}, (secs * 3000) * i)	
		}
	}
	backgroundSequence();  
	
}(jQuery));