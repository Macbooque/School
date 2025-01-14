document.addEventListener("DOMContentLoaded", () => {
	const serviceID = document.getElementById("serviceid");
	const theForm = document.getElementById("form");
	const submitButton = document.getElementById("submit");
	const hiddenInput = document.getElementById('hiddeninput');




	submitButton.addEventListener("click", (e) => {
		if (serviceID.value.length === 0){
			e.preventDefault();
			alert("Service Appointment ID is missing.");
			serviceID.focus();
		}
		else if (!/^\d+$/.test(serviceID.value)) {
			e.preventDefault();
			alert("Service Appointment ID must be a number.");
			serviceID.focus();
		}
		else{

			if (confirm("You are about to CANCEL this service appointment. Canceling this service appointment will also cancel any supplies ordered for the service. Are you sure you want to do so?")){
				theForm.submit();
			}
			else{
				e.preventDefault();
			}
		}
	});
});


