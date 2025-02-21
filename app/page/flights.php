<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Flight Search</title>

  <!-- Styles & Libraries -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <style>
    body {
      background-color: #f8f9fa;
    }
    .flight-card {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .input-box {
      cursor: pointer;
      padding: 10px;
      border-radius: 8px;
      background: #fff;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      position: relative; /* needed for clear (X) button positioning */
    }
    .dropdown, .dropdown-menu {
      display: none;
      position: absolute;
      background: #fff;
      width: 100%;
      border-radius: 8px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
      z-index: 1000;
    }
    .dropdown-item, .btn-option {
      cursor: pointer;
      padding: 8px 12px;
      margin: 4px 0;
      border-radius: 6px;
    }
    .dropdown-item:hover, .btn-option:hover {
      background: #f1f1f1;
    }
    .btn-option.selected {
      background: #007bff;
      color: white;
    }
    .btn-search {
      background-color: #007bff;
      color: #fff;
      border-radius: 20px;
      padding: 10px 20px;
      font-weight: bold;
      border: none;
      cursor: pointer;
    }
    .swap-btn {
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      color: #007bff;
    }
    #travellers {
      background: #f8f9fa;
      border-radius: 10px;
      padding: 12px;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      font-size: 18px;
      font-weight: bold;
    }
    #travellers .sub-text {
      font-size: 12px;
      color: gray;
      font-weight: normal;
    }
    /* Hidden inputs for flatpickr */
    #departureDateInput, #returnDateInput {
      display: none !important;
    }
    /* Clear (X) button for Return date */
    .clear-btn {
      position: absolute;
      right: 10px;
      top: 10px;
      background: transparent;
      border: none;
      font-size: 18px;
      color: #999;
      cursor: pointer;
      display: none; /* hidden by default, shown once a date is selected */
    }
    .clear-btn:hover {
      color: #000;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="flight-card">
    <!-- Top Row: Trip Types + Right-aligned text -->
    <div class="row g-3 align-items-center">
      <div class="col-md-6">
        <input type="radio" name="tripType" id="oneWay" checked>
        <label for="oneWay">One Way</label>
        <input type="radio" name="tripType" id="roundTrip">
        <label for="roundTrip">Round Trip</label>
      </div>
      <div class="col-md-6 text-end">
        <span style="font-size:14px; color:gray;">Book International and Domestic Flights</span>
      </div>
    </div>

    <hr>

    <!-- Fields: From → Swap → To → Departure → Return → Travellers & Class -->
    <div class="row g-3 align-items-center mt-1">
      <!-- From Location -->
      <div class="col-md-2 position-relative">
        <label>From</label>
        <div id="from" class="input-box">
          <div class="selected-value">Select Departure</div>
          <div class="sub-text">Airport will appear here</div>
        </div>
        <div class="dropdown" id="fromDropdown"></div>
      </div>

      <!-- Swap Button -->
      <div class="col-md-auto text-center">
        <button id="swapBtn" class="swap-btn">⇄</button>
      </div>

      <!-- To Location -->
      <div class="col-md-2 position-relative">
        <label>To</label>
        <div id="to" class="input-box">
          <div class="selected-value">Select Destination</div>
          <div class="sub-text">Airport will appear here</div>
        </div>
        <div class="dropdown" id="toDropdown"></div>
      </div>

      <!-- Departure Date (with default "today") -->
      <div class="col-md-2 position-relative">
        <label>Departure</label>
        <div id="departureDate" class="input-box">
          <div class="selected-value">Select Date</div>
          <div class="sub-text"></div>
        </div>
        <!-- Hidden input for Flatpickr -->
        <input type="hidden" id="departureDateInput">
      </div>

      <!-- Return Date + Clear Button -->
      <div class="col-md-2 position-relative">
        <label>Return</label>
        <div id="returnDate" class="input-box">
          <div class="selected-value">Select Date</div>
          <div class="sub-text"></div>
          <button id="clearReturnDate" class="clear-btn">×</button>
        </div>
        <!-- Hidden input for Flatpickr -->
        <input type="hidden" id="returnDateInput">
      </div>

      <!-- Travellers & Class -->
      <div class="col-md-2 position-relative">
        <label>Travellers & Class</label>
        <div id="travellers" class="input-box">
          <span class="selected-value">1 Traveller</span>
          <span class="sub-text">Economy</span>
        </div>
        <!-- Travellers Dropdown -->
        <div class="dropdown-menu" id="travellersDropdown" style="padding: 15px;">
          <label>ADULTS (12+)</label>
          <div class="d-flex flex-wrap" id="adultsGroup">
            <span class="btn-option" data-category="adults" data-value="1">1</span>
            <span class="btn-option" data-category="adults" data-value="2">2</span>
            <span class="btn-option" data-category="adults" data-value="3">3</span>
          </div>
          <hr>
          <label>CHILDREN (2y - 12y)</label>
          <div class="d-flex flex-wrap" id="childrenGroup">
            <span class="btn-option" data-category="children" data-value="0">0</span>
            <span class="btn-option" data-category="children" data-value="1">1</span>
            <span class="btn-option" data-category="children" data-value="2">2</span>
          </div>
          <hr>
          <label>INFANTS (below 2y)</label>
          <div class="d-flex flex-wrap" id="infantsGroup">
            <span class="btn-option" data-category="infants" data-value="0">0</span>
            <span class="btn-option" data-category="infants" data-value="1">1</span>
            <span class="btn-option" data-category="infants" data-value="2">2</span>
          </div>
          <hr>
          <label>CHOOSE TRAVEL CLASS</label>
          <div class="d-flex flex-wrap" id="classGroup">
            <span class="btn-option" data-category="class" data-value="Economy">Economy/Premium Economy</span>
            <span class="btn-option" data-category="class" data-value="Business">Business</span>
            <span class="btn-option" data-category="class" data-value="First Class">First Class</span>
          </div>
          <button class="btn-search mt-3" id="applyTravellers">APPLY</button>
        </div>
      </div>
    </div>

    <!-- Search Button BELOW, Centered -->
    <div class="row mt-4">
      <div class="col text-center">
        <button class="btn-search">SEARCH</button>
      </div>
    </div>

  </div>
</div>

<script>
  // Airport list
  const airports = [
    { code: "BOM", city: "Mumbai",    country: "India", airport: "Chhatrapati Shivaji Intl Airport" },
    { code: "DEL", city: "Delhi",     country: "India", airport: "Indira Gandhi Intl Airport" },
    { code: "BLR", city: "Bengaluru", country: "India", airport: "Bengaluru Intl Airport" },
    { code: "HYD", city: "Hyderabad", country: "India", airport: "Rajiv Gandhi Intl Airport" },
    { code: "MAA", city: "Chennai",   country: "India", airport: "Chennai Intl Airport" }
  ];

  $(document).ready(function() {
    /************************
     * Auto-Select From/To  *
     ************************/
    $("#from .selected-value").text(`${airports[0].city}, ${airports[0].country}`);
    $("#from .sub-text").text(`${airports[0].airport} (${airports[0].code})`);
    const lastIndex = airports.length - 1;
    $("#to .selected-value").text(`${airports[lastIndex].city}, ${airports[lastIndex].country}`);
    $("#to .sub-text").text(`${airports[lastIndex].airport} (${airports[lastIndex].code})`);

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
      $(".dropdown").not("#" + dropdownId).hide(); // close others
      populateDropdown(dropdownId);
      $("#" + dropdownId).toggle();
    });

    function populateDropdown(dropdownId) {
      let dropdownEl = $("#" + dropdownId);
      dropdownEl.empty();
      airports.forEach(airport => {
        dropdownEl.append(`
          <div class="dropdown-item" data-code="${airport.code}">
            <div class="selected-value">${airport.city}, ${airport.country}</div>
            <div class="sub-text">${airport.airport} (${airport.code})</div>
          </div>
        `);
      });
    }

    $(".dropdown").on("click", ".dropdown-item", function() {
      let parentBox = $(this).closest(".position-relative").find(".input-box");
      parentBox.find(".selected-value").text($(this).find(".selected-value").text());
      parentBox.find(".sub-text").text($(this).find(".sub-text").text());
      $(this).closest(".dropdown").hide();
    });

    $(document).click(function(e) {
      if (!$(e.target).closest(".input-box, .dropdown").length) {
        $(".dropdown").hide();
      }
    });

    /************************
     *    Departure Date    *
     ************************/
    const departureFlatpickr = flatpickr("#departureDateInput", {
      dateFormat: "d M Y",
      minDate: "today",         // No past dates
      defaultDate: "today",     // Today’s date by default
      clickOpens: false,        // We'll open it manually
      onReady: function(selectedDates, dateStr, instance) {
        // Once it's ready, set the UI to today's date + weekday
        if (selectedDates.length) {
          const weekday = selectedDates[0].toLocaleDateString("en-US", { weekday: "long" });
          $("#departureDate .selected-value").text(dateStr);
          $("#departureDate .sub-text").text(weekday);
        }
      },
      onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length) {
          const weekday = selectedDates[0].toLocaleDateString("en-US", { weekday: "long" });
          $("#departureDate .selected-value").text(dateStr);
          $("#departureDate .sub-text").text(weekday);
        }
      }
    });

    // Open flatpickr on the div
    $("#departureDate").on("click", function(e) {
      e.stopPropagation();
      departureFlatpickr.open();
    });

    /************************
     *     Return Date      *
     ************************/
    const returnFlatpickr = flatpickr("#returnDateInput", {
      dateFormat: "d M Y",
      minDate: "today",
      clickOpens: false,
      onChange: function(selectedDates, dateStr, instance) {
        if (dateStr) {
          // If user picks a return date, switch to Round Trip
          if ($("#oneWay").is(":checked")) {
            $("#roundTrip").prop("checked", true);
          }
          const weekday = selectedDates[0].toLocaleDateString("en-US", { weekday: "long" });
          $("#returnDate .selected-value").text(dateStr);
          $("#returnDate .sub-text").text(weekday);
          // Show the clear button
          $("#clearReturnDate").show();
        } else {
          // If user clears the date, switch to One Way
          if ($("#roundTrip").is(":checked")) {
            $("#oneWay").prop("checked", true);
          }
          $("#returnDate .selected-value").text("Select Date");
          $("#returnDate .sub-text").text("");
          $("#clearReturnDate").hide();
        }
      }
    });

    // Open return date picker on div click
    $("#returnDate").on("click", function(e) {
      e.stopPropagation();
      returnFlatpickr.open();
    });

    // Clear button for return date
    $("#clearReturnDate").click(function(e) {
      e.stopPropagation();
      returnFlatpickr.clear(); // triggers onChange -> switches to One Way
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
      // Only allow one selection per category
      $(`.btn-option[data-category='${category}']`).removeClass("selected");
      $(this).addClass("selected");
    });

    $("#applyTravellers").click(function() {
      let adults   = parseInt($("#adultsGroup .selected").data("value")   || 1);
      let children = parseInt($("#childrenGroup .selected").data("value") || 0);
      let infants  = parseInt($("#infantsGroup .selected").data("value")  || 0);
      let travelClass = $("#classGroup .selected").data("value") || "Economy";

      let totalTravellers = adults + children + infants;

      $("#travellers .selected-value").text(
        totalTravellers + " Traveller" + (totalTravellers > 1 ? "s" : "")
      );
      $("#travellers .sub-text").text(travelClass);

      $("#travellersDropdown").hide();
    });
  });
</script>
</body>
</html>
