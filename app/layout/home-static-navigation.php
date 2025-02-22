<!-- Responsive Navigation Bar -->
<nav class="navbar">
    <div class="navbar_inner">
    <div class="flex flex-row gap-3">
    <!-- <img src="../media/mmt_dt_top_icon.avif" alt="logo" style="max-width: 200px;filter: drop-shadow(1px 1px 0.2px #333);"> -->
    <div class="logo">Beimond Travels</div>

    <ul class="nav-menu">
        <?php 
        $current_page = basename($_SERVER['REQUEST_URI']); // Get the current page
        foreach ($menu_items as $item => $data): 
            $active_class = ($current_page == basename($data['link'])) ? 'active' : ''; 
        ?>
            <li class="nav-item <?= $active_class ?>"><a href="<?= $data['link'] ?>"><i class="<?= $data['icon'] ?>"></i> <?= $item ?></a></li>
        <?php endforeach; ?>
        <li class="more-dropdown hidden m-0">
            <div class="dropdown">
                <div class="dropdown-button">More ▼</div>
                <div class="dropdown-content" id="moreMenu"></div>
            </div>
        </li>
    </ul>
    </div>

    <div class="flex gap-1 flex-row justify-content-center admin-controls">
    <div style="font-size:12px; text-align:center;">Login/ <br>Create account</div>

    <!-- Country Dropdown -->
    <?php 
$countries = [
    "IN" => ["name" => "India", "flag" => "https://flagcdn.com/w40/in.png"],
    "AE" => ["name" => "UAE", "flag" => "https://flagcdn.com/w40/ae.png"],
    "US" => ["name" => "USA", "flag" => "https://flagcdn.com/w40/us.png"]
];

// Default Selected Country
$defaultCountry = $countries["IN"];
?>

<div class="generic-dropdown countryDropdown">
    <div class="dropdown-button" id="selectedCountry">
       <img src="<?= $defaultCountry['flag'] ?>" class="flag"> ▼
    </div>
    <div class="dropdown-content" id="countryList">
        <?php foreach ($countries as $code => $country): ?>
            <div class="country-item" data-code="<?= $code ?>" data-name="<?= $country['name'] ?>" data-flag="<?= $country['flag'] ?>">
                <img src="<?= $country['flag'] ?>" class="flag"> <?= $country['name'] ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

    <!-- Language Dropdown -->
    <div class="generic-dropdown" id="languageDropdown">
        <div class="dropdown-button" id="selectedLanguage">ENG ▼</div>
        <div class="dropdown-content">
            <div data-lang="en">English</div>
            <div data-lang="hi">हिंदी</div>
            <div data-lang="ta">தமிழ்</div>
        </div>
    </div>

    <!-- Currency Dropdown -->
    <div class="generic-dropdown" id="currencyDropdown">
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

    </div>
</nav>