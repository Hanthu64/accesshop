document.addEventListener('DOMContentLoaded', function () {
    const roleSelector = document.getElementById('role');
    const shopSelector = document.getElementById('shop');

    roleSelector.addEventListener('change', function () {
        if (this.value === 'provider') {
            shopSelector.classList.remove('hidden');
            shopSelector.classList.add('block');
        } else {
            shopSelector.classList.remove('block');
            shopSelector.classList.add('hidden');
        }
    });
});
