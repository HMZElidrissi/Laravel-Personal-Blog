(function() {
  "use strict"; // Start of use strict

  var mainNav = document.querySelector('#mainNav');

  if (mainNav) {

    // Collapse Navbar
    var collapseNavbar = function() {

      var scrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;

      if (scrollTop > 100) {
        mainNav.classList.add("navbar-shrink");
      } else {
        mainNav.classList.remove("navbar-shrink");
      }
    };
    // Collapse now if page is not at top
    collapseNavbar();
    // Collapse the navbar when page is scrolled
    document.addEventListener("scroll", collapseNavbar);
  }

})(); // End of use strict

// Function to perform the search
function performSearch() {
    const searchText = document.getElementById("searchInput").value;
    // Your search logic goes here (e.g., display search results, filter items, etc.)
    console.log("Search performed with text:", searchText);
}

// Variables to hold timer and delay time
let timerId;
const delayTime = 1000; // Set the delay time in milliseconds (1 second in this example)

// Event listener for the search input field
document.getElementById("searchInput").addEventListener("input", function () {
    // Clear the previous timer
    clearTimeout(timerId);

    // Set a new timer to trigger the search after the specified delay
    timerId = setTimeout(performSearch, delayTime);
});
