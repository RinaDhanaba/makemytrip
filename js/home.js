
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

        let availableSpace = navbarWidth - usedSpace;
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
