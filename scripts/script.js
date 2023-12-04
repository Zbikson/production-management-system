function showContent(contentId) {
    // Ukryj wszystkie sekcje treści
    var contentSections = document.querySelectorAll('.main-content');
    contentSections.forEach(function(section) {
        section.style.display = 'none';
    });

    // Pokaż wybraną sekcję treści
    document.getElementById(contentId).style.display = 'block';
}