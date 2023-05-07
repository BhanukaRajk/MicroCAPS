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

  let searchInput;
  let carSet, cars, car, car_cards, car_count, car_id;


  // value.toUpperCase() WILL CONVERT THE TEXT TO UPPERCASE
  searchInput = document.getElementById("searchBox").value.toUpperCase();
  // THIS WILL TAKE THE CONTAINER OF CAR CARDS
  carSet = document.getElementById("carList");

  // THIS WILL TAKE THE CHASSIS NUMBER FIELDS OF ALL CARS FROM CONTAINER
  cars = carSet.getElementsByClassName("chassisno");
  // THIS WILL TAKE THE FULL CARDS OF ALL VEHICLES FROM CONTAINER
  car_cards = carSet.getElementsByClassName("carcard");


  for (car_count = 0; car_count < cars.length; car_count++) {
    // GETTING ONE BY ONE CHASSIS NUMBER FROM CHASSIS NUMBER ARRAY
    car = cars[car_count];
    if (car) {
      // CHECKING THE INPUT INCLUDE IN ANY CHASSIS NUMBER
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


function searchPart() {

  let searchInput;
  let partSet, parts, part, part_records, part_count, part_name;

  // value.toUpperCase() WILL CONVERT THE TEXT TO UPPERCASE
  searchInput = document.getElementById("searchBox").value.toUpperCase();
  partSet = document.getElementById("partsTable");

  parts = partSet.getElementsByClassName("parts-col-01");
  part_records = partSet.getElementsByClassName("parts-table-row");

  for (part_count = 1; part_count < parts.length; part_count++) {
    part = parts[part_count];
    if (part) {
      part_name = part.textContent || part.innerText;
      if ((part_name.toUpperCase()).includes(searchInput)) {
        part_records[part_count].style.display = "";
      } else {
        part_records[part_count].style.display = "none";
      }
    } // IF part IS NULL SKIP IT
  }

}



function GoBack() {
  // GO BACK TO THE PREVIOUS PAGE
  window.history.back();
}