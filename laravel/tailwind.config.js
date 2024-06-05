const defaultTheme = require('tailwindcss/defaultTheme');
const animations = require('@midudev/tailwind-animations');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    keyframes: {
        'pulse-fade-in': {
            '0%': { transform: 'scale(0.9)', opacity: '0' },
            '50%': { transform: 'scale(1.05)', opacity: '0.5' },
            '100%': { transform: 'scale(1)', opacity: '1' },
        },
        'rotate-in': {
            '0%': { opacity: '0', transform: 'rotate(-90deg)' },
            '100%': { opacity: '1', transform: 'rotate(0deg)' }
        }
    },
    animation: {
        'pulse-fade-in': 'pulse-fade-in 0.6s ease-out both',
        'rotate-in': 'rotate-in 0.6s ease-out both',
    },

    plugins: [
        require('@tailwindcss/forms'),
        animations
    ],
};
