const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/*.html"],
  theme: {
    extend: {
      colors: {
        'green': '#568C6D',
        'green-500': '#365945',
        'brown': '#A68C7C',
        'brown-500': '#7d695c',
        'black': '#262626',
        'white': '#F2F2F2',
        'blue': '#5E8C7F',
        'blue-500': '#43635a',
      },
      backgroundSize: {
        '20': '20rem',
        '15': '15rem',
        '14': '14rem',
        '10': '10rem',
        '5': '5rem',
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
        marbre : "url('./img/marbre.jpg')",
      },
      gridTemplateColumns: {
        blog: "repeat(auto-fit, minmax(11rem, 1fr))",
        "blog-md": "repeat(auto-fit, minmax(16rem, 1fr))",
      },
      borderWidth: {
        '10': '10px',
      },
    },
  },
  plugins: [],
}
