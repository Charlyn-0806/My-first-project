document.getElementById("subscribe-form").addEventListener("submit", function(event) {
    event.preventDefault();
    
    let email = document.getElementById("email").value;
    let message = document.getElementById("message");

    if (validateEmail(email)) {
        message.style.color = "green";
        message.innerHTML = "✅ Subscribed successfully!";
        document.getElementById("email").value = "";  // Clear input
    } else {
        message.style.color = "red";
        message.innerHTML = "❌ Please enter a valid email!";
    }
});

// Email validation function
function validateEmail(email) {
    let re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
