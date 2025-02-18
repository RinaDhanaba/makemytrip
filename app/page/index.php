<!-- Include the header -->
<?php include('../layout/header.php'); ?>

<div class="bgGradient">

<div class="flight-search-container">
<div class="booking-container">
    <form action="search.php" method="GET">
        
        <!-- Trip Type Selection -->
        <div class="trip-options">
            <?php 
            $tripTypes = ['One Way', 'Round Trip', 'Multi City'];
            foreach ($tripTypes as $type) {
                $checked = ($type == 'One Way') ? 'checked' : ''; 
                echo "<label><input type='radio' name='trip' value='$type' $checked> $type</label>";
            }
            ?>
        </div>

        <!-- Flight Details -->
        <div class="flight-details">
            <label>From: <input type="text" name="from" placeholder="Enter departure city" required></label>
            <label>To: <input type="text" name="to" placeholder="Enter destination city" required></label>
            <label>Departure: <input type="date" name="departure" required></label>
            <label>Return: <input type="date" name="return"></label>
        </div>

        <!-- Special Fare Options -->
        <div class="fare-options">
            <label>Select a special fare:</label>
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
                echo "<label><input type='radio' name='fare' value='$key' $checked> $key ($desc)</label>";
            }
            ?>
        </div>

        <!-- Passenger Details -->
        <div class="passenger-details">
            <label>Passengers: 
                <select name="passengers">
                    <?php for ($i = 1; $i <= 5; $i++) {
                        echo "<option value='$i'>$i Traveller</option>";
                    } ?>
                </select>
            </label>
            <label>Class: 
                <select name="class">
                    <option value="Economy">Economy</option>
                    <option value="Premium Economy">Premium Economy</option>
                    <option value="Business">Business</option>
                </select>
            </label>
        </div>

        <button type="submit">Search</button>
    </form>
</div>

</div>
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

.flight-search-container{
    max-width: 1200px;
    margin: -50px auto 50px auto;
    background-color: #fff;
    padding: 100px 30px 30px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    position: relative;
    top: 180px;
}





.booking-container {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 100%;
    max-width: 500px;
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
    justify-content: space-around;
    padding: 10px;
}

.trip-options label {
    cursor: pointer;
}

/* Flight Details */
.flight-details {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.flight-details label {
    display: flex;
    flex-direction: column;
}

.flight-details input {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Fare Options */
.fare-options {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.fare-options label {
    display: flex;
    align-items: center;
}

.fare-options input {
    margin-right: 10px;
}

/* Passenger Details */
.passenger-details {
    display: flex;
    justify-content: space-between;
}

.passenger-details select {
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

/* Search Button */
button {
    background: #007bff;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: #0056b3;
}

/* Responsive Design */
@media (max-width: 600px) {
    .booking-container {
        max-width: 90%;
    }
}
</style>

<!-- Include the footer -->
<?php include('../layout/footer.php'); ?>
