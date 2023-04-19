

var inputField = document.getElementById("birthyear");

inputField.addEventListener("input", function() {
  if (this.value.length > 4) {
    this.value = this.value.slice(0,4);
  }
});

