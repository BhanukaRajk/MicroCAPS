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