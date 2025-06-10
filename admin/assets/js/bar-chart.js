document.addEventListener('DOMContentLoaded', function () {
  
    const ctx = document.getElementById('barChart').getContext('2d');

    const barChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Hostinger', 'GitHub', 'GoogleHost', 'Netlify', 'FireBase',],
        datasets: [{
        label: 'Number of Domains',
        data: [20, 12, 8, 10, 5],
        backgroundColor: [
            '#6366F1', // Indigo
            '#F97316', // Orange
            '#10B981', // Green
            '#8B5CF6', // Purple
            '#F43F5E'  // Rose
        ],
        borderRadius: 0,
        barThickness: 80
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: {
            display: true,
            labels: {
            color: '#374151', // Slate-700
            font: {
                size: 13,
                family: 'Arial'
            }
            }
        },
        tooltip: {
            enabled: true,
            callbacks: {
            label: function(context) {
                return `${context.parsed.y} domains`;
            }
            }
        }
        },
        scales: {
        y: {
            beginAtZero: true,
            ticks: {
            color: '#6B7280', // Slate-500
            stepSize: 5
            },
            grid: {
            color: '#ffffff', // Light gray
            borderDash: [5, 5]
            }
        },
        x: {
            ticks: {
            color: '#6B7280',
            },
            grid: {
            display: false,
            color: '#ffffff', // Light gray
            }
        }
        }
    }
    });




});










