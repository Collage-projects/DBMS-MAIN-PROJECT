// JavaScript for Deluxe King Room page

// DOM Elements
const bookNowButton = document.getElementById('bookNowButton');
const bookingModal = document.getElementById('bookingModal');
const closeBtn = document.querySelector('.close-btn');
const bookingForm = document.getElementById('bookingForm');
const mainImage = document.getElementById('mainImage');

// Function to change the main image when clicking on thumbnails
function changeImage(src) {
    if (mainImage) {
        mainImage.src = src;
    }
}

// Set minimum dates for check-in and check-out
function setMinDates() {
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);
    
    const dayAfterTomorrow = new Date(today);
    dayAfterTomorrow.setDate(today.getDate() + 2);
    
    // Format dates to YYYY-MM-DD
    const formatDate = (date) => {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    };
    
    const checkIn = document.getElementById('checkIn');
    const checkOut = document.getElementById('checkOut');
    
    if (checkIn && checkOut) {
        checkIn.min = formatDate(tomorrow);
        checkIn.value = formatDate(tomorrow);
        
        checkOut.min = formatDate(dayAfterTomorrow);
        checkOut.value = formatDate(dayAfterTomorrow);
        
        // Update checkout minimum date when check-in changes
        checkIn.addEventListener('change', function() {
            const newCheckInDate = new Date(this.value);
            const newMinCheckOut = new Date(newCheckInDate);
            newMinCheckOut.setDate(newCheckInDate.getDate() + 1);
            
            checkOut.min = formatDate(newMinCheckOut);
            
            // If current checkout date is before new minimum, update it
            if (new Date(checkOut.value) <= newCheckInDate) {
                checkOut.value = formatDate(newMinCheckOut);
            }
        });
    }
}

// Open modal when Book Now button is clicked
if (bookNowButton) {
    bookNowButton.addEventListener('click', function() {
        if (bookingModal) {
            bookingModal.style.display = 'block';
            setMinDates();
        }
    });
}

// Close modal when X is clicked
if (closeBtn) {
    closeBtn.addEventListener('click', function() {
        if (bookingModal) {
            bookingModal.style.display = 'none';
        }
    });
}

// Close modal when clicking outside of it
window.addEventListener('click', function(event) {
    if (event.target === bookingModal) {
        bookingModal.style.display = 'none';
    }
});

// Handle form submission
if (bookingForm) {
    bookingForm.addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Collect form data
        const formData = new FormData(bookingForm);
        const bookingData = {};
        
        for (const [key, value] of formData.entries()) {
            bookingData[key] = value;
        }
        
        // In a real application, you would send this data to your server
        console.log('Booking data:', bookingData);
        
        // Show confirmation message
        alert('Thank you for your booking! Your reservation has been confirmed.');
        
        // Close modal
        bookingModal.style.display = 'none';
        
        // Reset form
        bookingForm.reset();
        
        // In a real application, you might redirect to a confirmation page
        // window.location.href = 'booking_confirmation.html';
    });
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Auto-rotate gallery images every 5 seconds if present
    const roomImages = document.querySelectorAll('.thumbnail-gallery img');
    
    if (mainImage && roomImages.length > 0) {
        let currentImageIndex = 0;
        const imageSources = Array.from(roomImages).map(img => img.src);
        
        setInterval(function() {
            currentImageIndex = (currentImageIndex + 1) % imageSources.length;
            mainImage.style.opacity = 0.7;
            
            setTimeout(function() {
                mainImage.src = imageSources[currentImageIndex];
                mainImage.style.opacity = 1;
            }, 300);
        }, 5000);
    }
});