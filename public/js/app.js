
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
