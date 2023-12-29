Certainly! You can enhance the visual appearance of your sign-up form by adding BootstrapCDN to the HTML file. Here's an updated version of the `signup.php` file with Bootstrap styling:

```php
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a random verification code
function generateVerificationCode() {
    return md5(uniqid());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $verificationCode = generateVerificationCode();

    // Insert user data into the database
    $sql = "INSERT INTO users (username, email, password, verification_code) VALUES ('$username', '$email', '$password', '$verificationCode')";

    if ($conn->query($sql) === TRUE) {
        // Send email verification
        $subject = "Email Verification";
        $message = "Click the following link to verify your email: http://localhost/verify.php?code=$verificationCode";
        $headers = "From: webmaster@example.com";

        mail($email, $subject, $message, $headers);

        echo "Registration successful. Please check your email to verify your account.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Add BootstrapCDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbs5XiVHPg5cIA98KbG5LLO6WYcgHGY8N4CkcdQpibZRl5/Nl8fGQutA8bdEQq28" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Sign Up</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add BootstrapCDN for JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-eMNnH9KRBjsE4hZBoiCtJ3gaQxZCCZE5vm/kCFDAyo2lpoAtzxu1ghI2PwQZnlzv" crossorigin="anonymous"></script>
</body>
</html>
```

This version includes Bootstrap styling for form elements, making it more visually appealing. Adjust the Bootstrap version according to your needs.
