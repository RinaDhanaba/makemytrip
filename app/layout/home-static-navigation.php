<!-- Responsive Navigation Bar -->
<nav class="navbar">
    <div class="navbar_inner">
    <!-- <img src="../media/mmt_dt_top_icon.avif" alt="logo" style="max-width: 200px;filter: drop-shadow(1px 1px 0.2px #333);"> -->
    <div class="logo">Beimond Travels</div>

    <ul class="nav-menu">
        <?php foreach ($menu_items as $item => $data): ?>
            <li class="nav-item"><a href="<?= $data['link'] ?>"><i class="<?= $data['icon'] ?>"></i> <?= $item ?></a></li>
        <?php endforeach; ?>
        <li class="more-dropdown hidden">
            <div class="dropdown">
                <div class="dropdown-button">More ▼</div>
                <div class="dropdown-content" id="moreMenu"></div>
            </div>
        </li>
    </ul>

    <div style="display:flex;gap:7px; flex-wrap:wrap;align-content: center;align-items: center; flex-wrap: nowrap;" class="dropdown-nav-container">
    <div style="font-size:12px; text-align:center;">Login/ <br>Create account</div>

    <!-- Country Dropdown -->

    <?php
        $countries = [
            ["name" => "India", "code" => "in", "flag" => "https://flagcdn.com/w40/in.png"],
            ["name" => "UAE", "code" => "ae", "flag" => "https://flagcdn.com/w40/ae.png"],
            ["name" => "USA", "code" => "us", "flag" => "https://flagcdn.com/w40/us.png"]
        ];
        ?>

        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const countries = <?php echo json_encode($countries); ?>;
            
            function updateCountrySelection(dropdown, country) {
                const button = dropdown.querySelector(".dropdown-button");
                button.innerHTML = `<img src="${country.flag}" class="flag"> ${country.name} ▼`;
                sessionStorage.setItem(dropdown.id, JSON.stringify(country)); 
            }

            document.querySelectorAll(".countryDropdown").forEach(dropdown => {
                const countryList = dropdown.querySelector(".dropdown-content");
                const button = dropdown.querySelector(".dropdown-button");

                countries.forEach(country => {
                    const div = document.createElement("div");
                    div.classList.add("dropdown-item");
                    div.innerHTML = `<img src="${country.flag}" class="flag"> ${country.name}`;
                    div.addEventListener("click", (e) => {
                        e.stopPropagation();
                        updateCountrySelection(dropdown, country);
                        countryList.classList.remove("show");
                    });
                    countryList.appendChild(div);
                });

                button.addEventListener("click", (e) => {
                    e.stopPropagation();
                    document.querySelectorAll(".dropdown-content").forEach(list => list.classList.remove("show"));
                    countryList.classList.toggle("show");
                });

                // Restore selection from sessionStorage
                const saved = sessionStorage.getItem(dropdown.id);
                if (saved) {
                    updateCountrySelection(dropdown, JSON.parse(saved));
                }
            });

            document.addEventListener("click", () => {
                document.querySelectorAll(".dropdown-content").forEach(list => list.classList.remove("show"));
            });
        });
        </script>


    <div class="dropdown countryDropdown">
    <div class="dropdown-button" id="selectedCountry">
        <img src="https://flagcdn.com/w40/in.png" class="flag"> ▼
    </div>
    <div class="dropdown-content"></div>
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

    </div>
</nav>