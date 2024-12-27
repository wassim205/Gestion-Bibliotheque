<?php
require '../Class/DatabaseClass.php';
require '../AdminController/homepagecontroller.php';

$database = new Database();
$db = $database->connect();

$admin = new Admin($db);
$userCount = $admin->getUsersCount();
$booksCount = $admin->getBooksNumber();
$availableBooks = $admin->getAvailableBooks();
$borrowedBooks = $admin->borrowedBooks();
$topBooks = $admin->topBorrowedBooks();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen">
    <div class="flex h-full">
        <aside class="w-64 bg-blue-600 text-white hidden md:block">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Dashboard</h1>
            </div>
            <nav>
                <ul class="space-y-4 p-4">
                    <li><a href="#"
                            class="flex items-center font-bold gap-2 text-lg hover:bg-blue-500 p-2 rounded"><span>🏠</span>
                            Home</a></li>
                    <li><a href="UsersManaging.php"
                            class="flex items-center gap-2 text-lg hover:bg-blue-500 p-2 rounded"><span>📋</span>
                            Users</a></li>
                    <li><a href="Books.php"
                            class="flex items-center gap-2 text-lg hover:bg-blue-500 p-2 rounded"><span>📁</span>
                            Books</a></li>
                </ul>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-800">Dashboard Overview</h2>
                <div class="flex items-center space-x-4">
                    <input type="text" placeholder="Search..." class="py-1 px-3 border rounded-lg text-sm">
                    <a class="bg-blue-600 text-white py-1 px-3 rounded-lg" href="../logout.php">Log Out</a>
                </div>
            </header>

            <main class="p-6 flex-1 overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-sm text-gray-500">Total Users</h3>
                        <p class="text-2xl font-bold"><?php echo $userCount; ?></p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-sm text-gray-500">The number of Books</h3>
                        <p class="text-2xl font-bold"><?php echo $booksCount ?></p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-sm text-gray-500">The available books</h3>
                        <p class="text-2xl font-bold"><?php  echo $availableBooks?></p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-sm text-gray-500">Borrowed books</h3>
                        <p class="text-2xl font-bold"><?php  echo $borrowedBooks?></p>
                    </div>
                </div>

                <div class="mt-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-bold p-4">Top Borrowed books</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2 px-4">Title</th>
                                <th class="py-2 px-4">Author</th>
                                <th class="py-2 px-4">The number of borrows</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($topBooks as $topBook) : ?>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-2 px-4"><?php echo $topBook['title']; ?></td>
                                <td class="py-2 px-4"><?php echo $topBook['author']; ?></td>
                                <td class="py-2 px-4"><?php echo $topBook['title']; ?></td>
                            </tr>
                            <?php  endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>


  </body>
</html>