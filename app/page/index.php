<!-- Include the header -->
<?php include('../layout/header.php'); ?>

<div class="bgGradient">
    <div class="booking-container">
        <form action="search.php" method="GET">

            <!-- Trip Type Selection -->
            <div class="trip-options">
                <label><input type="radio" name="trip" value="one-way" onclick="switchTab('one-way')" checked> One Way</label>
                <label><input type="radio" name="trip" value="round-trip" onclick="switchTab('round-trip')"> Round Trip</label>
                <label><input type="radio" name="trip" value="multi-city" onclick="switchTab('multi-city')"> Multi City</label>
            </div>

            <p>Book International and Domestic Flights</p>

            <!-- One Way Section -->
            <div id="one-way" class="tab-content">
                <div class="flight-section">
                    <div class="flight-box">
                        <label>From</label>
                        <input type="text" id="from-input" name="from" placeholder="Enter city or airport" onkeyup="filterOptions('from-input', 'from-dropdown')" required>
                        <div class="dropdown-content" id="from-dropdown"></div>
                    </div>
                    <div class="swap-icon" onclick="swapValues()">⇄</div>
                    <div class="flight-box">
                        <label>To</label>
                        <input type="text" id="to-input" name="to" placeholder="Enter city or airport" onkeyup="filterOptions('to-input', 'to-dropdown')" required>
                        <div class="dropdown-content" id="to-dropdown"></div>
                    </div>
                </div>

                <div class="date-section">
                    <div class="date-box">
                        <label>Departure</label>
                        <input type="date" name="departure" required>
                    </div>
                </div>
            </div>

            <!-- Round Trip Section -->
            <div id="round-trip" class="tab-content" style="display: none;">
                <div class="flight-section">
                    <div class="flight-box">
                        <label>From</label>
                        <input type="text" id="from-input-rt" name="from" placeholder="Enter city or airport" onkeyup="filterOptions('from-input-rt', 'from-dropdown-rt')" required>
                        <div class="dropdown-content" id="from-dropdown-rt"></div>
                    </div>
                    <div class="swap-icon" onclick="swapValuesRT()">⇄</div>
                    <div class="flight-box">
                        <label>To</label>
                        <input type="text" id="to-input-rt" name="to" placeholder="Enter city or airport" onkeyup="filterOptions('to-input-rt', 'to-dropdown-rt')" required>
                        <div class="dropdown-content" id="to-dropdown-rt"></div>
                    </div>
                </div>

                <div class="date-section">
                    <div class="date-box">
                        <label>Departure</label>
                        <input type="date" name="departure" required>
                    </div>
                    <div class="date-box">
                        <label>Return</label>
                        <input type="date" name="return" required>
                    </div>
                </div>
            </div>

            <!-- Multi City Section -->
            <div id="multi-city" class="tab-content" style="display: none;">
                <div id="multi-city-container">
                    <div class="multi-city-row">
                        <input type="text" placeholder="From" name="multi_from[]" required>
                        <input type="text" placeholder="To" name="multi_to[]" required>
                        <input type="date" name="multi_departure[]" required>
                    </div>
                </div>
                <button type="button" onclick="addCity()">+ Add City</button>
            </div>

            <button type="submit" class="search-btn">SEARCH</button>
        </form>
    </div>
</div>

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

<div style="display:flex; gap:10px; margin:50px auto; max-width:1200px;    justify-content: space-between; ">
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


<div class="grid grid-2 container" style="padding-bottom:20px; border-bottom:2px solid #333; margin-bottom:20px">
    <div >
        <b>Q - How do I make a flight booking on MakeMyTrip?</b>
        <p>A: You can book a flight on MakeMyTrip in five easy steps: Head over to the MakeMyTrip flight booking page, Enter your departure and arrival destinations, Select your air travel dates, Choose from our wide range of cheap flights based on your airfare preferences, Click on ‘Book Now’ and your air flight booking is done. Alternatively, you can also use the MakeMyTrip app for your flight ticket booking. Download the MakeMyTrip app, Put in the details i.e. date of journey, departure and arrival destinations, travel class of your choice, Select on your best comfortable option and click on 'Book Now'.</p>
    </div>
    <div>
        <b>Q - Can I avail domestic flight offers on MakeMyTrip?</b>
        <p>A: Of course, you can. While making domestic flight bookings, you can avail any special offer that is active at that time. In accordance with the offer selected, a listing of eligible cheapest flights would show up on your screen. You can then apply the price filter and click on the downwards arrow, following which budget-friendly flights would start showing up in ascending order from the top (lowest price on top).</p>
    </div>
</div>
<div class="grid grid-2 container">
    <div >
        <b>Q - How can I avail budget air tickets on MakeMyTrip?</b>
        <p>A: It’s super-easy to avail budget airfare while booking your cheap flight tickets on MakeMyTrip. Just select the ‘Price’ filter once the available flight options are displayed and adjust according to your convenience. On the MakeMyTrip app, you can select the downward arrow, which will show the lowest airfare at the top and continue downward in ascending order.</p>
    </div>
    <div >
        <b>Q - Why could I not avail the flight booking offers at the time of checkout?</b>
        <p>A: MakeMyTrip makes use of a world-class real-time reservation database to list airfare and availability. As dynamic changes in airfare take place, or the available flight tickets sell out, the database reflects the changes in real-time. Hence, we suggest, you double-check online flight booking prices when purchasing flight tickets, as the airfare might have been dynamically updated since you first selected the air travel dates or planned your itinerary.</p>
    </div>
</div>

<!-- Include the footer -->
<?php include('../layout/footer.php'); ?>
