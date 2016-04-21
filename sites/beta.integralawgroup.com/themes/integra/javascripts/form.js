function xmlhttpPost(strURL) {
	var form = document.forms['ContactUs'];
	if(validateForm(form) == false) {
		alert('Please fill all required fields!');
		return;
	}

    var xmlHttpReq = false;
    var self = this;

	if (window.XMLHttpRequest) {
		self.xmlHttpReq = new XMLHttpRequest;
	} else if (window.ActiveXObject) {
		try {
			xmlHttpReq = new ActiveXObject('Msxml2.XMLHTTP');
		} catch (ex) {
			try {
				xmlHttpReq = new ActiveXObject('Microsoft.XMLHTTP');
			} catch (ex) {
			}
		}
	}

	self.xmlHttpReq.open('POST', strURL, true);
//	self.xmlHttpReq.setRequestHeader('Content-Type', 'text/html; charset=utf-8'); // Not working in IE!!!
	self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    self.xmlHttpReq.onreadystatechange = function() {
        if (self.xmlHttpReq.readyState == 4) {
            updatepage(self.xmlHttpReq.responseText);
        }
    }
//	alert(getquerystring()); // For testing purposes
    self.xmlHttpReq.send(getquerystring());
}

function getquerystring() {
    var form = document.forms['ContactUs'];

	var Name = form.Name.value;
    var Phone = form.Phone.value;
    var Email = form.Email.value;
    var Message = form.Message.value;

	qstr = 'Name=' + Name;  // NOTE: no '?' before querystring
	qstr += '&Phone=' + Phone;
	qstr += '&Email=' + Email;
	qstr += '&Message=' + Message;
    return qstr;
}

function updatepage(str){
    document.getElementById("contact_us_box").innerHTML = str;
}

function validateForm(form) {
	var Name = form.Name.value;
    var Phone = form.Phone.value;
    var Email = form.Email.value;
    var Message = form.Message.value;
	
	if(Name == '')
		return false;

	if(Phone == '')
		return false;

	if(Email == '')
		return false;

	if(Message == '')
		return false;

	return true;
}