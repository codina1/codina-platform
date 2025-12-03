/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		// PHP templates
		'./*.php',
		'./templates/**/*.php',
		'./template-parts/**/*.php',
		// JavaScript files
		'./assets/js/**/*.js',
		'./src/js/**/*.js',
	],
	theme: {
		extend: {
			// Persian font family
			fontFamily: {
				persian: ['Vazirmatn', 'Tahoma', 'Arial', 'sans-serif'],
				sans: ['Vazirmatn', 'Tahoma', 'Arial', 'sans-serif'],
			},
			// Codina brand colors
			colors: {
				codina: {
					50: '#f0f9ff',
					100: '#e0f2fe',
					200: '#bae6fd',
					300: '#7dd3fc',
					400: '#38bdf8',
					500: '#0ea5e9', // Primary brand color
					600: '#0284c7',
					700: '#0369a1',
					800: '#075985',
					900: '#0c4a6e',
					950: '#082f49',
				},
				accent: {
					50: '#fdf4ff',
					100: '#fae8ff',
					200: '#f5d0fe',
					300: '#f0abfc',
					400: '#e879f9',
					500: '#d946ef', // Accent color
					600: '#c026d3',
					700: '#a21caf',
					800: '#86198f',
					900: '#701a75',
					950: '#4a044e',
				},
			},
			// RTL-optimized spacing
			spacing: {
				'18': '4.5rem',
				'88': '22rem',
			},
			// Typography for Persian
			typography: {
				DEFAULT: {
					css: {
						fontFamily: 'Vazirmatn, Tahoma, Arial, sans-serif',
						lineHeight: '1.75',
						'--tw-prose-body': '#374151',
						'--tw-prose-headings': '#111827',
						'--tw-prose-links': '#0ea5e9',
						'--tw-prose-bold': '#111827',
						'--tw-prose-counters': '#6b7280',
						'--tw-prose-bullets': '#6b7280',
						'--tw-prose-hr': '#e5e7eb',
						'--tw-prose-quotes': '#111827',
						'--tw-prose-quote-borders': '#e5e7eb',
						'--tw-prose-captions': '#6b7280',
						'--tw-prose-code': '#111827',
						'--tw-prose-pre-code': '#e5e7eb',
						'--tw-prose-pre-bg': '#1f2937',
						'--tw-prose-th-borders': '#d1d5db',
						'--tw-prose-td-borders': '#e5e7eb',
					},
				},
			},
		},
	},
	plugins: [
		require('@tailwindcss/typography'),
	],
	// RTL support
	rtl: true,
}

