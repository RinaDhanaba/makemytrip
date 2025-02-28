<!-- Include the header -->
<?php include('../layout/header.php'); ?>

<!-- Include the Home static navigation -->
<?php include('../layout/home-static-navigation.php'); ?>


<!-- Top row of flight details (like the image) -->
<div class="search-summary" id="flightDetailsContainer">
  <div class="summary-box">
    <label>Trip Type</label>
    <span id="tripTypeText">--</span>
  </div>
  <div class="summary-box">
    <label>From</label>
    <span id="fromText">--</span>
  </div>
  <div class="summary-box">
    <label>To</label>
    <span id="toText">--</span>
  </div>
  <div class="summary-box">
    <label>Departure</label>
    <span id="departureText">--</span>
  </div>
  <div class="summary-box">
    <label>Return</label>
    <span id="returnText">--</span>
  </div>
  <div class="summary-box">
    <label>Travellers</label>
    <span id="travellersText">--</span>
  </div>
</div>

<!-- Detailed flight info section -->
<div class="container">
  <div id="flightDetails"></div>
</div>


<script>
   document.addEventListener("DOMContentLoaded", function () {
    let flightData = JSON.parse(localStorage.getItem("flightData"));

    if (flightData) {

    if (flightData.tripType.toLowerCase() === "one way") {
      document.getElementById("oneWay").checked = true;
    } else if (flightData.tripType.toLowerCase() === "round trip") {
      document.getElementById("roundTrip").checked = true;
    }


      // Populate top summary row
      document.getElementById("tripTypeText").textContent   = flightData.tripType;
      document.getElementById("fromText").textContent       = flightData.from;
      document.getElementById("toText").textContent         = flightData.to;
      document.getElementById("departureText").textContent  = flightData.departure;
      document.getElementById("returnText").textContent     = flightData.returnDate ? flightData.returnDate : "N/A";
      document.getElementById("travellersText").textContent = flightData.travellers;

    // Normalize Trip Type
    let tripType = flightData.tripType.toLowerCase();

    // Show return info only if Round Trip
    let returnInfo = (tripType === "round trip" && flightData.returnDate)
      ? `, ${flightData.returnDate} and back`
      : "";

    // Populate detailed info
    document.getElementById("flightDetails").innerHTML = `
      <p>Flights From ${flightData.from} To ${flightData.to}${returnInfo}</p>
    `;
    
    } else {
      // Fallback if no data is in localStorage
      document.getElementById("flightDetails").innerHTML = `<p>No Flight Data Found</p>`;
    }
  });
</script>



<!-- Include the footer -->
<?php include('../layout/footer.php'); ?>
