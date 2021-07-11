module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue'
  ],
  
  darkMode: false, // or 'media' or 'class'
  theme: {
    fontFamily: {
      'display': ['Calistoga'],
      'content': ['Neuton']
    },
    extend: {
      colors: {
        primary: '#158876',
        secondary: '#0e2233',
        graybg: '#f3f5f4'
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/line-clamp'),
  ],
}
