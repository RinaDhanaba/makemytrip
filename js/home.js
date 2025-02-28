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
    const isMobile = window.matchMedia("(max-width: 768px)").matches;

    const departureFlatpickr = flatpickr("#departureDateInput", {
      dateFormat: "j M\\'y",
      minDate: "today",
      defaultDate: "today",
      clickOpens: false, 
      position: isMobile ? "auto" : "below", // Center picker on mobile
      appendTo: isMobile ? document.body : document.querySelector("#departureDate"), // Append to body only for mobile
      disableMobile: true, // Force Flatpickr UI instead of native mobile date picker

      onReady: function (selectedDates, dateStr) {
        updateDepartureDate(selectedDates, dateStr);
      },

      onChange: function (selectedDates, dateStr) {
        updateDepartureDate(selectedDates, dateStr);
      },

      onOpen: function () {
        if (isMobile) {
          document.body.classList.add("flatpickr-mobile-center");
        }
      },

      onClose: function () {
        if (isMobile) {
          document.body.classList.remove("flatpickr-mobile-center");
        }
      }
    });

    // Function to update the displayed date and weekday
    function updateDepartureDate(selectedDates, dateStr) {
      if (selectedDates.length) {
        const weekday = selectedDates[0].toLocaleDateString("en-US", { weekday: "long" });
        document.querySelector("#departureDate .selected-value").textContent = dateStr;
        document.querySelector("#departureDate .sub-text").textContent = weekday;
      }
    }

    // Manually open the date picker when clicking #departureDate
    document.querySelector("#departureDate").addEventListener("click", function (e) {
      e.stopPropagation();
      departureFlatpickr.open();
    });

    /************************
     *     Return Date      *
     ************************/
    // const isMobile = window.matchMedia("(max-width: 768px)").matches; // define above

    const returnFlatpickr = flatpickr("#returnDateInput", {
      dateFormat: "j M\\'y",
      minDate: "today",
      clickOpens: false,
      position: isMobile ? "auto" : "below", // Center Flatpickr only on mobile
      appendTo: isMobile ? document.body : document.querySelector("#returnDate"), // Append to body only on mobile
      disableMobile: true, // Force Flatpickr UI instead of native mobile picker

      onChange: function (selectedDates, dateStr) {
        updateReturnDate(selectedDates, dateStr);
      },

      onOpen: function () {
        if (isMobile) {
          document.body.classList.add("flatpickr-mobile-center");
        }
      },

      onClose: function () {
        if (isMobile) {
          document.body.classList.remove("flatpickr-mobile-center");
        }
      }
    });

    // Function to update the return date display
    function updateReturnDate(selectedDates, dateStr) {
      const returnDateEl = document.querySelector("#returnDate .selected-value");
      const returnSubTextEl = document.querySelector("#returnDate .sub-text");
      const clearReturnBtn = document.querySelector("#clearReturnDate");

      if (selectedDates.length) {
        if (document.querySelector("#oneWay").checked) {
          document.querySelector("#roundTrip").checked = true;
        }

        const weekday = selectedDates[0].toLocaleDateString("en-US", { weekday: "long" });
        returnDateEl.textContent = dateStr;
        returnSubTextEl.textContent = weekday;
        clearReturnBtn.style.display = "block"; // Show the clear button
      } else {
        if (document.querySelector("#roundTrip").checked) {
          document.querySelector("#oneWay").checked = true;
        }

        returnDateEl.textContent = "";
        returnSubTextEl.textContent = "Tap to add a return date for bigger discounts";
        clearReturnBtn.style.display = "none"; // Hide the clear button
      }
    }

    // Open Flatpickr when clicking #returnDate
    document.querySelector("#returnDate").addEventListener("click", function (e) {
      e.stopPropagation();
      returnFlatpickr.open();
    });

    // Clear the return date when clicking the clear button
    document.querySelector("#clearReturnDate").addEventListener("click", function (e) {
      e.stopPropagation();
      returnFlatpickr.clear();
    });

    // Clear the return date when "One Way" is selected
    document.querySelector("#oneWay").addEventListener("click", function () {
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







  function searchFlight() {
    // Get Trip Type (One Way / Round Trip)
    let tripType = document.querySelector('input[name="tripType"]:checked').id;
    // Get From Location
    let from = document.querySelector("#from .selected-value").innerText;
    // Get To Location
    let to = document.querySelector("#to .selected-value").innerText;
    // Get Departure Date
    let departure = document.querySelector("#departureDate .selected-value").innerText;
    // Get Return Date (If Available)
    let returnDate = document.querySelector("#returnDate .selected-value").innerText;
    // Get Travellers & Class
    let travellers = document.querySelector("#travellers .selected-value").innerText;
    let travelClass = document.querySelector("#travellers .sub-text").innerText;

    // Validation
    if (from === "Select Departure" || to === "Select Destination" || departure === "Select Date") {
        alert("Please fill all required fields.");
        return;
    }

    // Create Flight Data Object
    let flightData = {
        tripType: tripType,
        from: from,
        to: to,
        departure: departure,
        returnDate: returnDate || "N/A",
        travellers: travellers,
        class: travelClass,
    };

    // Store in Local Storage
    localStorage.setItem("flightData", JSON.stringify(flightData));

    // Store in Session Storage
    sessionStorage.setItem("flightData", JSON.stringify(flightData));

    window.location.href = "/flights-listing";
}

  








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