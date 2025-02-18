<!-- Include the header -->
<?php include('../layout/header.php'); ?>

<div class="bgGradient">


<div class="flight-search-container">
        <form action="search-results.php" method="GET">
            <div class="row">
                <!-- From section with search suggestions -->
                <div class="form-group">
                    <label for="from">From</label>
                    <input type="text" id="from" name="from" placeholder="Search for a city" required>
                    <div id="from-dropdown" class="dropdown-content">
                        <h5>Recent Searches</h5>
                        <p>Mumbai, India - BOM</p>
                        <p>New Delhi, India - DEL</p>
                        <p>Bangkok, Thailand - BKK</p>
                        <h5>Popular Cities</h5>
                        <p>Mumbai, India - BOM</p>
                        <p>New Delhi, India - DEL</p>
                        <p>Bangkok, Thailand - BKK</p>
                    </div>
                </div>

                <!-- To section with search suggestions -->
                <div class="form-group">
                    <label for="to">To</label>
                    <input type="text" id="to" name="to" placeholder="Search for a city" required>
                    <div id="to-dropdown" class="dropdown-content">
                        <h5>Recent Searches</h5>
                        <p>New Delhi, India - DEL</p>
                        <p>Mumbai, India - BOM</p>
                        <p>Bangkok, Thailand - BKK</p>
                        <h5>Popular Cities</h5>
                        <p>New Delhi, India - DEL</p>
                        <p>Mumbai, India - BOM</p>
                        <p>Bangkok, Thailand - BKK</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Departure Date (with calendar selection) -->
                <div class="form-group">
                    <label for="departure">Departure</label>
                    <input type="date" id="departure" name="departure" required>
                </div>

                <!-- Return Date (with calendar selection) -->
                <div class="form-group">
                    <label for="return">Return</label>
                    <input type="date" id="return" name="return">
                </div>
            </div>

            <div class="row">
                <!-- Traveler and Class Section -->
                <div class="form-group">
                    <label for="adults">Adults (12+ years)</label>
                    <input type="number" id="adults" name="adults" value="1" min="1" required>

                    <label for="toddlers">Toddlers (2-12 years)</label>
                    <input type="number" id="toddlers" name="toddlers" value="0" min="0">

                    <label for="infants">Infants (<2 years)</label>
                    <input type="number" id="infants" name="infants" value="0" min="0">
                </div>

                <!-- Travel Class Selection -->
                <div class="form-group">
                    <label for="class">Choose Travel Class</label>
                    <select name="class" id="class">
                        <option value="economy">Economy</option>
                        <option value="premium_economy">Premium Economy</option>
                        <option value="business">Business</option>
                        <option value="first_class">First Class</option>
                    </select>
                </div>
            </div>

            <!-- Special Fare Options -->
            <div class="row">
                <label>Select a special fare</label>
                <input type="radio" id="regular" name="special_fare" value="regular" checked>
                <label for="regular">Regular</label>

                <input type="radio" id="student" name="special_fare" value="student">
                <label for="student">Student</label>

                <input type="radio" id="senior" name="special_fare" value="senior">
                <label for="senior">Senior Citizen</label>

                <input type="radio" id="armed_forces" name="special_fare" value="armed_forces">
                <label for="armed_forces">Armed Forces</label>

                <input type="radio" id="doctor_nurse" name="special_fare" value="doctor_nurse">
                <label for="doctor_nurse">Doctor and Nurses</label>
            </div>

            <!-- Search Button -->
            <div class="row">
                <button type="submit" class="btn-search">Search</button>
            </div>
        </form>
    </div>

    <script>
        // jQuery for showing and hiding dropdowns for From and To sections
        $('#from').on('focus', function() {
            $('#from-dropdown').show();
        });
        $('#to').on('focus', function() {
            $('#to-dropdown').show();
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('#from').length) {
                $('#from-dropdown').hide();
            }
            if (!$(e.target).closest('#to').length) {
                $('#to-dropdown').hide();
            }
        });
    </script>


</div>

<div style="min-height:100vh"></div>

<style>

.bgGradient{
background: #f2f2f2;
background-repeat: no-repeat;
background-image: url(../media/bg7.jpg), linear-gradient(to bottom, #051322, #15457c);
min-height: 500px;
transition: background 0.1s linear;
margin: -100px 0 0 0;
}

.nav-menu-home{
    background: #fff;
    max-width: 1000px;
    margin: auto;
    box-shadow: 1px 1px 10px #6a6a6a45;
    border-radius: 20px;
    padding: 20px 10px;
    display: flex;
    gap: 20px;
    justify-content: space-around;
    position: relative;
    z-index: 9;
}

.flight-search-container {
    max-width: 1200px;
    margin: 50px auto;
    background-color: #fff;
    padding: 100px 30px 30px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    position: relative;
    top: 180px;
}

h1 {
    text-align: center;
    margin-bottom: 40px;
}

.row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    flex: 1;
    min-width: 250px;
    margin-bottom: 15px;
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 8px;
    color: #333;
}

input[type="text"], input[type="date"], select, input[type="number"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="radio"] {
    margin-right: 10px;
}

button[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: #fff;
    font-size: 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Dropdown */
#from-dropdown, #to-dropdown {
    display: none;
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    border-radius: 5px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin-top: 5px;
    z-index: 9999;
}

#from-dropdown p, #to-dropdown p {
    padding: 10px;
    margin: 0;
    cursor: pointer;
}

#from-dropdown p:hover, #to-dropdown p:hover {
    background-color: #f0f0f0;
}

/* Special Fare Section */
.special-fare label {
    margin-right: 15px;
}

.special-fare input[type="radio"] {
    margin-right: 5px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .row {
        flex-direction: column;
    }

    .form-group {
        width: 100%;
    }

    button[type="submit"] {
        padding: 15px;
        font-size: 16px;
    }
}

</style>

<!-- Include the footer -->
<?php include('../layout/footer.php'); ?>
