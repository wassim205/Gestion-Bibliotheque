<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign-in</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>



<div class="py-16">
    <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
        <div class="hidden lg:block lg:w-1/2 bg-cover"
            style="background-image:url('img/ImgLogin.jpeg')">
        </div>
        <div class="w-full p-8 lg:w-1/2">
            <h2 class="text-2xl font-semibold text-gray-700 text-center"><span class="text-slate-400">welcome to </span><span class="text-[#FF5743]">Book</span>Haven</h2>



            <form action="Controllers/sign-upController.php" method="POST">
            <div class="mt-8 flex items-center justify-between ">
                <span class="border-b w-1/5 lg:w-1/4 "></span>
                <a class="text-xs text-center text-gray-500 uppercase">Regester</a>
                <span class="border-b w-1/5 lg:w-1/4"></span>
                
            </div>
            <?php if (isset($_GET['error'])): ?>
                <div id="error-message" class="text-red-500 mb-4">
                    <?php
                        if ($_GET['error'] === 'email_deja_enregistre') {
                            echo "This email is already registered.";
                        } elseif ($_GET['error'] === 'une_erreur_est_survenue') {
                            echo "An error has occurred, please try again.";
                        }
                    ?>
                </div>
            <?php endif; ?>




            <div class="mt-8">
                <label for="user_name" class="block text-gray-700 text-sm font-bold mb-2">Nom complet</label>
                <input type="text" id="user_name" name="user_name" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none">
                <span id="nameError" class="text-red-500 text-sm hidden">Please enter your full name.</span>
            </div>
            <div class="mt-8">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <input type="email" id="email" name="email" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none">
                <span id="emailError" class="text-red-500 text-sm hidden">Please enter your Email Address.</span>
            </div>
            <div class="mt-8">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none">
                <span id="passwordError" class="text-red-500 text-sm hidden">Please enter a password (minimum 8 characters).</span>
            </div>
            <div class="mt-8">
                <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Confirm password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none">
                <span id="confirmPasswordError" class="text-red-500 text-sm hidden">Passwords do not match.</span>
            </div>
            <div class="flex justify-center">
                <button type="submit" name="register" class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600 mt-8">Sing Up</button>
            </div>

            <div class="mt-4 flex items-center justify-between">
                <span class="border-b w-1/5 md:w-1/4"></span>
                <a href="login.php" class="text-xs text-gray-500 uppercase hover:text-[#FF5743]">or Back to login</a>
                <span class="border-b w-1/5 md:w-1/4"></span>
            </div>
        </form>
        </div>
    </div>
</div>


</body>
</html>