/** @type {import('tailwindcss').Config} */
export default {
  important: true,
  content: [
    "./app/Views/**/*.{html,js,php}", 
    "./public/**/*.{html,js,php}"
  ],
  prefix: 'tw-',
  corePlugins: {
    preflight: false,
  },
  theme: {
    extend: {},
  },
  plugins: [],
}

