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
    }
    .dropdown {
      display: none;
      position: absolute;
      background: #fff;
      width: 100%;
      max-height: 200px;
      overflow-y: auto;
      border-radius: 8px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
      z-index: 1000;
    }
    .dropdown-item {
      padding: 10px;
      border-bottom: 1px solid #eee;
      cursor: pointer;
    }
    .dropdown-item:hover {
      background: #f1f1f1;
    }
    .dropdown-menu {
      display: none;
      position: absolute;
      background: #fff;
      width: 100%;
      max-height: 300px;
      overflow-y: auto;
      border-radius: 8px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
      z-index: 1000;
      padding: 15px;
    }
    .btn-option {
      display: inline-block;
      padding: 8px 12px;
      border-radius: 6px;
      margin: 4px;
      cursor: pointer;
      background: #f1f1f1;
      transition: 0.3s;
    }
    .btn-option.selected {
      background: #007bff;
      color: white;
    }
    .btn-apply {
      background: linear-gradient(to right, #007bff, #0056b3);
      color: white;
      padding: 10px 20px;
      border-radius: 20px;
      font-weight: bold;
      border: none;
      cursor: pointer;
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

    <hr><!-- Just a horizontal separator for clarity -->

    <!-- Second Row: From → Swap → To → Departure → Return → Travellers & Class → SEARCH -->
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

      <!-- Departure Date -->
      <div class="col-md-2">
        <label>Departure</label>
        <input type="text" id="departureDate" class="form-control" placeholder="Tap to add departure date">
      </div>

      <!-- Return Date (Always Visible) -->
      <div class="col-md-2" id="returnDateContainer">
        <label>Return</label>
        <input type="text" id="returnDate" class="form-control" placeholder="Tap to add a return date for bigger discounts">
      </div>

      <!-- Travellers & Class -->
      <?php
        $travellerOptions = [
          "adults" => range(1, 9),
          "children" => range(0, 6),
          "infants" => range(0, 2)
        ];
        $classOptions = [
          "Economy" => "Economy/Premium Economy",
          "Business" => "Business",
          "First Class" => "First Class"
        ];
      ?>
      <div class="col-md-2 position-relative">
        <label>Travellers & Class</label>
        <div id="travellers" class="input-box">
          <span class="selected-value">1 Traveller</span>
          <span class="sub-text">Economy</span>
        </div>
        <!-- Travellers Dropdown -->
        <div class="dropdown-menu" id="travellersDropdown">
          <label>ADULTS (12+)</label>
          <div class="d-flex flex-wrap" id="adultsGroup">
            <?php foreach ($travellerOptions['adults'] as $val) { ?>
              <span class="btn-option" data-category="adults" data-value="<?= $val; ?>"><?= $val; ?></span>
            <?php } ?>
          </div>
          <hr>

          <label>CHILDREN (2y - 12y)</label>
          <div class="d-flex flex-wrap" id="childrenGroup">
            <?php foreach ($travellerOptions['children'] as $val) { ?>
              <span class="btn-option" data-category="children" data-value="<?= $val; ?>"><?= $val; ?></span>
            <?php } ?>
          </div>
          <hr>

          <label>INFANTS (below 2y)</label>
          <div class="d-flex flex-wrap" id="infantsGroup">
            <?php foreach ($travellerOptions['infants'] as $val) { ?>
              <span class="btn-option" data-category="infants" data-value="<?= $val; ?>"><?= $val; ?></span>
            <?php } ?>
          </div>
          <hr>

          <label>CHOOSE TRAVEL CLASS</label>
          <div class="d-flex flex-wrap" id="classGroup">
            <?php foreach ($classOptions as $key => $label) { ?>
              <span class="btn-option" data-category="class" data-value="<?= $key; ?>"><?= $label; ?></span>
            <?php } ?>
          </div>

          <button class="btn-apply mt-3" id="applyTravellers">APPLY</button>
        </div>
      </div>

      <!-- Search Button -->
      <div class="col-md-auto">
        <button class="btn-search mt-4">SEARCH</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Airport list
  const airports = [
    { code: \"BOM\", city: \"Mumbai\",    country: \"India\", airport: \"Chhatrapati Shivaji International Airport\" },
    { code: \"DEL\", city: \"Delhi\",     country: \"India\", airport: \"Indira Gandhi International Airport\" },
    { code: \"BLR\", city: \"Bengaluru\", country: \"India\", airport: \"Bengaluru International Airport\" },
    { code: \"HYD\", city: \"Hyderabad\", country: \"India\", airport: \"Rajiv Gandhi International Airport\" },
    { code: \"MAA\", city: \"Chennai\",   country: \"India\", airport: \"Chennai International Airport\" }
  ];

  $(document).ready(function() {

    /************************
     * Auto-Select From/To  *
     ************************/
    // First airport in 'From'
    let first = airports[0];
    let last  = airports[airports.length - 1];
    $("#from .selected-value").text(`${first.city}, ${first.country}`);
    $("#from .sub-text").text(`${first.airport} (${first.code})`);

    // Last airport in 'To'
    $("#to .selected-value").text(`${last.city}, ${last.country}`);
    $("#to .sub-text").text(`${last.airport} (${last.code})`);

    /************************
     *  Swap Functionality  *
     ************************/
    $("#swapBtn").click(function() {
      let fromVal = $("#from .selected-value").text();
      let fromSub = $("#from .sub-text").text();
      let toVal   = $("#to .selected-value").text();
      let toSub   = $("#to .sub-text").text();

      // Swap
      $("#from .selected-value").text(toVal);
      $("#from .sub-text").text(toSub);
      $("#to .selected-value").text(fromVal);
      $("#to .sub-text").text(fromSub);
    });

    /************************
     *  Airport Dropdowns   *
     ************************/
    // Toggle the \"From\" and \"To\" dropdowns
    $(\"#from, #to\").click(function(e) {
      e.stopPropagation();
      let dropdownId = $(this).attr(\"id\") + \"Dropdown\";
      // Close other airport dropdowns
      $(\".dropdown\").not(\"#\" + dropdownId).hide();
      // Populate & toggle
      populateDropdown($(this).attr(\"id\"), dropdownId);
      $(\"#\" + dropdownId).toggle();
    });

    // Populate the dropdown with airport data
    function populateDropdown(inputId, dropdownId) {
      let dropdownEl = $(\"#\" + dropdownId);
      dropdownEl.empty(); // clear old items
      airports.forEach(airport => {
        dropdownEl.append(`
          <div class=\"dropdown-item\" data-code=\"${airport.code}\">
            <div class=\"selected-value\">${airport.city}, ${airport.country}</div>
            <div class=\"sub-text\">${airport.airport} (${airport.code})</div>
          </div>
        `);
      });
    }

    // When an airport is clicked, update the \"From\" or \"To\" text
    $(\".dropdown\").on(\"click\", \".dropdown-item\", function() {
      let parentBox = $(this).closest(\".position-relative\").find(\".input-box\");
      parentBox.find(\".selected-value\").text($(this).find(\".selected-value\").text());
      parentBox.find(\".sub-text\").text($(this).find(\".sub-text\").text());
      $(this).closest(\".dropdown\").hide();
    });

    // Close airport dropdown if clicked outside
    $(document).click(function(e) {
      if (!$(e.target).closest(\".input-box, .dropdown\").length) {
        $(\".dropdown\").hide();
      }
    });

    /************************
     *   Custom Date Format *
     ************************/
    function formatDate(dateObj) {
      // e.g. \"22 Feb'25 Saturday\"
      const dayOfWeek = dateObj.toLocaleString('en-GB', { weekday: 'long' }); // e.g. Saturday
      const day       = dateObj.getDate(); // e.g. 22
      const month     = dateObj.toLocaleString('en-GB', { month: 'short' }); // e.g. Feb
      const year      = dateObj.getFullYear().toString().slice(-2); // e.g. 25
      return `${day} ${month}'${year} ${dayOfWeek}`;
    }

    /************************
     *     Date Pickers     *
     ************************/
    // Departure Date
    $(\"#departureDate\").flatpickr({
      dateFormat: \"d M Y\",
      minDate: \"today\",
      onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
          // Format selected date
          let date = selectedDates[0];
          instance.input.value = formatDate(date);
        } else {
          // Cleared date
          instance.input.value = \"\";
          instance.input.placeholder = \"Tap to add departure date\";
        }
      }
    });

    // Return Date
    $(\"#returnDate\").flatpickr({
      dateFormat: \"d M Y\",
      minDate: \"today\",
      onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
          // Format selected date
          let date = selectedDates[0];
          instance.input.value = formatDate(date);

          // If user picks a return date while on One Way => switch to Round Trip
          if ($(\"#oneWay\").is(\":checked\")) {
            $(\"#roundTrip\").prop(\"checked\", true);
          }
        } else {
          // If user cleared the date
          instance.input.value = \"\";
          instance.input.placeholder = \"Tap to add a return date for bigger discounts\";

          // If user is on Round Trip => switch to One Way
          if ($(\"#roundTrip\").is(\":checked\")) {
            $(\"#oneWay\").prop(\"checked\", true);
          }
        }
      }
    });

    /************************
     * Travellers & Class   *
     ************************/
    // Toggle travellers dropdown
    $(\"#travellers\").click(function(e) {
      e.stopPropagation();
      $(\"#travellersDropdown\").toggle();
    });

    // Close travellers dropdown if clicked outside
    $(document).click(function(e) {
      if (!$(e.target).closest(\"#travellersDropdown, #travellers\").length) {
        $(\"#travellersDropdown\").hide();
      }
    });

    // Handle selection (adults, children, infants, class)
    $(\".btn-option\").click(function() {
      let category = $(this).data(\"category\");
      // Only allow one selected per category
      $(`.btn-option[data-category='${category}']`).removeClass(\"selected\");
      $(this).addClass(\"selected\");
    });

    // Apply selection
    $(\"#applyTravellers\").click(function() {
      let adults   = $(\"#adultsGroup .selected\").data(\"value\")   || 1;
      let children = $(\"#childrenGroup .selected\").data(\"value\") || 0;
      let infants  = $(\"#infantsGroup .selected\").data(\"value\")  || 0;
      let travelClass = $(\"#classGroup .selected\").data(\"value\") || \"Economy\";

      let totalTravellers = parseInt(adults) + parseInt(children) + parseInt(infants);

      // Update the display
      $(\"#travellers .selected-value\").text(
        totalTravellers + \" Traveller\" + (totalTravellers > 1 ? \"s\" : \"\")
      );
      $(\"#travellers .sub-text\").text(travelClass);

      // Close the dropdown
      $(\"#travellersDropdown\").hide();
    });
  });
</script>
</body>
</html>
