<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign-in</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>



<div class="py-16 mt-16">
    <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
        <div class="hidden lg:block lg:w-1/2 bg-cover"
            style="background-image:url('img/ImgLogin.jpeg')">
        </div>
        <div class="w-full p-8 lg:w-1/2">
            <h2 class="text-2xl font-semibold text-gray-700 text-center"><span class="text-slate-400">welcome to </span><span class="text-[#FF5743]">Book</span>Haven</h2>



            <form action="Controllers/loginController.php" method="POST">
            <div class="mt-8 flex items-center justify-between ">
                <span class="border-b w-1/5 lg:w-1/4 "></span>
                <a href="#" class="text-xs text-center text-gray-500 uppercase">login with email</a>
                <span class="border-b w-1/5 lg:w-1/4"></span>
                
            </div>
            <?php if (isset($_GET['message'])):
                        if ($_GET['message'] === 'identifiants_incorrects') {
                            ?>
                            <div id="error-message" class="text-red-500 mt-8">
                            <?php
                            echo "Incorrect Identifiers.";
                        }
                        else if ($_GET['message'] === 'inscription_reussie') {
                            ?>
                            <div id="error-message" class="text-green-500 mt-8">
                            <?php
                            echo "Registration successful. You can log in.";
                        }
                    ?>
                </div>
            <?php endif; ?>
            <div class="mt-8">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <input name="email" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="email" />
            </div>
            <div class="mt-8">
                <div class="flex justify-between">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <!-- <a href="#" class="text-xs text-gray-500">Forget Password?</a> -->
                </div>
                <input name="password" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="password" />
            </div>
            <div class="mt-8">
                <button type="submit" name="login" class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Login</button>
            </div>
            <div class="mt-8 flex items-center justify-between">
                <span class="border-b w-1/5 md:w-1/4"></span>
                <a href="sign-up.php" class="text-xs text-gray-500 uppercase">or sign up</a>
                <span class="border-b w-1/5 md:w-1/4"></span>
            </div>
        </form>
        </div>
    </div>
</div>


</body>
</html>