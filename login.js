// Login Form Handler
document.addEventListener('DOMContentLoaded', function() {
    // Check if using file:// protocol
    if (window.location.protocol === 'file:') {
        showMessage('ERROR: You must use http://localhost. Please set up your local server.', 'error');
        return;
    }
    
    const loginForm = document.getElementById('loginForm');
    const messageDiv = document.getElementById('message');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Check protocol before submitting
            if (window.location.protocol === 'file:') {
                showMessage('ERROR: You must use http://localhost (not file://). Please set up your server.', 'error');
                return;
            }
            
            const formData = new FormData(this);
            
            // Client-side validation
            const email = formData.get('email');
            const password = formData.get('password');
            
            if (!email || !isValidEmail(email)) {
                showMessage('Please enter a valid email address', 'error');
                return;
            }
            
            if (!password) {
                showMessage('Password is required', 'error');
                return;
            }
            
            if (password.length < 6) {
                showMessage('Password must be at least 6 characters', 'error');
                return;
            }
            
            // Disable submit button during processing
            const submitBtn = loginForm.querySelector('.submit_btn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Logging in...';
            
            // Log for debugging
            console.log('Login form submitted');
            console.log('Email:', email);
            
            // Send to server
            fetch('process_login.php', {
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
                        showMessage(data.message + ' Redirecting...', 'success');
                        loginForm.reset();
                        
                        // Redirect after 2 seconds
                        setTimeout(function() {
                            window.location.href = 'dashboard.php';
                        }, 2000);
                    } else {
                        showMessage(data.message, 'error');
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Login';
                    }
                } catch (e) {
                    console.error('JSON Parse Error:', e);
                    console.error('Response text:', text);
                    showMessage('Server error: ' + text, 'error');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Login';
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                showMessage('Network error. Make sure your server is running.', 'error');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Login';
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
    }
}
