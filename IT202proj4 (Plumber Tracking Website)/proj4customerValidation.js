document.addEventListener("DOMContentLoaded", () => {
	const firstName = document.getElementById("customerfirstname");
	const lastName = document.getElementById("customerlastname");
	const customerID = document.getElementById("customerid");
	const theForm = document.getElementById("form");
	const submitButton = document.getElementById("submit");

	function checkID(id){
		return id.length === 4 && /^\d+$/.test(id);
	}

	submitButton.addEventListener("click", (e) => {
		if (firstName.value.length === 0){
			e.preventDefault();
			alert("First Name is missing.");
			firstName.focus();
		}
		else if (lastName.value.length === 0){
			e.preventDefault();
			alert("Last Name is missing.");
			lastName.focus();
		}
		else if (!checkID(customerID.value)){
			e.preventDefault();
			alert("ID must contain a 4-digit number.");
			customerID.focus();
		}
		else{
			theForm.submit();
		}
	});
});


