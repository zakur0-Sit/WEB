const popupBackground = document.querySelector('.popup-background');

function openPopup() {
    document.getElementById('edit-popup').style.display = 'block';
    popupBackground.style.display = 'block';
}

function closePopup() {
    document.getElementById('edit-popup').style.display = 'none';
    popupBackground.style.display = 'none';
}

document.getElementById('edit-icon').addEventListener('click', openPopup);
document.getElementById('popup-background').addEventListener('click', closePopup);
