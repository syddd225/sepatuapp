# ProductController Implementation Guide

## Overview
This document explains the complete ProductController implementation for the Digital Showcase (Etalase Digital) platform, including the WhatsApp CTA integration, data flow, and standardization patterns used.

---

## Architecture & Data Flow

```
┌─────────────────────────────────────────────────────────────┐
│                    USER REQUEST (Browser)                   │
└────────────────────────┬────────────────────────────────────┘
                         │
                         ▼
        ┌────────────────────────────────────┐
        │    ProductController Methods       │
        ├────────────────────────────────────┤
        │ • index()        → List categories │
        │ • byCategory()   → Filter products │
        │ • show()         → Product details │
        │ • generateWhatsAppLink() → AJAX    │
        └────────────────┬───────────────────┘
                         │
         ┌───────────────┼───────────────┐
         ▼               ▼               ▼
    ┌─────────┐  ┌──────────────┐  ┌──────────────┐
    │ Product │  │  Category    │  │ WhatsAppHelper
    │  Model  │  │   Model      │  │   (Helper)
    └──┬──────┘  └──────┬───────┘  └──────┬───────┘
       │                │                  │
       └────────┬───────┴──────────┬───────┘
                │                  │
                ▼                  ▼
        ┌─────────────────────────────────────┐
        │      Data Transformation            │
        ├─────────────────────────────────────┤
        │ • Prepare images (angles)           │
        │ • Extract materials array           │
        │ • Format philosophy text            │
        │ • Generate WhatsApp phone           │
        │ • Check stock availability          │
        └────────────┬────────────────────────┘
                     │
                     ▼
        ┌─────────────────────────────────────┐
        │   Return to View (Blade Template)   │
        ├─────────────────────────────────────┤
        │ • Product data with all fields      │
        │ • WhatsApp link (dynamic)           │
        │ • Multiple image angles             │
        │ • Materials & philosophy            │
        └────────────────────────────────────┘
                     │
                     ▼
        ┌─────────────────────────────────────┐
        │   Browser Renders HTML              │
        ├─────────────────────────────────────┤
        │ User sees product details with:     │
        │ - Images from multiple angles       │
        │ - Material information              │
        │ - Artisan philosophy                │
        │ - Size & Color variant selectors    │
        │ - "Pesan via WhatsApp" button       │
        └────────────────────────────────────┘
```

---

## Controller Methods Explained

### 1. **index()** - Display All Categories
```php
Route: GET /
Purpose: Show the home page with all product categories
Returns: View 'products.menu' with categories list
```

**Flow:**
- Fetches all categories with their related products
- Implements error handling (try-catch)
- Falls back gracefully if categories unavailable
- Logs errors for debugging

**Example Request:**
```
GET http://localhost:8000/
```

**Response Data:**
```php
[
    'categories' => Collection<Category>,
]
```

---

### 2. **byCategory($id)** - Filter Products by Category
```php
Route: GET /category/{id}
Purpose: Display all products in a specific category
Returns: View 'products.product' with filtered products
```

**Flow:**
- Validates category exists (404 if not)
- Filters products by category_id
- Scopes query to only available (in-stock) products
- Orders by most recent first
- Comprehensive error handling

**Example Request:**
```
GET http://localhost:8000/category/1
```

**Response Data:**
```php
[
    'category' => Category object,
    'products' => Collection<Product>,
]
```

---

### 3. **show($id)** - Product Detail Page
```php
Route: GET /product/{id}
Purpose: Display complete product information with multiple angles
Returns: View 'products.show' with enriched product data
```

**Key Features:**
- **Multiple Images:** Extracts primary image + angle images from `images_angles` JSON
- **Materials:** Converts `materials` JSON array to formatted list
- **Philosophy:** Displays artisan philosophy/craftsmanship story
- **Stock Status:** Checks availability
- **WhatsApp Phone:** Gets product-specific or default business number

**Example Request:**
```
GET http://localhost:8000/product/5
```

**Response Data:**
```php
[
    'product' => Product object,
    'images' => [
        'primary' => ['url' => '/image/shoe.jpg', 'alt' => '...'],
        'angle_1' => ['url' => '/image/shoe-side.jpg', 'alt' => '...'],
        'angle_2' => ['url' => '/image/shoe-top.jpg', 'alt' => '...'],
        // ... more angles
    ],
    'materials' => [
        ['name' => 'Kulit Asli', 'quality' => 'Premium'],
        ['name' => 'Sol Karet', 'quality' => 'Durable'],
    ],
    'philosophy' => 'String describing artisan philosophy...',
    'whatsappPhone' => '62895321683364',
    'inStock' => true,
]
```

---

### 4. **generateWhatsAppLink($request, $id)** - AJAX WhatsApp Link Generator
```php
Route: POST /product/{id}/whatsapp
Purpose: Generate pre-filled WhatsApp message link
Returns: JSON response with WhatsApp URL
```

**Request Validation:**
```json
{
    "size": "42",      // optional: shoe size
    "color": "Original" // optional: color/texture variant
}
```

**Response on Success (200 OK):**
```json
{
    "success": true,
    "whatsapp_link": "https://wa.me/62895321683364?text=Halo!%20Saya%20tertarik...",
    "product_name": "Retro Oxford Black",
    "price": 330000
}
```

**Response on Error:**
```json
{
    "success": false,
    "message": "Error description",
    "errors": {} // validation errors if applicable
}
```

**HTTP Status Codes:**
- `200 OK` - Link generated successfully
- `404 Not Found` - Product doesn't exist
- `422 Unprocessable Entity` - Validation errors
- `500 Internal Server Error` - Server error

---

## WhatsApp Helper Class (`WhatsAppHelper`)

### Purpose
Centralize WhatsApp link generation with validation and message formatting.

### Key Methods

#### `generateProductInquiryLink()`
**Signature:**
```php
public static function generateProductInquiryLink(
    string $phoneNumber,
    string $productName,
    float $price,
    array $selectedVariant = []
): string
```

**Parameters:**
- `$phoneNumber`: Format `62895321683364` (Indonesia: 62 + number without leading 0)
- `$productName`: e.g., "Retro Oxford Black"
- `$price`: Numeric price value
- `$selectedVariant`: Array with optional `'size'` and `'color'` keys

**Example Usage:**
```php
$whatsappLink = WhatsAppHelper::generateProductInquiryLink(
    '62895321683364',
    'Retro Oxford Black',
    330000,
    ['size' => '42', 'color' => 'Original']
);

// Returns:
// https://wa.me/62895321683364?text=Halo!%20Saya%20tertarik...
```

**Message Format:**
```
Halo! Saya tertarik dengan produk ini:

*{Retro Oxford Black}*
Harga: Rp 330.000
Ukuran: 42
Warna/Tekstur: Original

Apakah stoknya masih tersedia?
```

#### `getBusinessPhoneNumber()`
**Returns:** Default WhatsApp business number from config.

**Priority:**
1. `config('whatsapp.business_phone')`
2. `env('WHATSAPP_BUSINESS_PHONE')`
3. Returns `null` if not configured

---

## Database Schema Extensions

### New Product Fields

| Column | Type | Purpose |
|--------|------|---------|
| `materials` | JSON | Array of material objects: `[{'name': '...', 'quality': '...'}]` |
| `philosophy` | TEXT | Artisan philosophy/craftsmanship story |
| `images_angles` | JSON | Array of additional image filenames for multiple angles |
| `whatsapp_phone` | VARCHAR | Product-specific WhatsApp number (overrides default) |

### Example Product Data
```json
{
    "id": 5,
    "name": "Retro Oxford Black",
    "description": "Sepatu formal hitam dengan tampilan rapi...",
    "price": 330000.00,
    "image": "formalhitam.jpeg",
    "category_id": 1,
    "stock": 8,
    "materials": [
        {"name": "Kulit Asli", "quality": "Premium"},
        {"name": "Sol Karet", "quality": "Durable"}
    ],
    "philosophy": "Klasik abadi: hitam yang sempurna untuk setiap kesempatan formal dengan kenyamanan sepanjang hari.",
    "images_angles": [
        "formal-black-side.jpg",
        "formal-black-top.jpg",
        "formal-black-sole.jpg"
    ],
    "whatsapp_phone": null,
    "created_at": "2026-06-17T10:30:00Z",
    "updated_at": "2026-06-17T10:30:00Z"
}
```

---

## Error Handling Strategy

### HTTP Status Codes
| Code | Scenario | Example |
|------|----------|---------|
| 200 | Success | Products loaded |
| 404 | Not Found | Product/Category doesn't exist |
| 422 | Validation Error | Invalid input data |
| 500 | Server Error | Database/system error |

### Logging
All errors are logged with:
- **Error Message**: What went wrong
- **Context**: Which record/ID caused the issue
- **Stack Trace**: For debugging

**Log Location:** `storage/logs/laravel.log`

**Example Log:**
```
[2026-06-17 10:45:23] local.ERROR: Failed to load product details {"product_id":999,"error":"No query results found for model [App\\Models\\Product] with value [999]","trace":"..."}
```

---

## RESTful Conventions Used

### Naming Patterns
- **Resources**: `products`, `categories` (plural)
- **Methods**: `index()`, `show()` (standard CRUD names)
- **Routes**: Descriptive paths (`/category/{id}`, `/product/{id}`)
- **HTTP Verbs**: GET for retrieval, POST for actions (WhatsApp link generation)

### URL Naming
```
GET  /                    → Show all categories
GET  /category/{id}       → Show products in category
GET  /product/{id}        → Show product detail
POST /product/{id}/whatsapp → Generate WhatsApp link
```

### Response Format
- **HTML Views**: Rendered Blade templates for browsers
- **JSON API**: Structured JSON for AJAX requests
- **Consistent Error Responses**: Standard error message format

---

## Configuration

### Environment Variables (.env)
```env
WHATSAPP_ENABLED=true
WHATSAPP_BUSINESS_PHONE=62895321683364
WHATSAPP_MESSAGE_TEMPLATE="Halo! Saya tertarik..."
```

### Config File (config/whatsapp.php)
```php
return [
    'business_phone' => env('WHATSAPP_BUSINESS_PHONE', '62895321683364'),
    'message_template' => env('WHATSAPP_MESSAGE_TEMPLATE', '...'),
    'enabled' => env('WHATSAPP_ENABLED', true),
];
```

---

## Testing the Implementation

### Step 1: Run Migrations
```bash
php artisan migrate
```

### Step 2: Seed Database
```bash
php artisan db:seed
```

### Step 3: Start Development Server
```bash
php artisan serve
```

### Step 4: Test Endpoints
```bash
# View categories
curl http://localhost:8000/

# View products in category 1
curl http://localhost:8000/category/1

# View product detail
curl http://localhost:8000/product/5

# Generate WhatsApp link
curl -X POST http://localhost:8000/product/5/whatsapp \
  -H "Content-Type: application/json" \
  -d '{"size": "42", "color": "Original"}'
```

---

## Security Considerations

1. **Input Validation**: All user inputs are validated before use
2. **Phone Number Validation**: WhatsApp numbers are validated for format
3. **Error Messages**: Generic messages to users; detailed logs for developers
4. **Logging**: Sensitive data (phone numbers) logged for audit trails
5. **URL Encoding**: WhatsApp messages properly URL-encoded

---

## Performance Optimizations

1. **Eager Loading**: `with('category')` prevents N+1 queries
2. **Query Scoping**: `available()` scope for stock filtering
3. **Caching Potential**: Categories could be cached (future enhancement)
4. **Image Optimization**: Consider lazy-loading for multiple angles

---

## Future Enhancements

1. **Search**: Add full-text search for products
2. **Favorites**: Allow users to save favorite products
3. **Image Gallery**: Interactive image carousel for angle viewing
4. **Analytics**: Track WhatsApp clicks and conversions
5. **Multi-language**: Support Indonesian/English product descriptions
6. **Admin Panel**: CRUD operations for products and categories

---

## Support & Maintenance

**Questions?** Check:
- Controller documentation (inline comments)
- Helper class methods
- Migration file comments
- .env configuration

**Issues?** Check:
- `storage/logs/laravel.log`
- Database migrations status: `php artisan migrate:status`
- Route list: `php artisan route:list`
