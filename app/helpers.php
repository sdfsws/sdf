<?php 


if (!function_exists('cleanDate')) {
    function cleanDate($dateString) {
        // إزالة الأحرف غير المرغوب فيها
        $cleaned = preg_replace('/\s+/', ' ', trim($dateString));
        
        // محاولة تحليل التاريخ والوقت
        try {
            $dateTime = new DateTime($cleaned);
            // الحصول على اسم اليوم، التاريخ، والوقت
            $dayName = $dateTime->format('l'); // اسم اليوم الكامل (مثل Monday)
            $formattedDate = $dateTime->format('Y-m-d H:i'); // تاريخ ووقت بصيغة معينة
            return $dayName . ' ' . $formattedDate;
        } catch (Exception $e) {
            // إذا فشل التحليل، إرجاع السلسلة كما هي
            return $cleaned;
        }
    }
    
    
}




if (!function_exists('cleanTime')) {
    function cleanTime($date) {
        // Extract the time portion (assumed to be in the format HH:MM at the start of the string)
        if (preg_match('/^\d{2}:\d{2}/', $date, $matches)) {
            return $matches[0];
        }
        return null; // Return null if no time is found
    }
}
