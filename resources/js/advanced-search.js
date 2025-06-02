const minRange = document.getElementById('minRange');
const maxRange = document.getElementById('maxRange');
const minInput = document.getElementById('minInput');
const maxInput = document.getElementById('maxInput');
const rangeTrack = document.getElementById('rangeTrack');

const updateInputs = () => {
    minInput.value = minRange.value;
    maxInput.value = maxRange.value;
    updateTrack();
};

const updateTrack = () => {
    const min = parseInt(minRange.value);
    const max = parseInt(maxRange.value);
    const total = parseInt(minRange.max);

    const left = (min / total) * 100;
    const right = 100 - (max / total) * 100;

    rangeTrack.style.left = `${left}%`;
    rangeTrack.style.right = `${right}%`;
};

// Sincronización sliders -> inputs
minRange.addEventListener('input', () => {
    if (parseInt(minRange.value) > parseInt(maxRange.value)) {
        minRange.value = maxRange.value;
    }
    updateInputs();
});

maxRange.addEventListener('input', () => {
    if (parseInt(maxRange.value) < parseInt(minRange.value)) {
        maxRange.value = minRange.value;
    }
    updateInputs();
});

// Sincronización inputs -> sliders
minInput.addEventListener('input', () => {
    minRange.value = minInput.value;
    minRange.dispatchEvent(new Event('input'));
});

maxInput.addEventListener('input', () => {
    maxRange.value = maxInput.value;
    maxRange.dispatchEvent(new Event('input'));
});

// Inicializar
updateTrack();
