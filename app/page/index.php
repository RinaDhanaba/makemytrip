<!-- Include the header -->
<?php include('../layout/header.php'); ?>

<div class="bgGradient">


<div class="booking-container">
    <form action="search.php" method="GET">
        
        <!-- Trip Type Selection -->
        <div class="trip-options">
            <div class="trip-options-inner">
            <?php 
            $tripTypes = ['One Way', 'Round Trip', 'Multi City'];
            foreach ($tripTypes as $type) {
                $id = strtolower(str_replace(' ', '-', $type));
                echo "<label><input type='radio' name='trip' value='$type' onclick='switchTab(\"$id\")' id='tab-$id'> $type</label>";
            }
            ?>
            </div>  
            <p>Book International and Domestic Flights</p>        
        </div>

        <!-- One Way & Round Trip Section -->
        <div id="one-way" class="tab-content">
            <div class="flight-section">
                <div class="flight-box">
                    <label>From</label>
                    <input type="text" name="from" placeholder="Mumbai (BOM)" required>
                </div>
                <div class="swap-icon">⇄</div>
                <div class="flight-box">
                    <label>To</label>
                    <input type="text" name="to" placeholder="New Delhi (DEL)" required>
                </div>
            </div>

            <div class="date-section">
                <div class="date-box">
                    <label>Departure</label>
                    <input type="date" name="departure" required>
                </div>
                <div class="date-box" id="return-date">
                    <label>Return</label>
                    <input type="date" name="return">
                </div>
            </div>
        </div>

        <!-- Multi-City Section -->
        <div id="multi-city" class="tab-content" style="display: none;">
            <div class="multi-city-box">
                <label>From</label>
                <input type="text" name="from1" placeholder="Delhi (DEL)" required>
                <label>To</label>
                <input type="text" name="to1" placeholder="Bengaluru (BLR)" required>
                <label>Departure</label>
                <input type="date" name="departure1" required>
            </div>
            <div class="multi-city-box">
                <label>From</label>
                <input type="text" name="from2" placeholder="Bengaluru (BLR)">
                <label>To</label>
                <input type="text" name="to2" placeholder="Select City">
                <label>Departure</label>
                <input type="date" name="departure2">
            </div>
            <button type="button" class="add-city">+ ADD ANOTHER CITY</button>
        </div>

        <!-- Special Fare Options -->
        <div class="fare-section">
            <label>Select a special fare:</label>
            <div class="fare-options">
                <?php 
                $fares = [
                    "Regular" => "Regular fares",
                    "Student" => "Extra discounts/baggage",
                    "Senior Citizen" => "Up to AED 25.47 off",
                    "Armed Forces" => "Up to AED 25.47 off",
                    "Doctor and Nurses" => "Up to AED 25.47 off"
                ];
                foreach ($fares as $key => $desc) {
                    $checked = ($key == "Regular") ? "checked" : "";
                    echo "<label class='fare-label'><input type='radio' name='fare' value='$key' $checked> $key</label>";
                }
                ?>
            </div>
        </div>

        <!-- Passenger Details -->
        <div class="passenger-section">
            <div>
                <label>Travellers & Class</label>
                <select name="passengers">
                    <?php for ($i = 1; $i <= 5; $i++) {
                        echo "<option value='$i'>$i Traveller</option>";
                    } ?>
                </select>
                <select name="class">
                    <option value="Economy">Economy</option>
                    <option value="Premium Economy">Premium Economy</option>
                    <option value="Business">Business</option>
                </select>
            </div>
        </div>

        <button type="submit" class="search-btn">SEARCH</button>
    </form>
</div>

<script>
    function switchTab(tabId) {
        document.getElementById('one-way').style.display = (tabId === 'one-way' || tabId === 'round-trip') ? 'block' : 'none';
        document.getElementById('multi-city').style.display = (tabId === 'multi-city') ? 'block' : 'none';
        document.getElementById('return-date').style.display = (tabId === 'round-trip') ? 'block' : 'none';
    }
</script>
</div>  


<style>
.bgGradient{
background: #f2f2f2;
background-repeat: no-repeat;
background-image: url(../media/bg7.jpg), linear-gradient(to bottom, #f2f2f2, #f2f2f2);
min-height: 500px;
transition: background 0.1s linear;
margin: -60px 0 0 0;
background-size: contain;
}



.booking-container {
    max-width: 1200px;
    margin: -50px auto 50px auto;
    background-color: #fff;
    padding: 100px 30px 30px 30px;
    border-radius: 8px;
    position: relative;
    top: 180px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* Trip Options */
.trip-options {
    display: flex;
    justify-content: space-between;
    padding: 10px;gap:20px;
}

.trip-options-inner {
    display: flex;
    justify-content: flex-start;
    gap:20px;
}

.trip-options label {
    cursor: pointer;
    font-weight: bold;
}

/* Flight Details */
.flight-section {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 15px 0;
}

.flight-box, .multi-city-box {
    display: flex;
    flex-direction: column;
}

.multi-city-box input {
    margin-bottom: 5px;
}

.flight-box input, .multi-city-box input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.swap-icon {
    font-size: 20px;
    color: #007bff;
}

/* Date Section */
.date-section {
    display: flex;
    gap: 10px;
    padding: 15px 0;
}

.date-box input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Multi-City */
.add-city {
    background: #007bff;
    color: white;
    border: none;
    padding: 10px;
    width: 100%;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    margin-top: 10px;
}

/* Fare Section */
.fare-section {
    padding: 10px 0;
}

.fare-options {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.fare-label {
    background: #f4f4f4;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

/* Search Button */
.search-btn {
    background: #007bff;
    color: white;
    border: none;
    padding: 15px;
    width: 100%;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    margin-top: 15px;
}

.search-btn:hover {
    background: #0056b3;
}

@media (max-width: 600px) {
    .booking-container {
        max-width: 90%;
    }
}
</style>

<!-- Include the footer -->
<?php include('../layout/footer.php'); ?>
