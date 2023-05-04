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

function searchCar() {

  let searchInput; // TO GET THE VALUE FROM SEARCH BAR
  let carSet; // THIS WILL TAKE THE CONTAINER OF CAR CARDS
  let cars; // THIS WILL TAKE THE CHASSIS NUMBER FIELDS OF ALL CARS
  let car; // THIS WILL TAKE THE CHASSIS NUMBER FIELD OF CURRENT VEHICLE
  let car_cards; // THIS WILL TAKE THE FULL CARDS OF ALL VEHICLES
  let car_count; // THIS WILL TAKE THE NUMBER OF CARD
  let car_id; // THIS WILL GET THE CHASSIS NUMBER FROM car VARIABLE

  // value.toUpperCase() WILL CONVERT THE TEXT TO UPPERCASE
  searchInput = document.getElementById("searchBox").value.toUpperCase();
  carSet = document.getElementById("carList");

  cars = carSet.getElementsByClassName("chassisno");
  car_cards = carSet.getElementsByClassName("carcard");

  for (car_count = 0; car_count < cars.length; car_count++) {
    car = cars[car_count];
    if (car) {
      car_id = car.textContent || car.innerText;
      if ((car_id.toUpperCase()).includes(searchInput)) {
        // car_cards[i].classList.remove("display-none");
        car_cards[car_count].style.display = "";
      } else {
        // car_cards[i].classList.toggle("display-none");
        car_cards[car_count].style.display = "none";
      }
    } // IF car IS NULL SKIP IT
  }

}



function GoBack() {
  // GO BACK TO THE PREVIOUS PAGE
  window.history.back();
}