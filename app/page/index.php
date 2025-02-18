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
}
</style>

<!-- Include the footer -->
<?php include('../layout/footer.php'); ?>
