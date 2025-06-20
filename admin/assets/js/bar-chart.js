
// Function to update the theme (light and dark mode) of the bar chart
function updateChartTheme() {
    const newOptions = getChartOptions();
    const chart = window.barChart;
    if (!chart) return;

    // Update legend and tooltip
    Object.assign(chart.options.plugins.legend.labels, newOptions.plugins.legend.labels);
    Object.assign(chart.options.plugins.tooltip, newOptions.plugins.tooltip);

    // Update scales
    Object.assign(chart.options.scales.y.ticks, newOptions.scales.y.ticks);
    Object.assign(chart.options.scales.y.grid, newOptions.scales.y.grid);
    Object.assign(chart.options.scales.y.border, newOptions.scales.y.border);

    Object.assign(chart.options.scales.x.ticks, newOptions.scales.x.ticks);
    Object.assign(chart.options.scales.x.grid, newOptions.scales.x.grid);

    chart.update();
}




// setting the dark and light mode of the bar chart. to be called later
function getChartOptions() {
  const isDark = document.documentElement.classList.contains("dark-theme-variables");

  return {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: true,
        labels: {
          color: isDark ? '#F3F4F6' : '#374151', 
          font: {
            size: 13,
            family: 'Arial'
          }
        }
      },
      tooltip: {
        enabled: true,
        backgroundColor: isDark ? '#1F2937' : '#F9FAFB', 
        titleColor: isDark ? '#F3F4F6' : '#111827', 
        bodyColor: isDark ? '#D1D5DB' : '#4B5563',
        callbacks: {
          label: function (context) {
            return `${context.parsed.y} domains`;
          }
        }
      }
    },
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
            color: isDark ? '#9CA3AF' : '#6B7280',
            stepSize: 5
        },
        grid: {
            color: isDark ? '#edeffd' : '#363949',
            borderDash: [5, 5],
            drawBorder: true,
        },
        border: {
            display: true,
            color: isDark ? '#edeffd' : '#363949' 
        }
        },
        x: {
            ticks: {
                color: isDark ? '#9CA3AF' : '#6B7280'
            },
            grid: {
                display: false,
                drawBorder: true,
                borderColor: isDark ? '#9CA3AF' : '#6B7280'
            }
        }
    }
  };
}




// create actual barchart to be displayed 
document.addEventListener('DOMContentLoaded', function () {
  const ctx = document.getElementById('barChart').getContext('2d');

  window.barChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Hostinger', 'GitHub', 'GoogleHost', 'Netlify', 'FireBase'],
      datasets: [{
        label: 'Number of Domains',
        data: [20, 12, 8, 10, 5],
        backgroundColor: [
          '#6366F1', '#F97316', '#10B981', '#8B5CF6', '#F43F5E'
        ],
        borderRadius: 0,
        barThickness: 80
      }]
    },
    options: getChartOptions()
  });
});




















