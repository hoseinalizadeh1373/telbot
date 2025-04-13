<?php
function xlsxToCsv($xlsxFile, $csvFile) {
    $zip = new ZipArchive;

    if ($zip->open($xlsxFile) === TRUE) {
        $xml = $zip->getFromName('xl/sharedStrings.xml');
        $zip->close();

        if ($xml === false) {
            return "⛔ خطا در خواندن فایل!";
        }

        // تبدیل XML به CSV
        $xmlObject = simplexml_load_string($xml);
        $strings = [];
        foreach ($xmlObject->si as $item) {
            $strings[] = (string) $item->t;
        }

        // ذخیره در فایل CSV
        file_put_contents($csvFile, implode("\n", $strings));
        return true;
    } else {
        return "⛔ خطا در باز کردن فایل!";
    }
}

// ** اجرای تابع و نمایش اطلاعات **
$xlsxFile = "test.xlsx"; // مسیر فایل را درست بده
$csvFile = "test.csv";

if (xlsxToCsv($xlsxFile, $csvFile) === true) {
    echo "✅ فایل تبدیل شد! حالا می‌تونی test.csv رو بخونی!";
} else {
    echo "⛔ خطا در پردازش فایل!";
}
