/** @type {import('tailwindcss').Config} */
module.exports = {
  important: true,
  content: ["./**/*.{html,js,php}"],
  theme: {
    extend: {
      screens: {
        smallPhone: '400px'
      },
      colors: {
        color: {
          primary: '#F2F2F2',
          accent: '#73E5FF',
          secondary: '#393e46',
          dark: '#222831',
          youtube: '#FF0000',
          cardbg: '#5B3E80',
          cardtext: '#BFAFD5',
          cardglow: '#E4CFFF',
          bg: '#1B0833'
        }
      }
    },
  },
  plugins: [],
}

