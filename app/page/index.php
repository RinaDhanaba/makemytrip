<!-- Include the header -->
<?php include('../layout/header.php'); ?>

<div class="bgGradient">

<div class="flight-search-container">

<style>
.tab {
    display: inline-block;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    margin: 5px;
    background-color: #e0e0e0;
}
.tab.active {
    background-color: #007bff;
    color: white;
}
.form-section {
    display: none;
}
.form-section.active {
    display: block;
}
.fare-options label {
    margin: 5px;
    display: inline-block;
    padding: 5px 10px;
    border: 1px solid #007bff;
    border-radius: 5px;
    cursor: pointer;
}
.fare-options input {
    display: none;
}
.fare-options input:checked + label {
    background-color: #007bff;
    color: white;
}
.search-btn {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}
</style>
<script>
function showTab(tab) {
    document.querySelectorAll('.tab').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.form-section').forEach(el => el.classList.remove('active'));
    document.getElementById(tab).classList.add('active');
    document.getElementById(tab + '-form').classList.add('active');
}
</script>
<script>
    function addCity() {
        let form = document.getElementById('multicity-form');
        let newField = document.createElement('div');
        newField.innerHTML = `<label>From: <input type="text" name="from[]" placeholder="Enter City"></label>
                              <label>To: <input type="text" name="to[]" placeholder="Enter City"></label>
                              <label>Departure Date: <input type="date" name="departure[]"></label><br><br>`;
        form.insertBefore(newField, form.lastElementChild.previousElementSibling);
    }
</script>

<div class="container">
    <!-- Trip Type Tabs -->
    <div>
        <div class="tab active" onclick="showTab('oneway')">One Way</div>
        <div class="tab" onclick="showTab('roundtrip')">Round Trip</div>
        <div class="tab" onclick="showTab('multicity')">Multi City</div>
    </div>

    <?php
    // Fare Options Array
    $fare_options = [
        "Regular" => "Regular fares",
        "Student" => "Extra discounts/baggage",
        "Senior Citizen" => "Up to AED 25.47 off",
        "Armed Forces" => "Up to AED 25.47 off",
        "Doctor and Nurses" => "Up to AED 25.47 off"
    ];
    ?>

    <!-- One Way Form -->
    <div id="oneway-form" class="form-section active">
        <h3>One Way Flight</h3>
        <form method="POST">
            <label>From: <input type="text" name="from" placeholder="Enter Departure City"></label><br><br>
            <label>To: <input type="text" name="to" placeholder="Enter Destination City"></label><br><br>
            <label>Departure Date: <input type="date" name="departure"></label><br><br>

            <!-- Fare Selection -->
            <div class="fare-options">
                <?php foreach ($fare_options as $key => $desc): ?>
                    <input type="radio" id="<?= strtolower(str_replace(' ', '_', $key)) ?>" name="fare" value="<?= $key ?>">
                    <label for="<?= strtolower(str_replace(' ', '_', $key)) ?>"><?= $key ?> (<?= $desc ?>)</label>
                <?php endforeach; ?>
            </div>

            <br><br>
            <button type="submit" class="search-btn">SEARCH</button>
        </form>
    </div>

    <!-- Round Trip Form -->
    <div id="roundtrip-form" class="form-section">
        <h3>Round Trip Flight</h3>
        <form method="POST">
            <label>From: <input type="text" name="from" placeholder="Enter Departure City"></label><br><br>
            <label>To: <input type="text" name="to" placeholder="Enter Destination City"></label><br><br>
            <label>Departure Date: <input type="date" name="departure"></label><br><br>
            <label>Return Date: <input type="date" name="return"></label><br><br>

            <!-- Fare Selection -->
            <div class="fare-options">
                <?php foreach ($fare_options as $key => $desc): ?>
                    <input type="radio" id="<?= strtolower(str_replace(' ', '_', $key)) ?>_round" name="fare" value="<?= $key ?>">
                    <label for="<?= strtolower(str_replace(' ', '_', $key)) ?>_round"><?= $key ?> (<?= $desc ?>)</label>
                <?php endforeach; ?>
            </div>

            <br><br>
            <button type="submit" class="search-btn">SEARCH</button>
        </form>
    </div>

    <!-- Multi-City Form -->
    <div id="multicity-form" class="form-section">
        <h3>Multi-City Flight</h3>
        <form method="POST">
            <?php
            // Array of Multi-City Flights
            $multi_cities = [
                ["from" => "Delhi", "to" => "Bengaluru"],
                ["from" => "Bengaluru", "to" => "Select City"]
            ];
            ?>
            
            <?php foreach ($multi_cities as $index => $flight): ?>
                <label>From: <input type="text" name="from[]" value="<?= $flight['from'] ?>"></label>
                <label>To: <input type="text" name="to[]" value="<?= $flight['to'] ?>"></label>
                <label>Departure Date: <input type="date" name="departure[]"></label><br><br>
            <?php endforeach; ?>

            <button type="button" onclick="addCity()">+ ADD ANOTHER CITY</button><br><br>

            <!-- Fare Selection -->
            <div class="fare-options">
                <?php foreach ($fare_options as $key => $desc): ?>
                    <input type="radio" id="<?= strtolower(str_replace(' ', '_', $key)) ?>_multi" name="fare" value="<?= $key ?>">
                    <label for="<?= strtolower(str_replace(' ', '_', $key)) ?>_multi"><?= $key ?> (<?= $desc ?>)</label>
                <?php endforeach; ?>
            </div>

            <br><br>
            <button type="submit" class="search-btn">SEARCH</button>
        </form>
    </div>
</div>

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

</style>

<!-- Include the footer -->
<?php include('../layout/footer.php'); ?>
