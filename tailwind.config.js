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
            colors: {
                primary: '#D98718',
                'primary-hover': '#b87314',
                secondary: '#A9333A',
                'secondary-hover': '#8e2b32',
                dark: '#383838',
                admin: {
                    DEFAULT: '#16a34a',
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    600: '#16a34a',
                    700: '#15803d',
                },
            },
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
        },
    },

    plugins: [forms],
};
