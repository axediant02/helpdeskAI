/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Nunito', 'sans-serif'],  // Set 'Nunito' as the default sans font
      },
      colors: {
        royalBlue: '#4169E1',
        lightRoyalBlue: '#6788DF',
        darkRoyalBlue: '#003DA5',
        buttonColor: '#4169E1',
        buttonHover: '#3456A0',
        navbarBackground: '#001F3F',
        navbarText: '#FFFFFF',
        inputBorder: '#A1C6EA',
        inputFocus: '#4169E1',
        placeholderText: '#B0C4DE',
        error: '#FF4C4C',
        success: '#28A745',
        background: '#F8F9FA',
        chatBG: '#A7C8FF',
      },
    },
  },
  plugins: [],
};
