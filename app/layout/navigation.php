

<?php
// Define the navigation items in an array with icon classes
$menu_items = [
    "Flights" => ["link" => "#", "icon" => "bi bi-airplane-engines"],
    "Hotels" => ["link" => "#", "icon" => "bi bi-house-door"],
    "Holiday Package" => ["link" => "#", "icon" => "bi bi-car-front"],
    "Cabs/Car Rental " => ["link" => "#", "icon" => "bi bi-car-front"],
    "Visa Assistance" => ["link" => "#", "icon" => "bi bi-cash"],
    "Travel Insurance" => ["link" => "#", "icon" => "bi bi-shield-lock"]
];
?>

<header>

<!-- Include the Home static navigation -->
<?php include('../layout/home-static-navigation.php'); ?>


<!-- top navbar  -->
<nav class="top-navbar">
    <img src="../media/mmt_dt_top_icon.avif" alt="logo" style="max-width: 200px;filter: drop-shadow(1px 1px 0.2px #333);">

<div class="nav-div-item"><p>List Your Property</p> <p class="small_text">Grow your business!</p></div>
<div class="nav-div-item"><p>Introducing myBiz</p> <p class="small_text">Business Travel Solution</p></div>
<div class="nav-div-item"><p>My Trips</p> <p class="small_text">Manage your bookings</p></div>


    <div style="display:flex;gap: 20px; flex-wrap:wrap;align-content: center;align-items: center;">
    <div style="color: #fff; font-size: 12px; background-image: linear-gradient(93deg, #53b2fe, #065af3);
    padding: 10px; border-radius: 4px;">Login/ Create account</div>

    <!-- Country Dropdown -->
    <div class="dropdown countryDropdown">
        <div class="dropdown-button" id="selectedCountry">
            <img src="https://flagcdn.com/w40/in.png" class="flag"> ▼
        </div>
        <div class="dropdown-content countryList"></div>
    </div>

    <!-- Language Dropdown -->
    <div class="dropdown" id="languageDropdown">
        <div class="dropdown-button" id="selectedLanguage">ENG ▼</div>
        <div class="dropdown-content">
            <div data-lang="en">English</div>
            <div data-lang="hi">हिंदी</div>
            <div data-lang="ta">தமிழ்</div>
        </div>
    </div>

    <!-- Currency Dropdown -->
    <div class="dropdown" id="currencyDropdown">
        <div class="dropdown-button" id="selectedCurrency">INR ▼</div>
        <div class="dropdown-content">
            <input type="text" class="search-box" id="searchCurrency" placeholder="Search Currency">
            <div class="currency-group">POPULAR CURRENCIES</div>
            <?php 
            $currencies = [
                "INR" => "Indian Rupee", "AED" => "UAE Dirham", "USD" => "US Dollar",
                "GBP" => "British Pound", "SGD" => "Singapore Dollar", "EUR" => "Euro",
                "THB" => "Thai Baht", "CAD" => "Canadian Dollar", "RUB" => "Russian Ruble",
                "NZD" => "New Zealand Dollar", "KRW" => "Korean Won"
            ];
            foreach ($currencies as $code => $name): ?>
                <div class="currency-item" data-currency="<?= $code ?>"><?= $name ?> <strong><?= $code ?></strong></div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>
</nav>


<div class="nav-menu-home">
        <?php foreach ($menu_items as $item => $data): ?>
            <div class="nav-item-home"><a href="<?= $data['link'] ?>"><i class="<?= $data['icon'] ?>"></i> <?= $item ?></a></div>
        <?php endforeach; ?>
</div>

</header>
