        // Add hover effects to room cards
        document.querySelectorAll('.room-card').forEach(card => {
            card.addEventListener('mouseover', function() {
                this.style.transform = 'translateY(-10px)';
                this.style.boxShadow = '0 15px 30px rgba(0, 0, 0, 0.15)';
                this.querySelector('.room-image').style.transform = 'scale(1.05)';
            });
            
            card.addEventListener('mouseout', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
                this.querySelector('.room-image').style.transform = '';
            });
            
            // Add click event to view details buttons
            card.querySelector('.action-button').addEventListener('click', function(e) {
                e.stopPropagation();
                const roomNumber = this.closest('.room-card').querySelector('.room-number').textContent;
                alert(`Viewing details for ${roomNumber}`);
            });
            
            // Add click event to the entire card
            card.addEventListener('click', function() {
                const roomNumber = this.querySelector('.room-number').textContent;
                alert(`Viewing details for ${roomNumber}`);
            });
        });