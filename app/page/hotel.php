<!-- Include the header -->
<?php include('../layout/header.php'); ?>

<div class="bgGradient">
    <div class="booking-container">

    <div class="container mt-5">
        <div class="flight-card">
            <!-- Top Row: Trip Types + Right-aligned text -->
            <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <input type="radio" name="tripType" id="oneWay" checked>
                <label for="oneWay">One Way</label>
                <input type="radio" name="tripType" id="roundTrip">
                <label for="roundTrip">Round Trip</label>
            </div>
            <div class="col-md-6 text-end">
                <span style="font-size:14px; color:gray;">Book International and Domestic Flights</span>
            </div>
            </div>

            <!-- Fields: From → Swap → To → Departure → Return → Travellers & Class -->
            <div class="row align-items-top flight-form-main">
            <!-- From Location -->
            <div class="col-md-2 position-relative flight-form-inner">
                <label>From</label>
                <div id="from" class="input-box">
                <div class="selected-value">Select Departure</div>
                <div class="sub-text">Airport will appear here</div>
                </div>
                <div class="dropdown" id="fromDropdown"></div>
            </div>

            <!-- Swap Button -->
            <div class="col-md-auto text-center position-relative" style="padding:0px;">
                <button id="swapBtn" class="swap-btn position-absolute">⇄</button>
            </div>

            <!-- To Location -->
            <div class="col-md-2 position-relative flight-form-inner" style="padding-left: 30px;">
                <label>To</label>
                <div id="to" class="input-box">
                <div class="selected-value">Select Destination</div>
                <div class="sub-text">Airport will appear here</div>
                </div>
                <div class="dropdown" id="toDropdown"></div>
            </div>

            <!-- Departure Date (with default "today") -->
            <div class="col-md-2 position-relative flight-form-inner">
                <label>Departure</label>
                <div id="departureDate" class="input-box">
                <div class="selected-value">Select Date</div>
                <div class="sub-text"></div>
                </div>
                <!-- Hidden input for Flatpickr -->
                <input type="text" id="departureDateInput" class="position-relative d-none">
            </div>

            <!-- Return Date + Clear Button -->
            <div class="col-md-2 position-relative flight-form-inner">
                <label>Return</label>
                <div id="returnDate" class="input-box">
                <div class="selected-value"></div>
                <div class="sub-text">Tap to add a return date for bigger discounts</div>
                <button id="clearReturnDate" class="clear-btn">×</button>
                </div>
                <!-- Hidden input for Flatpickr -->
                <input type="text" id="returnDateInput" class="position-relative d-none">
            </div>

            <!-- Travellers & Class -->
            <div class="col-md-2 position-relative flight-form-inner">
                <label>Travellers & Class</label>
                <div id="travellers" class="input-box">
                <span class="selected-value">1 Traveller</span>
                <span class="sub-text">Economy</span>
                </div>
                <!-- Travellers Dropdown -->
                <div class="dropdown-menu" id="travellersDropdown" style="padding: 15px;">
                <label>ADULTS (12+)</label>
                <div class="d-flex flex-wrap gap-1" id="adultsGroup">
                    <span class="btn-option" data-category="adults" data-value="1">1</span>
                    <span class="btn-option" data-category="adults" data-value="2">2</span>
                    <span class="btn-option" data-category="adults" data-value="3">3</span>
                </div>
                <hr>
                <label>CHILDREN (2y - 12y)</label>
                <div class="d-flex flex-wrap gap-1" id="childrenGroup">
                    <span class="btn-option" data-category="children" data-value="0">0</span>
                    <span class="btn-option" data-category="children" data-value="1">1</span>
                    <span class="btn-option" data-category="children" data-value="2">2</span>
                </div>
                <hr>
                <label>INFANTS (below 2y)</label>
                <div class="d-flex flex-wrap gap-1" id="infantsGroup">
                    <span class="btn-option" data-category="infants" data-value="0">0</span>
                    <span class="btn-option" data-category="infants" data-value="1">1</span>
                    <span class="btn-option" data-category="infants" data-value="2">2</span>
                </div>
                <hr>
                <label>CHOOSE TRAVEL CLASS</label>
                <div class="d-flex flex-wrap gap-1" id="classGroup">
                    <span class="btn-option" data-category="class" data-value="Economy">Economy/Premium Economy</span>
                    <span class="btn-option" data-category="class" data-value="Business">Business</span>
                    <span class="btn-option" data-category="class" data-value="First Class">First Class</span>
                </div>
                <button class="btn-search mt-3" id="applyTravellers">APPLY</button>
                </div>
            </div>
            </div>

            <!-- Search Button BELOW, Centered -->
            <div class="row mt-4">
            <div class="col text-center">
                <button class="btn-search">SEARCH</button>
            </div>
            </div>

        </div>
        </div>

    </div>

<div style="margin: 60px auto 20px auto;    color: #fff;    text-align: center;">>> Explore More >> </div>

<div class="extra-info-banner">
    <div class="extra-info-banner-btn flex gap-2"> <i class="bi bi-airplane-engines"></i> <p>Where2Go</p> </div>
    <div class="extra-info-banner-btn flex gap-2"> <i class="bi bi-airplane-engines"></i> <p>Insurance<br>For International Trips</p> </div>
    <div class="extra-info-banner-btn flex gap-2"> <i class="bi bi-airplane-engines"></i> <p>Explore International Flights<br>Cheapest Flights to Paris, Bali, Tokyo & more</p> </div>
    <div class="extra-info-banner-btn flex gap-2"> <i class="bi bi-airplane-engines"></i> <p>MICE<br>Offsites, Events & Meetings</p> </div>
    <div class="extra-info-banner-btn flex gap-2"> <i class="bi bi-airplane-engines"></i> <p>Gift Cards</p> </div>
</div>
</div>  

<div class="ad-bg-container1"></div>






<section class="offers-section card">
<div class="grid grid-2">
    <h2>Offers</h2>
<div class="offers-header">
<div class="tabs">
    <span class="tab active" onclick="showOffers('all')">All Offers</span>
    <span class="tab" onclick="showOffers('cabs')">Cabs</span>
</div>
    <a href="#" class="view-all">VIEW ALL →</a>
</div>
</div>

    <div class="grid grid-2" id="offers-container">
    <div class="offers-grid">
        <?php foreach ($offers as $offer): ?>
            <div class="offer-card">
                <img src="<?= $offer['image']; ?>" alt="<?= $offer['title']; ?>" class="offer-img">
                <div class="offer-content">
                    <span class="offer-category"><?= $offer['category']; ?></span>
                    <h3><?= $offer['title']; ?></h3>
                    <p><?= $offer['description']; ?></p>
                    <a href="<?= $offer['link']; ?>" class="book-now">BOOK NOW</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    </div>
</section>



<div style="display:flex; gap:10px; margin:50px auto; max-width:1200px;    justify-content: space-between; ">
<div class="ad-card flex gap-1"><img src="../media/Screenshot 2025-02-21 185501.png" alt=""><p>Planning to book an international flight?<br><a href="">Check Travel Guidelines</a></p></div>
<div class="ad-card flex gap-1"><img src="../media/Screenshot 2025-02-21 185501.png" alt=""><p>We are now available in हिंदी!<br><a href="">Change Language</a></p></div>
<div class="ad-card flex gap-1"><img src="../media/Screenshot 2025-02-21 185501.png" alt=""><p>Complete your web check-in on MakeMyTrip in easy steps. <br><a href="">Know More</a></p></div>
</div>



<div class="ad-bg-container container" style="margin:50px auto"></div>




<div class="flights-container container">
    <?php
    $flights = [
        ["city" => "Chennai", "via" => "Delhi, Mumbai, Coimbatore, Madurai", "image" => "../media/bg7.jpg"],
        ["city" => "Goa", "via" => "Delhi, Mumbai, Bangalore, Ahmedabad", "image" => "../media/bg7.jpg"],
        ["city" => "Mumbai", "via" => "Delhi, Bangalore, Chennai, Ahmedabad", "image" => "../media/bg7.jpg"],
        ["city" => "Hyderabad", "via" => "Chennai, Mumbai, Bangalore, Delhi", "image" => "../media/bg7.jpg"],
        ["city" => "Delhi", "via" => "Mumbai, Pune, Bangalore, Chennai", "image" => "../media/bg7.jpg"],
        ["city" => "Pune", "via" => "Delhi, Bangalore, Chennai, Ahmedabad", "image" => "../media/bg7.jpg"],
        ["city" => "Kolkata", "via" => "Delhi, Mumbai, Bangalore, Pune", "image" => "../media/bg7.jpg"],
        ["city" => "Bangalore", "via" => "Delhi, Pune, Mumbai, Kolkata", "image" => "../media/bg7.jpg"],
        ["city" => "Jaipur", "via" => "Mumbai, Delhi, Pune, Bangalore", "image" => "../media/bg7.jpg"]
    ];

    foreach ($flights as $flight) {
        echo '<div class="flight-card">
                <img src="images/' . $flight["image"] . '" alt="' . $flight["city"] . '">
                <div class="flight-info">
                    <h3>' . $flight["city"] . ' Flights</h3>
                    <p>Via - ' . $flight["via"] . '</p>
                </div>
              </div>';
    }
    ?>
</div>




<div style="max-width:1200px;margin: 50px auto;" class="terms-condition">
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


<div class="faq">

<div class="grid grid-2 container" style="padding-bottom:20px; border-bottom: 1px solid #ccc; margin-bottom:20px">
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

</div>

<!-- Include the footer -->
<?php include('../layout/footer.php'); ?>
