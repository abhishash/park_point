<?php

session_start();
if (isset($_SESSION["username"])) {
    header("Location: http://localhost/parking-point/index.php");
}
?>

<?php
// Database connection settings
$host = 'localhost'; // Your database host
$db = 'parking_project'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password

// Create a connection
$conn = new mysqli($host, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND user_type = ?");

// Initialize error message
$error = '';
$username = '';
$email = '';
$password = '';
$confirm_password = '';
$user_type = 0; // Default user type

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $user_type = $_POST['user_type'];

    // Validate input
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, user_type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $username, $email, $hashed_password, $user_type);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: /parking-point/login.php");
            exit;
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script
        src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
</head>

<body>

    <div class="bg-gray-50">
        <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
            <div class="max-w-md w-full">
                <a href="/parking-point" class="">
                    <img src="./images/logo/logo.png" alt="logo image" srcset="" class='w-40 mb-4 mx-auto block'>
                </a>
                <div class="p-8 grid grid-cols-12 rounded-2xl bg-white shadow">

                    <h2 class="text-gray-800 text-center mb-4 col-span-12 text-2xl font-bold">User Registration</h2>

                    <?php if ($error): ?>
                        <p class="text-red-500 text-sm text-left mb-2 font-me col-span-12"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                        class="col-span-12 grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label class="text-gray-800 text-sm mb-2 block">Username</label>
                            <input name="username" type="text" required
                                class="w-full text-gray-800 focus:border-cyan-500 focus:ring-cyan-500 text-sm border border-gray-300 px-4 py-3 rounded-md outline-cyan-600"
                                placeholder="Enter username" value="<?php echo htmlspecialchars($username); ?>" />
                        </div>
                        <div class="col-span-12">
                            <label class="text-gray-800 text-sm mb-2 block">Email</label>
                            <input name="email" type="text" required
                                class="w-full text-gray-800 focus:border-cyan-500 focus:ring-cyan-500 text-sm border border-gray-300 px-4 py-3 rounded-md outline-cyan-600"
                                placeholder="Enter email" value="<?php echo htmlspecialchars($email); ?>" />
                        </div>
                        <div class="col-span-6">
                            <label class="text-gray-800 text-sm mb-2 block">Password</label>
                            <input name="password" type="password" required
                                class="w-full text-gray-800 focus:border-cyan-500 focus:ring-cyan-500 text-sm border border-gray-300 px-4 py-3 rounded-md outline-cyan-600"
                                placeholder="Enter password" />
                        </div>
                        <div class="col-span-6">
                            <label class="text-gray-800 text-sm mb-2 block">Confirm Password</label>
                            <input name="confirm_password" type="password" required
                                class="w-full text-gray-800 focus:border-cyan-500 focus:ring-cyan-500 text-sm border border-gray-300 px-4 py-3 rounded-md outline-cyan-600"
                                placeholder="Confirm password" />
                        </div>
                        <div class="flex gap-x-4 px-1">
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
                        <div class="col-span-12 my-2">
                            <button type="submit"
                                class="w-full py-3 px-4 text-base font-semibold tracking-wide rounded-lg text-white bg-cyan-500 hover:bg-cyan-600 focus:outline-none">
                                Sign Up
                            </button>
                        </div>
                        <p class="text-gray-800 text-sm col-span-12 text-center">Already have an account? <a
                                href="/parking-point/login.php"
                                class="text-cyan-500 hover:underline ml-1 whitespace-nowrap font-semibold">Sign In</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>