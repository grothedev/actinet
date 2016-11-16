var accountTypeInput;

function init(){
	accountTypeInput = document.getElementById("account_type");

	$('#register_club').hide();
	$('#register_student').show();
}

function viewSwitcher(){
	console.log(accountTypeInput.options[accountTypeInput.selectedIndex].value);

	if (accountTypeInput.options[accountTypeInput.selectedIndex].value == 's'){
		$('#register_club').hide(350);
		$('#register_student').show(350);
	} else {
		$('#register_club').show(350);
		$('#register_student').hide(350);
	}

}