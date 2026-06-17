<?php

/**
 * WhatsApp Configuration
 * 
 * Configuration for WhatsApp Business API integration
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Business WhatsApp Number
    |--------------------------------------------------------------------------
    |
    | The default WhatsApp number for the business.
    | Format: International format without + or spaces (e.g., 62895321683364)
    | Can be overridden per product in the database (whatsapp_phone column)
    |
    */
    'business_phone' => env('WHATSAPP_BUSINESS_PHONE', '62895321683364'),

    /*
    |--------------------------------------------------------------------------
    | Message Template
    |--------------------------------------------------------------------------
    |
    | Default template for inquiry messages.
    | Can include placeholders: {product_name}, {price}, {size}, {color}
    |
    */
    'message_template' => env(
        'WHATSAPP_MESSAGE_TEMPLATE',
        "Halo! Saya tertarik dengan produk ini:\n\n*{product_name}*\nHarga: Rp {price}\n\nApakah stoknya masih tersedia?"
    ),

    /*
    |--------------------------------------------------------------------------
    | Enable WhatsApp Integration
    |--------------------------------------------------------------------------
    |
    | Set to false to disable WhatsApp CTA functionality
    |
    */
    'enabled' => env('WHATSAPP_ENABLED', true),
];
