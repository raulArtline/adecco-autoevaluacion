/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                sans: ["Neutraface", "Arial", "sans-serif"],
                lust: ["lust_regular"],
            },
            colors: {
                "verde-adecco": "#54c3bd",
            },
        },
    },
    plugins: [],
};
