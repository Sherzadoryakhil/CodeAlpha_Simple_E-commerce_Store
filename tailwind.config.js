import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],

    theme: {
        extend: {
            colors: {
                // Light-orange / apricot premium palette
                primary: {
                    DEFAULT: "#FB923C",
                    50: "#FFF7ED",
                    100: "#FFEDD5",
                    200: "#FED7AA",
                    300: "#FDBA74",
                    400: "#FB923C",
                    500: "#F97316",
                    600: "#EA580C",
                    700: "#C2410C",
                    800: "#9A3412",
                    900: "#7C2D12",
                    950: "#431407",

                    light: "#FFEDD5",
                    soft: "#FFF7ED",
                    dark: "#EA580C",
                    deep: "#C2410C",
                    ink: "#431407",
                },

                ink: "#1F2937", // primary text
                muted: "#6B7280", // secondary text
                cream: "#FFFBF7", // warm page background
                line: "#F3E8DE", // hairline borders
            },

            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
                display: ["Poppins", ...defaultTheme.fontFamily.sans],
            },

            borderRadius: {
                "3xl": "1.5rem",
                "4xl": "2rem",
            },

            boxShadow: {
                soft: "0 10px 30px -16px rgba(154, 52, 18, 0.14)",
                card: "0 16px 40px -24px rgba(154, 52, 18, 0.22)",
                lift: "0 22px 48px -24px rgba(154, 52, 18, 0.30)",
                glow: "0 0 0 6px rgba(251, 146, 60, 0.12)",
            },

            keyframes: {
                "fade-in-up": {
                    "0%": {
                        opacity: "0",
                        transform: "translateY(18px)",
                    },
                    "100%": {
                        opacity: "1",
                        transform: "translateY(0)",
                    },
                },
                "badge-pop": {
                    "0%": {
                        transform: "scale(0.4)",
                    },
                    "60%": {
                        transform: "scale(1.18)",
                    },
                    "100%": {
                        transform: "scale(1)",
                    },
                },
                float: {
                    "0%, 100%": {
                        transform: "translateY(0)",
                    },
                    "50%": {
                        transform: "translateY(-10px)",
                    },
                },
                shimmer: {
                    "0%": {
                        backgroundPosition: "-200% 0",
                    },
                    "100%": {
                        backgroundPosition: "200% 0",
                    },
                },
            },

            animation: {
                "fade-in-up":
                    "fade-in-up 0.7s cubic-bezier(0.16, 1, 0.3, 1) both",
                "badge-pop":
                    "badge-pop 0.45s cubic-bezier(0.16, 1, 0.3, 1) both",
                "float-slow": "float 7s ease-in-out infinite",
                shimmer: "shimmer 2.2s linear infinite",
            },

            transitionDuration: {
                400: "400ms",
            },

            transitionTimingFunction: {
                smooth: "cubic-bezier(0.16, 1, 0.3, 1)",
            },
        },
    },

    plugins: [forms],
};
