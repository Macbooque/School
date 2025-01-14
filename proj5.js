
function sendInput() {
	var form = $("#form");
	var loginFailInputArea = $("#loginFail");
	$.post("proj5.php", form.serialize())

		.done(function(response) {
			if (response === "loginFail"){
				loginFailInputArea.val("Chat not Updated: Wrong Credentials.");
			}
			else {
				loginFailInputArea.val("");
			}
		})
		/*
		.fail(function(xhr, status, error) {
			alert("PHP error: " + error);
		});

		 */
}

setInterval(listener, 100);

function listener(){
	var form = $("#form");
	var listenArea = $("#listenArea");
	$.post("proj5listen.php", form.serialize())
		.done(function(response) {
			listenArea.val(response);
		})
		/*
		.fail(function(xhr, status, error) {
			alert("PHP error: " + error);
		});

		 */
}
