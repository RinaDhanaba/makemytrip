<!-- Responsive Navigation Bar -->
<nav class="navbar">
    <img src="../media/mmt_dt_top_icon.avif" alt="logo" style="max-width: 200px;filter: drop-shadow(1px 1px 0.2px #333);">

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

    <div style="display:flex;gap: 20px; flex-wrap:wrap;align-content: center;align-items: center;">
    <div>Login/ Create account</div>

    <!-- Country Dropdown -->
    <div class="dropdown" id="countryDropdown">
        <div class="dropdown-button" id="selectedCountry">
            <img src="https://flagcdn.com/w40/in.png" class="flag"> India
        </div>
        <div class="dropdown-content" id="countryList"></div>
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





<script>
document.addEventListener("DOMContentLoaded", () => {
    const navContainer = document.querySelector(".nav-container");
    const navMenu = document.querySelector(".nav-menu");
    const moreDropdown = document.querySelector(".more-dropdown");
    const moreMenu = document.getElementById("moreMenu");

    function checkOverflow() {
        let moreShown = false;
        let availableSpace = navContainer.clientWidth - moreDropdown.clientWidth;

        // Reset: Move items back to nav-menu
        moreMenu.innerHTML = "";
        document.querySelectorAll(".nav-item").forEach(item => item.style.display = "inline-block");

        let totalWidth = 0;
        document.querySelectorAll(".nav-item").forEach(item => {
            totalWidth += item.offsetWidth;
            if (totalWidth > availableSpace) {
                moreShown = true;
                moreMenu.appendChild(item.cloneNode(true));
                item.style.display = "none";
            }
        });

        // Show/Hide "More" dropdown based on actual overflow
        moreDropdown.style.display = moreShown ? "inline-block" : "none";
    }

    window.addEventListener("resize", checkOverflow);
    checkOverflow();
});
</script>




<script>
    // Generic Dropdown Handler
    document.querySelectorAll('.dropdown').forEach(dropdown => {
        const button = dropdown.querySelector('.dropdown-button');
        const content = dropdown.querySelector('.dropdown-content');
        
        button.addEventListener('click', () => content.classList.toggle('show'));
        document.addEventListener('click', (e) => {
            if (!dropdown.contains(e.target)) content.classList.remove('show');
        });
    });

    // Currency Search Functionality
    document.getElementById("searchCurrency")?.addEventListener("input", (e) => {
        const filter = e.target.value.toLowerCase();
        document.querySelectorAll(".currency-item").forEach(item => {
            item.style.display = item.innerText.toLowerCase().includes(filter) ? "" : "none";
        });
    });

    // Update Dropdown Selection
    document.querySelectorAll(".currency-item, [data-lang]").forEach(item => {
        item.addEventListener("click", () => {
            item.closest('.dropdown').querySelector('.dropdown-button').innerHTML = item.innerHTML + " ▼";
            item.closest('.dropdown-content').classList.remove('show');
        });
    });

    // Country Dropdown Population
    const countries = [
        { name: "India", code: "in", flag: "https://flagcdn.com/w40/in.png" },
        { name: "UAE", code: "ae", flag: "https://flagcdn.com/w40/ae.png" },
        { name: "USA", code: "us", flag: "https://flagcdn.com/w40/us.png" }
    ];
    const countryList = document.getElementById("countryList");
    countries.forEach(country => {
        let div = document.createElement("div");
        div.innerHTML = `<img src="${country.flag}" class="flag"> ${country.name}`;
        div.addEventListener("click", () => {
            document.getElementById("selectedCountry").innerHTML = `<img src="${country.flag}" class="flag"> ${country.name}`;
            countryList.classList.remove("show");
        });
        countryList.appendChild(div);
    });
</script>

<style>
    .navbar {
        display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 5px;
    overflow: hidden;
    white-space: nowrap;
    }
    ul { list-style: none; display: flex; margin: 0; padding: 0; }
    li { margin: 0 15px; }
    a {text-decoration: none; font-size: 16px; display: flex; align-items: center; }
    a:hover { color: #ddd; }

    /* More Dropdown */
    .more-dropdown {
        display: none;
    }

    /* Dropdowns */
    .dropdown { position: relative; display: inline-block; cursor: pointer; }
    .dropdown-button { padding: 10px; border: 1px solid #ccc; background: white; display: flex; align-items: center; gap: 10px; cursor: pointer; }
    .dropdown-content {
        display: none; position: absolute;right: 0;background: white; border: 1px solid #ccc;
        min-width: 200px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); z-index: 1;
    }
    .dropdown-content div {
        padding: 10px; display: flex; align-items: center; gap: 10px; cursor: pointer;
    }
    .dropdown-content div:hover { background: #f1f1f1; }
    .flag { width: 20px; height: 14px; }
    .search-box { width: 100%; padding: 8px; border: 1px solid #ccc; margin-bottom: 8px; }

    /* Currency */
    .currency-group { font-weight: bold; padding: 5px 0; color: #666; border-bottom: 1px solid #ddd; margin-top: 5px; }
    .currency-item { padding: 8px 12px; cursor: pointer; display: flex; justify-content: space-between; }
    .currency-item:hover { background: #f1f1f1; }

    /* Show dropdown */
    .show { display: block; }

    /* Responsive */
    @media screen and (max-width: 768px) {
        .navbar { flex-direction: column; }
        ul { flex-direction: column; align-items: center; width: 100%; }
        li { margin: 10px 0; }
    }


    /* Responsive */
    @media screen and (max-width: 768px) {
    .navbar {
        flex-direction: column;
    }

    .nav-container {
        width: 100%;
        overflow-x: auto;
    }

    .nav-menu {
        flex-direction: row;
        justify-content: flex-start;
        flex-wrap: nowrap;
    }

    .nav-actions {
        flex-wrap: wrap;
        align-content: center;
        align-items: center;
        gap: 20px;
    }

    .more-dropdown {
        display: block;
    }
}
</style>
