

<?php
// Define the navigation items in an array with icons
$menu_items = [
    "Flights" => ["link" => "#", "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-airplane-engines' viewBox='0 0 16 16'><path d='M2 1.5a1.5 1.5 0 0 1 1.5-1.5h9A1.5 1.5 0 0 1 14 1.5v13a1.5 1.5 0 0 1-1.5 1.5H3.5A1.5 1.5 0 0 1 2 14.5V1.5z'/></svg>"],
    "Hotels" => ["link" => "#", "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-house-door' viewBox='0 0 16 16'><path d='M8 3.293l3.5 3.5V12a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V6.793L8 3.293zM7.5 1a1 1 0 0 0-1 1v1h2V2a1 1 0 0 0-1-1H7.5zM2 7.5v6a.5.5 0 0 1 .5.5h11a.5.5 0 0 1 .5-.5v-6l-5.5-5.5a.5.5 0 0 0-.707 0L2 7.5z'/></svg>"],
    "Homestays" => ["link" => "#", "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-house' viewBox='0 0 16 16'><path d='M8 3.293l3.5 3.5V12a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V6.793L8 3.293zM7.5 1a1 1 0 0 0-1 1v1h2V2a1 1 0 0 0-1-1H7.5zM2 7.5v6a.5.5 0 0 1 .5.5h11a.5.5 0 0 1 .5-.5v-6l-5.5-5.5a.5.5 0 0 0-.707 0L2 7.5z'/></svg>"],
    "Trains" => ["link" => "#", "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-train' viewBox='0 0 16 16'><path d='M11 1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z'/></svg>"],
    "Buses" => ["link" => "#", "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-bus-front' viewBox='0 0 16 16'><path d='M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2zm9 1H4v10h8V3z'/></svg>"],
    "Cabs" => ["link" => "#", "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-car-front' viewBox='0 0 16 16'><path d='M11 4H5a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h1V9h8v3h1a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zM5 5h6v6H5V5z'/></svg>"],
    "Forex Cards" => ["link" => "#", "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-cash' viewBox='0 0 16 16'><path d='M6 3v4H3V2a1 1 0 0 1 1-1h9a1 1 0 0 1 1 1v4h-3V3H6zM5 9v2H3V8a1 1 0 0 1 1-1h9a1 1 0 0 1 1 1v3h-3V9H5z'/></svg>"],
    "Travel Insurance" => ["link" => "#", "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-shield-lock' viewBox='0 0 16 16'><path d='M8 0a1 1 0 0 1 1 1v7.5a2.5 2.5 0 0 1 0 5v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2a2.5 2.5 0 0 1 0-5V1a1 1 0 0 1 1-1z'/></svg>"],
    "More" => ["link" => "#", "icon" => "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-list' viewBox='0 0 16 16'><path d='M3 2h10a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1zM3 7h10a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1zM3 12h10a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1z'/></svg>"]
];
?>

<!-- Include the Home static navigation -->
<?php include('/layout/home-static-navigation.php'); ?>