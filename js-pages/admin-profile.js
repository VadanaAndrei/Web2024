    function populateTables(data) {
    const usersTableBody = document.getElementById('users-table').getElementsByTagName('tbody')[0];
    const reportsTableBody = document.getElementById('reports-table').getElementsByTagName('tbody')[0];

    data.users.forEach(user => {
    const row = usersTableBody.insertRow();
    row.setAttribute('data-user-id', user.user_id);
    row.insertCell(0).innerText = user.user_id;
    row.insertCell(1).innerText = user.username;
    row.insertCell(2).innerText = user.email;
    const actionCell = row.insertCell(3);
    const removeButton = document.createElement('button');
    removeButton.innerText = 'Remove';
    removeButton.classList.add('remove-btn');
    removeButton.onclick = () => removeUser(user.user_id);
    actionCell.appendChild(removeButton);
});

    data.reports.forEach(report => {
    const row = reportsTableBody.insertRow();
    row.setAttribute('data-report-id', report.report_id);
    row.insertCell(0).innerText = report.report_id;
    row.insertCell(1).innerText = report.species;
    row.insertCell(2).innerText = report.area;
    const actionCell = row.insertCell(3);
    const removeButton = document.createElement('button');
    removeButton.innerText = 'Remove';
    removeButton.classList.add('remove-btn');
    removeButton.onclick = () => removeReport(report.report_id);
    actionCell.appendChild(removeButton);
});
}

    function removeUser(userId) {
    if (confirm('Are you sure you want to remove this user?')) {
    fetch(`AdminProfile/removeUser?user_id=${userId}`, { method: 'GET' })
    .then(response => response.json())
    .then(data => {
    if (data.success) {
    console.log('User removed:', userId);
    const row = document.querySelector(`#users-table tr[data-user-id="${userId}"]`);
    if (row) row.remove();
} else {
    console.error('Failed to remove user:', data.error);
}
})
    .catch(error => console.error('Error:', error));
}
}

    function removeReport(reportId) {
    if (confirm('Are you sure you want to remove this report?')) {
    fetch(`AdminProfile/removeReport?report_id=${reportId}`, { method: 'GET' })
    .then(response => response.json())
    .then(data => {
    if (data.success) {
    console.log('Report removed:', reportId);
    const row = document.querySelector(`#reports-table tr[data-report-id="${reportId}"]`);
    if (row) row.remove();
} else {
    console.error('Failed to remove report:', data.error);
}
})
    .catch(error => console.error('Error:', error));
}
}

    window.onload = function() {
    fetch('../checks/get-db-info.php')
        .then(response => response.json())
        .then(data => populateTables(data))
        .catch(error => console.error('Error:', error));
};