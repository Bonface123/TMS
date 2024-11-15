<?php
// public/traffic-reports.php
include_once '../includes/header.php';
include_once '../includes/config.php'; // Database connection

// Fetch incident reports from the database
$query = "SELECT * FROM incidents ORDER BY report_time DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$incidents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traffic Incident Reports</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        main {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 1.8em;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Table Styles */
        .incident-reports-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        .incident-reports-table th, .incident-reports-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            color: #333;
        }

        .incident-reports-table th {
            background-color: #1cc88a; /* Traffic Green */
            color: #fff;
        }

        .incident-reports-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .incident-reports-table tr:hover {
            background-color: #f1f1f1;
        }

        .incident-reports-table td {
            font-size: 0.9em;
        }

        /* No Reports Available Message */
        .no-reports {
            text-align: center;
            font-size: 1.2em;
            color: #f39c12; /* Traffic Amber */
            margin-top: 20px;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .incident-reports-table th, .incident-reports-table td {
                padding: 8px;
            }

            h2 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
<main>
    <h2>Traffic Incident Reports</h2>

    <!-- Display Message if No Reports Available -->
    <?php if (empty($incidents)) { ?>
        <p class="no-reports">No traffic incidents reported yet.</p>
    <?php } else { ?>
        <!-- Table of Traffic Reports -->
        <table class="incident-reports-table">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Incident Type</th>
                    <th>Description</th>
                    <th>Report Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($incidents as $incident) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($incident['location']); ?></td>
                        <td><?php echo htmlspecialchars($incident['incident_type']); ?></td>
                        <td><?php echo htmlspecialchars($incident['description']); ?></td>
                        <td><?php echo date('Y-m-d H:i:s', strtotime($incident['report_time'])); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</main>

<?php include_once '../includes/footer.php'; ?>
</body>
</html>
