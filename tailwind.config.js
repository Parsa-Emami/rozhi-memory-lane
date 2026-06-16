import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        blush: {
          50: '#fff7fb',
          100: '#ffe4ef',
          200: '#fecddf',
          300: '#f9a8c4',
          400: '#f472a5',
          500: '#ec5b97'
        },
        roseCozy: '#f9c8d9',
        warmBeige: '#f7ead8',
        latte: '#d9b99b',
        cocoa: '#5f4636',
        softPurple: '#d8c7ff',
        lavenderMilk: '#f1eaff',
        night: '#151124',
        nightSoft: '#221832'
      },
      fontFamily: {
        cozy: ['ui-rounded', 'Vazirmatn', 'system-ui', 'sans-serif']
      },
      boxShadow: {
        glow: '0 0 45px rgba(249, 168, 196, .35)',
        soft: '0 24px 70px rgba(95, 70, 54, .16)',
        nightGlow: '0 0 70px rgba(216, 199, 255, .24)'
      },
      backgroundImage: {
        cafe: 'radial-gradient(circle at top left, rgba(255,228,239,.95), transparent 36%), radial-gradient(circle at bottom right, rgba(216,199,255,.70), transparent 34%), linear-gradient(135deg, #fff7fb, #f7ead8)',
        night: 'radial-gradient(circle at 20% 20%, rgba(216,199,255,.22), transparent 30%), radial-gradient(circle at 80% 20%, rgba(249,168,196,.18), transparent 32%), linear-gradient(135deg, #151124, #221832)'
      },
      animation: {
        floaty: 'floaty 5s ease-in-out infinite',
        fadeUp: 'fadeUp .8s ease both',
        twinkle: 'twinkle 2.8s ease-in-out infinite',
        heartbeat: 'heartbeat 1.8s ease-in-out infinite',
        paw: 'paw 1.8s ease-in-out infinite',
        shimmer: 'shimmer 3s linear infinite'
      },
      keyframes: {
        floaty: {
          '0%,100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-14px)' }
        },
        fadeUp: {
          from: { opacity: '0', transform: 'translateY(20px)' },
          to: { opacity: '1', transform: 'translateY(0)' }
        },
        twinkle: {
          '0%,100%': { opacity: '.25', transform: 'scale(.8)' },
          '50%': { opacity: '1', transform: 'scale(1.25)' }
        },
        heartbeat: {
          '0%,100%': { transform: 'scale(1)' },
          '35%': { transform: 'scale(1.06)' },
          '55%': { transform: 'scale(.98)' }
        },
        paw: {
          '0%,100%': { transform: 'rotate(-8deg)' },
          '50%': { transform: 'rotate(8deg)' }
        },
        shimmer: {
          '0%': { backgroundPosition: '-200% 0' },
          '100%': { backgroundPosition: '200% 0' }
        }
      }
    }
  },
  plugins: [forms]
}
