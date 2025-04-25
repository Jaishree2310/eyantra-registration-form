// tailwind.config.js
module.exports = {
  content: [
    './public/index.html',
    './src/**/*.{vue,js,ts,jsx,tsx}'
  ],
  theme: {
    extend: {
      colors: {
        'primary': '#E31E24',     // Primary Red
        'primary-dark': '#C01B20', // Darker shade for hover states
        'primary-light': '#F9D7D8', // Lighter shade for backgrounds
        'accent': '#F7D154',      // Accent Yellow
        'accent-dark': '#E5C041', // Darker shade for hover states
        'accent-light': '#FDF6E1', // Lighter shade for backgrounds
        'neutral': '#333333',     // Neutral Black
      },
      fontFamily: {
        'montserrat': ['Montserrat', 'sans-serif'],
        'opensans': ['Open Sans', 'sans-serif']
      },
      boxShadow: {
        'card': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
      },
      borderRadius: {
        'lg': '0.5rem', // 8px border radius
      },
      spacing: {
        '72': '18rem',
        '84': '21rem',
        '96': '24rem',
      },
      animation: {
        'spin-slow': 'spin 3s linear infinite',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}