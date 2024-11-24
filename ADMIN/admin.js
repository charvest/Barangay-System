const styles = `
.tabs-container {
 margin-top: 20px;
}
.tab-content {
margin-top: 20px;
}

.search-btn {
    padding: 8px 16px;
    font-size: 14px;
    background-color: #28a745; /* Green color for the button */
    color: white;
    border: 1px solid #28a745;
    border-radius: 0 4px 4px 0; /* Rounded corners on the right side */
    cursor: pointer;
    transition: background-color 0.3s ease;
    height: 40px; /* Same height as input */
}

.search-btn:hover {
    background-color: #218838; /* Darker green on hover */
}


    /* Enhanced Table styling */
table {
    width: 95%; /* Slightly reduce width for more spacing */
    margin: 0 auto; /* Center the table */
    margin-top: 20px; /* Add space above the table */
    border-collapse: separate; /* Separate border styles for padding effect */
    border-spacing: 0 12px; /* Add vertical spacing between rows */
}

table th,
table td {
    padding: 14px 24px; /* Increase padding for more whitespace */
    text-align: left;
    font-size: 16px; /* Increase font size for readability */
}

table th {
    background-color: #f0f0f0;
    font-weight: bold;
    text-align: center;
    font-size: 17px; /* Slightly larger font for headers */
}

table tbody tr {
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow for separation */
}

table tbody tr:nth-child(even) {
    background-color: #f9f9f9; /* Subtle alternate row color */
}

table tbody td {
    text-align: center;
    font-size: 15px; /* Font size for table cells */
    word-wrap: break-word; /* Prevent text overflow */
}

/* Column-specific minimum widths */
th:nth-child(1), td:nth-child(1) { min-width: 160px; } /* Name */
th:nth-child(2), td:nth-child(2) { min-width: 110px; } /* Type */
th:nth-child(3), td:nth-child(3) { min-width: 200px; } /* Purpose */
th:nth-child(4), td:nth-child(4) { min-width: 140px; } /* Date */
th:nth-child(5), td:nth-child(5) { min-width: 60px; } /* Qty */
th:nth-child(6), td:nth-child(6) { min-width: 150px; } /* Action */

/* Adjust button group styling */
.btn-group {
    display: flex;
    gap: 14px;
    justify-content: center;
}



/* Mobile-specific table adjustments */
@media screen and (max-width: 768px) {
    table th, table td {
        padding: 12px 16px;
        font-size: 14px;
    }

    table {
        width: 100%;
        margin: 10px 0;
    }
}

/* Custom scrollbar styling for a more fitting look */
.table-container {
    max-height: 700px; /* Increase this value to show more rows */
    overflow-y: auto; /* Enable vertical scrolling */
}

.table-container::-webkit-scrollbar {
    width: 10px;
}

.table-container::-webkit-scrollbar-track {
    background: #e0e0e0;
    border-radius: 10px;
}

.table-container::-webkit-scrollbar-thumb {
    background-color: #bcbcbc;
    border-radius: 10px;
    border: 2px solid #e0e0e0;
}

.table-container::-webkit-scrollbar-thumb:hover {
    background-color: #a5a5a5;
}


.tabs-container {
    max-height: 700px; /* Increase this value to show more rows */
    overflow-y: auto; /* Enable vertical scrolling */
}


.tabs-container:-webkit-scrollbar {
    width: 10px;
}

.tabs-container:-webkit-scrollbar-track {
    background: #e0e0e0;
    border-radius: 10px;
}

.tabs-container:-webkit-scrollbar-thumb {
    background-color: #bcbcbc;
    border-radius: 10px;
    border: 2px solid #e0e0e0;
}

.tabs-container:-webkit-scrollbar-thumb:hover {
    background-color: #a5a5a5;
}

/* Approve (Like) icon styling */
.btn-update {
    padding: 8px; /* Adjust spacing around the icon */
    font-size: 24px !important; /* Adjust icon size */
    color: #28a745 !important; /* Force green color */
    cursor: pointer; /* Indicate it's clickable */
    transition: transform 0.2s ease; /* Only apply scale effect */
}

.btn-update:hover {
    transform: scale(1.2); /* Slight zoom effect on hover */
}

/* Disapprove (Dislike) icon styling */
.btn-delete {
    padding: 8px; /* Adjust spacing around the icon */
    font-size: 24px !important; /* Adjust icon size */
    color: #dc3545 !important; /* Force red color */
    cursor: pointer; /* Indicate it's clickable */
    transition: transform 0.2s ease; /* Only apply scale effect */
}

.btn-delete:hover {
    transform: scale(1.2); /* Slight zoom effect on hover */
}

/* Confirm Disapprove Button Styling */
#confirmDisapproveBtn {
    padding: 8px; /* Adjust spacing around the icon */
    font-size: 24px !important; /* Adjust font size */
    background-color: #dc3545; /* Red background */
    color: white !important; /* Force white text color */
    border: none; /* Remove border */
    border-radius: 4px; /* Slight rounding for a button look */
    cursor: pointer; /* Indicate it's clickable */
    transition: transform 0.2s ease; /* Only apply scale effect */
    text-align: center; /* Center the text */
}

#confirmDisapproveBtn:hover {
    transform: scale(1.2); /* Slight zoom effect on hover */
    background-color: #c82333; /* Darker red background on hover */
}



.modal-content {
    position: relative;
    max-width: 400px; /* Adjusted size */
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    overflow: hidden; /* Prevent content from overflowing */
}

.modal h3 {
    margin-bottom: 15px;
}

#disapprovalMessage {
    width: 100%;
    height: 150px; /* Fixed height */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    margin-bottom: 20px; /* Add margin at the bottom */
    resize: none; /* Disable resizing */
    box-sizing: border-box; /* Ensure padding and border are included in width/height */
}

#confirmDisapproveBtn {
    display: inline-block;
    padding: 12px 20px; /* Adjust padding */
    font-size: 16px; /* Adjust font size */
    background-color: #dc3545;
    color: white;
    border: none;
    border-radius: 50px; /* Round the button */
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    text-align: center; /* Ensure text is centered */
    width: 100%; /* Make the button full-width */
}

#confirmDisapproveBtn:hover {
    background-color: #c82333;
    transform: scale(1.05);
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #ff4a60;
    color: white;
    font-size: 18px;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.close-btn:hover {
    background-color: #ff2a40;
}

.id-image-modal { /* Unique modal for image preview */
        display: none; 
        position: fixed; 
        z-index: 1000; 
        left: 0; 
        top: 0; 
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgba(0,0,0,0.8); 
        align-items: center; 
        justify-content: center;
    }

    .id-image-modal .modal-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .id-image-modal img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .id-image-close-btn { /* Unique close button for image preview modal */
        position: absolute;
        top: 20px;
        right: 20px;
        background: #ff4a60;
        color: white;
        font-size: 20px;
        border: none;
        cursor: pointer;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .stats-container {
    display: flex;
    gap: 15px;
    margin: 20px 0;
    justify-content: center;
}

.stat-box {
    flex: 1;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    font-weight: bold;
    color: #333;
    transition: transform 0.3s ease;
}

.stat-box:hover {
    transform: scale(1.05);
}

.stat-value {
    font-size: 28px;
    margin-bottom: 5px;
}

.stat-title {
    font-size: 14px;
    color: #666;
}

.chart-container {
    margin: 50px auto;
    width: 80%;
    text-align: center;
}

/* Send-to-Queue Icon Styling (Matches Approve button) */
.btn-send-to-queue {
    padding: 8px; /* Adjust spacing around the icon */
    font-size: 30px !important; /* Adjust icon size */
    color: #28a745 !important; /* Force green color for "Send to Queue" icon */
    cursor: pointer; /* Indicate it's clickable */
    transition: transform 0.2s ease; /* Only apply scale effect */
}

.btn-send-to-queue:hover {
    transform: scale(1.2); /* Slight zoom effect on hover */
    color: #218838 !important; /* Darker green on hover */
}

/* Send-to-Queue Icon Styling (Matches Approve button) */
.btn-remove-from-queue {
    padding: 8px; /* Adjust spacing around the icon */
    font-size: 30px !important; /* Adjust icon size */
    color: #dc3545 !important; /* Force red color for "Send to Queue" icon */
    cursor: pointer; /* Indicate it's clickable */
    transition: transform 0.2s ease; /* Only apply scale effect */
}

.btn-remove-from-queue:hover {
    transform: scale(1.2); /* Slight zoom effect on hover */
    color: #b02a37 !important; /* Darker red on hover */
}




`;



// Sidebar Items with content and tab structure
const sidebarItems = [
    {
        name: 'Dashboard',
        content: `
            <div class="stats-container">
                <div class="stat-box" style="background-color: #d1e7dd;">
                    <div class="stat-icon">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                        </svg>
                    </div>
                    <div class="stat-value" id="newUsers">1</div>
                    <div class="stat-title">New Users</div>
                </div>
                <div class="stat-box" style="background-color: #cfe2ff;">
                    <div class="stat-icon">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.2s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16l-97.5 0c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8l97.5 0c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32L0 448c0 17.7 14.3 32 32 32l64 0c17.7 0 32-14.3 32-32l0-224c0-17.7-14.3-32-32-32l-64 0z"/></svg>
                        </svg>
                    </div>
                    <div class="stat-value" id="approvedRequests">11</div>
                    <div class="stat-title">Approved Requests</div>
                </div>
                <div class="stat-box" style="background-color: #f8d7da;">
                    <div class="stat-icon">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                        </svg>
                    </div>
                    <div class="stat-value" id="pendingRequests">6</div>
                    <div class="stat-title">Pending Requests</div>
                </div>
            </div>
            <div class="chart-container">
                <h3>Activity Overview</h3>
                <canvas id="barChart"></canvas>
            </div>
        `,
        showChart: true
    },
    
    // Pending Approval Section
    {
        name: 'Pending Approval', content: `
        <div class="tabs-container">
            <ul class="nav nav-tabs">
    <li class="nav-item"><a class="nav-link active" href="#" id="request-tab">Request</a></li>
    <li class="nav-item"><a class="nav-link" href="#" id="approved-tab">Approved</a></li>
    <li class="nav-item"><a class="nav-link" href="#" id="disapproved-tab">Disapproved</a></li>
    <li class="nav-item"><a class="nav-link" href="#" id="pre-queue-tab">Pre-Queue</a></li>
    <li class="nav-item"><a class="nav-link" href="#" id="completed-tab">Completed</a></li>
</ul>

            <div class="form-container">
                <input type="text" class="form-control" placeholder="Search...">
                <button class="search-btn">Search</button>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Purpose</th>
                        <th>Date</th>
                        <th>Qty</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr><td colspan="6" class="loading-text">Loading...</td></tr>
                </tbody>
            </table>
        </div>`,
        showChart: false
    },

    {
        name: 'Queue',
        content: `
            <div class="tabs-container">
                <div class="form-container">
                    <input type="text" class="form-control" placeholder="Search...">
                    <button class="search-btn">Search</button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Priority</th>
                            <th>Waiting Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="queueTableBody">
                        <tr><td colspan="7" class="loading-text">Loading Queue...</td></tr>
                    </tbody>
                </table>
            </div>`,
        showChart: false
    },


    // Barangay Business Permit Section
    { 
        name: 'Barangay Business Permit', content: `
    <div class="table-container">
        <div class="search-container">
            <input type="text" id="businessPermitSearch" class="form-control" placeholder="Search Business Permits...">
            <button id="searchBusinessPermitBtn" class="search-btn">Search</button>
        </div>    
        <table id="businessPermitTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Priority</th>
                    <th>Occupation</th>
                    <th>Business Address</th>
                    <th>Availability</th>
                    <th>Purpose</th>
                    <th>ID (Front)</th>
                    <th>ID (Back)</th>
                    <th>Date Submitted</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="businessPermitTableBody">
                <tr><td colspan="15" class="loading-text">Loading data...</td></tr>
            </tbody>
        </table>
    </div>`,
    showChart: false
},

    // Barangay Indigency Section
    {
        name: 'Barangay Indigency', content: `
        <div class="table-container">
            <div class="search-container">
                <input type="text" id="indigencySearch" class="form-control" placeholder="Search Indigency Records...">
                <button id="searchIndigencyBtn" class="search-btn">Search</button>
            </div>
            <table id="indigencyTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Years in Kalawaan</th>
                        <th>Gender</th>
                        <th>Civil Status</th>
                        <th>Availability</th>
                        <th>Reason For Request</th>
                        <th>Priority</th>
                        <th>ID (Front)</th>
                        <th>ID (Back)</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Date Registered</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="indigencyTableBody">
                    <tr><td colspan="15" class="loading-text">Loading data...</td></tr>
                </tbody>
            </table>
        </div>`,
        showChart: false
    }
  ,

    // Barangay Clearance Section
    {
        name: 'Baranggay Clearance', content: `
        <div class="table-container">
            <div class="search-container">
                <input type="text" id="clearanceSearch" class="form-control" placeholder="Search Clearance Records...">
                <button id="searchClearanceBtn" class="search-btn">Search</button>
            </div>

            <table id="clearanceTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Marital Status</th>
                        <th>Priority</th>
                        <th>Purpose</th>
                        <th>Availability</th>
                        <th>ID (Front)</th>
                        <th>ID (Back)</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Date Registered</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="clearanceTableBody">
                    <tr><td colspan="14" class="loading-text">Loading data...</td></tr>
                </tbody>
            </table>
        </div>`,
        showChart: false
    },

    {
        name: 'Logout',
        content: '',
        showChart: false,
        isLogout: true  // Mark this item as the logout button
    }
    
    
];


// Attach search function to the search button after content loads
document.addEventListener('DOMContentLoaded', function () {
    const searchButton = document.querySelector('.search-btn');
    if (searchButton) {
        searchButton.addEventListener('click', searchTable);
    }
});

// Function to search table rows based on input in the active tab
function searchTable() {
    const searchTerm = document.querySelector('.form-control').value.toLowerCase();
    const activeTabId = document.querySelector('.nav-tabs .nav-link.active').id;
    let tableBody;

    switch (activeTabId) {
        case 'request-tab':
            tableBody = document.getElementById('tableBody'); // Use this for the Request tab
            break;
        case 'approved-tab':
            tableBody = document.getElementById('tableBody'); // Use this for the Approved tab
            break;
        case 'disapproved-tab':
            tableBody = document.getElementById('tableBody'); // Use this for the Disapproved 
            break;
        case 'pre-queue-tab':
            tableBody = document.getElementById('tableBody'); // Assuming Pre-Queue will use tableBody ID
            break;
        case 'completed-tab':
            tableBody = document.getElementById('tableBody'); // Use this for the Completed tab
            break;
        default:
            console.error('No matching table for the active tab');
            return;
    }

    // Filter rows in the active tab's table
    const rows = tableBody.getElementsByTagName('tr');
    for (let row of rows) {
        const cells = row.getElementsByTagName('td');
        let match = false;

        for (let cell of cells) {
            if (cell.textContent.toLowerCase().includes(searchTerm)) {
                match = true;
                break;
            }
        }

        row.style.display = match ? '' : 'none';
    }
}

// Function to handle tab switching inside "Pending Approval"
// Function to handle tab switching inside "Pending Approval"
function loadTabContent(tabName) {
    const tableBody = document.getElementById('tableBody');
    const tableHead = document.querySelector('.table thead tr');
    if (!tableBody || !tableHead) return;

    // Update the table header based on the selected tab
    tableHead.innerHTML = `
    <th>Name</th>
    <th>Type</th>
    <th>Purpose</th>
    <th>Date</th>
    <th>Qty</th>
    ${tabName === 'Approved' || tabName === 'Pre-Queue' ? `<th>Priority</th>` : ''}
    <th>Status</th>
    ${tabName === 'Pre-Queue' ? `<th>Action</th>` : ''}
`;

    tableBody.innerHTML = `<tr><td colspan="${tabName === 'Pre-Queue' ? 8 : 7}" class="loading-text">Loading ${tabName} data...</td></tr>`;

    let fetchUrl = '';
    switch (tabName) {
        case 'Request':
            fetchUrl = 'fetch_pending_approvals.php';
            break;
        case 'Approved':
            fetchUrl = 'fetch_approved_approvals.php';
            break;
        case 'Disapproved':
            fetchUrl = 'fetch_disapproved_approvals.php';
            break;
        case 'Completed':
            fetchUrl = 'fetch_completed_approvals.php';
            break;
        case 'Pre-Queue':
            fetchUrl = 'fetch_approved_approvals.php'; // Use appropriate endpoint for Pre-Queue
            break;
        default:
            tableBody.innerHTML = `<tr><td colspan="7" class="text-center">No data available</td></tr>`;
            return;
    }

    fetch(fetchUrl)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                tableBody.innerHTML = data.map(row => {
                    const priority = row.pwd === 'yes' ? "Yes" : "No";
                    return `
                        <tr id="row-${row.id}">
                            <td>${row.fullname}</td>
                            <td>${row.type}</td>
                            <td>${row.purpose}</td>
                            <td>${row.submission_date}</td>
                            <td>1</td>
                            ${tabName === 'Approved' || tabName === 'Pre-Queue' ? `<td>${priority}</td>` : ''}
                            <td>${row.approval_status}</td>
                            ${
                                tabName === 'Pre-Queue'
                                    ? `<td><i class="fa-solid fa-user-plus btn-send-to-queue" onclick="sendToQueue(${row.id}, '${row.fullname}', '${row.type}', '${row.pwd}')"></i></td>`
                                    : ''
                            }
                        </tr>
                    `;
                }).join('');
            } else {
                tableBody.innerHTML = `<tr><td colspan="${tabName === 'Pre-Queue' ? 8 : 7}" class="text-center">No ${tabName.toLowerCase()} records found</td></tr>`;
            }

            // Trigger the search automatically when the page loads or when data is updated
            document.querySelector('.form-control').addEventListener('input', searchTable);

            // Optionally, call searchTable once immediately after data is loaded to show filtered results
            searchTable();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            tableBody.innerHTML = `<tr><td colspan="${tabName === 'Pre-Queue' ? 8 : 6}" class="text-center">Error loading data</td></tr>`;
        });
}




// Function to send a row to the queue table
// Function to send a row to the queue table
function sendToQueue(id, name, type, pwd) {
    Swal.fire({
        title: 'Send to Queue?',
        text: `Are you sure you want to send ${name} to the queue?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, send it!'
    }).then((result) => {
        if (result.isConfirmed) {
            const priority = pwd === 'yes' ? 1 : 0;

            const postData = {
                id: id,
                name: name,
                type: type,
                priority: priority
            };

            fetch('insert_into_queue.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(postData)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    Swal.fire('Sent!', `${name} has been sent to the queue.`, 'success');
                    document.getElementById(`row-${id}`).style.display = 'none'; // Hide the row visually
                } else {
                    Swal.fire('Error', `Failed to send to queue: ${result.error}`, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'An error occurred. Please try again later.', 'error');
            });
        }
    });
}











// Initialize tab switching
document.addEventListener('DOMContentLoaded', function () {
    handleTabSwitching();
});




// Function to handle tab switching inside "Pending Approval"
function handleTabSwitching() {
    const tabs = ['request-tab', 'approved-tab', 'disapproved-tab', 'completed-tab', 'pre-queue-tab'];

    const contentMap = {
        'request-tab': 'Request',
        'approved-tab': 'Approved',
        'disapproved-tab': 'Disapproved',
        'completed-tab': 'Completed',
        'pre-queue-tab': 'Pre-Queue'  // New Pre-Queue tab
    };
    

    tabs.forEach(tabId => {
        const tabElement = document.getElementById(tabId);
        if (tabElement) {
            tabElement.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all tabs
                tabs.forEach(tab => document.getElementById(tab).classList.remove('active'));

                // Add active class to the clicked tab
                this.classList.add('active');

                // Load content for the selected tab
                loadTabContent(contentMap[tabId]);
            });
        }
    });
}


// Initialize tab switching
document.addEventListener('DOMContentLoaded', function () {
    handleTabSwitching();
});



//APPROVE DISAPPOVE START

// Function to handle form approval with SweetAlert confirmation
function approveForm(id, email, table) {
    console.log(`Approving form for table: ${table}`); // Log the table name
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to approve this form?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            updateApprovalStatus(id, 'approved', table);
            Swal.fire(
                'Approved!',
                'The form has been approved.',
                'success'
            );
            sendApprovalEmail(email);
        }
    });
}

// New function to send the approval email
function sendApprovalEmail(email) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "send_approval_email.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log('Email sent:', xhr.responseText);
        }
    };

    // Sending the email data
    xhr.send(`email=${encodeURIComponent(email)}`);
}


// Function to handle form disapproval with SweetAlert confirmation
// Adding the modal container dynamically to the HTML body for disapproval
document.addEventListener('DOMContentLoaded', function () {
    const disapproveModalContainer = document.createElement('div');
    disapproveModalContainer.classList.add('modal');
    disapproveModalContainer.innerHTML = `
        <div class="modal-content">
            <button class="close-btn">&times;</button>
            <h3>Disapprove Form</h3>
            <textarea id="disapprovalMessage" rows="4" placeholder="Enter the reason for disapproval..."></textarea>
            <button id="confirmDisapproveBtn" class="btn btn-delete">Confirm Disapproval</button>
        </div>
    `;
    document.body.appendChild(disapproveModalContainer);
  });
  


  // Close modal functionality for disapproval
  document.addEventListener('DOMContentLoaded', function () {
    const disapproveModal = document.querySelector('.modal');
    const closeButton = document.querySelector('.close-btn');
  
    closeButton.addEventListener('click', function () {
        disapproveModal.style.display = 'none';
    });
  });
  
  // Open disapproval modal and pass necessary data to confirm the action
  function disapproveForm(id, email, table) {
    console.log(`Disapproving form for table: ${table}`); // Log the table name
    const disapproveModal = document.querySelector('.modal');
    const confirmButton = document.getElementById('confirmDisapproveBtn');

    disapproveModal.style.display = 'flex';

    confirmButton.onclick = function () {
        const message = document.getElementById('disapprovalMessage').value;
        if (message.trim() === '') {
            Swal.fire('Error', 'Disapproval message cannot be empty!', 'error');
            return;
        }

        sendDisapprovalEmail(id, email, message, table); // Pass table name here

        disapproveModal.style.display = 'none';
        updateApprovalStatus(id, 'disapproved', table); // Make sure to pass table here as well
    };
}
  
  // Function to send the disapproval email
  function sendDisapprovalEmail(id, email, message, table) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "send_disapproval_email.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log('Disapproval email sent:', xhr.responseText);
            Swal.fire(
                'Disapproved!',
                'The form has been disapproved and the message has been sent.',
                'success'
            );
            updateApprovalStatus(id, 'disapproved', table); // Ensure table is passed here as well
        }
    };

    // Send the form data including email, message, and table name
    xhr.send(`id=${id}&status=disapproved&table=${table}&email=${encodeURIComponent(email)}&message=${encodeURIComponent(message)}`);
}
  
  // Approve a permit with email notification
function approvePermitForm(id, email) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to approve this permit?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            updateApprovalStatus(id, 'approved', 'permit'); // Update the permit status
            Swal.fire('Approved!', 'The permit has been approved.', 'success');
            sendApprovalEmail(email);  // Send the approval email
        }
    });
}

// Disapprove a permit with reason and email notification
function disapprovePermitForm(id, email) {
    const disapproveModal = document.querySelector('.modal');
    const confirmButton = document.getElementById('confirmDisapproveBtn');

    disapproveModal.style.display = 'flex';

    confirmButton.onclick = function () {
        const message = document.getElementById('disapprovalMessage').value;
        if (message.trim() === '') {
            Swal.fire('Error', 'Disapproval message cannot be empty!', 'error');
            return;
        }

        sendDisapprovalEmail(id, email, message, 'permit'); // Send disapproval email for permit
        disapproveModal.style.display = 'none';
    };
}

// Helper function to send approval status update to the server (no changes needed here)
function updateApprovalStatus(id, status, table) {
    console.log(`Updating approval status for table: ${table}, ID: ${id}`); // Log table and ID
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_approval_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                fetchIndigencyForms();
            } else {
                Swal.fire(
                    'Error!',
                    `Failed to update form status: ${response.error}`,
                    'error'
                );
            }
        }
    };

    xhr.send(`id=${id}&status=${status}&table=${table}`); // Send table name in POST data
}



// APPROVE DISAPPROVE END


// Fetch data functions
function fetchIndigencyForms() {
    fetch('fetch_indigency_forms.php')
        .then(response => response.json())
        .then(data => renderTable('indigencyTableBody', data))
        .catch(error => console.error('Error fetching indigency forms:', error));
}

function fetchResidentData() {
    fetch('fetch_resident_data.php')
        .then(response => response.json())
        .then(data => renderTable('residentTableBody', data))
        .catch(error => console.error('Error fetching resident data:', error));
}

function fetchBusinessPermitData() {
    fetch('fetch_business_permit_data.php')
        .then(response => response.json())
        .then(data => renderBusinessPermitTable('businessPermitTableBody', data))
        .catch(error => console.error('Error fetching business permit data:', error));
}


function fetchClearanceData() {
    fetch('fetch_clearance_data.php')
        .then(response => response.json())
        .then(data => renderClearanceTable('clearanceTableBody', data))
        .catch(error => console.error('Error fetching clearance data:', error));
}

const modalStyles = `
    .modal {
        display: none; 
        position: fixed; 
        z-index: 1000; 
        left: 0; 
        top: 0; 
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgba(0,0,0,0.8); 
        align-items: center; 
        justify-content: center;
    }

    .modal-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .modal img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #ff4a60;
        color: white;
        font-size: 20px;
        border: none;
        cursor: pointer;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
`;


// Inject the modal CSS dynamically
const modalStyleSheet = document.createElement('style');
modalStyleSheet.type = 'text/css';
modalStyleSheet.innerText = modalStyles;
document.head.appendChild(modalStyleSheet);

// Inject the CSS dynamically into the document
const styleSheet = document.createElement('style');
styleSheet.type = 'text/css';
styleSheet.innerText = styles;
document.head.appendChild(styleSheet);



// Render table dynamically with Approve, Disapprove buttons, and Status indigency to boss

function searchIndigencyTable() {
    const searchTerm = document.getElementById('indigencySearch').value.toLowerCase();
    const tableBody = document.getElementById('indigencyTableBody');
    const rows = tableBody.getElementsByTagName('tr');

    for (let row of rows) {
        const cells = row.getElementsByTagName('td');
        let match = false;

        for (let cell of cells) {
            if (cell.textContent.toLowerCase().includes(searchTerm)) {
                match = true;
                break;
            }
        }

        row.style.display = match ? '' : 'none';
    }
}

function attachIndigencySearchListeners() {
    const searchButton = document.getElementById('searchIndigencyBtn');
    const searchInput = document.getElementById('indigencySearch');

    if (searchButton && searchInput) {
        // Trigger search on button click
        searchButton.addEventListener('click', searchIndigencyTable);

        // Trigger search on input change for instant filtering
        searchInput.addEventListener('input', searchIndigencyTable);
    } else {
        console.error('Search button or input not found for Indigency Table.');
    }
}


function renderTable(tableBodyId, data) {
    const tableBody = document.getElementById(tableBodyId);
    tableBody.innerHTML = ''; // Clear the loading message

    if (data.length > 0) {
        data.forEach(row => {
            let statusText = row.approval_status ? row.approval_status.charAt(0).toUpperCase() + row.approval_status.slice(1) : 'Pending';
            let statusColor = row.approval_status === 'approved' ? 'green' : row.approval_status === 'disapproved' ? 'red' : 'orange';

            tableBody.innerHTML += `
                <tr>
                    <td>${row.fullname}</td>
                    <td>${row.age}</td>
                    <td>${row.years_in_kalawaan}</td>
                    <td>${row.gender}</td>
                    <td>${row.marital_status}</td>
                    <td>${row.availability}</td>
                    <td>${row.reason_for_request}</td>
                    <td>${row.pwd}</td>
                    <td><img class="zoomable" src="data:image/jpeg;base64,${row.front_of_id}" alt="Front ID" width="50" onclick="showIDImageInModal('data:image/jpeg;base64,${row.front_of_id}')"/></td>
                    <td><img class="zoomable" src="data:image/jpeg;base64,${row.back_of_id}" alt="Back ID" width="50" onclick="showIDImageInModal('data:image/jpeg;base64,${row.back_of_id}')"/></td>
                    <td>${row.address}</td>
                    <td>${row.contact_number}</td>
                    <td>${row.submission_date}</td>
                    <td style="color: ${statusColor}; font-weight: bold;">${statusText}</td>
                    <td>
                    <div class="btn-group">
                        <i class="fa-solid fa-file-circle-check btn-update" onclick="approveForm(${row.id}, '${row.email}', 'indigency_forms')"></i>
                        <i class="fa-solid fa-file-circle-xmark btn-delete" onclick="disapproveForm(${row.id}, '${row.email}', 'indigency_forms')"></i>
                    </div>
                    </td>
                </tr>`;
        });
    } else {
        tableBody.innerHTML = `<tr><td colspan="15" class="text-center">No records found</td></tr>`;
    }

    // Attach search functionality after rendering
    attachIndigencySearchListeners();
}


// Clearance Table Render

function searchClearanceTable() {
    const searchTerm = document.getElementById('clearanceSearch').value.toLowerCase();
    const tableBody = document.getElementById('clearanceTableBody');
    const rows = tableBody.getElementsByTagName('tr');

    for (let row of rows) {
        const cells = row.getElementsByTagName('td');
        let match = false;

        for (let cell of cells) {
            if (cell.textContent.toLowerCase().includes(searchTerm)) {
                match = true;
                break;
            }
        }

        row.style.display = match ? '' : 'none';
    }
}

function attachClearanceSearchListeners() {
    const searchButton = document.getElementById('searchClearanceBtn');
    const searchInput = document.getElementById('clearanceSearch');

    if (searchButton && searchInput) {
        // Trigger search on button click
        searchButton.addEventListener('click', searchClearanceTable);

        // Trigger search on input change for instant filtering
        searchInput.addEventListener('input', searchClearanceTable);
    } else {
        console.error('Search button or input not found for Clearance Table.');
    }
}


function renderClearanceTable(tableBodyId, data) {
    const tableBody = document.getElementById(tableBodyId);
    tableBody.innerHTML = ''; // Clear the loading message

    if (data.length > 0) {
        data.forEach(row => {
            let statusText = row.approval_status ? row.approval_status.charAt(0).toUpperCase() + row.approval_status.slice(1) : 'Pending';
            let statusColor = row.approval_status === 'approved' ? 'green' : row.approval_status === 'disapproved' ? 'red' : 'orange';

            tableBody.innerHTML += `
                <tr>
                    <td>${row.fullname}</td>
                    <td>${row.age}</td>
                    <td>${row.gender}</td>
                    <td>${row.marital_status}</td>
                    <td>${row.pwd}</td>
                    <td>${row.purpose}</td>
                    <td>${row.availability}</td>
                    <td><img class="zoomable" src="data:image/jpeg;base64,${row.front_of_id}" alt="Front ID" width="50" onclick="showIDImageInModal('data:image/jpeg;base64,${row.front_of_id}')"/></td>
                    <td><img class="zoomable" src="data:image/jpeg;base64,${row.back_of_id}" alt="Back ID" width="50" onclick="showIDImageInModal('data:image/jpeg;base64,${row.back_of_id}')"/></td>
                    <td>${row.address}</td>
                    <td>${row.contact_number}</td>
                    <td>${row.submission_date}</td>
                    <td style="color: ${statusColor}; font-weight: bold;">${statusText}</td>
                    <td>
                    <div class="btn-group">
                        <i class="fa-solid fa-file-circle-check btn-update" onclick="approveForm(${row.id}, '${row.email}', 'baranggay_clearance')"></i>
                        <i class="fa-solid fa-file-circle-xmark btn-delete" onclick="disapproveForm(${row.id}, '${row.email}', 'baranggay_clearance')"></i>
                    </div>

                    </td>
                </tr>`;
        });
    } else {
        tableBody.innerHTML = `<tr><td colspan="15" class="text-center">No records found</td></tr>`;
    }

    // Attach search functionality after rendering
    attachClearanceSearchListeners();
}


//BUSINESS PERMIT START

// Function to filter the businessPermitTable rows
// Function to filter the businessPermitTable rows
function searchBusinessPermitTable() {
    const searchTerm = document.getElementById('businessPermitSearch').value.toLowerCase();
    const tableBody = document.getElementById('businessPermitTableBody');
    const rows = tableBody.getElementsByTagName('tr');

    for (let row of rows) {
        const cells = row.getElementsByTagName('td');
        let match = false;

        for (let cell of cells) {
            if (cell.textContent.toLowerCase().includes(searchTerm)) {
                match = true;
                break;
            }
        }

        row.style.display = match ? '' : 'none';
    }
}

// Attach search listeners dynamically
function attachBusinessPermitSearchListeners() {
    const searchButton = document.getElementById('searchBusinessPermitBtn');
    const searchInput = document.getElementById('businessPermitSearch');

    if (searchButton && searchInput) {
        searchButton.addEventListener('click', searchBusinessPermitTable);
        searchInput.addEventListener('input', searchBusinessPermitTable);
    } else {
        console.error('Search button or input not found for Business Permit Table.');
    }
}

// Function to render Business Permit Table and attach listeners
function renderBusinessPermitTable(tableBodyId, data) {
    const tableBody = document.getElementById(tableBodyId);
    tableBody.innerHTML = ''; 

    if (data.length > 0) {
        data.forEach(row => {
            let statusText = row.approval_status ? row.approval_status.charAt(0).toUpperCase() + row.approval_status.slice(1) : 'Pending';
            let statusColor = row.approval_status === 'approved' ? 'green' : row.approval_status === 'disapproved' ? 'red' : 'orange';

            tableBody.innerHTML += `
                <tr>
                    <td>${row.fullname}</td>
                    <td>${row.email}</td>
                    <td>${row.contact_number}</td>
                    <td>${row.gender}</td>
                    <td>${row.age}</td>
                    <td>${row.pwd}</td>
                    <td>${row.occupation}</td>
                    <td>${row.business_address}</td>
                    <td>${row.availability}</td>
                    <td>${row.purpose}</td>
                    <td><img src="data:image/jpeg;base64,${row.front_of_id}" alt="Front ID" width="50" onclick="showIDImageInModal('data:image/jpeg;base64,${row.front_of_id}')"/></td>
                    <td><img src="data:image/jpeg;base64,${row.back_of_id}" alt="Back ID" width="50" onclick="showIDImageInModal('data:image/jpeg;base64,${row.back_of_id}')"/></td>
                    <td>${row.submission_date}</td>
                    <td style="color: ${statusColor}; font-weight: bold;">${statusText}</td>
                    <td>
                    <div class="btn-group">
                        <i class="fa-solid fa-file-circle-check btn-update" onclick="approveForm(${row.id}, '${row.email}', 'business_permit')"></i>
                        <i class="fa-solid fa-file-circle-xmark btn-delete" onclick="disapproveForm(${row.id}, '${row.email}', 'business_permit')"></i>
                    </div>
                    </div>
                    </td>
                </tr>`;
        });
    } else {
        tableBody.innerHTML = `<tr><td colspan="15" class="text-center">No records found</td></tr>`;
    }

    // Attach search functionality after rendering
    attachBusinessPermitSearchListeners();
}



let interval; // Declare interval outside to clear it later
let currentFirstRowId = null; // Track the current first row ID

function fetchQueueData() {
    fetch('fetch_queue_data.php')
        .then(response => response.json())
        .then(data => renderQueueTable('queueTableBody', data))
        .catch(error => console.error('Error fetching queue data:', error));
}

// Function to search queue table rows based on the search term
function searchQueueTable() {
    const searchTerm = document.querySelector('.form-control').value.toLowerCase();
    const tableBody = document.getElementById('queueTableBody');
    const rows = tableBody.getElementsByTagName('tr');

    // Loop through the rows and check if any cell matches the search term
    for (let row of rows) {
        const cells = row.getElementsByTagName('td');
        let match = false;

        // Check each cell in the row for the search term
        for (let cell of cells) {
            if (cell.textContent.toLowerCase().includes(searchTerm)) {
                match = true;
                break;
            }
        }

        // Show or hide the row based on the search term match
        row.style.display = match ? '' : 'none';
    }
}


// Render Queue table with dynamic waiting time calculation only for the first position
function renderQueueTable(tableBodyId, data) {
    const tableBody = document.getElementById(tableBodyId);
    tableBody.innerHTML = ''; // Clear loading message

    if (data.length > 0) {
        tableBody.innerHTML = data.map((row, index) => `
            <tr id="row-${row.id}">
                <td>${index + 1}</td>
                <td>${row.name}</td>
                <td>${row.type}</td>
                <td>${parseInt(row.priority) === 1 ? "Yes" : "No"}</td>
                <td id="waitingTime-${row.id}">${index === 0 ? "Calculating..." : "Pending"}</td>
                <td>${row.status}</td>
                <td><i class="fa-solid fa-user-xmark btn-remove-from-queue" onclick="handleAction(${row.id}, '${row.name}')"></i></td>

            </tr>
        `).join('');

        // Start the timer only for the first row
        const firstRow = data[0];
        startFirstPositionTimer(firstRow.id);
    } else {
        tableBody.innerHTML = `<tr><td colspan="7" class="text-center">No records found</td></tr>`;
    }

    // Attach event listener for the search bar to trigger the search function on input
    document.querySelector('.form-control').addEventListener('input', searchQueueTable);

    // Optionally, call the search function to filter results as soon as the table is populated
    searchQueueTable();
}


function startFirstPositionTimer(id) {
    // Clear the timer if the first row has changed
    if (currentFirstRowId !== id) {
        clearInterval(interval); // Clear any previous timer

        // Remove the previous first row's start time from localStorage
        if (currentFirstRowId !== null) {
            localStorage.removeItem(`timerStartTime-${currentFirstRowId}`);
        }
        
        currentFirstRowId = id; // Update to the new first row ID

        // Retrieve the start time for the current first row from localStorage or set it to the current time
        let startTime = localStorage.getItem(`timerStartTime-${id}`);
        if (!startTime) {
            startTime = Date.now();
            localStorage.setItem(`timerStartTime-${id}`, startTime);
        } else {
            startTime = parseInt(startTime, 10); // Parse the stored start time as an integer
        }

        interval = setInterval(() => {
            const now = Date.now();
            const elapsedMilliseconds = now - startTime; // Calculate elapsed time from startTime

            // Convert milliseconds to HH:MM:SS
            const totalSeconds = Math.floor(elapsedMilliseconds / 1000);
            const hours = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
            const minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
            const seconds = String(totalSeconds % 60).padStart(2, '0');

            const waitingTimeElement = document.getElementById(`waitingTime-${id}`);
            if (waitingTimeElement) {
                waitingTimeElement.textContent = `${hours}:${minutes}:${seconds}`;
            }
        }, 1000); // Update every second
    }
}

// Function to handle actions and remove item from queue
function handleAction(id, name) {
    Swal.fire({
        title: `Remove ${name} from queue?`,
        text: `Are you sure you want to remove ${name} from queue?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('update_queue_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id, status: 'Completed', hidden: 1 })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Completed!', `${name}'s item has been marked as completed.`, 'success');
                    document.getElementById(`row-${id}`).style.display = 'none'; // Hide the row visually

                    // Clear the interval for the completed first row
                    clearInterval(interval);
                    currentFirstRowId = null; // Reset first row ID

                    // Remove the timer start time from localStorage
                    localStorage.removeItem(`timerStartTime-${id}`);

                    // Reload the queue data to update the table and start timing for the new first row
                    fetchQueueData();
                } else {
                    Swal.fire('Error', `Failed to update status: ${data.error}`, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'An error occurred. Please try again later.', 'error');
            });
        }
    });
}


// Initial call to fetch queue data
fetchQueueData();








``
//IMG INDIGENCY PREVIEW START

// Adding the image preview modal dynamically to the HTML body
document.addEventListener('DOMContentLoaded', function () {
    const imagePreviewModal = document.createElement('div');
    imagePreviewModal.classList.add('id-image-modal'); // Unique class for the image modal
    imagePreviewModal.innerHTML = `
        <div class="modal-content">
            <button class="close-btn id-image-close-btn">&times;</button> <!-- Unique close button class -->
            <img id="idPreviewImage" src="" alt="ID Image Preview" />
        </div>
    `;
    document.body.appendChild(imagePreviewModal);
});


// Function to handle showing the image in the preview modal
function showIDImageInModal(src) {
    const imageModal = document.querySelector('.id-image-modal'); // Select the unique image modal
    const modalImage = document.getElementById('idPreviewImage');
    modalImage.src = src;
    imageModal.style.display = 'flex'; // Display the modal
}

// Close modal when clicking the close button or outside the modal content
document.addEventListener('DOMContentLoaded', function () {
    const imageModal = document.querySelector('.id-image-modal'); // Select the unique image modal
    const closeImageButton = document.querySelector('.id-image-close-btn'); // Unique close button

    closeImageButton.addEventListener('click', function () {
        imageModal.style.display = 'none';
    });

    // Close the modal when clicking outside the image
    imageModal.addEventListener('click', function (event) {
        if (event.target === imageModal) {
            imageModal.style.display = 'none';
        }
    });
});

//IMG INDIGENCY PREVIEW END


// Generate sidebar and handle content switching
// Sidebar Items with content and tab structure


// Generate sidebar and handle content switching
function generateSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const ul = document.createElement('ul');
    const contentArea = document.querySelector('.main-content');

    sidebarItems.forEach((item, index) => {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.textContent = item.name;
        a.href = '#';

        // Set the first sidebar item ("Dashboard") as active by default
        if (index === 0) {
            li.classList.add('active');
            loadDashboardContent(); // Load the dashboard content initially
        }

        // Handle "Logout" button click
        a.addEventListener('click', function(event) {
            event.preventDefault();

            if (item.isLogout) {
                logout(); // Call the logout function
            } else {
                // Set active class to the clicked sidebar item
                document.querySelectorAll('.sidebar li').forEach(li => li.classList.remove('active'));
                li.classList.add('active');

                // Load the appropriate content based on the sidebar item
                if (item.name === 'Queue') {
                    fetchQueueData(); // Load queue data when the Queue tab is selected
                }
                if (item.name === 'Barangay Business Permit') {
                    fetchBusinessPermitData(); // Load the table data
                    attachBusinessPermitSearchListeners(); // Attach search listeners after rendering
                }                

                if (item.name === 'Dashboard') {
                    loadDashboardContent(); // Dashboard content with chart
                } else {
                    // Insert content for other sections
                    contentArea.innerHTML = `<h2>${item.name}</h2><div>${item.content}</div>`;

                    // Load the chart if the item requires it
                    if (item.showChart) {
                        initializeOrUpdateChart();
                    } else {
                        // Handle special functionalities for other tabs
                        if (item.name === 'Pending Approval') handleTabSwitching();
                        if (item.name === 'Barangay Indigency') fetchIndigencyForms();
                        if (item.name === 'Registered Resident') fetchResidentData();
                        if (item.name === 'Barangay Business Permit') fetchBusinessPermitData();
                        if (item.name === 'Baranggay Clearance') fetchClearanceData();
                    }
                }
            }
        });

        li.appendChild(a);
        ul.appendChild(li);
    });

    sidebar.appendChild(ul);
}

// Logout function to destroy session and redirect to login page
function logout() {
    // Assuming you're using PHP for session handling
    // You should send an AJAX request or redirect to a PHP file to destroy the session
    window.location.href = 'logout.php';  // Redirect to your logout page (e.g., logout.php)
}

  
function loadDashboardContent() {
    const contentArea = document.querySelector('.main-content');
    contentArea.innerHTML = `
        <h2>Dashboard</h2>
        ${sidebarItems[0].content} <!-- Load Dashboard content -->
    `;
    fetchDashboardStats(); // Fetch and update dashboard stats
}


function fetchDashboardStats() {
    fetch('fetch_dashboard_stats.php')
        .then(response => response.json())
        .then(data => {
            // Update the stats boxes
            document.getElementById('newUsers').textContent = data.newUsers;
            document.getElementById('approvedRequests').textContent = data.approvedRequests;
            document.getElementById('pendingRequests').textContent = data.pendingRequests;

            // Update the chart with fetched data
            updateChart(data.newUsers, data.approvedRequests, data.pendingRequests);
        })
        .catch(error => console.error('Error fetching dashboard stats:', error));
}



// Initialize or update the pie chart
let chartInstance = null;

function updateChart(newUsers, approvedRequests, pendingRequests) {
    const canvas = document.getElementById('barChart');
    if (!canvas) {
        console.error("Canvas element for bar chart not found!");
        return;
    }
    
    const ctx = canvas.getContext('2d');

    // Destroy any previous instance of the chart to prevent duplicates
    if (chartInstance) {
        chartInstance.destroy();
    }

    // Initialize or update the bar chart with fetched data
    chartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['New Users', 'Approved Requests', 'Pending Requests'],
            datasets: [{
                label: 'Activity Summary',
                data: [newUsers, approvedRequests, pendingRequests],
                backgroundColor: ['#d1e7dd', '#cfe2ff', '#f8d7da'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Count' }
                },
                x: {
                    title: { display: true, text: 'Activity Type' }
                }
            },
            plugins: {
                legend: { display: false },
            }
        }
    });
}



document.addEventListener('DOMContentLoaded', function () {
    generateSidebar(); // Sets up the sidebar with default "Dashboard" loaded
    loadDashboardContent(); // Load dashboard stats and content
});