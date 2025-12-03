# Codina Platform - Phase 1

**A Persian (Farsi) RTL-First Path-Based Learning Platform**

---

## 📋 Table of Contents

- [Overview](#overview)
- [Features (Phase 1)](#features-phase-1)
- [Architecture](#architecture)
- [Data Model](#data-model)
- [Project Structure](#project-structure)
- [Setup Guide](#setup-guide)
- [Build Instructions](#build-instructions)
- [Development Milestones](#development-milestones)
- [RTL Implementation Strategy](#rtl-implementation-strategy)
- [Future Extensions (Phase 2)](#future-extensions-phase-2)

---

## 🎯 Overview

**Codina** is a modern, RTL-first educational platform designed specifically for Persian (Farsi) speakers. Unlike traditional course marketplaces, Codina focuses on **Path-Based Learning**, where students follow structured learning paths that guide them through phases, steps, and resources.

### Key Principles

- **RTL-First Design**: Every component, layout, and interaction is designed for right-to-left reading
- **Persian Typography**: Optimized for Farsi text with proper font rendering and spacing
- **Path-Based Learning**: Structured progression through Learning Paths → Phases → Steps → Resources
- **WordPress Foundation**: Built on WordPress with custom theme and plugin architecture
- **WooCommerce Integration**: Seamless course purchasing and student management

### Phase 1 Scope

- ✅ Learning Path management (CPT)
- ✅ Course and Lesson system
- ✅ Student dashboard
- ✅ WooCommerce integration
- ✅ RTL-optimized UI/UX
- ❌ No AI features (reserved for Phase 2)
- ❌ No recommendation engine
- ❌ No chatbot

---

## ✨ Features (Phase 1)

### Core Functionality

1. **Learning Paths**
   - Create and manage learning paths with phases and steps
   - Hero sections with video support
   - Estimated duration and skill outcomes
   - Level-based filtering (beginner/junior)

2. **Phases & Steps**
   - Hierarchical organization (Path → Phase → Step → Resource)
   - Order management for sequential learning
   - Step types: theory, practice, project

3. **Resources**
   - Multiple resource types:
     - Internal courses
     - External links
     - Keyword searches
     - Books
     - Articles
     - Projects
   - Required/optional resource flags
   - Estimated time tracking
   - Student notes

4. **Courses & Lessons**
   - Full course management (CPT)
   - Video-based lessons
   - Content and attachments
   - Prerequisites tracking
   - WooCommerce product linking

5. **Student Dashboard**
   - Purchased courses overview
   - Followed learning paths
   - Continue learning section
   - Progress tracking

6. **Front-End Pages**
   - Home page with RTL hero and path cards
   - Single learning path page with timeline
   - Single course page with purchase integration
   - Lesson page with video player
   - Student dashboard
   - Blog with RTL typography
   - Static pages (About, Contact, FAQ)

---

## 🏗 Architecture

### معماری سیستم (System Architecture)

پلتفرم Codina بر اساس معماری **WordPress Theme + Plugin** ساخته شده است که جداسازی واضحی بین لایه نمایش (Front-End) و لایه منطق کسب‌وکار (Backend Logic) ایجاد می‌کند.

#### لایه‌های معماری (Architecture Layers)

```
┌─────────────────────────────────────────────────────────────┐
│                    WordPress Core                            │
│  (Latest Version, PHP 8+, MySQL)                            │
│  هسته WordPress - مدیریت کاربران، رسانه، API                │
└─────────────────────────────────────────────────────────────┘
                            │
        ┌───────────────────┴───────────────────┐
        │                                       │
┌───────▼──────────┐              ┌───────────▼──────────┐
│  codina-theme    │              │   codina-core         │
│  (Front-End)     │              │   (Backend Logic)     │
│  لایه نمایش      │              │   لایه منطق          │
│                  │              │                       │
│  - Templates     │              │  - Custom Post Types │
│  - RTL Styles    │              │  - Meta Boxes        │
│  - Tailwind CSS  │              │  - Relationships     │
│  - Vanilla JS    │              │  - REST API (opt)     │
│  - Components    │              │  - Hooks & Filters    │
└──────────────────┘              └───────────────────────┘
        │                                       │
        └───────────────────┬───────────────────┘
                            │
                ┌───────────▼───────────┐
                │    WooCommerce        │
                │  (E-commerce Layer)   │
                │  لایه تجارت الکترونیک │
                └───────────────────────┘
```

### توضیح معماری (Architecture Explanation)

#### 1. لایه تم (Theme Layer) - `codina-theme`

**هدف**: نمایش و تجربه کاربری (Presentation Layer)

**مسئولیت‌ها**:
- **Templates**: قالب‌های PHP برای صفحات مختلف (صفحه اصلی، مسیر یادگیری، دوره، درس، داشبورد)
- **RTL Styles**: استایل‌های بهینه‌شده برای راست‌به‌چپ با Tailwind CSS
- **Components**: کامپوننت‌های قابل استفاده مجدد (کارت، آکاردئون، دکمه، ویدیو پلیر)
- **JavaScript**: تعاملات کاربری با Vanilla JS (بدون فریمورک سنگین)
- **Responsive Design**: طراحی واکنش‌گرا برای موبایل و دسکتاپ

**ساختار**:
```
codina-theme/
├── templates/          → قالب‌های کامل صفحه
├── template-parts/     → بخش‌های قابل استفاده مجدد
├── assets/            → فایل‌های استاتیک (CSS, JS, Fonts)
├── src/               → فایل‌های منبع (قبل از کامپایل)
└── inc/               → کلاس‌ها و توابع کمکی
```

#### 2. لایه پلاگین (Plugin Layer) - `codina-core`

**هدف**: منطق کسب‌وکار و مدیریت داده (Business Logic Layer)

**مسئولیت‌ها**:
- **Custom Post Types (CPTs)**: ثبت 6 نوع پست سفارشی:
  - `learning_path` (مسیر یادگیری)
  - `learning_phase` (فاز)
  - `learning_step` (مرحله)
  - `learning_resource` (منبع)
  - `codina_course` (دوره)
  - `codina_lesson` (درس)
- **Meta Boxes**: جعبه‌های متا برای فیلدهای سفارشی هر CPT
- **Relationships**: مدیریت روابط سلسله‌مراتبی (Path → Phase → Step → Resource)
- **Admin UI**: بهبود رابط مدیریتی WordPress با RTL
- **Data Validation**: اعتبارسنجی و پاک‌سازی داده‌های ورودی
- **WooCommerce Integration**: یکپارچه‌سازی با WooCommerce برای فروش دوره‌ها

**ساختار**:
```
codina-core/
├── includes/
│   ├── post-types/      → ثبت CPTs
│   ├── meta-boxes/      → Meta Boxes
│   ├── relationships/   → مدیریت روابط
│   ├── woocommerce/     → یکپارچه‌سازی WooCommerce
│   ├── dashboard/       → داشبورد دانشجو
│   └── utilities/       → توابع کمکی
└── admin/               → Assets بخش مدیریت
```

#### 3. لایه WooCommerce (E-commerce Layer)

**هدف**: مدیریت تجارت الکترونیک

**عملکرد**:
- تبدیل دوره‌ها به محصولات WooCommerce
- مدیریت سبد خرید و پرداخت
- کنترل دسترسی دانشجویان به دوره‌های خریداری شده
- مدیریت سفارش‌ها و بازپرداخت‌ها

### جریان داده (Data Flow)

#### نمایش مسیر یادگیری (Learning Path Display)

```
1. کاربر درخواست صفحه مسیر یادگیری می‌کند
   ↓
2. WordPress Template Router → single-learning_path.php
   ↓
3. Query Learning Path (CPT) از دیتابیس
   ↓
4. codina-core Plugin → دریافت Meta Fields
   ↓
5. Query Phases (Child Posts) → برای هر فاز:
   ├─ Query Steps (Child Posts) → برای هر مرحله:
   │  └─ Query Resources (Child Posts)
   │     └─ اگر internal_course → Link to Course CPT
   ↓
6. Template Parts → Render Components (RTL)
   ↓
7. خروجی HTML (RTL) → مرورگر
```

#### خرید دوره (Course Purchase)

```
1. کاربر روی "خرید دوره" کلیک می‌کند
   ↓
2. WooCommerce Product Page
   ↓
3. افزودن به سبد خرید → Checkout
   ↓
4. پرداخت → Order Created
   ↓
5. codina-core Hook → Grant Course Access
   ├─ Save User Meta: course_access_{course_id}
   ├─ Send Confirmation Email (Persian)
   └─ Redirect to Course Page
   ↓
6. Check Access Permission
   ├─ Has Access? → Show Course Content
   └─ No Access? → Show Purchase CTA
```

### معماری داده (Data Architecture)

#### روابط سلسله‌مراتبی (Hierarchical Relationships)

```
Learning Path (Parent CPT)
    │
    ├─► Phase 1 (Child Post)
    │       │
    │       ├─► Step 1 (Child Post)
    │       │       │
    │       │       ├─► Resource 1 (Child Post)
    │       │       ├─► Resource 2 (Child Post)
    │       │       └─► Resource 3 (Child Post)
    │       │
    │       └─► Step 2 (Child Post)
    │               └─► ...
    │
    └─► Phase 2 (Child Post)
            └─► ...

Course (Parent CPT)
    │
    ├─► Lesson 1 (Child Post)
    ├─► Lesson 2 (Child Post)
    └─► Lesson 3 (Child Post)
```

**نکته مهم**: روابط از طریق `post_parent` در جدول `wp_posts` مدیریت می‌شوند.

#### ذخیره‌سازی داده (Data Storage)

- **Post Data**: در جدول `wp_posts` (title, content, post_type, post_parent)
- **Meta Data**: در جدول `wp_postmeta` (فیلدهای سفارشی)
- **User Access**: در جدول `wp_usermeta` (دسترسی به دوره‌ها)
- **WooCommerce**: در جداول WooCommerce (سفارش‌ها، محصولات)

### Integration Points

#### یکپارچه‌سازی با WordPress Core
- استفاده از WordPress Hooks و Filters
- استفاده از WordPress REST API (اختیاری)
- استفاده از WordPress User Management
- استفاده از WordPress Media Library

#### یکپارچه‌سازی با WooCommerce
- Custom Product Type برای دوره‌ها
- Hooks برای مدیریت دسترسی پس از خرید
- Customization صفحات Cart و Checkout (RTL)
- Email Templates به فارسی

### Component Architecture

#### Theme Component Hierarchy

```
Theme Root
│
├─► Header Component (RTL)
│   ├─► Logo
│   ├─► Navigation Menu (RTL)
│   └─► User Menu
│
├─► Content Area
│   ├─► Learning Path Components
│   │   ├─► Path Hero
│   │   ├─► Phases Timeline (RTL)
│   │   ├─► Steps Accordion (RTL)
│   │   └─► Resources List
│   │
│   ├─► Course Components
│   │   ├─► Course Hero
│   │   ├─► Purchase Box (Sticky, RTL)
│   │   └─► Lessons Accordion (RTL)
│   │
│   └─► Dashboard Components
│       ├─► Purchased Courses
│       └─► Followed Paths
│
└─► Footer Component (RTL)
```

### امنیت (Security)

- **Input Sanitization**: تمام ورودی‌های کاربر با توابع WordPress sanitize می‌شوند
- **Output Escaping**: تمام خروجی‌ها escape می‌شوند
- **Nonce Verification**: برای تمام فرم‌ها
- **Capability Checks**: بررسی دسترسی کاربران
- **SQL Injection Prevention**: استفاده از `$wpdb->prepare()`

### عملکرد (Performance)

- **Caching**: استفاده از WordPress Transients
- **Lazy Loading**: برای تصاویر و ویدیوها
- **Minification**: CSS و JavaScript
- **Font Optimization**: بهینه‌سازی فونت‌های فارسی
- **Database Optimization**: استفاده از Indexing و Query Optimization

---

## 📊 Data Model

### Entity Relationship Diagram (Text-Based)

```
┌─────────────────┐
│  LearningPath   │
│  (CPT)          │
├─────────────────┤
│ • title (fa)    │
│ • slug          │
│ • hero_desc     │
│ • description   │
│ • level         │
│ • duration      │
│ • outcomes      │
│ • hero_video    │
└────────┬────────┘
         │ 1:N
         │
┌────────▼────────┐
│     Phase       │
│  (CPT Child)    │
├─────────────────┤
│ • title (fa)    │
│ • description   │
│ • duration      │
│ • order         │
└────────┬────────┘
         │ 1:N
         │
┌────────▼────────┐
│      Step       │
│  (CPT Child)    │
├─────────────────┤
│ • title (fa)    │
│ • description   │
│ • type          │
│ • order         │
└────────┬────────┘
         │ 1:N
         │
┌────────▼────────┐
│    Resource     │
│  (CPT Child)    │
├─────────────────┤
│ • title         │
│ • description   │
│ • type          │
│ • url           │
│ • keywords      │
│ • time          │
│ • is_required   │
│ • note          │
│ • course_id (FK)│
└─────────────────┘

┌─────────────────┐
│     Course      │
│     (CPT)       │
├─────────────────┤
│ • title (fa)    │
│ • description   │
│ • prerequisites │
│ • level         │
│ • duration      │
│ • updated       │
│ • wc_product_id │
└────────┬────────┘
         │ 1:N
         │
┌────────▼────────┐
│     Lesson      │
│  (CPT Child)    │
├─────────────────┤
│ • title         │
│ • video_url     │
│ • content       │
│ • attachments   │
│ • order         │
└─────────────────┘
```

### Custom Post Types

#### 1. Learning Path (`learning_path`)
- **Hierarchy**: Parent CPT
- **Fields**:
  - `title` (Farsi)
  - `slug` (auto-generated)
  - `hero_description` (text)
  - `full_description` (textarea/WYSIWYG)
  - `level` (select: beginner, junior)
  - `estimated_duration` (text, e.g., "3 ماه")
  - `outcomes` (repeater: skill names)
  - `hero_video_url` (URL)

#### 2. Phase (`learning_phase`)
- **Hierarchy**: Child of Learning Path
- **Fields**:
  - `title` (Farsi)
  - `description` (textarea)
  - `estimated_duration` (text)
  - `order` (number)

#### 3. Step (`learning_step`)
- **Hierarchy**: Child of Phase
- **Fields**:
  - `title` (Farsi)
  - `short_description` (text)
  - `type` (select: theory, practice, project)
  - `order` (number)

#### 4. Resource (`learning_resource`)
- **Hierarchy**: Child of Step
- **Fields**:
  - `title` (Farsi)
  - `short_description` (text)
  - `resource_type` (select: internal_course, external_link, keyword_search, book, article, project)
  - `url` (URL, conditional)
  - `search_keywords` (text, for keyword_search type)
  - `estimated_time` (text)
  - `is_required` (checkbox)
  - `note_for_student` (textarea)
  - `linked_course_id` (post object, for internal_course type)

#### 5. Course (`codina_course`)
- **Hierarchy**: Parent CPT
- **Fields**:
  - `title` (Farsi)
  - `short_description` (text)
  - `full_description` (WYSIWYG)
  - `prerequisites` (textarea)
  - `level` (select)
  - `duration` (text)
  - `last_updated` (date)
  - `woocommerce_product_id` (number, links to WC product)

#### 6. Lesson (`codina_lesson`)
- **Hierarchy**: Child of Course
- **Fields**:
  - `title` (Farsi)
  - `video_url` (URL)
  - `content` (WYSIWYG)
  - `attachments` (file upload, multiple)
  - `order` (number)

### Relationships

- **Learning Path** → has many **Phases** (post_parent)
- **Phase** → has many **Steps** (post_parent)
- **Step** → has many **Resources** (post_parent)
- **Course** → has many **Lessons** (post_parent)
- **Resource** → optionally links to **Course** (meta field)

---

## 📁 Project Structure

### Root Structure

```
codina-platform/
├── README.md
├── wp-content/
│   ├── themes/
│   │   └── codina-theme/          # Custom theme
│   └── plugins/
│       └── codina-core/           # Custom plugin
├── package.json                   # Root build config (optional)
└── tailwind.config.js            # Root Tailwind config (optional)
```

### Theme Structure (`wp-content/themes/codina-theme/`)

```
codina-theme/
├── style.css                      # Theme header + main stylesheet
├── functions.php                  # Theme setup, enqueues, hooks
├── index.php                      # Fallback template
├── screenshot.png                 # Theme preview
│
├── assets/
│   ├── css/
│   │   ├── main.css              # Compiled Tailwind output
│   │   └── custom.css            # Additional custom styles
│   ├── js/
│   │   ├── main.js               # Main JavaScript file
│   │   ├── components/           # Component-specific JS
│   │   │   ├── accordion.js
│   │   │   ├── navigation.js
│   │   │   ├── video-player.js
│   │   │   └── dashboard.js
│   │   └── utils/
│   │       ├── rtl-helpers.js
│   │       └── api.js
│   ├── fonts/
│   │   └── [Persian fonts: IRANSans, Vazirmatn, etc.]
│   └── images/
│       └── [theme images]
│
├── src/                           # Source files for build
│   ├── css/
│   │   ├── tailwind.css          # Tailwind entry point
│   │   └── custom.scss           # Custom SCSS (optional)
│   └── js/
│       └── [source JS files]
│
├── templates/                     # WordPress templates
│   ├── index.php
│   ├── front-page.php            # Home page
│   ├── single-learning_path.php  # Single learning path
│   ├── archive-learning_path.php # Learning paths archive
│   ├── single-codina_course.php   # Single course
│   ├── archive-codina_course.php  # Courses archive
│   ├── single-codina_lesson.php   # Single lesson
│   ├── page.php                   # Default page template
│   ├── page-dashboard.php         # Student dashboard
│   ├── page-about.php             # About page
│   ├── page-contact.php           # Contact page
│   ├── page-faq.php               # FAQ page
│   ├── 404.php
│   └── search.php
│
├── template-parts/                # Template partials
│   ├── header/
│   │   ├── header.php
│   │   ├── navigation.php
│   │   └── mobile-menu.php
│   ├── footer/
│   │   ├── footer.php
│   │   └── footer-widgets.php
│   ├── learning-path/
│   │   ├── path-hero.php
│   │   ├── path-phases.php
│   │   ├── path-timeline.php
│   │   ├── path-steps.php
│   │   ├── path-resources.php
│   │   ├── path-outcomes.php
│   │   └── path-faq.php
│   ├── course/
│   │   ├── course-hero.php
│   │   ├── course-purchase-box.php
│   │   ├── course-lessons.php
│   │   ├── course-benefits.php
│   │   └── course-paths.php
│   ├── lesson/
│   │   ├── lesson-video.php
│   │   ├── lesson-navigation.php
│   │   ├── lesson-content.php
│   │   └── lesson-progress.php
│   ├── dashboard/
│   │   ├── dashboard-header.php
│   │   ├── dashboard-courses.php
│   │   ├── dashboard-paths.php
│   │   └── dashboard-continue.php
│   ├── components/
│   │   ├── card.php
│   │   ├── accordion.php
│   │   ├── button.php
│   │   ├── badge.php
│   │   ├── testimonial.php
│   │   └── path-card.php
│   └── blog/
│       ├── post-card.php
│       ├── post-meta.php
│       └── post-content.php
│
├── inc/                           # Theme includes
│   ├── class-theme-setup.php
│   ├── class-assets.php
│   ├── class-walker-nav-menu.php  # RTL nav walker
│   ├── class-template-loader.php
│   ├── template-functions.php
│   └── rtl-helpers.php
│
├── tailwind.config.js             # Tailwind configuration
├── postcss.config.js              # PostCSS configuration
├── package.json                   # Node dependencies
├── .gitignore
└── README.md                       # Theme-specific docs
```

### Plugin Structure (`wp-content/plugins/codina-core/`)

```
codina-core/
├── codina-core.php                # Main plugin file
├── uninstall.php                  # Cleanup on uninstall
├── README.md                       # Plugin documentation
│
├── includes/
│   ├── class-codina-core.php      # Main plugin class
│   ├── class-activator.php        # Activation hooks
│   ├── class-deactivator.php      # Deactivation hooks
│   │
│   ├── post-types/
│   │   ├── class-learning-path.php
│   │   ├── class-phase.php
│   │   ├── class-step.php
│   │   ├── class-resource.php
│   │   ├── class-course.php
│   │   └── class-lesson.php
│   │
│   ├── meta-boxes/
│   │   ├── class-meta-box-handler.php
│   │   ├── learning-path-meta.php
│   │   ├── phase-meta.php
│   │   ├── step-meta.php
│   │   ├── resource-meta.php
│   │   ├── course-meta.php
│   │   └── lesson-meta.php
│   │
│   ├── relationships/
│   │   ├── class-relationship-manager.php
│   │   ├── path-phase-relationship.php
│   │   ├── phase-step-relationship.php
│   │   ├── step-resource-relationship.php
│   │   └── resource-course-relationship.php
│   │
│   ├── admin/
│   │   ├── class-admin.php
│   │   ├── admin-assets.php
│   │   ├── admin-menu.php
│   │   └── admin-settings.php
│   │
│   ├── api/
│   │   ├── class-rest-api.php     # Optional REST endpoints
│   │   └── endpoints/
│   │       ├── learning-paths.php
│   │       └── courses.php
│   │
│   ├── woocommerce/
│   │   ├── class-woocommerce-integration.php
│   │   ├── course-product-type.php
│   │   ├── purchase-handler.php
│   │   └── access-control.php
│   │
│   ├── dashboard/
│   │   ├── class-student-dashboard.php
│   │   ├── dashboard-shortcodes.php
│   │   └── progress-tracker.php
│   │
│   └── utilities/
│       ├── class-sanitizer.php
│       ├── class-validator.php
│       ├── class-helpers.php
│       └── class-i18n.php
│
├── admin/
│   ├── css/
│   │   └── admin-rtl.css
│   └── js/
│       └── admin.js
│
├── languages/
│   └── codina-core-fa_IR.po       # Persian translations
│
└── .gitignore
```

### Build Configuration Files

#### `tailwind.config.js` (Theme)

```javascript
// Example structure (actual config will be generated)
module.exports = {
  content: ['./templates/**/*.php', './template-parts/**/*.php'],
  rtl: true,
  theme: {
    extend: {
      fontFamily: {
        'persian': ['IRANSans', 'Vazirmatn', 'sans-serif'],
      },
      // RTL-specific spacing and typography
    },
  },
  plugins: [
    require('tailwindcss-rtl'),
  ],
}
```

#### `package.json` (Theme)

```json
{
  "name": "codina-theme",
  "scripts": {
    "dev": "tailwindcss -i ./src/css/tailwind.css -o ./assets/css/main.css --watch",
    "build": "tailwindcss -i ./src/css/tailwind.css -o ./assets/css/main.css --minify",
    "js:build": "webpack --mode production"
  },
  "devDependencies": {
    "tailwindcss": "^3.x",
    "tailwindcss-rtl": "^0.x",
    "autoprefixer": "^10.x",
    "postcss": "^8.x"
  }
}
```

---

## 🚀 Setup Guide

### Prerequisites

- **WordPress**: 6.0 or higher
- **PHP**: 8.0 or higher
- **MySQL**: 5.7 or higher (or MariaDB 10.3+)
- **Node.js**: 16.x or higher
- **npm** or **yarn**
- **WooCommerce**: Latest version (for e-commerce features)

### Installation Steps

#### 1. WordPress Setup

1. Install WordPress in your development environment
2. Activate WooCommerce plugin
3. Configure WooCommerce settings (payment gateways, shipping, etc.)

#### 2. Theme Installation

```bash
# Navigate to themes directory
cd wp-content/themes/

# Clone or create codina-theme directory
mkdir codina-theme
cd codina-theme

# Install Node dependencies
npm install

# Build assets
npm run build

# For development with watch mode
npm run dev
```

#### 3. Plugin Installation

```bash
# Navigate to plugins directory
cd wp-content/plugins/

# Clone or create codina-core directory
mkdir codina-core
cd codina-core

# Plugin doesn't require Node.js (PHP only)
```

#### 4. WordPress Configuration

1. Log in to WordPress admin
2. Go to **Appearance → Themes**
3. Activate **Codina Theme**
4. Go to **Plugins**
5. Activate **Codina Core**
6. Configure plugin settings (if any)

#### 5. Initial Setup

1. **Set Site Language**: Go to **Settings → General** and set language to **Persian (فارسی)**
2. **Permalink Structure**: Go to **Settings → Permalinks** and choose a structure (e.g., `/post-name/`)
3. **WooCommerce Setup**: Complete WooCommerce wizard if not done
4. **Create Sample Data**: Use plugin admin to create sample learning paths and courses

### Development Environment

#### Local Development

- **XAMPP/WAMP/MAMP**: For Windows/Mac
- **Local by Flywheel**: Recommended for WordPress development
- **Docker**: For containerized development

#### Recommended Tools

- **VS Code** with PHP extensions
- **Git** for version control
- **Browser DevTools** for RTL debugging
- **Postman** for API testing (if REST API is implemented)

---

## 🔨 Build Instructions

### Theme Build Process

#### Development Mode

```bash
cd wp-content/themes/codina-theme
npm install
npm run dev
```

This will:
- Watch for file changes
- Compile Tailwind CSS with RTL support
- Auto-reload on changes

#### Production Build

```bash
npm run build
```

This will:
- Minify CSS
- Optimize assets
- Generate production-ready files

### Asset Pipeline

1. **CSS**: Tailwind CSS → PostCSS → `assets/css/main.css`
2. **JavaScript**: ES6+ → Babel (if needed) → `assets/js/main.js`
3. **Fonts**: Place Persian fonts in `assets/fonts/`
4. **Images**: Optimize and place in `assets/images/`

### RTL Build Considerations

- Tailwind RTL plugin automatically generates RTL variants
- Custom CSS should use logical properties (`margin-inline-start` instead of `margin-left`)
- Test all components in RTL mode during development

---

## 📅 Development Milestones

### Milestone 1: Setup + Scaffolding
**Duration**: 2-3 days

- [ ] Initialize theme structure
- [ ] Initialize plugin structure
- [ ] Set up Tailwind with RTL configuration
- [ ] Configure build tools (npm, PostCSS)
- [ ] Set up Git repository
- [ ] Create basic theme files (style.css, functions.php)
- [ ] Create plugin main file
- [ ] Test WordPress activation

**Deliverables**:
- Working theme skeleton
- Working plugin skeleton
- Tailwind RTL build pipeline
- Basic README

---

### Milestone 2: Plugin CPTs + Meta
**Duration**: 5-7 days

- [ ] Register Learning Path CPT
- [ ] Register Phase CPT (child of Path)
- [ ] Register Step CPT (child of Phase)
- [ ] Register Resource CPT (child of Step)
- [ ] Register Course CPT
- [ ] Register Lesson CPT (child of Course)
- [ ] Create meta boxes for all CPTs
- [ ] Implement relationship management
- [ ] Add admin columns for better UX
- [ ] Sanitize and validate all inputs
- [ ] Add Persian translations

**Deliverables**:
- All CPTs registered and functional
- All meta boxes working
- Relationships properly managed
- Admin UI in Persian

---

### Milestone 3: Theme Basics + RTL Setup
**Duration**: 4-5 days

- [ ] Create header template (RTL)
- [ ] Create footer template (RTL)
- [ ] Set up navigation (RTL menu walker)
- [ ] Implement Persian font loading
- [ ] Create base templates (index, single, archive)
- [ ] Set up Tailwind RTL utilities
- [ ] Create reusable components (cards, buttons, badges)
- [ ] Implement responsive RTL grid system
- [ ] Test typography and spacing

**Deliverables**:
- Complete theme structure
- RTL-optimized base templates
- Persian typography working
- Responsive RTL layout

---

### Milestone 4: Learning Path Front-End
**Duration**: 6-8 days

- [ ] Create single learning path template
- [ ] Implement path hero section (RTL)
- [ ] Create phases timeline/stack (RTL)
- [ ] Implement steps accordion (RTL)
- [ ] Create resources display (grouped by type)
- [ ] Add outcomes section
- [ ] Implement FAQ section (RTL)
- [ ] Create path archive template
- [ ] Add path filtering (by level)
- [ ] Implement path search

**Deliverables**:
- Complete learning path pages
- RTL-optimized UI
- Interactive components working
- Archive and filtering functional

---

### Milestone 5: Course + Lesson Pages
**Duration**: 5-7 days

- [ ] Create single course template
- [ ] Implement course hero (RTL)
- [ ] Create sticky purchase box
- [ ] Implement lessons accordion (RTL)
- [ ] Add course benefits section
- [ ] Show linked learning paths
- [ ] Create lesson template
- [ ] Implement video player (RTL controls)
- [ ] Create lesson navigation (RTL)
- [ ] Add progress tracking UI
- [ ] Create course archive

**Deliverables**:
- Complete course pages
- Lesson viewing experience
- Video player with RTL controls
- Progress tracking

---

### Milestone 6: Dashboard
**Duration**: 4-5 days

- [ ] Create dashboard page template
- [ ] Implement purchased courses section
- [ ] Create followed paths section
- [ ] Add "Continue learning" widget
- [ ] Implement progress indicators
- [ ] Add quick access links
- [ ] Create dashboard shortcodes
- [ ] Add user profile integration

**Deliverables**:
- Functional student dashboard
- Progress tracking
- Quick access to content

---

### Milestone 7: WooCommerce Integration
**Duration**: 5-6 days

- [ ] Create custom product type for courses
- [ ] Link courses to WooCommerce products
- [ ] Implement purchase flow
- [ ] Add access control (course access after purchase)
- [ ] Create purchase confirmation emails (Persian)
- [ ] Implement cart/checkout customization (RTL)
- [ ] Add course access validation
- [ ] Handle refunds and access revocation

**Deliverables**:
- Complete e-commerce integration
- Course purchasing working
- Access control functional
- RTL checkout experience

---

### Milestone 8: UX Polish + RTL Refinements
**Duration**: 4-6 days

- [ ] Home page implementation
- [ ] Blog templates (RTL)
- [ ] Static pages (About, Contact, FAQ)
- [ ] Test all components in RTL
- [ ] Fix spacing and alignment issues
- [ ] Optimize typography
- [ ] Add loading states
- [ ] Implement error pages (404, etc.)
- [ ] Cross-browser testing
- [ ] Mobile responsiveness check
- [ ] Performance optimization
- [ ] Accessibility improvements

**Deliverables**:
- Polished, production-ready UI
- Fully RTL-optimized
- Responsive and accessible
- Performance optimized

---

## 🎨 RTL Implementation Strategy

### HTML Structure

All templates must include:

```html
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Persian fonts -->
    <link rel="stylesheet" href="path/to/persian-font.css">
</head>
<body>
    <!-- Content -->
</body>
</html>
```

### Tailwind RTL Configuration

1. **Install RTL Plugin**:
   ```bash
   npm install tailwindcss-rtl
   ```

2. **Configure `tailwind.config.js`**:
   - Enable RTL mode
   - Add Persian font family
   - Configure RTL-specific spacing
   - Set up logical properties

3. **Use RTL Utilities**:
   - `rtl:` prefix for RTL-specific styles
   - Logical properties: `ms-*` (margin-start), `me-*` (margin-end)
   - Direction-aware classes

### Component Mirroring

All components must be RTL-aware:

- **Navigation**: Arrows point left (←) for next, right (→) for previous
- **Accordions**: Icons on the right side
- **Cards**: Content flows right-to-left
- **Forms**: Labels on the right, inputs on the left
- **Buttons**: Icons positioned for RTL
- **Timelines**: Flow from right to left

### Typography

- **Font Selection**: IRANSans, Vazirmatn, or Shabnam
- **Line Height**: Optimized for Persian text (1.6-1.8)
- **Letter Spacing**: Minimal (Persian doesn't need letter spacing)
- **Number Formatting**: Support Persian numerals (optional)

### Testing Checklist

- [ ] All layouts flow RTL
- [ ] Spacing is correct (padding/margin)
- [ ] Icons and arrows are mirrored
- [ ] Forms are RTL-aligned
- [ ] Navigation works correctly
- [ ] Typography is readable
- [ ] Persian text renders correctly
- [ ] Numbers display correctly (Persian or English)

---

## 🔮 Future Extensions (Phase 2)

### AI Features (Phase 2)

1. **Recommendation Engine**
   - Suggest learning paths based on user profile
   - Recommend next steps in current path
   - Personalized course suggestions

2. **AI-Powered Content**
   - Auto-generate learning path descriptions
   - Content summarization
   - Quiz generation

3. **Chatbot Assistant**
   - Persian-language chatbot
   - Answer student questions
   - Guide through learning paths

4. **Progress Analytics**
   - AI-driven progress insights
   - Learning pattern analysis
   - Predictive completion times

### Additional Features

1. **Social Learning**
   - Student forums
   - Study groups
   - Peer reviews

2. **Gamification**
   - Badges and achievements
   - Leaderboards
   - Points system

3. **Advanced Analytics**
   - Detailed progress tracking
   - Learning analytics dashboard
   - Export progress reports

4. **Mobile App**
   - React Native app
   - Offline content access
   - Push notifications

5. **Instructor Features**
   - Instructor dashboard
   - Content creation tools
   - Student management

---

## 📝 Notes

### Important Considerations

1. **RTL is Not Optional**: Every component must be RTL-first
2. **Persian Language**: All UI text should be in Farsi
3. **Performance**: Optimize for fast loading (especially fonts)
4. **Accessibility**: Follow WCAG guidelines for RTL content
5. **Browser Support**: Test in Chrome, Firefox, Safari, Edge
6. **Mobile First**: Design for mobile, enhance for desktop

### Development Best Practices

- Use semantic HTML
- Follow WordPress coding standards
- Write clean, documented PHP
- Use WordPress hooks and filters
- Sanitize all inputs
- Escape all outputs
- Use nonces for forms
- Follow security best practices

### Resources

- [WordPress Codex](https://codex.wordpress.org/)
- [Tailwind CSS RTL](https://github.com/20lives/tailwindcss-rtl)
- [Persian Typography Guide](https://github.com/rastikerdar/vazir-font)
- [WooCommerce Docs](https://woocommerce.com/documentation/)

---

## 📄 License

[Specify your license here]

---

## 👥 Contributors

[Add contributors here]

---

## 📧 Contact

[Add contact information here]

---

**Built with ❤️ for Persian learners**

