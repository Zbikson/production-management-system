// script.js

function changeContent(contentId) {
    // Ukryj wszystkie zawartości
    var contents = document.querySelectorAll('.main-content > div');
    contents.forEach(function (content) {
        content.style.display = 'none';
    });

    // Pokaż wybraną zawartość
    var selectedContent = document.getElementById(contentId);
    if (selectedContent) {
        selectedContent.style.display = 'block';
    }

    // Zaznacz aktywny element menu
    var menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(function (menuItem) {
        menuItem.classList.remove('active');
    });
    var activeMenuItem = document.querySelector('.menu-item[data-content="' + contentId + '"]');
    if (activeMenuItem) {
        activeMenuItem.classList.add('active');
    }
}
