# Codina Theme

تم RTL-first پلتفرم آموزشی Codina

## ویژگی‌ها

- **RTL-First Design**: طراحی شده برای راست‌به‌چپ
- **Tailwind CSS**: با پشتیبانی کامل RTL
- **فونت فارسی**: Vazirmatn
- **رنگ‌های برند Codina**: پالت رنگی سفارشی
- **Build Pipeline**: Tailwind CLI برای کامپایل CSS

## نصب و راه‌اندازی

### پیش‌نیازها

- Node.js 16.x یا بالاتر
- npm یا yarn

### مراحل نصب

1. نصب وابستگی‌ها:
```bash
npm install
```

2. کامپایل CSS برای توسعه (watch mode):
```bash
npm run dev
```

3. کامپایل CSS برای production:
```bash
npm run build
```

**⚠️ مهم**: پس از نصب یا تغییر قالب‌ها، حتماً `npm run build` را اجرا کنید تا Tailwind تمام کلاس‌ها را شناسایی کند.

### فایل‌های Build

- **Source**: `src/css/tailwind.css`
- **Output**: `assets/css/main.css` (کامپایل شده)
- **Config**: `tailwind.config.js`

برای جزئیات بیشتر، `BUILD.md` را مطالعه کنید.

## ساختار فولدرها

```
codina-theme/
├── assets/          # فایل‌های کامپایل شده (CSS, JS)
├── inc/            # کلاس‌ها و توابع PHP
├── src/            # فایل‌های منبع (قبل از کامپایل)
│   └── css/       # Tailwind CSS source
├── templates/      # قالب‌های WordPress
├── template-parts/ # بخش‌های قابل استفاده مجدد
├── style.css       # هدر تم WordPress
├── functions.php   # فایل اصلی توابع
├── tailwind.config.js  # تنظیمات Tailwind
└── package.json    # وابستگی‌های Node.js
```

## توسعه

### کامپایل CSS

برای توسعه با watch mode:
```bash
npm run dev
```

برای production build:
```bash
npm run build
```

### Tailwind Configuration

فایل `tailwind.config.js` شامل:
- فونت فارسی (Vazirmatn)
- رنگ‌های برند Codina
- پشتیبانی RTL
- Typography plugin

## رنگ‌های برند

- **Primary (Codina Blue)**: `codina-500` (#0ea5e9)
- **Accent (Purple)**: `accent-500` (#d946ef)

استفاده در Tailwind:
```html
<div class="bg-codina-500 text-white">...</div>
<div class="text-accent-500">...</div>
```

## فونت

تم از فونت **Vazirmatn** استفاده می‌کند که از Google Fonts لود می‌شود.

## RTL Support

تم به صورت کامل RTL است:
- HTML با `lang="fa" dir="rtl"`
- تمام استایل‌های Tailwind RTL-aware
- Typography بهینه شده برای فارسی

## نسخه

1.0.0

## مجوز

GPL v2 or later

