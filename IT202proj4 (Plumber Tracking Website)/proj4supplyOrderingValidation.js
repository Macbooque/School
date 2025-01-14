document.addEventListener("DOMContentLoaded", () => {
	const supplies = document.getElementById("supplies");
	const onSite = document.getElementById("onsite");
	const date = document.getElementById("datereceived");
	const serviceID = document.getElementById("serviceid");
	const theForm = document.getElementById("form");
	const submitButton = document.getElementById("submit");


	submitButton.addEventListener("click", (e) => {
		if (supplies.value.length === 0){
			e.preventDefault();
			alert("Supplies Needed section is missing.");
			supplies.focus();
		}
		else if (onSite.value.length === 0){
			e.preventDefault();
			alert("On Order or On Site portion is missing. Please specify one those two options.");
			onSite.focus();
		}
		else if (date.value.length === 0){
			e.preventDefault();
			alert("Date Received is missing.");
			date.focus();
		}
		else if (serviceID.value.length === 0){
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
			if (confirm("You are about to REQUEST supplies for your Customer. Are you sure you want to do so?")){
				theForm.submit();
			}
			else{
				e.preventDefault();
			}
		}
	});
});


