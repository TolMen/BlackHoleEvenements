const faqItems = document.querySelectorAll('.faq-item');

faqItems.forEach(item => {
    item.addEventListener('click', () => {
        const isExpanded = item.getAttribute('aria-expanded') === 'true';

        // Ferme tous
        faqItems.forEach(el => {
            el.setAttribute('aria-expanded', 'false');
            document.getElementById(el.getAttribute('aria-controls')).style.maxHeight = '0';
            el.querySelector('.faq-icon').classList.replace('fa-minus', 'fa-plus');
        });

        // Ouvre si pas déjà ouvert
        if (!isExpanded) {
            item.setAttribute('aria-expanded', 'true');
            const answer = document.getElementById(item.getAttribute('aria-controls'));
            answer.style.maxHeight = answer.scrollHeight + 'px';
            item.querySelector('.faq-icon').classList.replace('fa-plus', 'fa-minus');
        }
    });
});

// Ouverture par défaut de la première question
document.addEventListener('DOMContentLoaded', () => {
    const firstItem = faqItems[0];
    if (firstItem) {
        firstItem.setAttribute('aria-expanded', 'true');
        const answer = document.getElementById(firstItem.getAttribute('aria-controls'));
        answer.style.maxHeight = answer.scrollHeight + "px";
        firstItem.querySelector('.faq-icon').classList.replace('fa-plus', 'fa-minus');
    }
});