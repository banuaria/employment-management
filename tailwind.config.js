import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    '50': '#fff0f0',
                    '100': '#ffdddd',
                    '200': '#ffc0c0',
                    '300': '#ff9494',
                    '400': '#ff5757',
                    '500': '#ff2323',
                    '600': '#ff0000',
                    '700': '#d70000',
                    '800': '#b10303',
                    '900': '#920a0a',
                    '950': '#500000',
                },
                accent: {
                    50: '#FFFFFF',
                    100: '#FBFCFE',
                    200: '#F7F9FD',
                    300: '#F3F6FB',
                    400: '#EFF3FA',
                    500: '#ECF0F9',
                    600: '#A2B5E2',
                    700: '#587BCA',
                    800: '#2F4D93',
                    900: '#17264A',
                    950: '#0C1427'
                },
                yellow: {
                    50: '#FFF8EB',
                    100: '#FEF2D7',
                    200: '#FDE6B4',
                    300: '#FDD98C',
                    400: '#FCCD69',
                    500: '#FBC143',
                    600: '#FAB51E',
                    700: '#EBA205',
                    800: '#C88A04',
                    900: '#A06E03',
                    950: '#916403'
                  },
                  green: {
                    50: '#EAFBE4',
                    100: '#D5F7C9',
                    200: '#ABF094',
                    300: '#7DE75A',
                    400: '#53E024',
                    500: '#3FAE19',
                    600: '#39A117',
                    700: '#359315',
                    800: '#318A14',
                    900: '#2D7D12',
                    950: '#297411'
                  },
                  red: {
                    50: '#FCE8E8',
                    100: '#FAD1D1',
                    200: '#F4A4A4',
                    300: '#EF7676',
                    400: '#EA4D4D',
                    500: '#E51E1E',
                    600: '#D21818',
                    700: '#B71515',
                    800: '#A01212',
                    900: '#891010',
                    950: '#800F0F'
                  }
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                '2xs': [
                    '0.625rem',
                    {
                        lineHeight: '0.75rem'
                    }
                ]
            },
        },
    },

    plugins: [
        forms, 
        require('flowbite/plugin')({
          charts: true
        })
      ]
};
