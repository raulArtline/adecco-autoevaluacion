/** @type {import('tailwindcss').Config} */
export default {
    content: [
		"./resources/**/*.blade.php",
		 "./resources/**/*.js",
		 "./vendor/robsontenorio/mary/src/View/Components/**/*.php"
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
    plugins: [
		require("daisyui")
	],
};
