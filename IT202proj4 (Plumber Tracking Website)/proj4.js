document.addEventListener("DOMContentLoaded", () => {
	const firstName = document.getElementById("firstname");
	const lastName = document.getElementById("lastname");
	const password = document.getElementById("password");
	const plumberID = document.getElementById("plumberid");
	const phoneNum = document.getElementById("phonenumber");
	const email = document.getElementById("emailaddress");
	const emailCheckBox = document.getElementById("emailconfirmation");
	const transaction = document.getElementById("transactiontype");
	const submitButton = document.getElementById("submit");
	const theForm = document.getElementById("form");
	const passwordCheckBox = document.getElementById("showpasswordbox");
	const emailRequiredString = document.getElementById("emailrequired");
	function Plumber (firstName, lastName, password, plumberID, phoneNum, email){	
		this.firstName = firstName; // Constructor for plumber objects-->Makes verification easier.
		this.lastName = lastName;
		this.password = password;
		this.plumberID = plumberID;
		this.phoneNum = phoneNum;
		this.email = email;
	}
	
	function checkPassword(password) {
		return password.length <= 5 && /[A-Z]/.test(password) && /\W/.test(password) && /[0-9]/.test(password);
	}
	function checkID(id){
		return id.length === 4 && /^\d+$/.test(id);
	}
	function checkPhoneNum(phoneNum){
		let numCount = 0;
		let spaceOrDashCount = 0;
		for (let ch of phoneNum){
			if (/\d/.test(ch))
				numCount++;
			else if (ch !== '-' && !/\s/.test(ch))
				return false;
			if (ch === '-' || /\s/.test(ch))
				spaceOrDashCount++;
			if (spaceOrDashCount > numCount || numCount > spaceCount+1)
				return false;
		}
		return numCount === 10;
	}
	function checkEmail(email){
		let hasAt = false;
		let hasPeriod = false;
		domainCount = 0;
		for (let chara of email){
			if (chara == '@' && !hasPeriod){
				hasAt = true;
			}
			if (hasPeriod){
				domainCount++;
			}
			if (chara == '.' && hasAt){
				hasPeriod = true;
			}		
		}
		return hasAt && hasPeriod && domainCount >=2 && domainCount<=4;
	}
	passwordCheckBox.addEventListener("change", (e) =>{ //Show/Hide Password
		if (passwordCheckBox.checked){
		    password.type = "text";
	    }
	    else{
			password.type = "password";
	    }
    });
	emailCheckBox.addEventListener("change", (e) =>{ //Show/Hide Password
		if (emailCheckBox.checked){
			emailRequiredString.textContent = "REQUIRED";
		}
		else {
			emailRequiredString.textContent = "";
		}
	});
	submitButton.addEventListener("click", (e) => { //checking all input requirements before submitting form
		if (firstName.value.length == 0){
			e.preventDefault();
			alert("First Name is missing.");
			firstName.focus();
			return;
		}
		else if (lastName.value.length == 0){
			e.preventDefault();
			alert("Last Name is missing.");
			lastName.focus();
			return;
		}
		else if (!checkPassword(password.value)){
			e.preventDefault();
			alert("Password must contain a maximum of 5 characters, including at least 1 uppercase letter, one number, and one special character.");
			password.focus();
			return;
		}
		else if (!checkID(plumberID.value)){
			e.preventDefault();
			alert("ID must contain a 4-digit number.");
			plumberID.focus();
			return;
		}
		else if (!checkPhoneNum(phoneNum.value)){
			e.preventDefault();
			alert("Phone Number must be 10 digits delimited by either spaces or dashes.");
			phoneNum.focus();
			return;
		}
		else if (!checkEmail(email.value) && emailCheckBox.checked){
			e.preventDefault();
			alert("Email does not conform to requirements.");
			email.focus();
			return;
		}
		else{
			theForm.submit();
		}

	});
});


