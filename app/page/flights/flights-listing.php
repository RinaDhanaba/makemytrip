<!-- Include the header -->
<?php include('../../layout/header.php'); ?>

<!-- Include the Home static navigation -->
<?php include('../../app/layout/home-static-navigation.php'); ?>



<div class="container">
    <h2>Flight Search Results</h2>
    <div id="flightDetails"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let flightData = JSON.parse(localStorage.getItem("flightData"));

        if (flightData) {
            document.getElementById("flightDetails").innerHTML = `
                <p><strong>From:</strong> ${flightData.from}</p>
                <p><strong>To:</strong> ${flightData.to}</p>
                <p><strong>Departure:</strong> ${flightData.departure}</p>
                <p><strong>Return:</strong> ${flightData.returnDate ? flightData.returnDate : "N/A"}</p>
                <p><strong>Travellers:</strong> ${flightData.travellers}</p>
                <p><strong>Trip Type:</strong> ${flightData.tripType}</p>
            `;
        } else {
            document.getElementById("flightDetails").innerHTML = `<p>No Flight Data Found</p>`;
        }
    });
</script>



<!-- Include the footer -->
<?php include('../../app/layout/footer.php'); ?>
