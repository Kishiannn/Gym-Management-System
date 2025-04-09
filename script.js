function toggleAttendance(id, currentStatus) {
    let newStatus = currentStatus == 1 ? 0 : 1; // Flip status

    fetch('update-attendance.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${id}&status=${newStatus}` // Sending data to PHP
    })
    .then(response => response.text())
    .then(data => {
        if (data === "success") {
            location.reload(); // Reloads the page if successful
        } else {
            alert("Failed to update attendance.");
        }
    });
}

function toggleAttendance(id, currentStatus) {
    let newStatus = currentStatus == 1 ? 0 : 1; // Flip status

    fetch('update-member.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${id}&status=${newStatus}` // Sending data to PHP
    })
    .then(response => response.text())
    .then(data => {
        if (data === "success") {
            location.reload(); // Reloads the page if successful
        } else {
            alert("Failed to update attendance.");
        }
    });
}