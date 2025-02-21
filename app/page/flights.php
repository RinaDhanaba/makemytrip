<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            background: white;
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
            background: white;
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
        .selected-value {
            font-size: 16px;
            font-weight: bold;
        }
        .sub-text {
            font-size: 12px;
            color: gray;
        }
        .btn-search {
            background-color: #007bff;
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h5 class="mb-3">Book International and Domestic Flights</h5>
        <div class="flight-card">
            <div class="row g-3 align-items-center">
                <!-- Trip Type -->
                <div class="col-md-auto">
                    <input type="radio" name="tripType" id="oneWay" checked> <label for="oneWay">One Way</label>
                    <input type="radio" name="tripType" id="roundTrip"> <label for="roundTrip">Round Trip</label>
                </div>

                <!-- From Location -->
                <div class="col-md-3 position-relative">
                    <label>From</label>
                    <div id="from" class="input-box">
                        <div class="selected-value">Select Departure</div>
                        <div class="sub-text">Airport will appear here</div>
                    </div>
                    <div class="dropdown" id="fromDropdown"></div>
                </div>

                <!-- To Location -->
                <div class="col-md-3 position-relative">
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
                    <input type="text" id="departureDate" class="form-control" placeholder="Select date">
                </div>

                <!-- Return Date -->
                <div class="col-md-2" id="returnDateContainer" style="display: none;">
                    <label>Return</label>
                    <input type="text" id="returnDate" class="form-control" placeholder="Select date">
                </div>

                <!-- Travellers & Class -->
                <div class="col-md-3 position-relative">
                    <label>Travellers & Class</label>
                    <div id="travellers" class="input-box">
                        <div class="selected-value">1 Traveller</div>
                        <div class="sub-text">Economy/Premium Economy</div>
                    </div>
                    <div class="dropdown" id="travellersDropdown">
                        <label>Adults (12+)</label>
                        <input type="number" id="adults" class="form-control" min="1" max="9" value="1">

                        <label>Children (2-12)</label>
                        <input type="number" id="children" class="form-control" min="0" max="6" value="0">

                        <label>Infants (Below 2)</label>
                        <input type="number" id="infants" class="form-control" min="0" max="2" value="0">

                        <label>Class</label>
                        <select id="travelClass" class="form-select">
                            <option value="Economy">Economy/Premium Economy</option>
                            <option value="Business">Business</option>
                            <option value="First Class">First Class</option>
                        </select>
                        <button class="btn btn-primary mt-2" id="applyTravellers">Apply</button>
                    </div>
                </div>

                <!-- Search Button -->
                <div class="col-md-auto">
                    <button class="btn btn-search">SEARCH</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const airports = [
            { code: "BOM", city: "Mumbai", country: "India", airport: "Chhatrapati Shivaji International Airport" },
            { code: "DEL", city: "Delhi", country: "India", airport: "Indira Gandhi International Airport" },
            { code: "BLR", city: "Bengaluru", country: "India", airport: "Bengaluru International Airport" },
            { code: "HYD", city: "Hyderabad", country: "India", airport: "Rajiv Gandhi International Airport" },
            { code: "MAA", city: "Chennai", country: "India", airport: "Chennai International Airport" }
        ];

        function populateDropdown(id, dropdownId) {
            let dropdown = $(`#${dropdownId}`);
            dropdown.empty();
            airports.forEach(airport => {
                dropdown.append(`
                    <div class="dropdown-item" data-code="${airport.code}">
                        <div class="selected-value">${airport.city}, ${airport.country}</div>
                        <div class="sub-text">${airport.airport} (${airport.code})</div>
                    </div>
                `);
            });
        }

        $("#from, #to").click(function () {
            let dropdownId = $(this).attr("id") + "Dropdown";
            populateDropdown($(this).attr("id"), dropdownId);
            $(`#${dropdownId}`).toggle();
        });

        $(".dropdown").on("click", ".dropdown-item", function () {
            let parentInput = $(this).closest(".position-relative").find(".input-box");
            parentInput.find(".selected-value").text($(this).find(".selected-value").text());
            parentInput.find(".sub-text").text($(this).find(".sub-text").text());
            $(this).closest(".dropdown").hide();
        });

        $("#departureDate, #returnDate").flatpickr({ dateFormat: "d M Y", minDate: "today" });

        $("#roundTrip").change(function () { $("#returnDateContainer").fadeIn(); });
        $("#oneWay").change(function () { $("#returnDateContainer").fadeOut(); });

        $("#travellers").click(function () { $("#travellersDropdown").toggle(); });

        $("#applyTravellers").click(function () {
            let text = `${$("#adults").val()} Traveller`;
            $("#travellers").find(".selected-value").text(text);
            $("#travellersDropdown").hide();
        });
    </script>
</body>
</html>
