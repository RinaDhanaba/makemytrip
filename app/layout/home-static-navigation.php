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
    const navbar = document.querySelector(".navbar");
    const navMenu = document.querySelector(".nav-menu");
    const moreDropdown = document.querySelector(".more-dropdown");
    const moreMenu = document.getElementById("moreMenu");
    const navItems = [...document.querySelectorAll(".nav-item")];

    function checkOverflow() {
        let navbarWidth = navbar.clientWidth;
        let usedSpace = moreDropdown.clientWidth;
        let itemsMoved = false;

        // Reset More Menu
        moreMenu.innerHTML = "";

        // Calculate space used by non-nav elements
        let otherElements = [...navbar.children].filter(el => !el.classList.contains("nav-menu"));
        otherElements.forEach(el => {
            usedSpace += el.clientWidth; 
        });

        let availableSpace = navbarWidth - usedSpace - 1;
        let totalWidth = 0;

        // Move overflowing items to "More" dropdown
        navItems.forEach(item => {
            item.style.display = "inline-block";
            totalWidth += item.offsetWidth;

            if (totalWidth > availableSpace) {
                itemsMoved = true;
                item.style.display = "none";
                let clone = item.cloneNode(true);
                clone.style.display = "block";
                moreMenu.appendChild(clone);
            }
        });

        // Show/Hide "More" dropdown
        moreDropdown.style.display = itemsMoved ? "block" : "none";
    }

    function handleStickyNavbar() {
        if (window.scrollY > 100) {
            navbar.classList.add("sticky");
        } else {
            navbar.classList.remove("sticky");
        }
    }

    // Run functions on load & events
    window.addEventListener("resize", checkOverflow);
    window.addEventListener("scroll", handleStickyNavbar);
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
    display: none;
    width: 100%;
    z-index: 1000;
}

/* Sticky effect when scrolled past 100px */
.navbar.sticky {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background: white;
}

    .navbar.sticky {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 5px;
    white-space: nowrap;
    }
    nav ul { list-style: none; display: flex; margin: 0; padding: 0; }
    nav li { margin: 0 15px; }
    nav a {text-decoration: none; font-size: 16px; display: flex; align-items: center; }
    nav a:hover { color: #ddd; }

    /* More Dropdown */
    .more-dropdown {
        display: none;
    }

    /* Dropdowns */
    nav .dropdown { position: relative; display: inline-block; cursor: pointer; }
    nav .dropdown-button { padding: 10px; border: 1px solid #ccc; background: white; display: flex; align-items: center; gap: 10px; cursor: pointer; }
    nav .dropdown-content {
        display: none; position: absolute;right: 0;background: white; border: 1px solid #ccc;
        min-width: 200px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); z-index: 1;
    }
    nav .dropdown-content div {
        padding: 10px; display: flex; align-items: center; gap: 10px; cursor: pointer;
    }
    nav .dropdown-content div:hover { background: #f1f1f1; }
    nav .flag { width: 20px; height: 14px; }
    nav .search-box { width: 100%; padding: 8px; border: 1px solid #ccc; margin-bottom: 8px; }

    /* Currency */
    nav .currency-group { font-weight: bold; padding: 5px 0; color: #666; border-bottom: 1px solid #ddd; margin-top: 5px; }
    nav .currency-item { padding: 8px 12px; cursor: pointer; display: flex; justify-content: space-between; }
    nav .currency-item:hover { background: #f1f1f1; }

    /* Show dropdown */
    nav .show { display: block; }

    /* Responsive */
    @media screen and (max-width: 768px) {
        .navbar { flex-direction: column; }
        nav ul { flex-direction: column; align-items: center; width: 100%; }
        nav li { margin: 10px 0; }
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

    nav .more-dropdown {
        display: block;
    }
}
</style>
