# Pages Module - WordPress-Like Content Management

This module provides a complete page management system with template support, similar to WordPress. You can create pages with different templates and manage them through the admin panel.

## Features

- ✅ Create and manage pages through Filament admin panel
- ✅ Multiple page templates (Default, Doctor Template, About, Contact, Blank)
- ✅ Rich text editor for page content
- ✅ Featured image support
- ✅ SEO meta fields (title, description, keywords)
- ✅ URL slug management (auto-generated from title)
- ✅ Page status (active/inactive)
- ✅ Display order control
- ✅ WordPress-like simplicity

## Database

The pages are stored in the `pages` table with the following fields:
- `id` - Primary key
- `title` - Page title
- `slug` - URL-friendly identifier (unique)
- `content` - Rich text content (HTML)
- `template` - Template selection (default, doctor-template, about, contact, blank)
- `meta_title` - SEO meta title
- `meta_description` - SEO meta description
- `meta_keywords` - SEO meta keywords
- `featured_image` - Featured image path
- `is_active` - Active status (boolean)
- `order` - Display order
- `created_at`, `updated_at` - Timestamps

## Available Templates

### 1. Default Template (`default`)
- Standard page layout
- Featured image at top
- Full-width content area
- Breadcrumbs and page banner

### 2. Doctor Template (`doctor-template`)
- Displays all departments
- Links to department doctors
- Can include custom content at the top
- Similar to the department-doctors page

### 3. About Page (`about`)
- Two-column layout
- Featured image on left
- Content on right
- Perfect for "About Us" pages

### 4. Contact Page (`contact`)
- Left column for content
- Right column for contact information
- Displays site settings (phone, email, address)

### 5. Blank Template (`blank`)
- No wrapper or styling
- Completely customizable
- Perfect for landing pages

## How to Use

### Access the Admin Panel

1. Go to the Filament admin panel (usually at `/admin`)
2. Navigate to **Content → Pages** in the sidebar
3. Click **Create Page** to add a new page

### Creating a Page

1. Enter the page title
2. The slug will auto-generate from the title (you can edit it)
3. Select a template from the dropdown
4. Add content using the rich text editor
5. Upload a featured image (optional)
6. Add SEO meta information (optional)
7. Set the display order
8. Click **Save**

### Accessing Pages

Pages are accessible at: `https://yoursite.com/page-slug`

For example:
- Page with slug "about-us" → `/about-us`
- Page with slug "contact" → `/contact`

## Adding Custom Templates

To add a new template:

1. Create a new blade file in `resources/views/livewire/pages/your-template.blade.php`

2. Add the template to the `getTemplates()` method in `app/Models/Page.php`:

```php
public static function getTemplates()
{
    return [
        'default' => 'Default Template',
        'doctor-template' => 'Doctor Template',
        'about' => 'About Page',
        'contact' => 'Contact Page',
        'blank' => 'Blank Page',
        'your-template' => 'Your Custom Template', // Add here
    ];
}
```

3. Add the template case to `app/Livewire/PageView.php`:

```php
$templateView = match($this->page->template) {
    'doctor-template' => 'livewire.pages.doctor-template',
    'about' => 'livewire.pages.about',
    'contact' => 'livewire.pages.contact',
    'blank' => 'livewire.pages.blank',
    'your-template' => 'livewire.pages.your-template', // Add here
    default => 'livewire.pages.default',
};
```

## Example Usage

### Creating an "About Us" Page

1. Go to **Content → Pages → Create Page**
2. Title: "About Us"
3. Slug: "about-us"
4. Template: Select "About Page"
5. Upload a featured image
6. Add content in the rich text editor
7. Save

The page will be accessible at `/about-us`

### Creating a Doctors Directory Page

1. Go to **Content → Pages → Create Page**
2. Title: "Our Medical Team"
3. Slug: "medical-team"
4. Template: Select "Doctor Template"
5. Add introduction content in the editor
6. Save

The page will show all departments with links to view doctors in each department.

## File Structure

```
app/
├── Livewire/
│   └── PageView.php (Main page component)
├── Models/
│   └── Page.php (Page model)
└── Filament/
    └── Resources/
        └── Pages/
            ├── PageResource.php (Filament resource)
            ├── Pages/
            │   ├── ListPages.php
            │   ├── CreatePage.php
            │   └── EditPage.php
            ├── Schemas/
            │   └── PageForm.php (Form configuration)
            └── Tables/
                └── PagesTable.php (Table configuration)

resources/views/livewire/
├── page-view.blade.php (Main view)
└── pages/
    ├── default.blade.php
    ├── doctor-template.blade.php
    ├── about.blade.php
    ├── contact.blade.php
    └── blank.blade.php

database/migrations/
└── *_create_pages_table.php
```

## Tips

- Use the slug field to create clean URLs
- The blank template gives you complete design freedom
- Featured images work best in 1200x600px or similar ratio
- Use the SEO fields to improve search engine visibility
- Set lower order numbers to show pages first in listings

## Maintenance

The pages module is fully integrated with the existing project structure and follows the same patterns as other modules (Doctors, Departments, etc.).
