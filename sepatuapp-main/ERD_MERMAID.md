```mermaid
erDiagram
    USERS {
        int id PK
        string name
        string email UNIQUE
        datetime email_verified_at
        string password
        string remember_token
        timestamp created_at
        timestamp updated_at
    }

    CATEGORIES {
        int id PK
        string name
        string slug UNIQUE
        text description
        timestamp created_at
        timestamp updated_at
    }

    PRODUCTS {
        int id PK
        string name
        text description
        decimal price(10,2)
        string image
        int category_id FK
        int stock
        timestamp created_at
        timestamp updated_at
    }

    CATEGORIES ||--o{ PRODUCTS : "has many"
    PRODUCTS }o--|| CATEGORIES : "belongs to"

```

Catatan:
- Diagram di atas dihasilkan dari model dan migration yang ditemukan pada repository (app/Models dan database/migrations).
- Jika Anda ingin diagram yang lebih lengkap (mis. tabel jurnal, master data), jalankan `php artisan make:model` atau tambahkan model/migration yang relevan ke repo lalu jalankan ulang proses ini.
