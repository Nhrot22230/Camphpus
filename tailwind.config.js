/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',      // Escanea archivos Blade
    './resources/**/*.{js,ts,jsx,tsx}', // Escanea archivos React en `resources/js`
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
