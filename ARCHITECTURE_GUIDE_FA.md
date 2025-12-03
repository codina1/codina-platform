# راهنمای معماری پلتفرم Codina
## Architecture Guide - Persian

این سند راهنمای سریع معماری پلتفرم Codina را به زبان فارسی ارائه می‌دهد.

---

## 📐 معماری کلی (Overall Architecture)

پلتفرم Codina بر اساس **معماری سه لایه** طراحی شده است:

```
┌─────────────────────────────────────┐
│   لایه نمایش (Presentation Layer)   │
│         codina-theme                 │
└─────────────────────────────────────┘
              ↓
┌─────────────────────────────────────┐
│   لایه منطق (Business Logic Layer) │
│         codina-core                 │
└─────────────────────────────────────┘
              ↓
┌─────────────────────────────────────┐
│   لایه داده (Data Layer)            │
│      WordPress + MySQL              │
└─────────────────────────────────────┘
```

---

## 🎨 لایه نمایش (Theme Layer)

### مسیر: `wp-content/themes/codina-theme/`

**وظیفه**: نمایش محتوا به کاربر (Front-End)

### ساختار اصلی:

```
codina-theme/
│
├── 📁 templates/              # قالب‌های کامل صفحه
│   ├── front-page.php        # صفحه اصلی
│   ├── single-learning_path.php
│   ├── single-codina_course.php
│   └── page-dashboard.php
│
├── 📁 template-parts/         # بخش‌های قابل استفاده مجدد
│   ├── header/                # هدر
│   ├── footer/                # فوتر
│   ├── learning-path/         # بخش‌های مسیر یادگیری
│   ├── course/                # بخش‌های دوره
│   ├── lesson/                # بخش‌های درس
│   ├── dashboard/             # بخش‌های داشبورد
│   └── components/            # کامپوننت‌های عمومی
│
├── 📁 assets/                 # فایل‌های استاتیک
│   ├── css/                   # استایل‌های کامپایل شده
│   ├── js/                    # فایل‌های JavaScript
│   ├── fonts/                 # فونت‌های فارسی
│   └── images/                 # تصاویر
│
├── 📁 src/                    # فایل‌های منبع (قبل از کامپایل)
│   ├── css/tailwind.css      # ورودی Tailwind
│   └── js/                    # فایل‌های JS منبع
│
└── 📁 inc/                    # کلاس‌ها و توابع
    ├── class-theme-setup.php
    ├── class-assets.php
    └── rtl-helpers.php
```

### تکنولوژی‌ها:
- **PHP**: قالب‌های WordPress
- **Tailwind CSS**: استایل‌دهی با پشتیبانی RTL
- **Vanilla JavaScript**: تعاملات کاربری
- **HTML5**: ساختار صفحات

---

## 🔌 لایه منطق (Plugin Layer)

### مسیر: `wp-content/plugins/codina-core/`

**وظیفه**: منطق کسب‌وکار و مدیریت داده (Backend)

### ساختار اصلی:

```
codina-core/
│
├── 📄 codina-core.php         # فایل اصلی پلاگین
│
├── 📁 includes/
│   │
│   ├── 📁 post-types/         # ثبت Custom Post Types
│   │   ├── class-learning-path.php
│   │   ├── class-phase.php
│   │   ├── class-step.php
│   │   ├── class-resource.php
│   │   ├── class-course.php
│   │   └── class-lesson.php
│   │
│   ├── 📁 meta-boxes/         # Meta Boxes برای فیلدهای سفارشی
│   │   ├── learning-path-meta.php
│   │   ├── phase-meta.php
│   │   └── ...
│   │
│   ├── 📁 relationships/      # مدیریت روابط سلسله‌مراتبی
│   │   ├── path-phase-relationship.php
│   │   ├── phase-step-relationship.php
│   │   └── ...
│   │
│   ├── 📁 woocommerce/        # یکپارچه‌سازی WooCommerce
│   │   ├── purchase-handler.php
│   │   └── access-control.php
│   │
│   └── 📁 utilities/          # توابع کمکی
│       ├── class-sanitizer.php
│       └── class-validator.php
│
└── 📁 admin/                  # فایل‌های بخش مدیریت
    ├── css/admin-rtl.css
    └── js/admin.js
```

### تکنولوژی‌ها:
- **PHP 8+**: منطق پلاگین
- **WordPress Hooks & Filters**: یکپارچه‌سازی با WordPress
- **MySQL**: ذخیره‌سازی داده

---

## 📊 مدل داده (Data Model)

### ساختار سلسله‌مراتبی:

```
مسیر یادگیری (Learning Path)
    │
    ├─► فاز 1 (Phase)
    │       │
    │       ├─► مرحله 1 (Step)
    │       │       │
    │       │       ├─► منبع 1 (Resource)
    │       │       ├─► منبع 2 (Resource)
    │       │       └─► منبع 3 (Resource)
    │       │
    │       └─► مرحله 2 (Step)
    │
    └─► فاز 2 (Phase)
            └─► ...
```

### Custom Post Types:

1. **learning_path** (مسیر یادگیری)
   - Parent CPT
   - فیلدها: عنوان، توضیحات، سطح، مدت زمان، نتایج

2. **learning_phase** (فاز)
   - Child of Learning Path
   - فیلدها: عنوان، توضیحات، ترتیب

3. **learning_step** (مرحله)
   - Child of Phase
   - فیلدها: عنوان، نوع (نظری/عملی/پروژه)، ترتیب

4. **learning_resource** (منبع)
   - Child of Step
   - فیلدها: نوع منبع، URL، زمان تخمینی، الزامی/اختیاری

5. **codina_course** (دوره)
   - Parent CPT
   - فیلدها: عنوان، توضیحات، پیش‌نیازها، سطح، لینک WooCommerce

6. **codina_lesson** (درس)
   - Child of Course
   - فیلدها: عنوان، ویدیو، محتوا، ترتیب

---

## 🔄 جریان کار (Workflow)

### 1. نمایش مسیر یادگیری:

```
کاربر → WordPress Router → single-learning_path.php
    ↓
Query Learning Path از دیتابیس
    ↓
Query Phases (Child Posts)
    ↓
برای هر Phase: Query Steps
    ↓
برای هر Step: Query Resources
    ↓
Render Template Parts (RTL)
    ↓
خروجی HTML → مرورگر
```

### 2. خرید دوره:

```
کاربر → صفحه دوره → دکمه خرید
    ↓
WooCommerce Product Page
    ↓
افزودن به سبد → Checkout
    ↓
پرداخت → Order Created
    ↓
Hook: Grant Course Access
    ↓
ذخیره در User Meta
    ↓
ارسال ایمیل تایید (فارسی)
    ↓
Redirect به صفحه دوره
```

---

## 🎯 اصول طراحی (Design Principles)

### 1. جداسازی نگرانی‌ها (Separation of Concerns)

- **Theme**: فقط نمایش (Presentation)
- **Plugin**: فقط منطق (Business Logic)
- **WooCommerce**: فقط تجارت الکترونیک

### 2. RTL-First Design

- تمام کامپوننت‌ها از ابتدا برای RTL طراحی می‌شوند
- استفاده از Logical Properties
- فونت‌های فارسی بهینه

### 3. WordPress Standards

- پیروی از استانداردهای کدنویسی WordPress
- استفاده از Hooks و Filters
- Sanitize Input, Escape Output

### 4. Performance

- Caching با WordPress Transients
- Lazy Loading برای تصاویر
- Minification برای CSS/JS

---

## 🛠 تکنولوژی‌های استفاده شده

### Front-End:
- **Tailwind CSS 3.x**: Framework CSS با پشتیبانی RTL
- **Vanilla JavaScript**: بدون فریمورک سنگین
- **HTML5**: ساختار معنایی

### Back-End:
- **PHP 8+**: زبان برنامه‌نویسی
- **WordPress 6.0+**: CMS پایه
- **MySQL 5.7+**: دیتابیس

### Build Tools:
- **Node.js 16+**: برای کامپایل Tailwind
- **npm/yarn**: مدیریت وابستگی‌ها
- **PostCSS**: پردازش CSS

### E-commerce:
- **WooCommerce**: پلتفرم تجارت الکترونیک

---

## 📁 ساختار فولدرها (Quick Reference)

### Theme:
```
codina-theme/
├── templates/        → قالب‌های صفحه
├── template-parts/    → بخش‌های قابل استفاده مجدد
├── assets/           → فایل‌های استاتیک
├── src/              → فایل‌های منبع
└── inc/              → کلاس‌ها و توابع
```

### Plugin:
```
codina-core/
├── includes/
│   ├── post-types/    → CPTs
│   ├── meta-boxes/    → Meta Boxes
│   ├── relationships/ → روابط
│   └── woocommerce/   → یکپارچه‌سازی WC
└── admin/            → Assets مدیریت
```

---

## 🔐 امنیت (Security)

1. **Input Sanitization**: تمام ورودی‌ها sanitize می‌شوند
2. **Output Escaping**: تمام خروجی‌ها escape می‌شوند
3. **Nonce Verification**: برای تمام فرم‌ها
4. **Capability Checks**: بررسی دسترسی کاربران
5. **SQL Injection Prevention**: استفاده از `$wpdb->prepare()`

---

## ⚡ عملکرد (Performance)

1. **Caching**: WordPress Transients
2. **Lazy Loading**: تصاویر و ویدیوها
3. **Minification**: CSS و JavaScript
4. **Font Optimization**: فونت‌های فارسی
5. **Database Optimization**: Indexing و Query Optimization

---

## 📚 مستندات بیشتر

- **README.md**: مستندات کامل پروژه
- **ARCHITECTURE.md**: مستندات فنی معماری
- **FOLDER_STRUCTURE.md**: ساختار کامل فولدرها

---

**آخرین به‌روزرسانی**: این راهنما برای Phase 1 طراحی شده است.

