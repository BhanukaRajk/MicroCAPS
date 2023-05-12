const connectivityCheckbox = document.getElementById('connectivity-cb');
const holdingCheckbox = document.getElementById('holding-cb');

holdingCheckbox?.addEventListener('change', (event) => {
  if (event.target.checked) {
    connectivityCheckbox.checked = false;
    connectivityCheckbox.disabled = true;
  } else {
    connectivityCheckbox.disabled = false;
  }
});

// const holdingCheckbox = document.querySelector('input[name="holding"]');
// const connectivityCheckbox = document.querySelector('input[name="connectivity"]');

// holdingCheckbox.addEventListener('change', function() {
//   if (this.checked) {
//     connectivityCheckbox.checked = false;
//     connectivityCheckbox.disabled = true;
//   } else {
//     connectivityCheckbox.disabled = false;
//   }
// });




// const itemsPerPage = 8;
// const items = document.querySelectorAll('.stage-control-row');
// const numItems = items.length;
// const pagination = document.getElementById('parent');
// const numPages = Math.ceil(numItems / itemsPerPage);

// let currentPage = 1;
// let start = 0;
// let end = itemsPerPage;

// function renderItems(page) {
//   start = (page - 1) * itemsPerPage;
//   end = start + itemsPerPage;
//   items.forEach((item, index) => {
//     if (index >= start && index < end) {
//       item.style.display = 'block';
//     } else {
//       item.style.display = 'none';
//     }
//   });
// }

// function setupPagination() {
//   pagination.innerHTML = '';

//   const prevButton = document.createElement('button');
//   prevButton.innerHTML = '&laquo;';
//   prevButton.addEventListener('click', () => {
//     if (currentPage > 1) {
//       currentPage--;
//       renderItems(currentPage);
//     }
//   });

//   const nextButton = document.createElement('button');
//   nextButton.innerHTML = '&raquo;';
//   nextButton.addEventListener('click', () => {
//     if (currentPage < numPages) {
//       currentPage++;
//       renderItems(currentPage);
//     }
//   });

//   pagination.appendChild(prevButton);

//   for (let i = 1; i <= numPages; i++) {
//     const button = document.createElement('button');
//     button.innerHTML = i;
//     button.addEventListener('click', () => {
//       currentPage = i;
//       renderItems(currentPage);
//     });
//     pagination.appendChild(button);
//   }

//   pagination.appendChild(nextButton);

//   renderItems(currentPage);
// }

// setupPagination();








showPage(1);


function showPage(pageNumber) {
  // Get all pagination items
  var items = document.getElementsByClassName('pagination-item');
  
  // Calculate start and end indices for items to show
  var startIndex = (pageNumber - 1) * 8;
  var endIndex = startIndex + 8;
  
  // Loop through all items and hide/show based on index
  for (var i = 0; i < items.length; i++) {
      if (i >= startIndex && i < endIndex) {
          items[i].style.display = 'flex';
      } else {
          items[i].style.display = 'none';
      }
  }
}