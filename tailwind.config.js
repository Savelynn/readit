/** @type {import('tailwindcss').Config} */
module.exports = {
  important: true,
  content: ["./**/*.{html,js,php}"],
  theme: {
    extend: {
      colors: {
        color: {
          primary: '#F2F2F2',
          accent: '#73E5FF',
          secondary: '#393e46',
          dark: '#222831',
          youtube: '#FF0000'
        }
      }
    },
  },
  plugins: [],
}

