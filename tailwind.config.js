/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontFamily: {
            sans: ["Poppins", ...defaultTheme.fontFamily.sans],
            inter: ["Inter", ...defaultTheme.fontFamily.sans],
        },
        extend: {},
    },
    plugins: [require("flowbite/plugin")],
};
