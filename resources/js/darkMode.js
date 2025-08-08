// Global Dark Mode Functionality
(function() {
    'use strict';

    // Initialize dark mode on page load
    function initializeDarkMode() {
        const html = document.documentElement;
        const darkModeToggle = document.getElementById('darkModeToggle');
        const darkModeThumb = document.getElementById('darkModeThumb');

        if (!darkModeToggle || !darkModeThumb) {
            return; // Exit if elements don't exist
        }

        // Check for saved dark mode preference or default to light mode
        const savedDarkMode = localStorage.getItem('darkMode');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedDarkMode === 'true' || (!savedDarkMode && prefersDark)) {
            html.classList.add('dark');
            html.setAttribute('data-theme', 'dark');
            html.style.colorScheme = 'dark';
            darkModeThumb.classList.add('translate-x-6');
            darkModeThumb.classList.remove('translate-x-1');
        } else {
            html.classList.remove('dark');
            html.setAttribute('data-theme', 'light');
            html.style.colorScheme = 'light';
            darkModeThumb.classList.remove('translate-x-6');
            darkModeThumb.classList.add('translate-x-1');
        }

        // Add click event listener
        darkModeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            localStorage.setItem('darkMode', isDark);

            if (isDark) {
                html.setAttribute('data-theme', 'dark');
                html.style.colorScheme = 'dark';
                darkModeThumb.classList.add('translate-x-6');
                darkModeThumb.classList.remove('translate-x-1');
            } else {
                html.setAttribute('data-theme', 'light');
                html.style.colorScheme = 'light';
                darkModeThumb.classList.remove('translate-x-6');
                darkModeThumb.classList.add('translate-x-1');
            }
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeDarkMode);
    } else {
        initializeDarkMode();
    }

    // Also initialize on page transitions (for SPA-like behavior)
    window.addEventListener('load', initializeDarkMode);
})(); 