
/* Form Validation Start Here... */
function validateForm(names){
	//var names = ['first_name', 'last_name', 'gender', 'nationality', 'country', 'country_phonecode_mobile', 'mobile', 'country_phonecode_whatsapp', 'whatsapp_mobile'];
	
	var names = names;
	
	var errorCount = 0;
	names.forEach((el) => {
		var val = document.forms["basicInfo"][el].value;
		if (val == null || val == "" || val == 0) {
			document.getElementById(el + '_error').style = 'color:red';
			document.getElementById(el + '_error').focus();
			document.getElementById(el + '_error').textContent = el.charAt(0).toUpperCase() + el.slice(1).replace('_', ' ') + " must be filled out";
			++errorCount;
		}
	});
	
	if (errorCount) return false;
	/* Form Validation End Here... */
	
}