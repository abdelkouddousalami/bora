function initializeCharts() {
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    padding: 20,
                    font: {
                        size: 12
                    }
                }
            }
        }
    };

    // Reservations Overview Chart
    const reservationsCtx = document.getElementById('reservationsChart');
    if (reservationsCtx) {
        new Chart(reservationsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Confirmed', 'Cancelled'],
                datasets: [{
                    data: reservationStats,
                    backgroundColor: [
                        '#d97706', // warning
                        '#059669', // success
                        '#dc2626'  // danger
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                ...chartOptions,
                cutout: '75%'
            }
        });
    }

    // Monthly Bookings Chart
    const monthlyCtx = document.getElementById('monthlyChart');
    if (monthlyCtx) {
        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: Object.keys(monthlyStats),
                datasets: [{
                    label: 'Bookings',
                    data: Object.values(monthlyStats),
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // Tour Types Chart
    const tourTypesCtx = document.getElementById('tourTypesChart');
    if (tourTypesCtx) {
        new Chart(tourTypesCtx, {
            type: 'bar',
            data: {
                labels: tourTypeLabels,
                datasets: [{
                    label: 'Bookings',
                    data: tourTypeStats,
                    backgroundColor: '#3b82f6',
                    borderRadius: 6
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
}

// Filter functionality
function initializeFilters() {
    const filterButtons = document.querySelectorAll('[data-filter]');
    const reservationRows = document.querySelectorAll('.reservation-row');

    filterButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const filter = this.dataset.filter;
            
            reservationRows.forEach(row => {
                if (filter === 'all' || 
                    row.dataset.type === filter || 
                    row.dataset.status === filter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Update active state
            filterButtons.forEach(btn => {
                btn.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
}

// Search functionality
function initializeSearch() {
    const searchInput = document.getElementById('reservationSearch');
    const reservationRows = document.querySelectorAll('.reservation-row');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            reservationRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchText) ? '' : 'none';
            });
        });
    }
}

// Initialize all dashboard features
document.addEventListener('DOMContentLoaded', function() {
    initializeFilters();
    initializeSearch();
});
