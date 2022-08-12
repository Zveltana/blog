const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/*.html"],
  theme: {
    extend: {
      colors: {
        'green': '#568C6D',
        'brown': '#A68C7C',
        'black': '#262626',
        'white': '#F2F2F2',
        'blue': '#5E8C7F',
      },
      fontFamily: {
        'oleo': ['Oleo Script', ...defaultTheme.fontFamily.sans],
        'fira': ['Fira Sans Condensed', ...defaultTheme.fontFamily.sans],
      },
      fontSize: {
        '3xl': '1.875rem',
        '4xl': '2.25rem',
        '5xl': '3rem',
        '6xl': '4rem',
        '7xl': '5rem',
      },
      backgroundImage: {
        blob: "url('./img/blob.svg')",
        "blob-blue": "url('./img/blob-blue.svg')",
      }
    },
  },
  plugins: [],
}
