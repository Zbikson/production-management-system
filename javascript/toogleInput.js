function toggleInput() {
    var textInput = document.getElementById("password");
    textInput.disabled = !document.getElementById("passwordCheckbox").checked;
}