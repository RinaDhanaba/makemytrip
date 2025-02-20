
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

    navItems.forEach(item => {
        item.style.display = "inline-block"; // Reset visibility before recalculating
        totalWidth += item.offsetWidth;

        if (totalWidth > availableSpace) {
            itemsMoved = true;
            item.style.display = "none"; // Hide in main menu
            let clone = item.cloneNode(true);
            clone.style.display = "block";
            moreMenu.appendChild(clone); // Move to dropdown
        }
    });

    // Show/Hide "More" dropdown based on overflow
    moreDropdown.style.display = itemsMoved ? "block" : "none";

    // Ensure navbar does not exceed 100vw
    adjustNavbarWidth();
}

function adjustNavbarWidth() {
    const navbar = document.querySelector(".navbar");
    if (navbar.scrollWidth > window.innerWidth) {
        navbar.style.maxWidth = "100vw"; // Prevent horizontal scroll
    } else {
        navbar.style.maxWidth = ""; // Reset if within bounds
        navbar.style.overflow = "";
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





// Generic Dropdown Handler
document.querySelectorAll('.dropdown').forEach(dropdown => {
    const button = dropdown.querySelector('.dropdown-button');
    const content = dropdown.querySelector('.dropdown-content');
    
    button.addEventListener('click', () => content.classList.toggle('show'));
    document.addEventListener('click', (e) => {
        if (!dropdown.contains(e.target)) content.classList.remove('show');
    });
});







// Function to load saved selections from sessionStorage
function loadSavedSelections() {
    // Load Country
    if (sessionStorage.getItem("selectedCountry")) {
        document.querySelectorAll("#selectedCountry").forEach(el => {
            el.innerHTML = sessionStorage.getItem("selectedCountry");
        });
    }

    // Load Language
    if (sessionStorage.getItem("selectedLanguage")) {
        document.querySelectorAll("#selectedLanguage").forEach(el => {
            el.innerHTML = sessionStorage.getItem("selectedLanguage") + " ▼";
        });
    }

    // Load Currency
    if (sessionStorage.getItem("selectedCurrency")) {
        document.querySelectorAll("#selectedCurrency").forEach(el => {
            el.innerHTML = sessionStorage.getItem("selectedCurrency") + " ▼";
        });
    }
}

// Function to update selections and store them in sessionStorage
function updateSelection(type, value) {
    sessionStorage.setItem(type, value);
    document.querySelectorAll(`#${type}`).forEach(el => {
        el.innerHTML = value + " ▼";
    });
}

// Currency Search Functionality
document.getElementById("searchCurrency")?.addEventListener("input", (e) => {
    const filter = e.target.value.toLowerCase();
    document.querySelectorAll(".currency-item").forEach(item => {
        item.style.display = item.innerText.toLowerCase().includes(filter) ? "" : "none";
    });
});

// Update Dropdown Selection & Store in Session
document.querySelectorAll(".currency-item, [data-lang]").forEach(item => {
    item.addEventListener("click", () => {
        const type = item.closest('.dropdown').querySelector('.dropdown-button').id;
        updateSelection(type, item.innerHTML);
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
        const countryHTML = `<img src="${country.flag}" class="flag"> ${country.name}`;
        updateSelection("selectedCountry", countryHTML);
        countryList.classList.remove("show");
    });
    countryList.appendChild(div);
});

// Load saved selections on page load
window.addEventListener("load", loadSavedSelections);








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
