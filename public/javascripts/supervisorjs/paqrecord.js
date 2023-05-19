const selectElements = document.querySelectorAll('select');

for (let i = 0; i < selectElements.length; i++) {
    selectElements[i].addEventListener('change', function () {
        let needAttention = false;
        for (let j = 0; j < selectElements.length; j++) {
            if (selectElements[j].value === 'NA') {
                needAttention = true;
                break;
            }
        }
        if (needAttention) {
            document.getElementById('option1').disabled = true;
            document.getElementById('option2').disabled = false;
            document.getElementById('option2').checked = true;
        } else {
            document.getElementById('option1').disabled = false;
            document.getElementById('option2').disabled = true;
            document.getElementById('option1').checked = true;
        }
    });
}



// Get all the required input elements
const selectFields = document.querySelectorAll('select[required]');
const inputFields = document.querySelectorAll('input[required]');
const checkboxFields = document.querySelectorAll('input[type="checkbox"][required]');

// Get the submit button element
const submitBtn = document.querySelector('#submit-btn');

// Function to check if all the required fields are filled
function checkRequiredFields() {
    let isValid = true;

    // Check if all the select fields are filled
    selectFields.forEach((field) => {
        if (!field.value) {
            isValid = false;
        }
    });

    // Check if all the input fields are filled
    inputFields.forEach((field) => {
        if (!field.value) {
            isValid = false;
        }
    });

    // Check if all the checkbox fields are checked
    checkboxFields.forEach((field) => {
        if (!field.checked) {
            isValid = false;
        }
    });

    // Enable/disable the submit button based on the validation result
    if (isValid) {
        submitBtn.disabled = false;
    } else {
        submitBtn.disabled = true;
    }
}

// Add event listeners to all the required input fields
selectFields.forEach((field) => {
    field.addEventListener('change', checkRequiredFields);
});

inputFields.forEach((field) => {
    field.addEventListener('input', checkRequiredFields);
});

checkboxFields.forEach((field) => {
    field.addEventListener('change', checkRequiredFields);
});
