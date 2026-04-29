<?php
function br_format_rupiah($price) {
    return 'Rp ' . number_format($price, 0, ',', '.');
}

function br_whatsapp_message($bike_title){
    $message = urlencode("Hello, I would like to rent this bike:\n\nBike: " . $bike_title);
    return "https://wa.me/6281234567890?text=" . $message;
}