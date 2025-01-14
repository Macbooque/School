document.addEventListener("DOMContentLoaded", () => {
	const customerID = document.getElementById("customerid");
	const theForm = document.getElementById("form");
	const submitButton = document.getElementById("submit");


	submitButton.addEventListener("click", (e) => {
		if (customerID.value.length === 0){
			e.preventDefault();
			alert("Customer ID is missing/required.");
			customerID.focus();
		}
		else{
			theForm.submit();
		}
	});
});


