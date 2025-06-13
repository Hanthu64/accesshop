const minInput = document.getElementById('minInput');
const maxInput = document.getElementById('maxInput');

minInput.addEventListener('blur', () => {
    if (parseInt(minInput.value) > parseInt(maxInput.value)) {
        minInput.value = maxInput.value;
    }
});

maxInput.addEventListener('blur', () => {
    if (parseInt(maxInput.value) < parseInt(minInput.value)) {
        maxInput.value = minInput.value;
    }
});
