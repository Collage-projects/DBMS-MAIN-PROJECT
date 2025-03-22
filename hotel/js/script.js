        // DOM Elements
        const loginButton = document.getElementById('loginButton');
        const signinButton = document.getElementById('signinButton');
        const loginForm = document.getElementById('loginForm');
        const signinForm = document.getElementById('signinForm');
        const actionText = document.getElementById('actionText');
        
        // Event Listeners
        loginButton.addEventListener('click', showLoginForm);
        signinButton.addEventListener('click', showSigninForm);
        
        // Functions
        function showLoginForm() {
            // Update buttons
            loginButton.classList.add('active');
            signinButton.classList.remove('active');
            
            // Update forms
            loginForm.classList.add('active');
            signinForm.classList.remove('active');
            
            // Update text
            actionText.textContent = 'log in';
        }
        
        function showSigninForm() {
            // Update buttons
            signinButton.classList.add('active');
            loginButton.classList.remove('active');
            
            // Update forms
            signinForm.classList.add('active');
            loginForm.classList.remove('active');
            
            // Update text
            actionText.textContent = 'sign in';
        }
        
        // Form submission (prevent default behavior)
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                // Here you would typically handle form submission
                console.log('Form submitted:', this.id);
            });
        });
        document.getElementById('loginLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('signinForm').classList.remove('active');
            document.getElementById('loginForm').classList.add('active');
        });
        document.getElementById('signupLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('loginForm').classList.remove('active');
            document.getElementById('signinForm').classList.add('active');
        });