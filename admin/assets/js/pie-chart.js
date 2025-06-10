// pie chart
document.addEventListener('DOMContentLoaded', function () {
  
    const ctx = document.getElementById('domainStatusChart').getContext('2d');

    const domainStatusChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Active', 'Expiring Soon', 'Expired'],
        datasets: [{
        label: 'Domain Status',
        data: [45, 10, 5], // Update these numbers dynamically
        backgroundColor: [
            '#0a8a5f', // Green - Active
            '#FF681E', // Yellow - Expiring Soon
            '#D3212C'  // Red - Expired
        ],
        borderColor: '#e6e6eb',
        borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
        tooltip: {
            callbacks: {
            label: function(context) {
                const label = context.label || '';
                const value = context.parsed || 0;
                return `${label}: ${value} domains`;
            }
            }
        }
        }
    }
    });




});





