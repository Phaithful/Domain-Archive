<?php
include '../config/db-connect.php';  // Adjust path if needed

$query = "SELECT domain_name, status, expiry_date, auto_renew, registrar FROM domain_table ORDER BY purchase_date DESC LIMIT 10";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Map status to CSS class for color coding
        $statusClass = '';
        switch (strtolower($row['status'])) {
            case 'active':
                $statusClass = 'success';
                break;
            case 'expire soon':
                $statusClass = 'warning';
                break;
            case 'expired':
                $statusClass = 'danger';
                break;
            default:
                $statusClass = '';
        }

        // Format expiry_date to mm-dd-yy
        $expiryDate = date('m-d-y', strtotime($row['expiry_date']));

        // Format auto_renew boolean to Yes/No
        $autoRenew = $row['auto_renew'] ? 'Yes' : 'No';

        echo "<tr>
            <td>" . htmlspecialchars($row['domain_name']) . "</td>
            <td class='$statusClass'>" . htmlspecialchars($row['status']) . "</td>
            <td>$expiryDate</td>
            <td>$autoRenew</td>
            <td>" . htmlspecialchars($row['registrar']) . "</td>
            <td class='primary'>Action</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No domains found.</td></tr>";
}

$conn->close();
?>
