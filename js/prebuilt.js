        // Get all buttons with class "btn-outline-secondary"
        var viewButtons = document.querySelectorAll('.btn-outline-secondary');

        // Loop through each button and add event listener
        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Toggle the full-screen-card class on the parent card element
                var card = this.closest('.card');
                card.classList.toggle('full-screen-card');
            });
        });