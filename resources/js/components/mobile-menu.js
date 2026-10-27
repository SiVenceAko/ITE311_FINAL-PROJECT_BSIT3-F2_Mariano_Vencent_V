document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.querySelector('.mobile-menu-button');
    const navLinks = document.querySelector('.nav-links');

    if (!menuButton || !navLinks) {
        return;
    }

    const openMenu = () => {
        navLinks.classList.add('is-open');
        menuButton.classList.add('is-open');
        menuButton.setAttribute('aria-expanded', 'true');

        document.body.classList.add('mobile-menu-open');
    };

    const closeMenu = () => {
        navLinks.classList.remove('is-open');
        menuButton.classList.remove('is-open');
        menuButton.setAttribute('aria-expanded', 'false');

        document.body.classList.remove('mobile-menu-open');
    };

    const toggleMenu = () => {
        const isOpen = navLinks.classList.contains('is-open');

        if (isOpen) {
            closeMenu();
        } else {
            openMenu();
        }
    };

    menuButton.setAttribute('aria-expanded', 'false');

    menuButton.addEventListener('click', (event) => {
        event.stopPropagation();
        toggleMenu();
    });

    navLinks.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            closeMenu();
        });
    });

    document.addEventListener('click', (event) => {
        if (
            navLinks.classList.contains('is-open') &&
            !navLinks.contains(event.target) &&
            !menuButton.contains(event.target)
        ) {
            closeMenu();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (
            event.key === 'Escape' &&
            navLinks.classList.contains('is-open')
        ) {
            closeMenu();
            menuButton.focus();
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 900) {
            closeMenu();
        }
    });
});
