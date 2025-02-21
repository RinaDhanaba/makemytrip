<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui/1.12.1/jquery-ui.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui/1.12.1/jquery-ui.min.js"></script>
    <style>
        .flight-card {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .trip-options label {
            margin-right: 15px;
            font-weight: bold;
        }
        .highlight {
            font-size: 18px;
            font-weight: bold;
        }
        .header-text {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }
        .form-select {
            font-size: 16px;
            font-weight: bold;
        }
        .search-btn {
            background-color: #007bff;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .row-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="flight-card bg-white p-4">
            <div class="header-text">Book International and Domestic Flights</div>

            <div class="d-flex align-items-center mb-3 trip-options">
                <input type="radio" name="trip" id="oneWay" checked>
                <label for="oneWay">One Way</label>
                <input type="radio" name="trip" id="roundTrip">
                <label for="roundTrip">Round Trip</label>
            </div>

            <div class="row-flex">
                <div>
                    <label>From</label>
                    <select id="from" class="form-select">
                        <option>Delhi (DEL)</option>
                        <option>Mumbai (BOM)</option>
                        <option>Chennai (MAA)</option>
                    </select>
                </div>

                <div>
                    <label>To</label>
                    <select id="to" class="form-select">
                        <option>Bengaluru (BLR)</option>
                        <option>Kolkata (CCU)</option>
                        <option>Hyderabad (HYD)</option>
                    </select>
                </div>

                <div>
                    <label>Departure</label>
                    <input type="text" id="departure" class="form-control highlight" placeholder="Select date">
                </div>

                <div id="returnSection">
                    <label>Return</label>
                    <input type="text" id="return" class="form-control highlight" placeholder="Tap to add return">
                </div>

                <div>
                    <label>Travellers & Class</label>
                    <button id="travellersBtn" class="btn btn-outline-primary">1 Traveller, Economy</button>
                </div>
            </div>

            <div class="text-center mt-4">
                <button class="search-btn">SEARCH</button>
            </div>
        </div>
    </div>

    <!-- Travellers & Class Dropdown -->
    <div id="travellerModal" style="display: none; position: fixed; top: 20%; left: 50%; transform: translateX(-50%); background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h5>Select Travellers & Class</h5>
        <label>Adults</label>
        <input type="number" id="adults" min="1" max="9" value="1" class="form-control mb-2">
        
        <label>Children</label>
        <input type="number" id="children" min="0" max="6" value="0" class="form-control mb-2">

        <label>Infants</label>
        <input type="number" id="infants" min="0" max="6" value="0" class="form-control mb-2">
        
        <label>Class</label>
        <select id="classSelect" class="form-select">
            <option>Economy/Premium Economy</option>
            <option>Business</option>
            <option>First Class</option>
        </select>

        <button id="applyTravellers" class="btn btn-primary mt-2">Apply</button>
    </div>

    <script>
        $(document).ready(function () {
            // Custom Calendar
            $("#departure, #return").datepicker({ dateFormat: "dd M yy" });

            // Handle "Return" field click in One Way mode
            $("#return").click(function () {
                $("#roundTrip").prop("checked", true);
                $("#returnSection").show();
            });

            // Toggle Return field based on trip type
            $("input[name='trip']").change(function () {
                if ($("#oneWay").is(":checked")) {
                    $("#returnSection").show();
                } else {
                    $("#returnSection").show();
                }
            });

            // Travellers & Class Dropdown
            $("#travellersBtn").click(function () {
                $("#travellerModal").show();
            });

            $("#applyTravellers").click(function () {
                var adults = $("#adults").val();
                var children = $("#children").val();
                var infants = $("#infants").val();
                var travelClass = $("#classSelect").val();
                
                var travellerText = `${adults} Traveller`;
                if (children > 0) travellerText += `, ${children} Child`;
                if (infants > 0) travellerText += `, ${infants} Infant`;

                travellerText += `, ${travelClass}`;
                
                $("#travellersBtn").text(travellerText);
                $("#travellerModal").hide();
            });

            // Close modal on outside click
            $(document).mouseup(function (e) {
                var modal = $("#travellerModal");
                if (!modal.is(e.target) && modal.has(e.target).length === 0) {
                    modal.hide();
                }
            });
        });
    </script>
</body>
</html>
