
/* add code here  */
document.addEventListener("DOMContentLoaded", function() {

    const hilightableElements = document.querySelectorAll('.hilightable');

    hilightableElements.forEach(function(element) {
        // Toggle the 'highlight' class when the element gains focus
        element.addEventListener('focus', function() {
            this.classList.toggle('highlight');
        });

        // Toggle the 'highlight' class when the element loses focus
        element.addEventListener('blur', function() {
            this.classList.toggle('highlight');
        });
    });

    const form = document.getElementById('mainForm');
    const requiredElements = document.querySelectorAll('.required');

    form.addEventListener('submit', function(event) {
        let hasEmptyFields = false;

        requiredElements.forEach(function(element) {
            // Check if the required field is empty 
            if (element.value.trim() === '') {
                element.classList.add('error');
                hasEmptyFields = true;
            }
        });

        // Cancel the form submission if any required field is empty
        if (hasEmptyFields) {
            event.preventDefault();
        }
    });

 
    requiredElements.forEach(function(element) {
        // The 'input' event triggers immediately as the user types
        element.addEventListener('input', function() {
            this.classList.remove('error');
        });
        
        // Also handling 'change' for wider compatibility (e.g., dropdowns)
        element.addEventListener('change', function() {
            this.classList.remove('error');
        });
    });

});