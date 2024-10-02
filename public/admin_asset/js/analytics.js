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

function updateTotalUsers() {
    // Fetch the total customer count from the server
    fetch('/analytics/total-customers')
        .then(response => response.json()) // Parse the JSON from the response
        .then(data => {
            // Check if we got the total_customers value from the server
            if (data.total_customers !== undefined) {
                // Update the "Total Users" value in the card
                document.getElementById('total-users-count').innerText = data.total_customers;
            } else {
                console.error("Total users data not found in the response.");
            }
        })
        .catch(error => {
            console.error('Error fetching total users data:', error);
        });
}

function updateTotalRockets(){
    fetch('/analytics/total_rockets')
    .then(response => response.json())
    .then(data => {
        if (data.total_rockets !== undefined) {
            document.getElementById('total-rockets-html').innerText = data.total_rockets;
        } else {
            console.error("Total rockets data not found in the response."); 
        }
    })
    .catch(error =>{
        console.error('Error fetching total rockets data:', error);
    });
}

function updateTotalSales(){
    fetch('/analytics/total_sales')
    .then(response => response.json())
    .then(data => {
        if (data.total_sales !== undefined) {
            document.getElementById('total-sales-html').innerText = '$'+data.total_sales;

            console.log('Total Sales:', data.total_sales);
        } else {
            console.error("Total sales data not found in the response."); 
        }
    });  
}

function updateTotalSpaceStations(){
    fetch('/analytics/total_space_stations')
    .then(response => response.json())
    .then(data => {
        if (data.total_space_stations !== undefined) {
            document.getElementById('total-space-stations-html').innerText = data.total_space_stations;
            console.log('Total Space Stations:', data.total_space_stations);
        } else {
            console.error("Total space stations data not found in the response."); 
        }
    });
}

// Function to initialize FullCalendar
function initializeCalendar() {
    $('#datetimepicker-dashboard').fullCalendar({
        // Your calendar options here
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: '/your-event-endpoint', // Replace with your endpoint to fetch events
    });
}

function loadTicketsByDateChart() {
    // Fetch ticket analytics data from the server
    fetch('/analytics/tickets-by-date')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const ctx = document.getElementById('tickets-by-date-chart').getContext('2d');

            // Prepare labels and data from the received object
            const labels = Object.keys(data); // Dates
            const counts = Object.values(data); // Corresponding counts

            // Create the chart
            new Chart(ctx, {
                type: 'line', // or 'bar', depending on your preference
                data: {
                    labels: labels, // Dates
                    datasets: [{
                        label: 'Tickets Created by Date',
                        data: counts, // Corresponding counts
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: false
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
            console.error('Error fetching ticket analytics data:', error);
        });
}

// Event listener to load the chart and calendar after the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    loadNationalityChart();
    updateTotalUsers(); // Call the function to load and display the chart
    updateTotalRockets();
    updateTotalSales();
    updateTotalSpaceStations();
    initializeCalendar(); // Call the function to initialize the calendar
    loadTicketsByDateChart();   
});
