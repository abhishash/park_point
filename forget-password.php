<?php

session_start();
if (isset($_SESSION["username"])) {
    header("Location: http://localhost/parking-point/index.php");
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
                    <img src="./images/logo/logo.png" alt="logo image" srcset="" class='w-40 mb-4 mx-auto block'>
                </a>
                <div class="p-8 rounded-2xl bg-white shadow">
                    <h2 class="text-gray-800 text-center text-2xl font-bold">Agent Sign in</h2>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mt-8 space-y-4" method="post">
                        <div>
                            <label class="text-gray-800 text-sm mb-2 block">Username OR Email</label>
                            <div class="relative flex items-center">
                                <input name="username" type="text" required
                                    class="w-full text-gray-800 focus:border-cyan-500 focus:ring-cyan-500 text-sm border border-gray-300 px-4 py-3 rounded-md outline-cyan-600"
                                    placeholder="Enter username OR Email" />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                    class="w-4 h-4 absolute right-4" viewBox="0 0 24 24">
                                    <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                                    <path
                                        d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"
                                        data-original="#000000"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="flex gap-x-4">
                            <div class="flex items-center">
                                <input id="user" value="0" checked name="user_type" type="radio"
                                    class="h-4 w-4 shrink-0 text-cyan-600 focus:outline-cyan-600 focus:ring-cyan-500 focus:outline-cyan-600 border-gray-300 rounded-full" />
                                <label for="user" class="ml-3 block text-sm text-gray-800">
                                    User
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="agent" value="1" name="user_type" type="radio"
                                    class="h-4 w-4 shrink-0 text-cyan-600 focus:outline-cyan-600 focus:ring-cyan-500 focus:outline-cyan-600 border-gray-300 rounded-full" />
                                <label for="agent" class="ml-3 block text-sm text-gray-800">
                                    Agent
                                </label>
                            </div>
                        </div>

                        <div class="!mt-8">
                            <button type="submit"
                                class="w-full py-3 px-4 text-base font-semibold tracking-wide rounded-lg text-white bg-cyan-500 hover:bg-cyan-600 focus:outline-none">
                                Forget Password
                            </button>
                        </div>
                        <p class="text-gray-800 text-sm !mt-8 text-center">Back to Login? <a
                                href="/parking-point/login.php"
                                class="text-cyan-500 hover:underline ml-1 whitespace-nowrap font-semibold">Login
                            </a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>