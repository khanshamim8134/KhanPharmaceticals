// Sign Up Form Handler
document.addEventListener('DOMContentLoaded', function() {
    // Check if using file:// protocol
    if (window.location.protocol === 'file:') {
        const setupInstructions = document.getElementById('setupInstructions');
        if (setupInstructions) {
            setupInstructions.style.display = 'block';
        }
        console.warn('Warning: Using file:// protocol. Please use http://localhost');
    }
    
    const signupForm = document.getElementById('signupForm');
    const messageDiv = document.getElementById('message');
    
    if (signupForm) {
        signupForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Check protocol before submitting
            if (window.location.protocol === 'file:') {
                showMessage('ERROR: You must use http://localhost (not file://). Please set up XAMPP. See XAMPP_SETUP.txt for instructions.', 'error');
                return;
            }
            
            const formData = new FormData(this);
            
            // Client-side validation
            const firstName = formData.get('firstName');
            const lastName = formData.get('lastName');
            const email = formData.get('email');
            const userType = formData.get('userType');
            const password = formData.get('password');
            const confirmPassword = formData.get('confirmPassword');
            
            if (!firstName || !lastName) {
                showMessage('First Name and Last Name are required', 'error');
                return;
            }
            
            if (!isValidEmail(email)) {
                showMessage('Please enter a valid email address', 'error');
                return;
            }
            
            if (!userType) {
                showMessage('Please select a User Type', 'error');
                return;
            }
            
            if (password.length < 6) {
                showMessage('Password must be at least 6 characters', 'error');
                return;
            }
            
            if (password !== confirmPassword) {
                showMessage('Passwords do not match', 'error');
                return;
            }
            
            // Disable submit button during processing
            const submitBtn = signupForm.querySelector('.submit_btn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Processing...';
            
            // Determine the correct path to the PHP file
            let phpFile = 'process_signup.php';
            
            // Log for debugging
            console.log('Form submitted');
            console.log('Current URL:', window.location.href);
            console.log('PHP file path:', phpFile);
            
            // Send to server
            fetch(phpFile, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error('Server responded with status: ' + response.status);
                }
                return response.text();
            })
            .then(text => {
                console.log('Response text:', text);
                try {
                    const data = JSON.parse(text);
                    console.log('Parsed JSON:', data);
                    
                    if (data.status === 'success') {
                        showMessage(data.message, 'success');
                        signupForm.reset();
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Sign Up';
                        
                        // Redirect after 2 seconds
                        setTimeout(function() {
                            window.location.href = 'Project.html';
                        }, 2000);
                    } else {
                        showMessage(data.message, 'error');
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Sign Up';
                    }
                } catch (e) {
                    console.error('JSON Parse Error:', e);
                    console.error('Response text:', text);
                    showMessage('Server error: ' + text, 'error');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Sign Up';
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                console.error('Error stack:', error.stack);
                showMessage('Network error: Make sure you are running a local server (XAMPP, WAMP, etc.) and access via http://localhost not file://', 'error');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Sign Up';
            });
        });
    }
});

// Email validation function
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Show message function
function showMessage(message, type) {
    const messageDiv = document.getElementById('message');
    if (messageDiv) {
        messageDiv.innerHTML = message;
        messageDiv.className = 'message ' + type;
        
        // Scroll to message
        messageDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Auto hide success message after 3 seconds
        if (type === 'success') {
            setTimeout(function() {
                messageDiv.className = 'message';
            }, 3000);
        }
    }
}
