document.addEventListener("DOMContentLoaded", () => {
	const appointmentDate = document.getElementById("serviceappointmentdate");
	const appointmentTime = document.getElementById("serviceappointmenttime");
	const serviceType = document.getElementById("servicetype");
	const cost = document.getElementById("cost");
	const theForm = document.getElementById("form");
	const submitButton = document.getElementById("submit");


	submitButton.addEventListener("click", (e) => {
		if (appointmentDate.value.length === 0){
			e.preventDefault();
			alert("Appointment Date is missing.");
			appointmentDate.focus();
		}
		else if (appointmentTime.value.length === 0){
			e.preventDefault();
			alert("Appointment Time is missing.");
			appointmentTime.focus();
		}
		else if (serviceType.value.length === 0){
			e.preventDefault();
			alert("Service Type is missing.");
			serviceType.focus();
		}
		else if (cost.value.length === 0){
			e.preventDefault();
			alert("Cost is missing.");
			cost.focus();
		}
		else{
			theForm.submit();
		}
	});
});


