
function handleNavOverflow() {
    const navbar = document.querySelector(".navbar_inner"); // Use inner container instead of full navbar
    const moreDropdown = document.querySelector(".more-dropdown");
    const moreMenu = document.getElementById("moreMenu");
    const navItems = [...document.querySelectorAll(".navbar .nav-menu .nav-item")];

    let navbarWidth = navbar.clientWidth; // Container width
    let usedSpace = moreDropdown.clientWidth; // Start with "More" dropdown width
    let itemsMoved = false;

    // Reset More Menu
    moreMenu.innerHTML = "";

    // Calculate space used by elements other than the nav-menu
    let otherElements = [...navbar.children].filter(el => !el.classList.contains("nav-menu"));
    otherElements.forEach(el => {
        usedSpace += el.getBoundingClientRect().width;
    });

    let availableSpace = navbarWidth - usedSpace;
    let totalWidth = 0;

    navItems.forEach((item, index) => {
        item.style.display = "inline-block"; // Reset before recalculating
        totalWidth += item.offsetWidth;

        if (totalWidth > availableSpace) {
            itemsMoved = true;
            item.style.display = "none"; // Move to "More" dropdown

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

    // Ensure navbar does not exceed container width
    adjustNavbarWidth();
}

function adjustNavbarWidth() {
    const navbar = document.querySelector(".navbar_inner"); // Use inner container
    const moreDropdown = document.querySelector(".more-dropdown");

    // Ensure navbar stays within its container
    if (navbar.scrollWidth > navbar.clientWidth) {
        navbar.style.overflowX = "hidden"; // Prevent horizontal scroll
    } else {
        navbar.style.overflowX = "";
    }

    // Handle sticky navbar effect when scrolling
    window.addEventListener("scroll", () => {
        const mainNavbar = document.querySelector(".navbar");
        if (window.scrollY > 100) {
            mainNavbar.classList.add("sticky");
        } else {
            mainNavbar.classList.remove("sticky");
        }
    });

    // Hide "More" dropdown if empty
    if (moreDropdown.querySelector(".dropdown-content").children.length === 0) {
        moreDropdown.style.display = "none";
    }
}

// Run on page load, resize, and user interaction
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





// Generic Dropdown Handler (excluding country dropdowns)
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
    // Load Country (Only Flag)
    if (sessionStorage.getItem("selectedCountry")) {
        let tempDiv = document.createElement("div");
        tempDiv.innerHTML = sessionStorage.getItem("selectedCountry");
        let flagImg = tempDiv.querySelector("img") ? tempDiv.querySelector("img").outerHTML : sessionStorage.getItem("selectedCountry");

        document.querySelectorAll("#selectedCountry").forEach(el => {
            el.innerHTML = flagImg + " ▼"; // Only show flag
        });
    }

    // Load Language (First 3 Characters)
    if (sessionStorage.getItem("selectedLanguage")) {
        document.querySelectorAll("#selectedLanguage").forEach(el => {
            el.innerHTML = sessionStorage.getItem("selectedLanguage").substring(0, 3).toUpperCase() + " ▼";
        });
    }

    // Load Currency (Only 3-letter Code)
    if (sessionStorage.getItem("selectedCurrency")) {
        let storedCurrency = sessionStorage.getItem("selectedCurrency");
        let currencyCode = storedCurrency.match(/\b[A-Z]{3}\b/) ? storedCurrency.match(/\b[A-Z]{3}\b/)[0] : storedCurrency;

        document.querySelectorAll("#selectedCurrency").forEach(el => {
            el.innerHTML = currencyCode + " ▼"; // Show only currency code
        });
    }
}

// Function to update selections and store in sessionStorage
function updateSelection(type, value) {
    let formattedValue = value;

    if (type === "selectedCountry") {
        // Extract only the flag
        let tempDiv = document.createElement("div");
        tempDiv.innerHTML = value;
        let flagImg = tempDiv.querySelector("img") ? tempDiv.querySelector("img").outerHTML : value;
        formattedValue = flagImg; // Only show flag
    } 
    else if (type === "selectedLanguage") {
        formattedValue = value.substring(0, 3).toUpperCase(); // First 3 letters
    } 
    else if (type === "selectedCurrency") {
        // Extract only currency code
        formattedValue = value.match(/\b[A-Z]{3}\b/) ? value.match(/\b[A-Z]{3}\b/)[0] : value;
    }

    sessionStorage.setItem(type, value);
    document.querySelectorAll(`#${type}`).forEach(el => {
        el.innerHTML = formattedValue + " ▼";
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



document.addEventListener("DOMContentLoaded", function () {
    const selectedCountry = document.getElementById("selectedCountry");
    const countryList = document.getElementById("countryList");

    // Toggle dropdown on button click
    selectedCountry.addEventListener("click", (event) => {
        event.stopPropagation();
        countryList.classList.toggle("show");
    });

    // Handle country selection
    document.querySelectorAll(".country-item").forEach(item => {
        item.addEventListener("click", function () {
            const flag = this.getAttribute("data-flag");
            const name = this.getAttribute("data-name");
            
            // Update selected country display
            selectedCountry.innerHTML = `<img src="${flag}" class="flag"> ${name} ▼`;
            
            // Hide dropdown
            countryList.classList.remove("show");
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", () => {
        countryList.classList.remove("show");
    });
});


// Load saved selections on page load
window.addEventListener("load", loadSavedSelections);












const offers = [
    {
        image: "offer1.jpg",
        category: "cabs",
        title: "Your Outstation Cabs Made More Comfortable",
        description: "with New Features!",
        link: "#"
    },
    {
        image: "offer2.jpg",
        category: "cabs",
        title: "FOR MAHA KUMBH 2025: Book Airport Cabs",
        description: "with FLAT 5% OFF*.",
        link: "#"
    },
    {
        image: "offer3.jpg",
        category: "cabs",
        title: "FOR MAHA KUMBH 2025: Book Outstation Cabs",
        description: "with up to ₹500 OFF*.",
        link: "#"
    },
    {
        image: "offer4.jpg",
        category: "cabs",
        title: "Launched: EV Airport Cabs",
        description: "for Journeys to/from the Hyderabad Airport.",
        link: "#"
    }
];

function loadOffers(filter = "all") {
    const container = document.getElementById("offers-container");
    container.innerHTML = "";

    const filteredOffers = filter === "all" ? offers : offers.filter(offer => offer.category === filter);

    filteredOffers.forEach(offer => {
        const offerHTML = `
            <div class="offer-card">
                <img src="${offer.image}" alt="${offer.title}">
                <div class="offer-content">
                    <h3>${offer.title}</h3>
                    <p>${offer.description}</p>
                    <a href="${offer.link}" class="book-now">BOOK NOW</a>
                </div>
            </div>
        `;
        container.innerHTML += offerHTML;
    });
}

function showOffers(category) {
    document.querySelectorAll(".tab").forEach(tab => tab.classList.remove("active"));
    document.querySelector(`.tab[onclick="showOffers('${category}')"]`).classList.add("active");
    
    loadOffers(category);
}

// Load default offers on page load
document.addEventListener("DOMContentLoaded", () => {
    loadOffers("all");
});
