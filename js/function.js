document.querySelectorAll(".viewpwd").forEach((element) => {
	let el = document.getElementById(element.getAttribute("for"));
	element.addEventListener("click", () => {
		let visibility = element.getElementsByTagName('span')[0].innerHTML;
		if (visibility === "visibility") {
			el.setAttribute("type", "text");
			element.getElementsByTagName('span')[0].innerHTML = "visibility_off";
		} else {
			el.setAttribute("type", "password");
			element.getElementsByTagName('span')[0].innerHTML = "visibility";
		}
		el.focus();
	});
});

document.querySelectorAll(".form-group").forEach((element) => {
	let label = element.querySelector(".input-label");
	if (!label) return;
	let id = label.getAttribute("for");
	let input = document.getElementById(id);
	if (!input) return;
	input.addEventListener("input", (event) => {
		if (input.value.length > 0) {
			input.classList.remove("wrong");
			label.classList.remove("wrong-label");
			label.classList.add("focused");
		} else if (input.value.length === 0) {
			if (!input === document.activeElement)
				label.classList.remove("focused");
			input.classList.add("wrong");
			label.classList.add("wrong-label");
		}
	});
	input.onfocus = () => {
		if (input.value.length === 0 && input.classList.contains("clicked")) {
			label.classList.remove("focused");
			input.classList.add("wrong");
			label.classList.add("wrong-label");
		} else if (input.value.length >= 0) {
			label.classList.add("focused");
			input.classList.remove("wrong");
			label.classList.remove("wrong-label");
		}
		input.classList.add("clicked");
	};

	input.onblur = () => {
		if (input.value.length === 0) {
			input.classList.add("wrong");
			label.classList.remove("wrong-label");
			label.classList.remove("focused");
		}
	};
});