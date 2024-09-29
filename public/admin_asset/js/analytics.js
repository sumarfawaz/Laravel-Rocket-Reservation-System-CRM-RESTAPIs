function loadNationalityChart() {
    // Fetch customer analytics data from the server
    fetch('/analytics/customers')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const ctx = document.getElementById('nationality-chart').getContext('2d');

            // Prepare labels and data from the received object
            const labels = Object.keys(data); // Nationality names
            const counts = Object.values(data); // Corresponding counts

            // Log the fetched data for debugging
            console.log('Fetched Data:', data);

            // Generate background colors dynamically based on the length of the data
            const rainbowColors = [
                'rgba(255, 0, 0, 0.5)', // Red
                'rgba(255, 127, 0, 0.5)', // Orange
                'rgba(255, 255, 0, 0.5)', // Yellow
                'rgba(0, 255, 0, 0.5)', // Green
                'rgba(0, 0, 255, 0.5)', // Blue
                'rgba(75, 0, 130, 0.5)', // Indigo
                'rgba(148, 0, 211, 0.5)' // Violet
            ];

            // Dynamically map the colors to the number of items
            const backgroundColors = Array.from({ length: counts.length }, (_, index) => rainbowColors[index % rainbowColors.length]);

            // Create the chart
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // Nationality names
                    datasets: [{
                        label: 'Customers by Nationality',
                        data: counts, // Corresponding counts
                        backgroundColor: backgroundColors, // Dynamically generated background colors
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                stepSize: 1,
                                beginAtZero: true,
                            },
                        }],
                        xAxes: [{
                            ticks: {
                                stepSize: 1,
                                beginAtZero: true,
                            },
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching analytics data:', error);
        });
}

// Event listener to load the chart after the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    loadNationalityChart(); // Call the function to load and display the chart
});
