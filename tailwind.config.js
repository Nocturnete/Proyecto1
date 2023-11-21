import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
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
            colors: {
                customred: '#FC5A1E',
                customblue: '#0080F0',
                customblack: '#000000',
                customgray: '#424242',
                customgray2: '#8C8C8C',
                customgray3: '#D1D1D1',
                customyellow: '#FFFF00',
            },
        },
    },

    plugins: [forms],
};
