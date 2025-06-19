// Console message - putting this first
console.log('%cMaded by Abdelkouddous El alami', 'color: #d4af37; font-size: 20px; font-weight: bold;');

import './bootstrap';

// Disable right-click
document.addEventListener('contextmenu', (e) => e.preventDefault());

// Disable keyboard shortcuts and dev tools
document.addEventListener('keydown', (e) => {
    // Disable F12
    if (e.key === 'F12') {
        e.preventDefault();
        return false;
    }
    
    // Disable Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+Shift+C
    if (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J' || e.key === 'C')) {
        e.preventDefault();
        return false;
    }
    
    // Disable Ctrl+U (view source)
    if (e.ctrlKey && e.key === 'u') {
        e.preventDefault();
        return false;
    }
});

// Clear console on open
window.addEventListener('load', () => {
    console.clear();
    console.log('%cMaded by Abdelkouddous El alami', 'color: #d4af37; font-size: 20px; font-weight: bold;');
});

// Disable console
const disableConsole = () => {
    const noop = () => undefined;
    const methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'profile', 'profileEnd', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
    
    methods.forEach(method => {
        console[method] = noop;
    });
};

// Additional devtools detection
let devtools = false;
const threshold = 160;

const devToolsChecker = {
    interval: null,
    startChecking: function() {
        this.interval = setInterval(() => {
            const widthThreshold = window.outerWidth - window.innerWidth > threshold;
            const heightThreshold = window.outerHeight - window.innerHeight > threshold;
            if (widthThreshold || heightThreshold) {
                disableConsole();
                document.documentElement.innerHTML = 'Developer tools are not allowed on this site.';
            }
        }, 1000);
    }
};

devToolsChecker.startChecking();
