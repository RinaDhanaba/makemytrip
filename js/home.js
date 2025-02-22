// Function to handle the overflow of navigation items
function handleNavOverflow() {
  const navbar = document.querySelector(".navbar_inner_nav");
  const moreDropdown = document.querySelector(".more-dropdown");
  const moreMenu = document.getElementById("moreMenu");
  const navItems = [...document.querySelectorAll(".navbar .nav-menu .nav-item")];

  let navbarWidth = navbar.clientWidth;
  let usedSpace = moreDropdown.clientWidth;
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
      // Reset display in case it was hidden previously
      item.style.display = "inline-block";
      totalWidth += item.offsetWidth;

      if (totalWidth > availableSpace) {
          itemsMoved = true;
          // Hide item from main navbar
          item.style.display = "none";

          // Clone and display the item in the More dropdown
          let clone = item.cloneNode(true);
          clone.style.display = "block";

          if (!moreMenu.querySelector(`[data-id="item-${index}"]`)) {
              clone.dataset.id = `item-${index}`;
              moreMenu.appendChild(clone);
          }
      }
  });

  // Show/Hide "More" dropdown based on whether any items were moved
  moreDropdown.style.display = itemsMoved ? "block" : "none";

  // Hide More dropdown if there are no items to show
  if (moreMenu.children.length === 0) {
    moreDropdown.style.display = "none";
  }

  // Prevent horizontal scrolling if content overflows
  if (navbar.scrollWidth > navbar.clientWidth) {
      navbar.style.overflowX = "hidden";
  } else {
      navbar.style.overflowX = "";
  }
}

// Attach dropdown and sticky navbar event listeners once on DOM load
document.addEventListener("DOMContentLoaded", () => {
  const moreDropdown = document.querySelector(".more-dropdown");
  const dropdownContent = moreDropdown.querySelector('.dropdown-content-nav');
  const dropdownButton = moreDropdown.querySelector('.dropdown-button');
  
  // Toggle dropdown content when the dropdown button is clicked
  if (dropdownButton && dropdownContent) {
    dropdownButton.addEventListener('click', (e) => {
      e.stopPropagation();
      dropdownContent.classList.toggle('show');
    });
  }
  
  // Sticky navbar effect: attach listener once
  window.addEventListener("scroll", () => {
    const mainNavbar = document.querySelector(".navbar");
    if (window.scrollY > 100) {
      mainNavbar.classList.add("sticky");
    } else {
      mainNavbar.classList.remove("sticky");
    }
  });
  
  // Initial call to position nav items correctly
  handleNavOverflow();
});

// Attach handleNavOverflow on window events
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
document.querySelectorAll('.generic-dropdown').forEach(dropdown => {
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

    sessionStorage.setItem(type, formattedValue);
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
document.querySelectorAll(".country-item, .currency-item, [data-lang]").forEach(item => {
    item.addEventListener("click", (e) => {
        const dropdown = e.target.closest('.generic-dropdown');
        const button = dropdown.querySelector('.dropdown-button');
        const type = button.id;

        let value;

        if (item.classList.contains("country-item")) {
            // Extract only the flag image for country selection
            let flagImg = item.querySelector("img") ? item.querySelector("img").outerHTML : "";
            value = flagImg;
        } 
        else if (item.hasAttribute("data-lang")) {
            // Take the first 3 characters of the full language name and convert to uppercase
            value = item.innerText.substring(0, 3).toUpperCase();
        } 
        else if (item.hasAttribute("data-currency")) {
            // Extract currency code
            value = item.dataset.currency;
        } 
        else {
            value = item.innerHTML;
        }

        updateSelection(type, value);

        // Ensure only the selected dropdown updates
        button.innerHTML = value + " ▼";

        // Close the dropdown
        dropdown.querySelector('.dropdown-content').classList.remove('show');
    });
});




// Load saved selections on page load
window.addEventListener("DOMContentLoaded", loadSavedSelections);






$(document).ready(function() {
    // Airport list
    const airports = [
      { code: "BOM", city: "Mumbai",    country: "India", airport: "Chhatrapati Shivaji Intl Airport" },
      { code: "DEL", city: "Delhi",     country: "India", airport: "Indira Gandhi Intl Airport" },
      { code: "BLR", city: "Bengaluru", country: "India", airport: "Bengaluru Intl Airport" },
      { code: "HYD", city: "Hyderabad", country: "India", airport: "Rajiv Gandhi Intl Airport" },
      { code: "MAA", city: "Chennai",   country: "India", airport: "Chennai Intl Airport" }
    ];
  
    /************************
     * Auto-Select From/To  *
     ************************/
    $("#from .selected-value").text(`${airports[0].city}`);
    $("#from .sub-text").text(`${airports[0].airport} (${airports[0].code}), ${airports[0].country}`);
  
    const lastIndex = airports.length - 1;
    $("#to .selected-value").text(`${airports[lastIndex].city}`);
    $("#to .sub-text").text(`${airports[lastIndex].airport} (${airports[lastIndex].code}), ${airports[lastIndex].country}`);
  
    /************************
     *  Swap Functionality  *
     ************************/
    $("#swapBtn").click(function() {
      let fromVal = $("#from .selected-value").text();
      let fromSub = $("#from .sub-text").text();
      let toVal   = $("#to .selected-value").text();
      let toSub   = $("#to .sub-text").text();
  
      $("#from .selected-value").text(toVal);
      $("#from .sub-text").text(toSub);
      $("#to .selected-value").text(fromVal);
      $("#to .sub-text").text(fromSub);
    });
  
    /************************
     *  Airport Dropdowns   *
     ************************/
    $("#from, #to").click(function(e) {
      e.stopPropagation();
      let dropdownId = $(this).attr("id") + "Dropdown";
      // Hide other dropdowns in booking-container
      $(".booking-container .dropdown").not("#" + dropdownId).hide();
      populateDropdown(dropdownId);
      $("#" + dropdownId).toggle();
    });
  
    function populateDropdown(dropdownId) {
      let dropdownEl = $("#" + dropdownId);
      dropdownEl.empty();
      airports.forEach(airport => {
        dropdownEl.append(`
          <div class="dropdown-item" data-code="${airport.code}">
            <div class="selected-value">${airport.city}</div>
            <div class="sub-text">${airport.airport} (${airport.code}), ${airport.country}</div>
          </div>
        `);
      });
    }
  
    // Delegate click event for booking-container dropdown items
    $(".booking-container .dropdown").on("click", ".dropdown-item", function() {
      let parentBox = $(this).closest(".position-relative").find(".input-box");
      parentBox.find(".selected-value").text($(this).find(".selected-value").text());
      parentBox.find(".sub-text").text($(this).find(".sub-text").text());
      $(this).closest(".dropdown").hide();
    });
  
    // Hide booking dropdowns when clicking outside
    $(document).click(function(e) {
      if (!$(e.target).closest(".input-box, .booking-container .dropdown").length) {
        $(".booking-container .dropdown").hide();
      }
    });
  
    /************************
     *    Departure Date    *
     ************************/
    const departureFlatpickr = flatpickr("#departureDateInput", {
      dateFormat: "j M\\'y",
      minDate: "today",
      defaultDate: "today",
      clickOpens: false,
      position: "auto", // Ensures automatic positioning below the input
      appendTo: document.querySelector("#departureDate"),
      onReady: function(selectedDates, dateStr) {
        if (selectedDates.length) {
          const weekday = selectedDates[0].toLocaleDateString("en-US", { weekday: "long" });
          $("#departureDate .selected-value").text(dateStr);
          $("#departureDate .sub-text").text(weekday);
        }
      },
      onChange: function(selectedDates, dateStr) {
        if (selectedDates.length) {
          const weekday = selectedDates[0].toLocaleDateString("en-US", { weekday: "long" });
          $("#departureDate .selected-value").text(dateStr);
          $("#departureDate .sub-text").text(weekday);
        }
      }
    });
  
    $("#departureDate").on("click", function(e) {
      e.stopPropagation();
      departureFlatpickr.open();
    });
  
    /************************
     *     Return Date      *
     ************************/
    const returnFlatpickr = flatpickr("#returnDateInput", {
      dateFormat: "j M\\'y",
      minDate: "today",
      clickOpens: false,
      position: "auto", // Ensures automatic positioning below the input
      appendTo: document.querySelector("#returnDate"),
      onChange: function(selectedDates, dateStr) {
        if (dateStr) {
          if ($("#oneWay").is(":checked")) {
            $("#roundTrip").prop("checked", true);
          }
          const weekday = selectedDates[0].toLocaleDateString("en-US", { weekday: "long" });
          $("#returnDate .selected-value").text(dateStr);
          $("#returnDate .sub-text").text(weekday);
          $("#clearReturnDate").show();
        } else {
          if ($("#roundTrip").is(":checked")) {
            $("#oneWay").prop("checked", true);
          }
          $("#returnDate .selected-value").text("");
          $("#returnDate .sub-text").text("Tap to add a return date for bigger discounts");
          $("#clearReturnDate").hide();
        }
      }
    });
  
    $("#returnDate").on("click", function(e) {
      e.stopPropagation();
      returnFlatpickr.open();
    });
  
    $("#clearReturnDate").click(function(e) {
      e.stopPropagation();
      returnFlatpickr.clear();
    });
  
    $("#oneWay").on("click", function() {
      returnFlatpickr.clear();
    });
  
    /************************
     * Travellers & Class   *
     ************************/
    $("#travellers").click(function(e) {
      e.stopPropagation();
      $("#travellersDropdown").toggle();
    });
  
    $(document).click(function(e) {
      if (!$(e.target).closest("#travellersDropdown, #travellers").length) {
        $("#travellersDropdown").hide();
      }
    });
  
    $(".btn-option").click(function() {
      let category = $(this).data("category");
      $(`.btn-option[data-category='${category}']`).removeClass("selected");
      $(this).addClass("selected");
    });
  
    $("#applyTravellers").click(function() {
      let adults   = $("#adultsGroup .selected").data("value")   || 1;
      let children = $("#childrenGroup .selected").data("value") || 0;
      let infants  = $("#infantsGroup .selected").data("value")  || 0;
      let travelClass = $("#classGroup .selected").data("value") || "Economy";
  
      let totalTravellers = adults + children + infants;
      $("#travellers .selected-value").text(totalTravellers + " Traveller" + (totalTravellers > 1 ? "s" : ""));
      $("#travellers .sub-text").text(travelClass);
      $("#travellersDropdown").hide();
    });
  });
  








const offers = [
    {
        image: "../media/Desktop-CabFeature-13Dec.webp",
        category: "cabs",
        title: "Your Outstation Cabs Made More Comfortable",
        description: "with New Features!",
        link: "#"
    },
    {
        image: "../media/Desktop-CabFeature-13Dec.webp",
        category: "cabs",
        title: "FOR MAHA KUMBH 2025: Book Airport Cabs",
        description: "with FLAT 5% OFF*.",
        link: "#"
    },
    {
        image: "../media/Desktop-CabFeature-13Dec.webp",
        category: "cabs",
        title: "FOR MAHA KUMBH 2025: Book Outstation Cabs",
        description: "with up to ₹500 OFF*.",
        link: "#"
    },
    {
        image: "../media/Desktop-CabFeature-13Dec.webp",
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