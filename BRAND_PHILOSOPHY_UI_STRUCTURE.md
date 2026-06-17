# Brand & Philosophy UI/View Structure

## Overview
This document outlines the aesthetic UI layout for brand storytelling pages. All components are designed to complement the existing minimalist, premium dark theme (#1E1E1E, gold accents #C19A6B).

---

## Page Architecture

### 1. **Brand Philosophy / About Us Page** (`/about`)

#### Layout Structure:
```
┌─────────────────────────────────────────────┐
│         HERO SECTION (Full Screen)          │
│  Background: Brand hero image (cinematic)   │
│  Overlay: Dark gradient (60% opacity)       │
│  Content: Centered text                     │
│  - Title: "Retro Collection"                │
│  - Tagline: "Craftsmanship, Heritage, Soul" │
│  - CTA: "Jelajahi Koleksi" button           │
└─────────────────────────────────────────────┘
         ↓
┌─────────────────────────────────────────────┐
│      BRAND STORY SECTION (Full Width)       │
│  Background: Clean white (#F5F5F5)          │
│  Layout: 2-column grid on desktop           │
│  - Left: Large image (founder/workshop)     │
│  - Right: Compelling narrative text         │
│  Typography: Serif font for story           │
│  Spacing: Generous padding (80px vertical)  │
└─────────────────────────────────────────────┘
         ↓
┌─────────────────────────────────────────────┐
│  MISSION / VISION / VALUES (3-column)       │
│  Background: Dark (#1E1E1E)                 │
│  Text: White with gold accents              │
│  Cards: Each with icon + title + text       │
│  - Mission: "Mengapa kami membuat..."       │
│  - Vision: "Kemana kami akan..."            │
│  - Values: "Prinsip inti kami..."           │
└─────────────────────────────────────────────┘
         ↓
┌─────────────────────────────────────────────┐
│    ARTISAN PROFILES SECTION (Grid)          │
│  Background: Light gray (#F8F9FA)           │
│  Layout: 2-3 column grid (responsive)       │
│  Each Card:                                 │
│  - Circular artisan photo (300x300)         │
│  - Name (gold accent, large)                │
│  - Specialty (subtitle)                     │
│  - Years of experience                      │
│  - Short bio (3-4 lines)                    │
│  - Read More link                           │
│  Hover: Subtle shadow lift, icon appears    │
└─────────────────────────────────────────────┘
         ↓
┌─────────────────────────────────────────────┐
│   MATERIAL PHILOSOPHY SECTION (Carousel)    │
│  Background: Dark (#1E1E1E)                 │
│  Title: "Bahan-Bahan Pilihan" (gold)        │
│  Cards: Swipeable/scrollable                │
│  Each Card:                                 │
│  - Material image (texture closeup)         │
│  - Material name (gold)                     │
│  - Origin + supplier story (short)          │
│  - Sustainability badges                    │
│  - Durability rating (stars)                │
│  - Hover: Expand to show full story         │
└─────────────────────────────────────────────┘
         ↓
┌─────────────────────────────────────────────┐
│  SUSTAINABILITY COMMITMENT (Full Width)     │
│  Background: Cream (#FEFDF8)                │
│  Content: Centered text + infographic       │
│  - Eco badges                               │
│  - Fair trade statement                     │
│  - Local sourcing %                         │
│  - Carbon footprint (if available)          │
└─────────────────────────────────────────────┘
         ↓
┌─────────────────────────────────────────────┐
│    SOCIAL & CONTACT SECTION                 │
│  Background: Dark (#1E1E1E)                 │
│  Links: Instagram, TikTok, WhatsApp         │
│  Centered layout with large icons           │
└─────────────────────────────────────────────┘
```

---

### 2. **Individual Artisan Profile Page** (`/about/artisan/{slug}`)

#### Layout:
```
┌─────────────────────────────────────────────┐
│      HERO: Artisan Action Photo             │
│  Full screen background image               │
│  (Artisan at work in workshop)              │
│  Overlay: Dark gradient                     │
│  Text: Name + specialty (white, centered)   │
└─────────────────────────────────────────────┘
         ↓
┌──────────────────────────────────────────────┐
│       ARTISAN PROFILE (2-column)             │
│  Left: Circular headshot (400x400)           │
│  Right:                                      │
│  - Name (gold, large)                       │
│  - Specialty (gray text)                    │
│  - Years of experience                      │
│  - Key achievements/certifications          │
│  - Social links (Instagram icon)            │
│  - Contact button (WhatsApp)                │
└──────────────────────────────────────────────┘
         ↓
┌──────────────────────────────────────────────┐
│      CRAFTSMANSHIP PHILOSOPHY (Text)         │
│  Full width, generous padding               │
│  Serif font for poetic feel                 │
│  Background: Alternating light/dark         │
│  Max-width: 700px (readable)                │
└──────────────────────────────────────────────┘
         ↓
┌──────────────────────────────────────────────┐
│    SIGNATURE PRODUCTS (Grid)                 │
│  Products this artisan specializes in       │
│  Show 4-6 featured products                 │
│  With images and quick links                │
└──────────────────────────────────────────────┘
         ↓
┌──────────────────────────────────────────────┐
│      AWARDS & RECOGNITION                   │
│  Timeline or list of achievements           │
│  With years and descriptions                │
└──────────────────────────────────────────────┘
```

---

### 3. **Materials Reference Page** (`/about/materials`)

#### Layout:
```
┌──────────────────────────────────────────────┐
│      HERO: "Bahan-Bahan Kami"               │
│  Subtitle: "Kualitas & Keberlanjutan"       │
└──────────────────────────────────────────────┘
         ↓
┌──────────────────────────────────────────────┐
│    MATERIAL CATEGORIES (Tab Navigation)      │
│  Tabs: Leather, Canvas, Soles, Hardware    │
│  Grid below shows selected category         │
│  Responsive: Stack on mobile                │
└──────────────────────────────────────────────┘
         ↓
┌──────────────────────────────────────────────┐
│  MATERIAL CARDS (Grid, 2-3 columns)         │
│  Each Card:                                 │
│                                             │
│  ┌─────────────────────────────┐           │
│  │   [Texture Image: 400x300]  │           │
│  ├─────────────────────────────┤           │
│  │ Premium Kulit Asli Cokelat  │ (Gold)   │
│  │ Asal: Tannery, Bandung      │           │
│  │ Durability: ⭐⭐⭐⭐⭐      │           │
│  │ [♻️ Sustainable]            │           │
│  │ [🌍 Locally Sourced]        │           │
│  │ ───────────────────────     │           │
│  │ "Carefully sourced from..." │           │
│  │ [Baca Selengkapnya →]       │           │
│  └─────────────────────────────┘           │
│                                             │
│  On Click/Hover: Expand full supplier       │
│  story, sustainability details, care tips  │
└──────────────────────────────────────────────┘
         ↓
┌──────────────────────────────────────────────┐
│   SUPPLIER SPOTLIGHT (Featured)             │
│  Background: Cream                          │
│  Full story of one special supplier         │
│  With map + photos                         │
│  - "Mengapa kami percaya..."                │
│  - "Komitmen mereka..."                     │
└──────────────────────────────────────────────┘
```

---

## Component Code Examples

### Hero Section (Blade)
```blade
<section class="hero-about" style="background-image: url('{{ $brand->hero_image }}')">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>{{ $brand->name }}</h1>
        <p class="hero-tagline">{{ $brand->tagline }}</p>
        <a href="/category/1" class="btn-hero">
            Jelajahi Koleksi
        </a>
    </div>
</section>

<style>
.hero-about {
    background-size: cover;
    background-position: center;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    text-align: center;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6);
}

.hero-content {
    position: relative;
    z-index: 2;
    color: white;
}

.hero-content h1 {
    font-size: 4rem;
    margin-bottom: 15px;
    font-weight: 700;
}

.hero-tagline {
    font-size: 1.3rem;
    color: #ddd;
    margin-bottom: 30px;
}

.btn-hero {
    display: inline-block;
    padding: 15px 40px;
    background: #C19A6B;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    transition: 0.3s;
    font-weight: 600;
}

.btn-hero:hover {
    background: #a8855a;
}
</style>
```

### Brand Story Section
```blade
<section class="brand-story">
    <div class="story-grid">
        <div class="story-image">
            <img src="{{ $brand->founder_image }}" alt="Founder">
        </div>
        <div class="story-text">
            <h2>{{ $brand->name }}</h2>
            <p class="story-intro">{{ $brand->tagline }}</p>
            {!! nl2br($brand->story) !!}
        </div>
    </div>
</section>

<style>
.brand-story {
    padding: 100px 20px;
    background: #F5F5F5;
}

.story-grid {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.story-image img {
    width: 100%;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.story-text h2 {
    font-size: 2.5rem;
    color: #1E1E1E;
    margin-bottom: 10px;
    font-weight: 700;
}

.story-intro {
    color: #C19A6B;
    font-size: 1.1rem;
    margin-bottom: 20px;
    font-weight: 600;
}

.story-text p {
    font-size: 1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 15px;
}

@media (max-width: 768px) {
    .story-grid {
        grid-template-columns: 1fr;
    }
}
</style>
```

### Mission/Vision/Values (3-Column Cards)
```blade
<section class="mvv-section">
    <div class="mvv-container">
        <!-- Mission Card -->
        <div class="mvv-card">
            <div class="mvv-icon">🎯</div>
            <h3>Misi Kami</h3>
            <p>{{ $brand->mission }}</p>
        </div>

        <!-- Vision Card -->
        <div class="mvv-card">
            <div class="mvv-icon">🌟</div>
            <h3>Visi Kami</h3>
            <p>{{ $brand->vision }}</p>
        </div>

        <!-- Values Card -->
        <div class="mvv-card">
            <div class="mvv-icon">❤️</div>
            <h3>Nilai-Nilai Kami</h3>
            <p>{{ $brand->values }}</p>
        </div>
    </div>
</section>

<style>
.mvv-section {
    background: #1E1E1E;
    padding: 80px 20px;
}

.mvv-container {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
}

.mvv-card {
    background: rgba(193, 154, 107, 0.05);
    padding: 40px;
    border-radius: 12px;
    border-left: 4px solid #C19A6B;
    text-align: center;
}

.mvv-icon {
    font-size: 3rem;
    margin-bottom: 20px;
}

.mvv-card h3 {
    color: #C19A6B;
    font-size: 1.4rem;
    margin-bottom: 15px;
}

.mvv-card p {
    color: #ddd;
    font-size: 1rem;
    line-height: 1.6;
}
</style>
```

### Artisan Profile Cards (Grid)
```blade
<section class="artisans-section">
    <h2>Tim Pengrajin Kami</h2>
    <div class="artisans-grid">
        @foreach ($artisans as $artisan)
            <div class="artisan-card">
                <div class="artisan-image">
                    <img src="{{ $artisan->photo }}" alt="{{ $artisan->name }}">
                </div>
                <div class="artisan-info">
                    <h3>{{ $artisan->name }}</h3>
                    <p class="specialty">{{ $artisan->specialty }}</p>
                    <p class="experience">{{ $artisan->getExperienceText() }}</p>
                    <p class="bio">{{ Str::limit($artisan->bio, 150) }}</p>
                    <a href="/about/artisan/{{ $artisan->slug }}" class="link-more">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>

<style>
.artisans-section {
    padding: 80px 20px;
    background: #F8F9FA;
}

.artisans-section h2 {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 60px;
    color: #1E1E1E;
}

.artisans-grid {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 40px;
}

.artisan-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.artisan-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.artisan-image {
    width: 100%;
    height: 250px;
    overflow: hidden;
    background: #e0e0e0;
}

.artisan-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.artisan-info {
    padding: 30px;
    text-align: center;
}

.artisan-info h3 {
    font-size: 1.4rem;
    color: #C19A6B;
    margin-bottom: 5px;
    font-weight: 700;
}

.specialty {
    color: #666;
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 10px;
}

.experience {
    color: #999;
    font-size: 0.9rem;
    margin-bottom: 15px;
}

.bio {
    color: #555;
    font-size: 0.95rem;
    line-height: 1.5;
    margin-bottom: 15px;
}

.link-more {
    color: #C19A6B;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

.link-more:hover {
    color: #a8855a;
}
</style>
```

### Material Cards (Carousel/Grid)
```blade
<section class="materials-section">
    <h2>Bahan-Bahan Pilihan</h2>
    <div class="materials-grid">
        @foreach ($materials as $material)
            <div class="material-card">
                <div class="material-image">
                    <img src="{{ $material->image }}" alt="{{ $material->name }}">
                </div>
                <div class="material-content">
                    <h3>{{ $material->name }}</h3>
                    <p class="origin">{{ $material->supplier_country }} • {{ $material->supplier_name }}</p>
                    
                    <div class="badges">
                        @if ($material->is_sustainable)
                            <span class="badge eco">♻️ Berkelanjutan</span>
                        @endif
                        @if ($material->is_locally_sourced)
                            <span class="badge local">🌍 Lokal</span>
                        @endif
                    </div>
                    
                    <p class="durability">
                        Durabilitas: {{ $material->getDurabilityIcon() }}
                    </p>
                    
                    <p class="description">{{ Str::limit($material->description, 100) }}</p>
                    
                    <a href="/about/materials#{{ $material->slug }}" class="expand-btn">
                        Pelajari Selengkapnya
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>

<style>
.materials-section {
    background: #1E1E1E;
    padding: 80px 20px;
}

.materials-section h2 {
    text-align: center;
    font-size: 2.5rem;
    color: #C19A6B;
    margin-bottom: 60px;
}

.materials-grid {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}

.material-card {
    background: rgba(193, 154, 107, 0.05);
    border: 1px solid rgba(193, 154, 107, 0.2);
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s;
    cursor: pointer;
}

.material-card:hover {
    border-color: #C19A6B;
    box-shadow: 0 0 20px rgba(193, 154, 107, 0.2);
}

.material-image {
    width: 100%;
    height: 200px;
    overflow: hidden;
}

.material-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.material-content {
    padding: 25px;
}

.material-content h3 {
    color: #C19A6B;
    font-size: 1.2rem;
    margin-bottom: 5px;
}

.origin {
    color: #aaa;
    font-size: 0.9rem;
    margin-bottom: 15px;
}

.badges {
    display: flex;
    gap: 8px;
    margin-bottom: 12px;
}

.badge {
    display: inline-block;
    padding: 4px 10px;
    font-size: 0.85rem;
    border-radius: 20px;
    background: rgba(193, 154, 107, 0.1);
    color: #C19A6B;
}

.durability {
    color: #ddd;
    font-size: 0.95rem;
    margin-bottom: 10px;
}

.description {
    color: #bbb;
    font-size: 0.9rem;
    line-height: 1.4;
    margin-bottom: 15px;
}

.expand-btn {
    color: #C19A6B;
    text-decoration: none;
    font-size: 0.95rem;
    font-weight: 600;
    transition: 0.3s;
}

.expand-btn:hover {
    color: #dac9b8;
}
</style>
```

---

## Responsive Design Principles

### Mobile (< 768px)
- Single column layouts
- Full-screen hero sections
- Stacked cards
- Larger touch targets (48px minimum)
- Simplified navigation

### Tablet (768px - 1024px)
- 2-column grids
- Reduced padding (60px instead of 80px)
- Proportional text sizing

### Desktop (> 1024px)
- Full 3-column layouts
- Generous whitespace
- Optimal line lengths (max-width: 700px for text)

---

## Color Palette (Existing + Extensions)

| Use | Color | Hex | Note |
|-----|-------|-----|------|
| Primary Background | Dark | #1E1E1E | Primary dark background |
| Secondary Background | Light Gray | #F5F5F5 | Section separation |
| Accent | Gold | #C19A6B | Premium highlight |
| Text (Dark) | Dark Gray | #333 | High contrast |
| Text (Light) | Off-white | #ddd | On dark backgrounds |
| Border | Subtle Gold | rgba(193, 154, 107, 0.2) | Elegant separation |
| Eco Badge | Green | #4CAF50 | Sustainability indicator |
| Hover State | Lighter Gold | #dac9b8 | Interactive feedback |

---

## Typography

### Headings
```css
font-family: 'Inter', sans-serif;
font-weight: 700;
line-height: 1.2;
```

### Body Text
```css
font-family: 'Inter', sans-serif;
font-weight: 400;
line-height: 1.6;
font-size: 1rem;
```

### Story/Philosophy Text (Poetic sections)
```css
font-family: 'Georgia', serif;
font-weight: 400;
line-height: 1.8;
font-size: 1.05rem;
color: #555;
```

---

## Animation & Micro-interactions

### Hover Effects
- Cards: `translateY(-10px)` + shadow
- Links: Color transition (0.3s)
- Images: Subtle zoom (1.02x)

### Page Transitions
- Fade-in on scroll (using Intersection Observer)
- Smooth scroll-behavior

### Interactive Elements
- Expand/collapse material details
- Tab switching for material categories
- Image lightbox for portfolio

---

## Accessibility Considerations

1. **Color Contrast** — Gold text on dark background has sufficient contrast
2. **Images** — All images have descriptive alt text
3. **Typography** — Minimum 16px font on mobile
4. **Navigation** — Keyboard navigable links
5. **Forms** — Clear labels and error messages
6. **Skip Links** — Jump to main content

---

## Integration Points with Product Catalog

### From About Pages → Product Pages
- Artisan name → Link to "products by artisan" (future feature)
- Material name → Link to products using that material
- Category → Link to products in category

### From Product Pages → About Pages
- Product detail shows used materials → Link to material page
- Product detail shows artisan → Link to artisan profile
- "About our craft" → Link to about page

---

## Future Enhancements

1. **Timeline Feature** — Brand history timeline (founded year → milestones)
2. **Artisan Interviews** — Video testimonials from artisans
3. **Virtual Workshop Tour** — 360° photo gallery or video walkthrough
4. **Material Sourcing Map** — Interactive map showing supplier locations
5. **Sustainability Dashboard** — Visualize eco metrics
6. **Blog Integration** — Brand stories and tips
7. **Newsletter Signup** — In about section
