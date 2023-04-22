const consumeTypeSelect = document.getElementById('consume-type');
const conStatusInput = document.querySelector('.new-con-status');

consumeTypeSelect.addEventListener('change', (event) => {
  const selectedType = event.target.value;
  switch (selectedType) {
    case 'Lubricant':
      conStatusInput.placeholder = 'Stock quantity (Liters)';
      break;
    case 'Grease':
      conStatusInput.placeholder = 'Stock quantity (KG)';
      break;
    default:
      conStatusInput.placeholder = 'Stock quantity';
  }
});

function navbartoggle(x) {
  x.classList.toggle("change");
}



var acc = document.getElementsByClassName("sup-leave-list-non-edit");
console.log("HI");

var number;

for (number = 0; number < acc.length; number++) {
  acc[number].addEventListener("click", function () {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}