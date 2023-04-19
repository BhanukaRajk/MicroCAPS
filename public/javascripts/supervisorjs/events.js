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