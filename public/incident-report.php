<?php
// public/incident-report.php
include_once '../includes/header.php';
include_once '../includes/config.php'; // Database connection

$message = ""; // Initialize message variable

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all fields are set and not empty
    $location = $_POST['location'] ?? null;
    $incident_type = $_POST['incident_type'] ?? null;
    $description = $_POST['description'] ?? null;

    // Verify required fields are not empty
    if (!$location || !$incident_type || !$description) {
        $message = "Please fill in all required fields.";
    } else {
        // Prepare SQL to insert the incident report into the database
        $query = "INSERT INTO incidents (location, incident_type, description, report_time) VALUES (:location, :incident_type, :description, NOW())";
        $stmt = $pdo->prepare($query);

        // Bind values to prevent SQL injection
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':incident_type', $incident_type);
        $stmt->bindParam(':description', $description);

        // Execute the query and handle success or error message
        try {
            if ($stmt->execute()) {
                $message = "Incident reported successfully!";
            } else {
                $message = "Failed to report the incident. Please try again.";
            }
        } catch (PDOException $e) {
            // Catch any database-related errors
            $message = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report an Incident</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        /* Reset some basic styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        /* Main container */
        main {
            max-width: 600px; /* Adjusted max width for smaller screens */
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Heading styles */
        h2 {
            text-align: center;
            color: #333;
        }

        /* Form styles */
        .incident-form {
            display: flex;
            flex-direction: column;
            gap: 15px; /* Space between form elements */
        }

        .incident-form label {
            font-weight: bold;
            color: #555;
        }

        .incident-form input,
        .incident-form select,
        .incident-form textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .incident-form button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff; /* Blue background */
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .incident-form button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        /* Message styles */
        p {
            text-align: center;
            color: #28a745; /* Green for success messages */
            font-weight: bold;
        }

        /* Responsive styles */
        @media (max-width: 600px) {
            main {
                padding: 15px; /* Less padding on small screens */
            }

            .incident-form input,
            .incident-form select,
            .incident-form textarea,
            .incident-form button {
                width: 100%; /* Full width on small screens */
            }
        }
    </style>
</head>
<body>
<main>
    <h2>Report a Traffic Incident</h2>
    
    <!-- Display message if form submitted -->
    <?php if ($message) { echo "<p>$message</p>"; } ?>
    
    <!-- Incident Report Form -->
    <form method="POST" action="incident-report.php" class="incident-form">
        <label for="location">Location:</label>
        <select id="location" name="location" required>
            <option value="">Select Location</option>
            <option value="Downtown Nairobi">Downtown Nairobi</option>
            <option value="Westlands">Westlands</option>
            <option value="Thika Road">Thika Road</option>
            <option value="Mombasa Road">Mombasa Road</option>
            <option value="Kisumu City Center">Kisumu City Center</option>
            <option value="Nakuru Highway">Nakuru Highway</option>
            <option value="Eldoret Town">Eldoret Town</option>
            <option value="Nairobi CBD">Nairobi CBD</option>
            <option value="Nairobi Airport Road">Nairobi Airport Road</option>
            <option value="Karen">Karen</option>
            <option value="Gigiri">Gigiri</option>
            <option value="Lang'ata">Lang'ata</option>
            <option value="Kilimani">Kilimani</option>
            <option value="Juja Town">Juja Town</option>
            <option value="Machakos Town">Machakos Town</option>
            <option value="Nakuru Town">Nakuru Town</option>
            <option value="Thika Town">Thika Town</option>
            <option value="Meru Town">Meru Town</option>
            <option value="Kitale Town">Kitale Town</option>
            <option value="Nyeri Town">Nyeri Town</option>
            <option value="Naivasha Town">Naivasha Town</option>
            <option value="Nandi Hills">Nandi Hills</option>
            <option value="Voi Town">Voi Town</option>
            <option value="Malindi Town">Malindi Town</option>
            <option value="Lamu Town">Lamu Town</option>
            <option value="Kisii Town">Kisii Town</option>
            <option value="Eldama Ravine">Eldama Ravine</option>
            <option value="Isiolo Town">Isiolo Town</option>
            <option value="Garissa Town">Garissa Town</option>
            <option value="Wajir Town">Wajir Town</option>
            <option value="Bungoma Town">Bungoma Town</option>
            <option value="Kakamega Town">Kakamega Town</option>
            <option value="Busia Town">Busia Town</option>
            <option value="Ruiru">Ruiru</option>
            <option value="Kiambu Town">Kiambu Town</option>
            <option value="Kajiado Town">Kajiado Town</option>
            <option value="Vihiga Town">Vihiga Town</option>
            <option value="Embu Town">Embu Town</option>
            <option value="Murang'a Town">Murang'a Town</option>
            <option value="Kirinyaga Town">Kirinyaga Town</option>
            <option value="Trans Nzoia">Trans Nzoia</option>
            <option value="Taita Taveta">Taita Taveta</option>
            <option value="Kilifi Town">Kilifi Town</option>
            <option value="Kwale Town">Kwale Town</option>
            <option value="Narok Town">Narok Town</option>
            <!-- Add more locations as needed -->
        </select>

        <label for="incident_type">Type of Incident:</label>
        <select id="incident_type" name="incident_type" required>
            <option value="Accident">Accident</option>
            <option value="Road Block">Road Block</option>
            <option value="Construction">Construction</option>
            <option value="Other">Other</option>
        </select>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required placeholder="Describe the incident"></textarea>

        <button type="submit">Submit Incident Report</button>
    </form>
</main>

<?php include_once '../includes/footer.php'; ?>
</body>
</html>
