
function handleNavOverflow() {
    const navbar = document.querySelector(".navbar");
    const moreDropdown = document.querySelector(".more-dropdown");
    const moreMenu = document.getElementById("moreMenu");
    const navItems = [...document.querySelectorAll(".navbar .nav-menu .nav-item")];

    let navbarWidth = navbar.clientWidth;
    let usedSpace = moreDropdown.clientWidth;
    let itemsMoved = false;

    // Reset More Menu
    moreMenu.innerHTML = "";

    // Calculate space occupied by other navbar elements (logo, dropdowns, etc.)
    let otherElements = [...navbar.children].filter(el => !el.classList.contains("nav-menu"));
    otherElements.forEach(el => {
        usedSpace += el.getBoundingClientRect().width;
    });

    let availableSpace = navbarWidth - usedSpace;
    let totalWidth = 0;

    navItems.forEach((item, index) => {
        item.style.display = "inline-block"; // Reset visibility before recalculating
        totalWidth += item.offsetWidth;

        if (totalWidth > availableSpace) {
            itemsMoved = true;
            item.style.display = "none"; // Hide in main menu
            
            let clone = item.cloneNode(true);
            clone.style.display = "block";

            if (!moreMenu.querySelector(`[data-id="item-${index}"]`)) { 
                clone.dataset.id = `item-${index}`;
                moreMenu.appendChild(clone);
            }
        }
    });

    // Show/Hide "More" dropdown based on overflow
    moreDropdown.style.display = itemsMoved ? "block" : "none";

    // Ensure navbar does not exceed 100vw
    adjustNavbarWidth();
}

function adjustNavbarWidth() {
    const navbar = document.querySelector(".navbar");
    const moreDropdown = document.querySelector(".more-dropdown");

    // Ensure navbar doesn't exceed viewport width
    if (navbar.scrollWidth > window.innerWidth) {
        navbar.style.maxWidth = "100vw";
        navbar.style.overflow = "hidden"; // Prevent horizontal scroll
    } else {
        navbar.style.maxWidth = ""; // Reset if within bounds
        navbar.style.overflow = "";
    }

    // Handle sticky navbar effect when scrolling
    window.addEventListener("scroll", () => {
        if (window.scrollY > 100) {
            navbar.classList.add("sticky");
        } else {
            navbar.classList.remove("sticky");
        }
    });

    // Hide "More" dropdown if empty
    if (moreDropdown.querySelector(".dropdown-content").children.length === 0) {
        moreDropdown.style.display = "none";
    }
}


// Run on page load, resize, and any user interaction
document.addEventListener("DOMContentLoaded", handleNavOverflow);
window.addEventListener("resize", handleNavOverflow);
window.addEventListener("load", handleNavOverflow);
window.addEventListener("click", handleNavOverflow);
window.addEventListener("scroll", handleNavOverflow);


// Function to handle sticky navbar behavior
function handleStickyNavbar() {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 100) {
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }
}
handleStickyNavbar();
window.addEventListener("scroll", handleStickyNavbar);


// character limit
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".nav-item a").forEach(function(item) {
        let icon = item.querySelector("i");  // Get the <i> icon
        let textNode = item.childNodes[1];  // Get the text after the icon

        if (textNode && textNode.nodeType === 3) {  // Ensure it's a text node
            let text = textNode.nodeValue.trim();
            if (text.length > 10) {
                textNode.nodeValue = text.substring(0, 10) + "...";
            }
        }
    });
});








// 🌍 **Updated Country Dropdown Logic**
const countries = [
    { name: "India", code: "IN", flag: "https://flagcdn.com/w40/in.png" },
    { name: "UAE", code: "AE", flag: "https://flagcdn.com/w40/ae.png" },
    { name: "USA", code: "US", flag: "https://flagcdn.com/w40/us.png" }
];

document.querySelectorAll(".countryDropdown").forEach(dropdown => {
    const countryList = dropdown.querySelector(".countryList");
    const selectedCountry = dropdown.querySelector(".dropdown-button");

    countryList.innerHTML = ""; 

    countries.forEach(country => {
        let div = document.createElement("div");
        div.classList.add("dropdown-item");
        div.innerHTML = `<img src="${country.flag}" class="flag"> ${country.name}`;

        div.addEventListener("click", () => {
            selectedCountry.innerHTML = `<img src="${country.flag}" class="flag"> ▼`;
            countryList.classList.remove("show");

            sessionStorage.setItem(dropdown.id, country.name);
        });

        countryList.appendChild(div);
    });

    selectedCountry.addEventListener("click", (e) => {
        e.stopPropagation();
        countryList.classList.toggle("show");
    });

    document.addEventListener("click", (e) => {
        if (!dropdown.contains(e.target)) {
            countryList.classList.remove("show");
        }
    });

    const savedCountry = sessionStorage.getItem(dropdown.id);
    if (savedCountry) {
        const countryData = countries.find(c => c.name === savedCountry);
        if (countryData) {
            selectedCountry.innerHTML = `<img src="${countryData.flag}" class="flag"> ▼`;
        }
    }
});

// 🌐 **Language Dropdown Logic**
const languages = ["English", "Hindi", "Arabic", "French", "Spanish"];

document.querySelectorAll(".languageDropdown").forEach(dropdown => {
    const langList = dropdown.querySelector(".languageList");
    const selectedLang = dropdown.querySelector(".dropdown-button");

    langList.innerHTML = ""; 

    languages.forEach(lang => {
        let div = document.createElement("div");
        div.classList.add("dropdown-item");
        div.textContent = lang;

        div.addEventListener("click", () => {
            selectedLang.textContent = lang.substring(0, 3).toUpperCase() + " ▼";
            langList.classList.remove("show");

            sessionStorage.setItem(dropdown.id, lang);
        });

        langList.appendChild(div);
    });

    selectedLang.addEventListener("click", (e) => {
        e.stopPropagation();
        langList.classList.toggle("show");
    });

    document.addEventListener("click", (e) => {
        if (!dropdown.contains(e.target)) {
            langList.classList.remove("show");
        }
    });

    const savedLang = sessionStorage.getItem(dropdown.id);
    if (savedLang) {
        selectedLang.textContent = savedLang.substring(0, 3).toUpperCase() + " ▼";
    }
});

// 💰 **Currency Dropdown Logic**
const currencies = ["USD - United States Dollar", "INR - Indian Rupee", "AED - UAE Dirham", "EUR - Euro"];

document.querySelectorAll(".currencyDropdown").forEach(dropdown => {
    const currencyList = dropdown.querySelector(".currencyList");
    const selectedCurrency = dropdown.querySelector(".dropdown-button");

    currencyList.innerHTML = ""; 

    currencies.forEach(curr => {
        let div = document.createElement("div");
        div.classList.add("dropdown-item");
        div.textContent = curr;

        div.addEventListener("click", () => {
            let currencyCode = curr.match(/\b[A-Z]{3}\b/)[0];
            selectedCurrency.textContent = currencyCode + " ▼";
            currencyList.classList.remove("show");

            sessionStorage.setItem(dropdown.id, curr);
        });

        currencyList.appendChild(div);
    });

    selectedCurrency.addEventListener("click", (e) => {
        e.stopPropagation();
        currencyList.classList.toggle("show");
    });

    document.addEventListener("click", (e) => {
        if (!dropdown.contains(e.target)) {
            currencyList.classList.remove("show");
        }
    });

    const savedCurrency = sessionStorage.getItem(dropdown.id);
    if (savedCurrency) {
        let currencyCode = savedCurrency.match(/\b[A-Z]{3}\b/)[0];
        selectedCurrency.textContent = currencyCode + " ▼";
    }
});









// Airport Data
const airports = [
    { city: "Mumbai", country: "India", code: "BOM", airport: "Chhatrapati Shivaji International Airport" },
    { city: "New Delhi", country: "India", code: "DEL", airport: "Indira Gandhi International Airport" },
    { city: "Bangkok", country: "Thailand", code: "BKK", airport: "Suvarnabhumi Airport" },
    { city: "Dubai", country: "UAE", code: "DXB", airport: "Dubai International Airport" }
];

// Filter dropdown based on input
function filterOptions(inputId, dropdownId) {
    let input = document.getElementById(inputId).value.toLowerCase();
    let dropdown = document.getElementById(dropdownId);
    dropdown.innerHTML = ""; // Clear previous results

    if (input.length > 0) {
        let filtered = airports.filter(a => 
            a.city.toLowerCase().includes(input) || 
            a.code.toLowerCase().includes(input) ||
            a.airport.toLowerCase().includes(input)
        );

        filtered.forEach(a => {
            let option = document.createElement("div");
            option.classList.add("dropdown-item");
            option.innerHTML = `<b>${a.city}, ${a.country}</b> (${a.code})<br><small>${a.airport}</small>`;
            option.onclick = () => {
                document.getElementById(inputId).value = `${a.city}, ${a.country} (${a.code})`;
                dropdown.innerHTML = "";
            };
            dropdown.appendChild(option);
        });
    }
}

// Swap From & To Values (One Way)
function swapValues() {
    let fromInput = document.getElementById("from-input");
    let toInput = document.getElementById("to-input");
    [fromInput.value, toInput.value] = [toInput.value, fromInput.value];
}

// Swap From & To Values (Round Trip)
function swapValuesRT() {
    let fromInput = document.getElementById("from-input-rt");
    let toInput = document.getElementById("to-input-rt");
    [fromInput.value, toInput.value] = [toInput.value, fromInput.value];
}

// Toggle Sections
function switchTab(tabId) {
    document.getElementById('one-way').style.display = (tabId === 'one-way') ? 'block' : 'none';
    document.getElementById('round-trip').style.display = (tabId === 'round-trip') ? 'block' : 'none';
    document.getElementById('multi-city').style.display = (tabId === 'multi-city') ? 'block' : 'none';
}

// Add Multi-City Row
function addCity() {
    let container = document.getElementById('multi-city-container');
    let newRow = document.createElement("div");
    newRow.classList.add("multi-city-row");
    newRow.innerHTML = `<input type="text" placeholder="From" name="multi_from[]" required>
                        <input type="text" placeholder="To" name="multi_to[]" required>
                        <input type="date" name="multi_departure[]" required>`;
    container.appendChild(newRow);
}
