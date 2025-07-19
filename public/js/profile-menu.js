document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('.profile__nav-item');
    const contentContainers = document.querySelectorAll('.profile__dynamic-content');

    navItems.forEach(navItem => {
        navItem.addEventListener('click', function(event) {
            event.preventDefault();

            const contentType = this.dataset.content;

            const url = new URL(window.location.href);
            url.searchParams.set('menu', contentType);
            window.history.pushState({}, '', url);

            navItems.forEach(item => item.classList.remove('active'));
            contentContainers.forEach(container => container.classList.remove('active'));

            this.classList.add('active');
            document.getElementById(contentType + '-content').classList.add('active');
        });
    });
});
