// Function to handle the overflow of navigation items
function handleNavOverflow() {
    const navbar = document.querySelector(".navbar_inner_nav");
    const moreDropdown = document.querySelector(".more-dropdown");
    const moreMenu = document.getElementById("moreMenu");
    
    // Exclude the more-dropdown itself from nav items selection
    const navItems = [...document.querySelectorAll(".navbar .nav-menu > li.nav-item:not(.more-dropdown)")];
    
  
    let navbarWidth = navbar.clientWidth;
    // Start with the width of the moreDropdown (if visible) as used space
    let usedSpace = moreDropdown.clientWidth;
    let itemsMoved = false;
  
    // Reset More Menu
    moreMenu.innerHTML = "";
  
    // Calculate space used by elements other than the nav-menu
    let otherElements = [...navbar.children].filter(el => !el.classList.contains("nav-menu"));
    otherElements.forEach(el => {
        usedSpace += el.getBoundingClientRect().width;
    });
  
    let availableSpace = navbarWidth - usedSpace;
    let totalWidth = 0;
  
    navItems.forEach((item, index) => {
        // Reset display in case it was hidden previously
        item.style.display = "inline-block";
        totalWidth += item.offsetWidth;
  
        if (totalWidth > availableSpace) {
            itemsMoved = true;
            // Hide item from main navbar
            item.style.display = "none";
  
            // Clone and display the item in the More dropdown
            let clone = item.cloneNode(true);
            clone.style.display = "block";
  
            // Add a unique data attribute if not already present
            if (!moreMenu.querySelector(`[data-id="item-${index}"]`)) {
                clone.dataset.id = `item-${index}`;
                moreMenu.appendChild(clone);
            }
        }
    });
  
    // Show/Hide "More" dropdown based on whether any items were moved
    moreDropdown.style.display = itemsMoved ? "block" : "none";
  
    // Hide More dropdown if there are no items to show
    if (moreMenu.children.length === 0) {
      moreDropdown.style.display = "none";
    }
  
    // Prevent horizontal scrolling if content overflows
    if (navbar.scrollWidth > navbar.clientWidth) {
        // navbar.style.overflowX = "";
    } else {
        // navbar.style.overflowX = "";
    }
  }
  
  // Attach dropdown and sticky navbar event listeners once on DOM load
  document.addEventListener("DOMContentLoaded", () => {
    const moreDropdown = document.querySelector(".more-dropdown");
    const dropdownContent = moreDropdown.querySelector('.dropdown-content-nav');
    const dropdownButton = moreDropdown.querySelector('.dropdown-button');
    
    // Toggle dropdown content when the dropdown button is clicked
    if (dropdownButton && dropdownContent) {
      dropdownButton.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownContent.classList.toggle('show');
      });
    }
    
    // Initial call to position nav items correctly
    handleNavOverflow();
  });
  
  // Attach handleNavOverflow on window events
  window.addEventListener("resize", handleNavOverflow);
  window.addEventListener("load", handleNavOverflow);
  window.addEventListener("click", handleNavOverflow);
  window.addEventListener("scroll", handleNavOverflow);
  
  
  
  // character limit
  document.addEventListener("DOMContentLoaded", function() {
      document.querySelectorAll(".nav-item a").forEach(function(item) {
          let icon = item.querySelector("i");  // Get the <i> icon
          let textNode = item.childNodes[1];  // Get the text after the icon
  
          if (textNode && textNode.nodeType === 3) {  // Ensure it's a text node
              let text = textNode.nodeValue.trim();
              if (text.length > 10) {
                  textNode.nodeValue = text.substring(0, 10) + "...";
              }
          }
      });
  });
  
  
  
  
  
  // Generic Dropdown Handler
  document.querySelectorAll('.generic-dropdown').forEach(dropdown => {
      const button = dropdown.querySelector('.dropdown-button');
      const content = dropdown.querySelector('.dropdown-content');
      
      button.addEventListener('click', () => content.classList.toggle('show'));
      document.addEventListener('click', (e) => {
          if (!dropdown.contains(e.target)) content.classList.remove('show');
      });
  });
  
  
  // Function to load saved selections from sessionStorage
  function loadSavedSelections() {
      // Load Country (Only Flag)
      if (sessionStorage.getItem("selectedCountry")) {
          let tempDiv = document.createElement("div");
          tempDiv.innerHTML = sessionStorage.getItem("selectedCountry");
          let flagImg = tempDiv.querySelector("img") ? tempDiv.querySelector("img").outerHTML : sessionStorage.getItem("selectedCountry");
  
          document.querySelectorAll("#selectedCountry").forEach(el => {
              el.innerHTML = flagImg + " ▼"; // Only show flag
          });
      }
  
      // Load Language (First 3 Characters)
      if (sessionStorage.getItem("selectedLanguage")) {
          document.querySelectorAll("#selectedLanguage").forEach(el => {
              el.innerHTML = sessionStorage.getItem("selectedLanguage").substring(0, 3).toUpperCase() + " ▼";
          });
      }
  
      // Load Currency (Only 3-letter Code)
      if (sessionStorage.getItem("selectedCurrency")) {
          let storedCurrency = sessionStorage.getItem("selectedCurrency");
          let currencyCode = storedCurrency.match(/\b[A-Z]{3}\b/) ? storedCurrency.match(/\b[A-Z]{3}\b/)[0] : storedCurrency;
  
          document.querySelectorAll("#selectedCurrency").forEach(el => {
              el.innerHTML = currencyCode + " ▼"; // Show only currency code
          });
      }
  }
  
  // Function to update selections and store in sessionStorage
  function updateSelection(type, value) {
      let formattedValue = value;
  
      if (type === "selectedCountry") {
          // Extract only the flag
          let tempDiv = document.createElement("div");
          tempDiv.innerHTML = value;
          let flagImg = tempDiv.querySelector("img") ? tempDiv.querySelector("img").outerHTML : value;
          formattedValue = flagImg; // Only show flag
      } 
      else if (type === "selectedLanguage") {
          formattedValue = value.substring(0, 3).toUpperCase(); // First 3 letters
      } 
      else if (type === "selectedCurrency") {
          // Extract only currency code
          formattedValue = value.match(/\b[A-Z]{3}\b/) ? value.match(/\b[A-Z]{3}\b/)[0] : value;
      }
  
      sessionStorage.setItem(type, formattedValue);
      document.querySelectorAll(`#${type}`).forEach(el => {
          el.innerHTML = formattedValue + " ▼";
      });
  }
  
  // Currency Search Functionality
  document.getElementById("searchCurrency")?.addEventListener("input", (e) => {
      const filter = e.target.value.toLowerCase();
      document.querySelectorAll(".currency-item").forEach(item => {
          item.style.display = item.innerText.toLowerCase().includes(filter) ? "" : "none";
      });
  });
  
  // Update Dropdown Selection & Store in Session
  document.querySelectorAll(".country-item, .currency-item, [data-lang]").forEach(item => {
      item.addEventListener("click", (e) => {
          const dropdown = e.target.closest('.generic-dropdown');
          const button = dropdown.querySelector('.dropdown-button');
          const type = button.id;
  
          let value;
  
          if (item.classList.contains("country-item")) {
              // Extract only the flag image for country selection
              let flagImg = item.querySelector("img") ? item.querySelector("img").outerHTML : "";
              value = flagImg;
          } 
          else if (item.hasAttribute("data-lang")) {
              // Take the first 3 characters of the full language name and convert to uppercase
              value = item.innerText.substring(0, 3).toUpperCase();
          } 
          else if (item.hasAttribute("data-currency")) {
              // Extract currency code
              value = item.dataset.currency;
          } 
          else {
              value = item.innerHTML;
          }
  
          updateSelection(type, value);
  
          // Ensure only the selected dropdown updates
          button.innerHTML = value + " ▼";
  
          // Close the dropdown
          dropdown.querySelector('.dropdown-content').classList.remove('show');
      });
  });
  
  
  
  
  // Load saved selections on page load
  window.addEventListener("DOMContentLoaded", loadSavedSelections);
  
  
  