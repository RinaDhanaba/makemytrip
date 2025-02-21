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

        .small-heading {
            font-size: 14px;
            color: gray;
            text-align: right;
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

#travellersDropdown {
    display: none;
    position: absolute;
    background: white;
    width: 100%;
    max-height: 250px;
    overflow-y: auto;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    padding: 15px;
}


    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="flight-card">
            <div class="row g-3 align-items-center">
                <div class="row">
                <!-- Trip Type -->
                <div class="col-md-6">
                    <input type="radio" name="tripType" id="oneWay" checked> <label for="oneWay">One Way</label>
                    <input type="radio" name="tripType" id="roundTrip"> <label for="roundTrip">Round Trip</label>
                </div>

                <!-- Small Heading -->
                <div class="col-md-6 text-end">
                    <span class="small-heading">Book International and Domestic Flights</span>
                </div>
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
                <?php
                    // Define options as arrays
                    $travellerOptions = [
                        "adults" => range(1, 9),  // 1 to 9 adults
                        "children" => range(0, 6), // 0 to 6 children
                        "infants" => range(0, 2)   // 0 to 2 infants
                    ];

                    $classOptions = [
                        "Economy" => "Economy/Premium Economy",
                        "Business" => "Business",
                        "First Class" => "First Class"
                    ];
                    ?>
                <div class="container mt-5">
                    <div class="row g-3 align-items-center">
                        <!-- Travellers & Class -->
                        <div class="col-md-4 position-relative">
                            <label>Travellers & Class</label>
                            <div id="travellers">
                                <span class="selected-value">1 Traveller</span>
                                <span class="sub-text">Economy</span>
                            </div>
                            <div class="dropdown p-3" id="travellersDropdown">
                                <!-- Adults -->
                                <label>Adults (12+)</label>
                                <div class="d-flex flex-wrap" id="adultsGroup">
                                    <?php foreach ($travellerOptions['adults'] as $value) { ?>
                                        <span class="btn-option" data-category="adults" data-value="<?= $value; ?>"><?= $value; ?></span>
                                    <?php } ?>
                                </div>
                                
                                <!-- Children -->
                                <label>Children (2-12)</label>
                                <div class="d-flex flex-wrap" id="childrenGroup">
                                    <?php foreach ($travellerOptions['children'] as $value) { ?>
                                        <span class="btn-option" data-category="children" data-value="<?= $value; ?>"><?= $value; ?></span>
                                    <?php } ?>
                                </div>

                                <!-- Infants -->
                                <label>Infants (Below 2)</label>
                                <div class="d-flex flex-wrap" id="infantsGroup">
                                    <?php foreach ($travellerOptions['infants'] as $value) { ?>
                                        <span class="btn-option" data-category="infants" data-value="<?= $value; ?>"><?= $value; ?></span>
                                    <?php } ?>
                                </div>

                                <!-- Class Selection -->
                                <label>Choose Travel Class</label>
                                <div class="d-flex" id="classGroup">
                                    <?php foreach ($classOptions as $key => $label) { ?>
                                        <span class="btn-option" data-category="class" data-value="<?= $key; ?>"><?= $label; ?></span>
                                    <?php } ?>
                                </div>

                                <button class="btn btn-apply mt-3" id="applyTravellers">APPLY</button>
                            </div>
                        </div>
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



        $(document).ready(function () {
    // Close other dropdowns before opening a new one
    $("#from, #to").click(function (event) {
        event.stopPropagation();
        let dropdownId = $(this).attr("id") + "Dropdown";
        $(".dropdown").not(`#${dropdownId}`).hide(); // Close other dropdowns
        populateDropdown($(this).attr("id"), dropdownId);
        $(`#${dropdownId}`).toggle();
    });

    // Populate dropdowns with airport data
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

    // Handle dropdown selection
    $(".dropdown").on("click", ".dropdown-item", function () {
        let parentInput = $(this).closest(".position-relative").find(".input-box");
        parentInput.find(".selected-value").text($(this).find(".selected-value").text());
        parentInput.find(".sub-text").text($(this).find(".sub-text").text());
        $(this).closest(".dropdown").hide();
    });

    // Prevent dropdown from closing when clicking inside
    $(".dropdown").click(function (event) {
        event.stopPropagation();
    });

    // Close dropdowns when clicking outside
    $(document).click(function (event) {
        if (!$(event.target).closest(".input-box, .dropdown").length) {
            $(".dropdown").hide();
        }
    });

    // Toggle Traveller Dropdown
    $("#travellers").click(function (event) {
        event.stopPropagation();
        $("#travellersDropdown").toggle();
    });

    // Close traveller dropdown when clicking outside
    $(document).click(function (event) {
        if (!$(event.target).closest("#travellersDropdown, #travellers").length) {
            $("#travellersDropdown").hide();
        }
    });

    // Handle Traveller & Class Selection
    $(".btn-option").click(function () {
        let category = $(this).data("category");
        $(`.btn-option[data-category="${category}"]`).removeClass("selected");
        $(this).addClass("selected");
    });

    // Apply Traveller Selection
    $("#applyTravellers").click(function () {
        let adults = $("#adultsGroup .selected").data("value") || 1;
        let children = $("#childrenGroup .selected").data("value") || 0;
        let infants = $("#infantsGroup .selected").data("value") || 0;
        let travelClass = $("#classGroup .selected").data("value") || "Economy";

        let totalTravellers = parseInt(adults) + parseInt(children) + parseInt(infants);
        $("#travellers .selected-value").text(`${totalTravellers} Traveller${totalTravellers > 1 ? 's' : ''}`);
        $("#travellers .sub-text").text(travelClass);

        $("#travellersDropdown").hide();
    });

    // Initialize Date Pickers
    $("#departureDate, #returnDate").flatpickr({ dateFormat: "d M Y", minDate: "today" });

    // Show return date if round trip is selected
    $("#roundTrip").change(function () { $("#returnDateContainer").fadeIn(); });
    $("#oneWay").change(function () { $("#returnDateContainer").fadeOut(); });
});








        $(document).ready(function () {
            // Toggle Traveller Dropdown
            $("#travellers").click(function (event) {
                event.stopPropagation(); // Prevents closing when clicking inside
                $("#travellersDropdown").toggle();
            });

            // Close dropdown if clicked outside
            $(document).click(function (event) {
                if (!$(event.target).closest("#travellersDropdown, #travellers").length) {
                    $("#travellersDropdown").hide();
                }
            });

            // Handle button selection
            $(".btn-option").click(function () {
                let category = $(this).data("category");
                
                // Reset selection in the category
                $(`.btn-option[data-category="${category}"]`).removeClass("selected");
                $(this).addClass("selected");
            });

            // Apply selection
            $("#applyTravellers").click(function () {
                let adults = $("#adultsGroup .selected").data("value") || 1;
                let children = $("#childrenGroup .selected").data("value") || 0;
                let infants = $("#infantsGroup .selected").data("value") || 0;
                let travelClass = $("#classGroup .selected").data("value") || "Economy";

                let totalTravellers = parseInt(adults) + parseInt(children) + parseInt(infants);
                
                $("#travellers .selected-value").text(`${totalTravellers} Traveller${totalTravellers > 1 ? 's' : ''}`);
                $("#travellers .sub-text").text(travelClass);
                
                $("#travellersDropdown").hide();
            });
        });



    </script>
</body>
</html>
