# Codina Theme - Build Instructions

## Production Build Process

### Prerequisites

```bash
# Install Node.js dependencies
npm install
```

### Development Mode

Watch for changes and auto-compile:

```bash
npm run dev
```

This will:
- Watch all PHP template files
- Compile Tailwind CSS on file changes
- Output to `assets/css/main.css`

### Production Build

Generate minified CSS for production:

```bash
npm run build
```

This will:
- Scan all PHP and JS files for Tailwind classes
- Purge unused CSS classes
- Minify the output
- Generate optimized `assets/css/main.css`

### Tailwind Content Scanning

The `tailwind.config.js` scans these paths:

- `./*.php` - Root PHP templates
- `./templates/**/*.php` - Template files
- `./template-parts/**/*.php` - Template parts
- `./assets/js/**/*.js` - JavaScript files
- `./src/js/**/*.js` - Source JavaScript

**Important**: After adding new templates or components, run `npm run build` to ensure Tailwind scans them.

### CSS Output

- **Source**: `src/css/tailwind.css`
- **Output**: `assets/css/main.css` (compiled, minified)

### RTL Support

The build process maintains RTL support through:
- `rtl: true` in Tailwind config
- PostCSS RTL plugin
- Custom RTL utilities in source CSS

## New Template Parts Created

### Components (`template-parts/components/`)
- `section-heading.php` - Reusable section heading with title/subtitle
- `path-card.php` - Learning Path card component
- `course-card.php` - Course card component with progress support
- `progress-bar.php` - Progress bar component
- `empty-state.php` - Empty state component for empty lists

### Learning Path Templates (`template-parts/learning-path/`)
- `path-hero.php` - Hero section for learning paths
- `path-description.php` - Full description section
- `path-phases.php` - Phases timeline with accordion
- `path-outcomes.php` - Learning outcomes section

## Design System

See comments in `src/css/tailwind.css` for:
- Brand colors
- Typography scale
- Spacing guidelines

## Performance Optimizations

1. **Conditional Alpine.js Loading**: Only loads on pages that need it
2. **Image Optimization**: Uses `wp_get_attachment_image()` with srcset
3. **Lazy Loading**: Images use `loading="lazy"`
4. **CSS Purge**: Tailwind purges unused classes in production
5. **Minified Output**: Production CSS is minified

