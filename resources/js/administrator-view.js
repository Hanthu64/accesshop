import './bootstrap';

const userDeleter = document.getElementsByClassName('user-deleter');
const userDeleteModal = document.getElementById('user-delete-modal');
const userEditor = document.getElementsByClassName('user-editor');
const deleteCancelIcon = document.getElementById('delete_cancel_icon');
const cancelIcon = document.getElementById('cancel_icon');
const cancelButton = document.getElementById('cancel_button');
const modalHolder = document.getElementById('modal_holder');

for(let u of userDeleter){
    u.addEventListener('click', () => {
        userDeleteModal.classList.remove("hidden");
        userDeleteModal.classList.add("fixed");

        setTimeout(() => {
            userDeleteModal.classList.add('opacity-100');
        }, 10);

        const deleteConfirm = document.getElementById('delete-confirm');
        deleteConfirm.action = deleteRouteTemplate.replace(':id', u.getAttribute('data-userid'));
    });
}

for(let u of userEditor){
    u.addEventListener('click', () => {
        fetch(`profile/user-edit/${u.getAttribute('data-userid')}`)
            .then(response => response.text())
            .then(data => document.getElementById('insertFormModal').innerHTML = data)
            .catch(error => console.error('Error:', error));

        modalHolder.classList.remove("hidden");
    });
}

cancelIcon.addEventListener('click', () =>{
     modalHolder.classList.add("hidden");
});

deleteCancelIcon.addEventListener('click', () =>{
    userDeleteModal.classList.remove('opacity-100');
    setTimeout(() => {
        userDeleteModal.classList.remove("fixed");
        userDeleteModal.classList.add("hidden");
    }, 500);
});


cancelButton.addEventListener('click', () =>{
    userDeleteModal.classList.remove('opacity-100');
    setTimeout(() => {
        userDeleteModal.classList.remove("fixed");
        userDeleteModal.classList.add("hidden");
    }, 500);
});

