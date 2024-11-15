<?php
// public/contact.php
include_once '../includes/header.php';
include_once '../includes/config.php'; // Database connection

// Handle form submission
$response = '';
$response_class = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user inputs to prevent XSS attacks
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validate inputs (Basic validation can be enhanced based on requirements)
    if (empty($name) || empty($email) || empty($message)) {
        $response = "All fields are required.";
        $response_class = 'error'; // Red for error
    } else {
        // Insert the contact message into the database
        $query = "INSERT INTO inquiries (name, email, message, submitted_at) VALUES (:name, :email, :message, NOW())";
        $stmt = $pdo->prepare($query);

        // Bind values to prevent SQL injection
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            $response = "Thank you! Your message has been sent successfully.";
            $response_class = 'success'; // Green for success
        } else {
            $response = "Failed to send your message. Please try again.";
            $response_class = 'error'; // Red for error
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact and Support</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

         h3 {
            text-align: center;
            color: #333;
        }

        p {
            text-align: center;
            font-weight: bold;
        }

        /* Message styles */
        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .contact-form {
            margin: 20px 0;
        }

        .contact-form label {
            font-weight: bold;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 16px;
            font-size: 16px;
        }

        .contact-form button {
            padding: 12px 20px;
            border: none;
            background-color: #28a745;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .contact-form button:hover {
            background-color: #218838;
        }

        /* FAQ section styles */
        .faq {
            margin-top: 40px;
        }

        .faq-item {
            margin-bottom: 20px;
        }

        .faq-item h4 {
            color: #007bff;
            font-size: 18px;
            cursor: pointer;
        }

        .faq-item p {
            margin-top: 5px;
            color: #555;
            font-size: 16px;
        }

        /* Responsive styles */
        @media (max-width: 600px) {
            main {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
<main>
    <h2>Contact and Support</h2>
    
    <!-- Display response message after form submission -->
    <?php if ($response) { echo "<p class=\"$response_class\">$response</p>"; } ?>

    <!-- Contact Form -->
    <section class="contact-form">
        <h3>Send Us a Message</h3>
        <form method="POST" action="contact.php" novalidate>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit">Send Message</button>
        </form>
    </section>

    <!-- FAQ Section -->
    <section class="faq">
        <h3>Frequently Asked Questions</h3>
        <div class="faq-item">
            <h4>How do I report a traffic incident?</h4>
            <p>You can report an incident through the "Incident Reporting" page by providing location, type, and a brief description.</p>
        </div>
        <div class="faq-item">
            <h4>How often is traffic data updated?</h4>
            <p>Traffic data is updated every hour to ensure the latest information is available.</p>
        </div>
        <!-- Additional FAQs can be added here -->
    </section>
</main>

<?php include_once '../includes/footer.php'; ?>
</body>
</html>
