# Codina Core Plugin

پلاگین اصلی پلتفرم آموزشی Codina

## توضیحات

این پلاگین هسته اصلی پلتفرم Codina را تشکیل می‌دهد و شامل:

- ثبت Custom Post Types (CPTs)
- مدیریت روابط سلسله‌مراتبی
- یکپارچه‌سازی با WooCommerce
- مدیریت دسترسی دانشجویان

## Custom Post Types

### 1. Learning Path (`learning_path`)
- **نوع**: Parent CPT (سلسله‌مراتبی)
- **توضیحات**: مسیرهای یادگیری ساختاریافته
- **فیلدها**: عنوان، توضیحات، سطح، مدت زمان، نتایج، ویدیو هیرو

### 2. Course (`codina_course`)
- **نوع**: Parent CPT (سلسله‌مراتبی)
- **توضیحات**: دوره‌های آموزشی
- **فیلدها**: عنوان، توضیحات، پیش‌نیازها، سطح، مدت زمان، لینک WooCommerce

### 3. Lesson (`codina_lesson`)
- **نوع**: Child of Course
- **توضیحات**: دروس دوره‌های آموزشی
- **فیلدها**: عنوان، ویدیو، محتوا، ضمیمه‌ها، ترتیب

## نصب

1. پلاگین را در `wp-content/plugins/codina-core/` قرار دهید
2. از پنل مدیریت WordPress، پلاگین را فعال کنید
3. Permalink ها را به‌روزرسانی کنید (Settings → Permalinks → Save Changes)

## نیازمندی‌ها

- WordPress 6.0+
- PHP 8.0+
- WooCommerce (برای ویژگی‌های تجارت الکترونیک)

## نسخه

1.0.0

## مجوز

GPL v2 or later

