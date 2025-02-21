<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .flight-card {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .trip-options label {
            font-weight: bold;
            cursor: pointer;
        }
        .highlight {
            font-size: 22px;
            font-weight: bold;
        }
        .header-text {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
        }
        .swap-btn {
            cursor: pointer;
            font-size: 24px;
            color: #007bff;
        }
        .search-btn {
            display: block;
            margin: 20px auto;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 50px;
            background-color: #007bff;
            color: #fff;
            border: none;
            transition: 0.3s;
        }
        .search-btn:hover {
            background-color: #0056b3;
        }
        @media (max-width: 768px) {
            .highlight {
                font-size: 18px;
            }
            .swap-btn {
                display: block;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="flight-card p-4">
            <div class="header-text">Book International and Domestic Flights</div>

            <!-- Trip Options -->
            <div class="d-flex align-items-center mb-3 trip-options">
                <input type="radio" name="trip" id="oneWay" checked>
                <label for="oneWay" class="ms-2 me-3">One Way</label>
                <input type="radio" name="trip" id="roundTrip">
                <label for="roundTrip" class="ms-2 me-3">Round Trip</label>
                <input type="radio" name="trip" id="multiCity">
                <label for="multiCity" class="ms-2">Multi City</label>
            </div>

            <!-- Flight Details -->
            <div class="row align-items-center">
                <div class="col-md-4">
                    <label>From</label>
                    <p id="fromText" class="highlight">Delhi</p>
                    <p>DEL, Delhi Airport India</p>
                </div>
                <div class="col-md-1 text-center swap-btn" id="swapBtn">⇄</div>
                <div class="col-md-4">
                    <label>To</label>
                    <p id="toText" class="highlight">Bengaluru</p>
                    <p>BLR, Bengaluru International Airport</p>
                </div>
            </div>

            <!-- Departure & Return -->
            <div class="row mt-3">
                <div class="col-md-3">
                    <label>Departure</label>
                    <p class="highlight">22 Feb'25</p>
                    <p>Saturday</p>
                </div>
                <div class="col-md-3" id="returnSection" style="display: none;">
                    <label>Return</label>
                    <p class="text-muted">Tap to add a return date for bigger discounts</p>
                </div>
            </div>

            <!-- Travelers & Class -->
            <div class="row mt-3">
                <div class="col-md-4">
                    <label>Travellers & Class</label>
                    <p class="highlight">1 Traveller</p>
                    <p>Economy/Premium Economy</p>
                </div>
            </div>

            <!-- Search Button -->
            <button class="search-btn">SEARCH</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const oneWay = document.getElementById("oneWay");
            const roundTrip = document.getElementById("roundTrip");
            const multiCity = document.getElementById("multiCity");
            const returnSection = document.getElementById("returnSection");

            // Handle Trip Type Toggle
            oneWay.addEventListener("change", () => toggleReturnDate(false));
            roundTrip.addEventListener("change", () => toggleReturnDate(true));
            multiCity.addEventListener("change", () => toggleReturnDate(false));

            function toggleReturnDate(show) {
                returnSection.style.display = show ? "block" : "none";
            }

            // Swap From and To locations
            document.getElementById("swapBtn").addEventListener("click", function () {
                let fromText = document.getElementById("fromText").innerText;
                let toText = document.getElementById("toText").innerText;
                
                document.getElementById("fromText").innerText = toText;
                document.getElementById("toText").innerText = fromText;
            });
        });
    </script>

</body>
</html>
