const styles = `
   /* Full viewport height for the container */
    .tabs-container {
       
        justify-content: center;
     
        height:700px;
        flex-direction: column;
        width: 100%;
        padding: 10px;
    }

    .form-container {
        display: flex;
        justify-content: center;
        margin: 20px 0;
        width: 100%;
        padding: 10px;
    }

    .form-control {
        width: 50%;
        margin-right: 10px;
        padding: 10px;
    }

    /* Centering and enlarging the table */
    table {
        
        width: 90%;
        margin: 150 auto;
        border-collapse: separate;
        border-spacing: 0 5px;
         
         
    }

    table th, table td {
        padding: 14px 24px;
        text-align: center;
        font-size: 16px;
    }

    table th {
        background-color: #f0f0f0;
        font-weight: bold;
        font-size: 17px;
    }

    table tbody tr {
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Responsive adjustments */
    @media screen and (max-width: 768px) {
        .form-control {
            width: 70%;
        }
        table {
            width: 100%;
        }
    }

    @media screen and (max-width: 480px) {
        /* Make table more compact on smaller screens */
        table th, table td {
            font-size: 12px;
            padding: 8px;
            max-width:40px;
        }
        .form-control {
            width: 100%;
            margin-right: 0;
        }
    }
`;

const queueContent = `
    <div class="tabs-container">
         
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Priority</th>
                    <th>Waiting Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="queueTableBody">
                <tr><td colspan="6" class="loading-text">Loading Queue...</td></tr>
            </tbody>
        </table>
    </div>`;

let interval;
let currentFirstRowId = null;

function fetchQueueData() {
  fetch("fetch_queue_data.php")
    .then((response) => response.json())
    .then((data) => renderQueueTable("queueTableBody", data))
    .catch((error) => console.error("Error fetching queue data:", error));
}

function renderQueueTable(tableBodyId, data) {
  const tableBody = document.getElementById(tableBodyId);
  tableBody.innerHTML = "";

  if (data.length > 0) {
    tableBody.innerHTML = data
      .map(
        (row, index) => `
            <tr id="row-${row.id}">
                <td>${index + 1}</td>
                <td>${row.name}</td>
                <td>${row.type}</td>
                <td>${parseInt(row.priority) === 1 ? "Yes" : "No"}</td>
                <td id="waitingTime-${row.id}">${
          index === 0 ? "Calculating..." : "Pending"
        }</td>
                <td>${row.status}</td>
            </tr>
        `
      )
      .join("");

    const firstRow = data[0];
    startFirstPositionTimer(firstRow.id);
  } else {
    tableBody.innerHTML = `<tr><td colspan="6" class="text-center">No records found</td></tr>`;
  }
}

function startFirstPositionTimer(id) {
  if (currentFirstRowId !== id) {
    clearInterval(interval);

    if (currentFirstRowId !== null) {
      localStorage.removeItem(`timerStartTime-${currentFirstRowId}`);
    }

    currentFirstRowId = id;

    let startTime = localStorage.getItem(`timerStartTime-${id}`);
    if (!startTime) {
      startTime = Date.now();
      localStorage.setItem(`timerStartTime-${id}`, startTime);
    } else {
      startTime = parseInt(startTime, 10);
    }

    interval = setInterval(() => {
      const now = Date.now();
      const elapsedMilliseconds = now - startTime;

      const totalSeconds = Math.floor(elapsedMilliseconds / 1000);
      const hours = String(Math.floor(totalSeconds / 3600)).padStart(2, "0");
      const minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(
        2,
        "0"
      );
      const seconds = String(totalSeconds % 60).padStart(2, "0");

      const waitingTimeElement = document.getElementById(`waitingTime-${id}`);
      if (waitingTimeElement) {
        waitingTimeElement.textContent = `${hours}:${minutes}:${seconds}`;
      }
    }, 1000);
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const styleSheet = document.createElement("style");
  styleSheet.type = "text/css";
  styleSheet.innerText = styles;
  document.head.appendChild(styleSheet);

  // Display Queue Content Immediately
  document.querySelector(".main-content").innerHTML = queueContent;
  fetchQueueData();
});
