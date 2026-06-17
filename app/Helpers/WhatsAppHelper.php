<?php

namespace App\Helpers;

/**
 * WhatsAppHelper
 * 
 * Utility class for generating WhatsApp API links with pre-filled messages.
 * Follows standardized format: https://wa.me/{phone_number}?text={encoded_message}
 */
class WhatsAppHelper
{
    /**
     * Generate WhatsApp link with pre-filled message for product inquiry
     * 
     * @param string $phoneNumber WhatsApp phone number (format: 62XXXXXXXXXX for Indonesia)
     * @param string $productName Product name
     * @param float $price Product price
     * @param array $selectedVariant Array with 'size' and 'color' keys
     * @return string WhatsApp API link
     */
    public static function generateProductInquiryLink(
        string $phoneNumber,
        string $productName,
        float $price,
        array $selectedVariant = []
    ): string
    {
        try {
            // Validate phone number (basic validation - should be numeric)
            if (!self::isValidPhoneNumber($phoneNumber)) {
                throw new \InvalidArgumentException('Invalid phone number format');
            }

            // Build message
            $message = self::buildProductMessage($productName, $price, $selectedVariant);

            // Encode message for URL
            $encodedMessage = urlencode($message);

            // Generate and return WhatsApp API link
            return "https://wa.me/{$phoneNumber}?text={$encodedMessage}";
        } catch (\Exception $e) {
            \Log::error('WhatsApp link generation failed', [
                'phone' => $phoneNumber,
                'product' => $productName,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Build formatted message for product inquiry
     * 
     * @param string $productName
     * @param float $price
     * @param array $selectedVariant ['size' => '42', 'color' => 'Original']
     * @return string Formatted message
     */
    private static function buildProductMessage(
        string $productName,
        float $price,
        array $selectedVariant
    ): string
    {
        $message = "Halo! Saya tertarik dengan produk ini:\n\n";
        $message .= "*{$productName}*\n";
        $message .= "Harga: Rp " . number_format($price, 0, ',', '.') . "\n";

        if (!empty($selectedVariant['size'])) {
            $message .= "Ukuran: {$selectedVariant['size']}\n";
        }

        if (!empty($selectedVariant['color'])) {
            $message .= "Warna/Tekstur: {$selectedVariant['color']}\n";
        }

        $message .= "\nApakah stoknya masih tersedia?";

        return $message;
    }

    /**
     * Validate phone number format
     * 
     * @param string $phoneNumber
     * @return bool
     */
    private static function isValidPhoneNumber(string $phoneNumber): bool
    {
        // Remove any non-numeric characters except leading +
        $cleaned = preg_replace('/[^0-9+]/', '', $phoneNumber);
        
        // Check if it's a valid format (at least 10 digits after country code)
        return preg_match('/^(\+)?[\d]{10,15}$/', $cleaned) === 1;
    }

    /**
     * Get WhatsApp phone number from configuration
     * Falls back to environment variable
     * 
     * @return string|null
     */
    public static function getBusinessPhoneNumber(): ?string
    {
        return config('whatsapp.business_phone') ?? null;
    }
}
