// Initialize charts
function initializeCharts() {
    const reservationsCtx = document.getElementById('reservationsChart');
    if (reservationsCtx) {
        new Chart(reservationsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Confirmed', 'Cancelled'],
                datasets: [{
                    data: [
                        parseInt(reservationsCtx.dataset.pending),
                        parseInt(reservationsCtx.dataset.confirmed),
                        parseInt(reservationsCtx.dataset.cancelled)
                    ],
                    backgroundColor: ['#ffc107', '#28a745', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
}

// Handle reservation status updates
document.addEventListener('DOMContentLoaded', function() {
    // Initialize charts
    initializeCharts();

    // Add event listeners for status changes
    const statusSelects = document.querySelectorAll('.status-select');
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            const form = this.closest('form');
            const row = this.closest('tr');
            
            form.submit();
        });
    });

    // Initialize search functionality
    const searchInput = document.getElementById('reservationSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('.reservation-row');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchValue) ? '' : 'none';
            });
        });
    }

    // Add animation to stats cards
    const statsCards = document.querySelectorAll('.stats-card');
    statsCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
