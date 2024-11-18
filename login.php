<?php
session_start();
if (isset($_SESSION["username"])){
    if($_SESSION["user_type"] === 'admin'){
        header("Location: http://localhost/parking-point/admin/index.php");
    }elseif($_SESSION["user_type"]){
        header("Location: http://localhost/parking-point/agent/index.php");
    }else{
        header("Location: http://localhost/parking-point/index.php");
    }
}
// Initialize variables
$username = '';
$password = '';
$user_type = 0; // Default user type
$error_message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $user_type = isset($_POST['user_type']) ? intval($_POST['user_type']) : 0;

    // Create a database connection
    $conn = mysqli_connect("localhost", "root", "", "parking_project");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Enable error reporting
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Modify the SQL statement to select name as well
    $stmt = $conn->prepare("SELECT id, name, email, password FROM users WHERE username = ? AND user_type = ?");

    // Check if statement preparation was successful
    if (!$stmt) {
        die("Error preparing statement: " . htmlspecialchars($conn->error));
    }

    // Bind parameters
    $stmt->bind_param("si", $username, $user_type);

    // Execute the statement
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows == 1) {
        // Bind the additional result columns (id, name, email, and password)
        $stmt->bind_result($user_id, $user_name, $user_email, $hashed_password);
        $stmt->fetch();
        
        // Verify the password (assuming passwords are hashed)
        if (password_verify($password, $hashed_password)) {
            // Set session variables with the additional user details
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $username;
            $_SESSION["name"] = $user_name;  // Store name in the session
            $_SESSION["email"] = $user_email;
            $_SESSION["user_type"] = $user_type;  // user Type 0 for user and 1-> agent

            // Redirect based on user type
            if ($_SESSION["user_type"] === 1) {
                header("Location: http://localhost/parking-point/agent/index.php");
            } else {
                header("Location: http://localhost/parking-point/index.php");
            }
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
                    <img src="./images/logo/logo.png" alt="logo image" class='w-40 mb-4 mx-auto block'>
                </a>
                <div class="p-8 rounded-2xl bg-white shadow">
                    <h2 class="text-gray-800 text-center text-2xl font-bold">User Sign in</h2>

                    <?php if ($error_message): ?>
                        <p class="text-red-500 text-sm text-center mb-4"><?php echo htmlspecialchars($error_message); ?></p>
                    <?php endif; ?>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-8 space-y-4"
                        method="post">
                        <div>
                            <label class="text-gray-800 text-sm mb-2 block">User name</label>
                            <div class="relative flex items-center">
                                <input name="username" type="text" required
                                    class="w-full text-gray-800 focus:border-cyan-500 focus:ring-cyan-500 text-sm border border-gray-300 px-4 py-3 rounded-md outline-cyan-600"
                                    placeholder="Enter user name" value="<?php echo htmlspecialchars($username); ?>" />
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
                        <div class="flex gap-x-4">
                            <div class="flex items-center">
                                <input id="user" value="0" <?php echo ($user_type == 0) ? 'checked' : ''; ?>
                                    name="user_type" type="radio"
                                    class="h-4 w-4 shrink-0 text-cyan-600 focus:outline-cyan-600 focus:ring-cyan-500 focus:outline-cyan-600 border-gray-300 rounded-full" />
                                <label for="user" class="ml-3 block text-sm text-gray-800">User</label>
                            </div>
                            <div class="flex items-center">
                                <input id="agent" value="1" <?php echo ($user_type == 1) ? 'checked' : ''; ?>
                                    name="user_type" type="radio"
                                    class="h-4 w-4 shrink-0 text-cyan-600 focus:outline-cyan-600 focus:ring-cyan-500 focus:outline-cyan-600 border-gray-300 rounded-full" />
                                <label for="agent" class="ml-3 block text-sm text-gray-800">Agent</label>
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox"
                                    class="h-4 w-4 shrink-0 text-cyan-600 focus:outline-cyan-600 focus:ring-cyan-500 focus:outline-cyan-600 border-gray-300 rounded" />
                                <label for="remember-me" class="ml-3 block text-sm text-gray-800">Remember me</label>
                            </div>
                            <div class="text-sm">
                                <a href="/parking-point/forget-password.php"
                                    class="text-cyan-500 hover:underline font-semibold">Forgot your password?</a>
                            </div>
                        </div>
                        <div class="!mt-8">
                            <button type="submit"
                                class="w-full py-3 px-4 text-base font-semibold tracking-wide rounded-lg text-white bg-cyan-500 hover:bg-cyan-600 focus:outline-none">Sign
                                in</button>
                        </div>
                        <p class="text-gray-800 text-sm !mt-8 text-center">Don't have an account? <a
                                href="/parking-point/signup.php"
                                class="text-cyan-500 hover:underline ml-1 whitespace-nowrap font-semibold">Register
                                here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>