// Attach event listener to form submission
document.querySelector('.form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form from submitting and reloading the page
  
    // Get the form data
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;
  
    // Simple form validation (ensure fields aren't empty)
    if (!name || !email || !message) {
      document.getElementById('response').innerHTML = 'All fields are required!';
      document.getElementById('response').classList.add('show');
      return;
    }
  
    // If validation passes, simulate a success message
    document.getElementById('response').innerHTML = 'Thank you for your message, ' + name + '! We will get back to you soon.';
    document.getElementById('response').classList.add('show');
  
    // Clear the form after submission
    document.querySelector('.form').reset();

    // Hide the response after 5 seconds
    setTimeout(function() {
      document.getElementById('response').classList.remove('show');
    }, 5000); // Hide after 5 seconds
});

// Close button functionality
document.getElementById('response').addEventListener('click', function(event) {
    if (event.target.classList.contains('close-btn')) {
        document.getElementById('response').classList.remove('show');
    }
});
