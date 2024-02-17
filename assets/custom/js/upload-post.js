const post_containers = document.querySelectorAll(".post-container");
const form = document.getElementById("form");
const submit_btn = document.getElementById("submit-btn");
const btn_loader = `<i class="fa-solid fa-circle-notch fa-spin"></i> Creating Account, Please Wait ....`;
const btn_text = submit_btn.innerHTML;
const messsage_container = document.getElementById("message-container");
const message_box = document.getElementById("message-box");
const editable_area = document.querySelector(".note-editable");
// Initialize Editro
// load editor
$(document).ready(function () {
	$("#editor").summernote();
});
function choosePostType(element) {
	// hide all post containers
	post_containers.forEach((container) => {
		const type = element.value;
		if (container.id !== `post-${type}`) container.classList.add("d-none");
		else container.classList.remove("d-none");
	});
}

async function addpost(event) {
	event.preventDefault(); // Prevent default form submission
	// Check Validations
	// Check if Summernote editor is empty
	var editorContent = document.getElementById("editor").value;
	var fileInput = document.getElementById("file_chooser").files[0]; // Get the selected file

	// Check if Summernote editor is empty and no file is selected
	if (editorContent.trim() === "" && !fileInput) {
		// Show validation error
		showErrorMessage("Please select a file or type a post!", "fail");
		return;
	}
	const formData = new FormData(form); // Get form data
	submit_btn.innerHTML = btn_loader;
	submit_btn.setAttribute("disabled", true);
	messsage_container.classList.add("d-none");
	try {
		const response = await fetch(form.action, {
			method: form.method,
			body: formData,
		});

		if (!response.ok) {
			console.log(response);
			throw new Error(`HTTP error! status: ${response.status}`);
		}

		const data = await response.json();
		messsage_container.classList.add("d-none");
		// redirect to account resgistered page
		if (data.statusText == "fail") {
			showErrorMessage(data.message, data.statusText);
		} else if (data.statusText == "success") {
			// when success clear all the fields of  the form
			showErrorMessage(data.message, data.statusText);
			$("#editor").summernote("code", "");
			form.reset();
		} else {
			showErrorMessage(data.message, data.statusText);
		}
		// You can handle the response data here
	} catch (error) {
		showErrorMessage(error, "danger");
		// Handle error
	} finally {
		submit_btn.innerHTML = btn_text;
		submit_btn.removeAttribute("disabled");
	}
}

function showErrorMessage(message, statusText) {
	let class_name = "primary";
	if (statusText === "fail") class_name = "danger";
	if (statusText === "success") class_name = "success";
	const applied_classes = [
		"alert",
		"text-center",
		"p-0",
		"pt-1",
		"pb-1",
		"ps-2",
		"pe-2",
	];
	// remove all classes
	var classes = message_box.className.split(" ");
	// Filter out all classes except "alert"
	var filteredClasses = classes.filter(function (className) {
		return applied_classes.includes(className);
	});
	// Set the class attribute of the div to only include "alert"
	message_box.className = filteredClasses.join(" ");
	// Add Message
	messsage_container.classList.remove("d-none");
	message_box.innerHTML = message;
	message_box.classList.add(`alert-${class_name}`);
	messsage_container.focus();
}

function validateFileType(input) {
	messsage_container.classList.add("d-none");
	const allowedTypes = [
		"gif",
		"jpg",
		"jpeg",
		"png",
		"bmp",
		"svg",
		"webp",
		"mp4",
		"avi",
		"mov",
		"wmv",
		"flv",
		"mkv",
		"3gp",
		"mpg",
		"mpeg",
		"swf",
	];

	const file = input.files[0];
	const fileName = file.name.toLowerCase();
	const fileType = fileName.substring(fileName.lastIndexOf(".") + 1);

	if (!allowedTypes.includes(fileType)) {
		showErrorMessage(
			"Invalid file type. Please select a file of type: gif, jpg, jpeg, png, bmp, svg, webp, mp4, avi, mov, wmv, flv, mkv, 3gp, mpg, mpeg, swf",
			"fail"
		);
		input.value = ""; // Clear the file input
	}
}
