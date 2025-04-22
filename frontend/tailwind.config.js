module.exports = {
    content: [
      './index.html',
      './src/**/*.{vue,js,ts,jsx,tsx}'
    ],
    theme: {
      extend: {
        colors: {
          'primary-red': '#E31E24',
          'accent-yellow': '#F7D154',
          'neutral-black': '#333333'
        },
        fontFamily: {
          montserrat: ['Montserrat', 'sans-serif'],
          opensans: ['Open Sans', 'sans-serif']
        }
      }
    },
    plugins: [
      require('@tailwindcss/forms')
    ]
  }