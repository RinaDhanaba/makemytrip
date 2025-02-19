// Airport Data
const airports = [
    { city: "Mumbai", country: "India", code: "BOM", airport: "Chhatrapati Shivaji International Airport" },
    { city: "New Delhi", country: "India", code: "DEL", airport: "Indira Gandhi International Airport" },
    { city: "Bangkok", country: "Thailand", code: "BKK", airport: "Suvarnabhumi Airport" },
    { city: "Dubai", country: "UAE", code: "DXB", airport: "Dubai International Airport" }
];

// Filter dropdown based on input
function filterOptions(inputId, dropdownId) {
    let input = document.getElementById(inputId).value.toLowerCase();
    let dropdown = document.getElementById(dropdownId);
    dropdown.innerHTML = ""; // Clear previous results

    if (input.length > 0) {
        let filtered = airports.filter(a => 
            a.city.toLowerCase().includes(input) || 
            a.code.toLowerCase().includes(input) ||
            a.airport.toLowerCase().includes(input)
        );

        filtered.forEach(a => {
            let option = document.createElement("div");
            option.classList.add("dropdown-item");
            option.innerHTML = `<b>${a.city}, ${a.country}</b> (${a.code})<br><small>${a.airport}</small>`;
            option.onclick = () => {
                document.getElementById(inputId).value = `${a.city}, ${a.country} (${a.code})`;
                dropdown.innerHTML = "";
            };
            dropdown.appendChild(option);
        });
    }
}

// Swap From & To Values (One Way)
function swapValues() {
    let fromInput = document.getElementById("from-input");
    let toInput = document.getElementById("to-input");
    [fromInput.value, toInput.value] = [toInput.value, fromInput.value];
}

// Swap From & To Values (Round Trip)
function swapValuesRT() {
    let fromInput = document.getElementById("from-input-rt");
    let toInput = document.getElementById("to-input-rt");
    [fromInput.value, toInput.value] = [toInput.value, fromInput.value];
}

// Toggle Sections
function switchTab(tabId) {
    document.getElementById('one-way').style.display = (tabId === 'one-way') ? 'block' : 'none';
    document.getElementById('round-trip').style.display = (tabId === 'round-trip') ? 'block' : 'none';
    document.getElementById('multi-city').style.display = (tabId === 'multi-city') ? 'block' : 'none';
}

// Add Multi-City Row
function addCity() {
    let container = document.getElementById('multi-city-container');
    let newRow = document.createElement("div");
    newRow.classList.add("multi-city-row");
    newRow.innerHTML = `<input type="text" placeholder="From" name="multi_from[]" required>
                        <input type="text" placeholder="To" name="multi_to[]" required>
                        <input type="date" name="multi_departure[]" required>`;
    container.appendChild(newRow);
}
