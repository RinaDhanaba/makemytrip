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

        <!-- Passenger Details 
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
        </div>-->

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

<div style="margin: 60px auto 20px auto;    color: #fff;    text-align: center;">>> Explore More >> </div>

<div class="extra-info-banner">
    <div class="extra-info-banner-btn">Where2Go</div>
    <div class="extra-info-banner-btn">Insurance<br>For International Trips</div>
    <div class="extra-info-banner-btn">Explore International Flights<br>Cheapest Flights to Paris, Bali, Tokyo & more</div>
    <div class="extra-info-banner-btn">MICE<br>Offsites, Events & Meetings</div>
    <div class="extra-info-banner-btn">Gift Cards</div>
</div>
</div>  

<div class="card">
    ad
</div>


<div style="min-height:500px;" class="card">
Offers

</div>

<div style="display:flex; gap:10px; margin:50px auto; max-width:1200px; ">
<div>Planning to book an international flight?<br><a href="">Check Travel Guidelines</a></div>
<div>We are now available in हिंदी!<br><a href="">Change Language</a></div>
<div>Complete your web check-in on MakeMyTrip in easy steps. <br><a href="">Know More</a></div>
</div>

<div class="card" style="margin:50px auto">
Download App Now !
</div>

<div class="card" style="margin:50px auto">    
Chennai Flights
</div>

<div style="max-width:1200px;margin: 50px auto;">
<b>MakeMyTrip</b>

<p>About Us, Investor Relations, Careers, Sustainability, MMT Foundation, Legal Notices, CSR Policy & Committee, myPartner - Travel Agent Portal, List your hotel, Partners- Redbus, Partners- Goibibo, Advertise with Us, Holiday-Franchise
</p>
<b>About the Site</b>
<p>Customer Support, MMT Black Loyalty Program, Payment Security, Privacy Policy, Cookie Policy, User Agreement, Terms of Service, Franchise Offices, Make A Payment, Work From Home, Escalation Channel
</p>
<b>Product Offering</b>
<p>Flights, International Flights, Charter Flights, Hotels, International Hotels, Homestays and Villas, Activities, Holidays In India, International Holidays, Book Hotels From UAE, myBiz for Corporate Travel, Book Online Cabs, Book Bus Tickets, Book Train Tickets, Cheap Tickets to India, Book Flights From US, Book Flights From UAE, Trip Planner, Forex Card, Buy Foreign Currency, Travel Insurance, Travel Insurance for Schengen Visa, Travel Insurance for Asia, Travel Insurance Thailand, Travel Insurance For UAE, Travel Insurance For Indonesia, Travel Insurance For Vietnam, Travel Insurance For Europe, Travel Insurance For USA, Travel Insurance for Singapore, Travel Insurance for Malaysia, Travel Insurance for Sri Lanka, Travel Insurance for United Kingdom, Travel Insurance for Canada, Gift Cards, Gift, Wedding Gift, Anniversary Gift, Birthday Gift, Diwali Gift, Valentines Gift, Farewell Gift, Christmas Gift, New Year Gift, Trip Ideas, Travel Blog, PNR Status, MakeMyTrip Advertising Solutions, One Way Cab
</p>
<b>Quick Links</b>
<p>Flights Discount Coupons, Domestic Airlines, Indigo Airlines, Air Asia, SpiceJet, GoAir, Air India, Air India Express, Vistara, New Delhi Mumbai Flights, Pune Delhi Flights, Delhi Chennai Flights, Delhi Guwahati Flights, Mumbai Varanasi Flights, Guwahati Delhi Flights, Goa Delhi Flights, Delhi Goa Flights, Delhi Chennai Flights
</p>
<b>Important Links</b>
<p>Cheap Flights, Flight Status, Kumbh Mela, Domestic Airlines, International Airlines, Indigo, Spicejet, GoAir, Air Asia, Air India, Indian Railways, Trip Ideas, Beaches, Honeymoon Destinations, Romantic Destinations, Popular Destinations, Resorts In Udaipur, Resorts In Munnar, Villas In Lonavala, Hotels in Thailand, Villas In Goa, Domestic Flight Offers, International Flight Offers, UAE Flight Offers, USA, UAE, Saudi Arabia, UK, Oman
</p>
<b>Corporate Travel</b>
<p>Business Travel, Corporate Travel, Corporate Travel Management, Corporate Travel Solution, Corporate Hotel Booking, Corporate Flight Booking, Expense Management, Corporate Expense Management, GST on Hotel Rooms, GST on Flight Tickets, Business Travel for SME, GST Invoice for International flights, GST Invoice for Bus, GST on Train Tickets, T&E (Travel & Expense), myBiz - Best Business Travel Platform, GST Invoice for Corporate Travel, myBiz for Small Business, Free cancellation on International Flights
</p>
</div>


<div style="max-width:1200px;margin: 50px auto; display:flex; flex-wrap:wrap;">
    <div class="faq" style="width:50%">
        <b>Q - How do I make a flight booking on MakeMyTrip?</b>
        <p>A: You can book a flight on MakeMyTrip in five easy steps: Head over to the MakeMyTrip flight booking page, Enter your departure and arrival destinations, Select your air travel dates, Choose from our wide range of cheap flights based on your airfare preferences, Click on ‘Book Now’ and your air flight booking is done. Alternatively, you can also use the MakeMyTrip app for your flight ticket booking. Download the MakeMyTrip app, Put in the details i.e. date of journey, departure and arrival destinations, travel class of your choice, Select on your best comfortable option and click on 'Book Now'.</p>
    </div>
    <div class="faq" style="width:50%">
        <b>Q - Can I avail domestic flight offers on MakeMyTrip?</b>
        <p>A: Of course, you can. While making domestic flight bookings, you can avail any special offer that is active at that time. In accordance with the offer selected, a listing of eligible cheapest flights would show up on your screen. You can then apply the price filter and click on the downwards arrow, following which budget-friendly flights would start showing up in ascending order from the top (lowest price on top).</p>
    </div>
    <div class="faq" style="width:50%">
        <b>Q - How can I avail budget air tickets on MakeMyTrip?</b>
        <p>A: It’s super-easy to avail budget airfare while booking your cheap flight tickets on MakeMyTrip. Just select the ‘Price’ filter once the available flight options are displayed and adjust according to your convenience. On the MakeMyTrip app, you can select the downward arrow, which will show the lowest airfare at the top and continue downward in ascending order.</p>
    </div>
    <div class="faq" style="width:50%">
        <b>Q - Why could I not avail the flight booking offers at the time of checkout?</b>
        <p>A: MakeMyTrip makes use of a world-class real-time reservation database to list airfare and availability. As dynamic changes in airfare take place, or the available flight tickets sell out, the database reflects the changes in real-time. Hence, we suggest, you double-check online flight booking prices when purchasing flight tickets, as the airfare might have been dynamically updated since you first selected the air travel dates or planned your itinerary.</p>
    </div>
</div>
<style>
.bgGradient{
background: #f2f2f2;
background-repeat: no-repeat;
background-image: url(../media/bg7.jpg), linear-gradient(to bottom, #f2f2f2, #f2f2f2);
min-height: 500px;
transition: background 0.1s linear;
margin: -60px 0 160px 0;
background-size: cover;
padding: 130px 0 0px 0;
}

.card{
    background: #fff;
    min-height: 100px;
    padding:10px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width:1200px;
    margin:30px auto;
}



.booking-container {
    max-width: 1200px;
    margin: 50px auto 0px auto;
    background-color: #fff;
    padding: 50px 30px 0px 30px;
    border-radius: 8px;
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
    flex-direction: row;
    align-content: center;
    align-items: center;
    gap: 10px;
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
    position: relative;
    top: 30px;
    width: 200px;
    margin: auto;
    border-radius: 50px;
}

.search-btn:hover {
    background: #0056b3;
}

@media (max-width: 600px) {
    .booking-container {
        max-width: 90%;
    }
}






.extra-info-banner{
    max-width: 1100px;
    margin: 0px auto -50px auto;
    background-color: #fff;
    padding: 10px;
    border-radius: 50px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display:flex;
    gap:20px;
    justify-content: space-around;
    align-items: center;
    position: relative;
    top: 35px;
}

.extra-info-banner-btn:not(:last-child) {
    border-right: 1px solid #ccc;
}

</style>

<!-- Include the footer -->
<?php include('../layout/footer.php'); ?>
