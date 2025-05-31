<?php
session_start();
// Initialize variables
$username = '';
$password = '';
$user_type = 0; // Default user type
$error_message = '';
if (isset($_SESSION["username"]) && $_SESSION["user_type"] === 'admin') {
    header("Location: http://localhost/parking-point/admin/index.php");
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Create a database connection
    $conn = mysqli_connect("localhost", "root", "", "parking_project");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Enable error reporting
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $stmt = $conn->prepare("SELECT password, firstname, lastname FROM admin WHERE email = ?");

    if (!$stmt) {
        die("Error preparing statement: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashed_password, $firstname, $lastname);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["username"] = $username;
            $_SESSION["firstname"] = $firstname;
            $_SESSION["lastname"] = $lastname;
            $_SESSION["user_type"] = 'admin';
            header("Location: http://localhost/parking-point/admin/index.php");
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
    }


    // Close the statement and connection
    $stmt->close();
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Point</title>
    <script
        src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
</head>

<body>
    <div class="bg-gray-50">
        <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
            <div class="max-w-md w-full">
                <a href="/parking-point">
                    <img src="../images/logo/logo.png" alt="logo image" class='w-40 mb-4 mx-auto block'>
                </a>
                <div class="p-8 rounded-2xl bg-white shadow">
                    <h2 class="text-gray-800 text-center text-2xl font-bold">Admin Sign in</h2>

                    <?php if ($error_message): ?>
                        <p class="text-red-500 text-sm text-center mb-4"><?php echo htmlspecialchars($error_message); ?></p>
                    <?php endif; ?>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-8 space-y-4"
                        method="post">
                        <div>
                            <label class="text-gray-800 text-sm mb-2 block">Email</label>
                            <div class="relative flex items-center">
                                <input name="username" type="text" required
                                    class="w-full text-gray-800 focus:border-cyan-500 focus:ring-cyan-500 text-sm border border-gray-300 px-4 py-3 rounded-md outline-cyan-600"
                                    placeholder="Enter email" value="<?php echo htmlspecialchars($username); ?>" />
                            </div>
                        </div>
                        <div>
                            <label class="text-gray-800 text-sm mb-2 block">Password</label>
                            <div class="relative flex items-center">
                                <input name="password" type="password" required
                                    class="w-full text-gray-800 focus:border-cyan-500 focus:ring-cyan-500 text-sm border border-gray-300 px-4 py-3 rounded-md outline-cyan-600"
                                    placeholder="Enter password" />
                            </div>
                        </div>


                        <div class="!mt-8">
                            <button type="submit"
                                class="w-full py-3 px-4 text-base font-semibold tracking-wide rounded-lg text-white bg-cyan-500 hover:bg-cyan-600 focus:outline-none">Sign
                                in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>