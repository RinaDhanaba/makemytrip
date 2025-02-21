<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search</title>

    <!-- Styles & Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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
        .select2-container--default .select2-results__option {
            padding: 10px;
            display: flex;
            align-items: center;
        }
        .airport-item {
            display: flex;
            align-items: center;
        }
        .airport-icon {
            margin-right: 10px;
        }
        .airport-details {
            flex-grow: 1;
        }
        .airport-code {
            font-weight: bold;
            color: #666;
        }
        .btn-search {
            background-color: #007bff;
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: bold;
        }
        .swap-btn {
            cursor: pointer;
            font-size: 24px;
            color: #007bff;
            text-align: center;
            user-select: none;
        }
        .travellers-dropdown {
            display: none;
            background: white;
            padding: 15px;
            position: absolute;
            z-index: 1000;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 250px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="flight-card">
            <div class="row g-3 align-items-center">
                <!-- Trip Type -->
                <div class="col-md-auto">
                    <input type="radio" name="tripType" id="oneWay" checked> <label for="oneWay">One Way</label>
                    <input type="radio" name="tripType" id="roundTrip"> <label for="roundTrip">Round Trip</label>
                </div>

                <!-- From Location -->
                <div class="col-md-3">
                    <label>From</label>
                    <select id="from" class="form-select"></select>
                </div>

                <!-- Swap Button -->
                <div class="col-md-auto swap-btn" id="swapBtn">⇄</div>

                <!-- To Location -->
                <div class="col-md-3">
                    <label>To</label>
                    <select id="to" class="form-select"></select>
                </div>

                <!-- Departure Date -->
                <div class="col-md-2">
                    <label>Departure</label>
                    <input type="text" id="departureDate" class="form-control" placeholder="Select date">
                </div>

                <!-- Return Date (Hidden for One Way) -->
                <div class="col-md-2" id="returnDateContainer" style="display: none;">
                    <label>Return</label>
                    <input type="text" id="returnDate" class="form-control" placeholder="Select date">
                </div>

                <!-- Travellers & Class -->
                <div class="col-md-2 position-relative">
                    <label>Travellers & Class</label>
                    <input type="text" id="travellers" class="form-control" readonly>
                    <div class="travellers-dropdown">
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
            { code: "BOM", city: "Mumbai, India", airport: "Chhatrapati Shivaji International Airport" },
            { code: "DEL", city: "New Delhi, India", airport: "Indira Gandhi International Airport" },
            { code: "BLR", city: "Bengaluru, India", airport: "Bengaluru International Airport" },
            { code: "HYD", city: "Hyderabad, India", airport: "Rajiv Gandhi International Airport" },
            { code: "MAA", city: "Chennai, India", airport: "Chennai International Airport" }
        ];

        function formatAirport(airport) {
            if (!airport.id) return airport.text;
            const data = airports.find(a => a.code === airport.id);
            if (!data) return airport.text;
            return $(`
                <div class="airport-item">
                    <span class="airport-icon">✈️</span>
                    <div class="airport-details">
                        <div><strong>${data.city}</strong></div>
                        <div>${data.airport}</div>
                    </div>
                    <span class="airport-code">${data.code}</span>
                </div>
            `);
        }

        $(document).ready(function() {
            $("#from, #to").select2({
                data: airports.map(a => ({ id: a.code, text: `${a.city} (${a.code})` })),
                templateResult: formatAirport,
                templateSelection: formatAirport,
                width: '100%'
            });

            $("#departureDate, #returnDate").flatpickr({
                dateFormat: "d M Y",
                minDate: "today"
            });

            $("#roundTrip").change(() => $("#returnDateContainer").fadeIn());
            $("#oneWay").change(() => $("#returnDateContainer").fadeOut());

            $("#travellers").click(() => $(".travellers-dropdown").toggle());

            $(document).click(e => {
                if (!$(e.target).closest(".travellers-dropdown, #travellers").length) {
                    $(".travellers-dropdown").hide();
                }
            });

            $("#applyTravellers").click(() => {
                const adults = $("#adults").val();
                const children = $("#children").val();
                const infants = $("#infants").val();
                const travelClass = $("#travelClass option:selected").text();
                $("#travellers").val(`${adults} Adults, ${children} Children, ${infants} Infants - ${travelClass}`);
                $(".travellers-dropdown").hide();
            });

            $("#swapBtn").click(() => {
                let fromVal = $("#from").val();
                let toVal = $("#to").val();
                $("#from").val(toVal).trigger("change");
                $("#to").val(fromVal).trigger("change");
            });
        });
    </script>
</body>
</html>
