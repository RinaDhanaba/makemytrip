<!-- Responsive Navigation Bar -->
<nav class="navbar">
<img src="../media/mmt_dt_top_icon.avif" alt="logo">
<ul>
    <?php foreach ($menu_items as $item => $data): ?>
        <li><a href="<?= $data['link'] ?>"><i class="<?= $data['icon'] ?>"></i> <?= $item ?></a></li>
    <?php endforeach; ?>
</ul>
<div>Login/ Create account</div>

<div class="dropdown">
    <div class="dropdown-button" id="selectedCountry">
        <img src="https://flagcdn.com/w40/in.png" class="flag"> India
    </div>
    <div class="dropdown-content" id="dropdownList"></div>
</div>


<div class="dropdown" id="languageDropdown">
    <div class="dropdown-button" id="selectedLanguage">ENG ▼</div>
    <div class="dropdown-content" id="dropdownList">
        <div data-lang="en">English</div>
        <div data-lang="hi">हिंदी</div>
        <div data-lang="ta">தமிழ்</div>
    </div>
</div>


<div class="dropdown" id="currencyDropdown">
    <div class="dropdown-button" id="selectedCurrency">INR ▼</div>
    <div class="dropdown-content" id="dropdownList">
        <input type="text" class="search-box" id="searchCurrency" placeholder="Search Currency">
        <div class="currency-group">POPULAR CURRENCIES</div>
        <div class="currency-item" data-currency="INR">Indian Rupee <strong>INR</strong></div>
        <div class="currency-item" data-currency="AED">United Arab Emirates Dirham <strong>AED</strong></div>
        <div class="currency-item" data-currency="USD">US Dollar <strong>USD</strong></div>
        <div class="currency-item" data-currency="GBP">Great Britain Pound <strong>GBP</strong></div>
        <div class="currency-item" data-currency="SGD">Singapore Dollar <strong>SGD</strong></div>
        <div class="currency-item" data-currency="EUR">Euro <strong>EUR</strong></div>
        
        <div class="currency-group">OTHER CURRENCIES</div>
        <div class="currency-item" data-currency="THB">Thai Baht <strong>THB</strong></div>
        <div class="currency-item" data-currency="CAD">Canadian Dollar <strong>CAD</strong></div>
        <div class="currency-item" data-currency="RUB">Russian Ruble <strong>RUB</strong></div>
        <div class="currency-item" data-currency="NZD">New Zealand Dollar <strong>NZD</strong></div>
        <div class="currency-item" data-currency="KRW">Korean Won <strong>KRW</strong></div>
    </div>
</div>

</nav>


<script>
    const dropdown = document.getElementById("currencyDropdown");
    const dropdownButton = document.getElementById("selectedCurrency");
    const dropdownList = document.getElementById("dropdownList");
    const searchBox = document.getElementById("searchCurrency");
    const currencyItems = document.querySelectorAll(".currency-item");

    dropdownButton.addEventListener("click", () => {
        dropdownList.classList.toggle("show");
    });

    currencyItems.forEach(item => {
        item.addEventListener("click", (event) => {
            dropdownButton.innerHTML = event.target.dataset.currency + " ▼";
            dropdownList.classList.remove("show");
        });
    });

    searchBox.addEventListener("input", (event) => {
        const filter = event.target.value.toLowerCase();
        currencyItems.forEach(item => {
            const text = item.innerText.toLowerCase();
            item.style.display = text.includes(filter) ? "" : "none";
        });
    });

    document.addEventListener("click", (event) => {
        if (!dropdown.contains(event.target)) {
            dropdownList.classList.remove("show");
        }
    });
</script>



<script>
    const dropdown = document.getElementById("languageDropdown");
    const dropdownButton = document.getElementById("selectedLanguage");
    const dropdownList = document.getElementById("dropdownList");

    dropdownButton.addEventListener("click", () => {
        dropdown.classList.toggle("show");
    });

    dropdownList.addEventListener("click", (event) => {
        if (event.target.dataset.lang) {
            dropdownButton.innerHTML = event.target.innerHTML + " ▼";
            dropdown.classList.remove("show");
        }
    });

    document.addEventListener("click", (event) => {
        if (!dropdown.contains(event.target)) {
            dropdown.classList.remove("show");
        }
    });
</script>
<script>
    const countries = [
        { name: "India", code: "in", flag: "https://flagcdn.com/w40/in.png" },
        { name: "UAE", code: "ae", flag: "https://flagcdn.com/w40/ae.png" },
        { name: "USA", code: "us", flag: "https://flagcdn.com/w40/us.png" }
    ];

    const dropdownButton = document.getElementById("selectedCountry");
    const dropdownList = document.getElementById("dropdownList");

    // Populate dropdown
    countries.forEach(country => {
        let div = document.createElement("div");
        div.innerHTML = `<img src="${country.flag}" class="flag"> ${country.name}`;
        div.onclick = () => {
            dropdownButton.innerHTML = `<img src="${country.flag}" class="flag"> ${country.name}`;
            dropdownList.style.display = "none";
        };
        dropdownList.appendChild(div);
    });

    // Toggle dropdown
    dropdownButton.addEventListener("click", () => {
        dropdownList.style.display = dropdownList.style.display === "block" ? "none" : "block";
    });

    // Hide dropdown when clicking outside
    document.addEventListener("click", (event) => {
        if (!dropdownButton.contains(event.target) && !dropdownList.contains(event.target)) {
            dropdownList.style.display = "none";
        }
    });
</script>


<style>

.navbar {
background-color: #333;
overflow: hidden;
display: flex;
justify-content: space-between;
padding: 10px 20px;
align-items: center;
}

.nav-links {
list-style: none;
display: flex;
margin: 0;
padding: 0;
}

.nav-links li {
margin: 0 15px;
}

.nav-links a {
color: white;
text-decoration: none;
font-size: 16px;
display: flex;
align-items: center;
}

.nav-links a svg {
margin-right: 8px; /* Space between icon and text */
}

.search input {
padding: 8px;
margin-right: 10px;
border: 1px solid #ccc;
}

.search button {
padding: 8px 12px;
background-color: #007BFF;
color: white;
border: none;
cursor: pointer;
}

/* Hover Effect */
.nav-links a:hover {
color: #ddd;
}

/* Media Query for Responsive Design */
@media screen and (max-width: 768px) {
.navbar {
flex-direction: column;
}

.nav-links {
flex-direction: column;
align-items: center;
width: 100%;
}

.nav-links li {
margin: 10px 0;
}

.search {
width: 100%;
text-align: center;
margin-top: 10px;
}
}







.dropdown {
position: relative;
display: inline-block;
cursor: pointer;
}
.dropdown-button {
padding: 10px;
border: 1px solid #ccc;
background-color: white;
display: flex;
align-items: center;
gap: 10px;
cursor: pointer;
}
.dropdown-content {
display: none;
position: absolute;
background-color: white;
border: 1px solid #ccc;
min-width: 100px;
box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
z-index: 1;
}
.dropdown-content div {
padding: 10px;
display: flex;
align-items: center;
gap: 10px;
cursor: pointer;
}
.dropdown-content div:hover {
background-color: #f1f1f1;
}
.flag {
width: 20px;
height: 14px;
}




.search-box {
width: 100%;
padding: 8px;
border: 1px solid #ccc;
margin-bottom: 8px;
}

.currency-group {
font-weight: bold;
padding: 5px 0;
color: #666;
border-bottom: 1px solid #ddd;
margin-top: 5px;
}

.currency-item {
padding: 8px 12px;
cursor: pointer;
display: flex;
justify-content: space-between;
}

.currency-item:hover {
background-color: #f1f1f1;
}

.show {
display: block;
}
</style>