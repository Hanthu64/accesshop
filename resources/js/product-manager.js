import './bootstrap';

const productDeleter = document.getElementsByClassName('product-deleter');
const productDeleteModal = document.getElementById('product-delete-modal');
const productEditor = document.getElementsByClassName('product-editor');
const deleteCancelIcon = document.getElementById('delete_cancel_icon');
const cancelIcon = document.getElementById('cancel_icon');
const cancelButton = document.getElementById('cancel_button');
const modalHolder = document.getElementById('modal_holder');
const modalBackdrop = document.getElementById('modal_backdrop');
const productMaker = document.getElementById('product-maker');

for(let u of productDeleter){
    u.addEventListener('click', () => {
        productDeleteModal.classList.remove("hidden");
        productDeleteModal.classList.add("fixed");

        setTimeout(() => {
            productDeleteModal.classList.add('opacity-100');
        }, 10);

        const deleteConfirm = document.getElementById('delete-confirm');
        deleteConfirm.action = deleteRouteTemplate.replace(':id', u.getAttribute('data-productid'));
    });
}

for(let u of productEditor){
    u.addEventListener('click', () => {
        fetch(`profile/product-edit/${u.getAttribute('data-productid')}`)
            .then(response => response.text())
            .then(data => document.getElementById('insertFormModal').innerHTML = data)
            .catch(error => console.error('Error:', error));

        modalHolder.classList.remove("hidden");
        modalBackdrop.classList.remove("hidden");
    });
}

productMaker.addEventListener('click', () => {
    fetch(`profile/product-create`)
        .then(response => response.text())
        .then(data => document.getElementById('insertFormModal').innerHTML = data)
        .catch(error => console.error('Error:', error));

    modalHolder.classList.remove("hidden");
    modalBackdrop.classList.remove("hidden");
});
cancelIcon.addEventListener('click', () =>{
    modalHolder.classList.add("hidden");
    modalBackdrop.classList.add("hidden");
});

deleteCancelIcon.addEventListener('click', () =>{
    productDeleteModal.classList.remove('opacity-100');
    setTimeout(() => {
        productDeleteModal.classList.remove("fixed");
        productDeleteModal.classList.add("hidden");
    }, 500);
});


cancelButton.addEventListener('click', () =>{
    productDeleteModal.classList.remove('opacity-100');
    setTimeout(() => {
        productDeleteModal.classList.remove("fixed");
        productDeleteModal.classList.add("hidden");
    }, 500);
});
