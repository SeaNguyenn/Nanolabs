/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  theme: {
    extend: {
      colors: {
        'col-hover' : '#1900D5',
        'col-rate' : '#C1EF00',
        'col-orange' : '#E8502F',
        'col-gray' : '#3C3C3C',
        'col-gray-light' : '#7C7C7C',
        'col-rate-light' : '#A9FFA7',
        'dark-background' : '#252B42',
        'second-text-color' : '#737373',
        'primary-color' : '#23A6F0',
        'col-bg' : '#F5F8FD'
      },
      keyframes: {
        stickyy: {
          '0%': { transform: 'translateY(-80px)' },
          '100%': { transform: 'translateY(0)' },
        }
      },
      animation: {
        'sticky-header': 'stickyy 0.3s ease forwards',
      }
    },
    screens: {
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
      '3xl': '1920px',
    },
  },
  plugins: []
}
