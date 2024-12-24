
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
                    <li><a href="Dashboard.php"
                            class="flex items-center gap-2 text-lg hover:bg-blue-500 p-2 rounded"><span>🏠</span>
                            Home</a></li>
                    <li><a href="UsersManaging.php"
                            class="flex items-center gap-2 text-lg hover:bg-blue-500 p-2 rounded"><span>📋</span>
                            Users</a></li>
                    <li><a href="Books.php"
                            class="flex items-center font-bold gap-2 text-lg hover:bg-blue-500 p-2 rounded"><span>📁</span>
                            Books</a></li>
                </ul>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-800">Dashboard Overview</h2>
                <div class="flex items-center space-x-4">
                    <input type="text" placeholder="Search..." class="py-1 px-3 border rounded-lg text-sm">
                    <a class="bg-blue-600 text-white py-1 px-3 rounded-lg" href="logout.php">Log Out</a>
                </div>
            </header>

            <main class="p-6 flex-1 overflow-y-auto">
                
            <div class="flex justify-end">
                <button class="bg-blue-600 text-white py-1 px-3 rounded-lg">Add a book</button>
            </div>

                <div class="mt-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-bold p-4">All books</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b">
                            <th class="py-2 px-4">Image</th>
                                <th class="py-2 px-4">Title</th>
                                <th class="py-2 px-4">Author</th>
                                <th class="py-2 px-4">The number of times borrowed</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="bookTableBody">
                            <tr class="border-b hover:bg-gray-100">
                            <td class="py-2 px-4"></td>
                                <td class="py-2 px-4 cursor-pointer hover:text-blue-700 hover:font-bold hover:underline">E-commerce Website</td>
                                <td class="py-2 px-4">Jane Doe</td>
                                <td class="py-2 px-4 font-bold text-red-500">15</td>
                                <td class="py-2 px-4"><a href="#" class="text-blue-600 hover:underline">Details</a></td>
                            </tr>
                            <tr class="border-b hover:bg-gray-100">
                            <td class="py-2 px-4"></td>
                                <td class="py-2 px-4 cursor-pointer hover:text-blue-700 hover:font-bold hover:underline">Portfolio Website</td>
                                <td class="py-2 px-4">John Smith</td>
                                <td class="py-2 px-4 font-bold text-red-500">14</td>
                                <td class="py-2 px-4"><a href="#" class="text-blue-600 hover:underline">Details</a></td>
                            </tr>
                            <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4"></td>
                                <td class="py-2 px-4 cursor-pointer hover:text-blue-700 hover:font-bold hover:underline">Blog Website</td>
                                <td class="py-2 px-4 ">Alice Johnson</td>
                                <td class="py-2 px-4 font-bold text-red-500">5</td>
                                <td class="py-2 px-4"><a href="#" class="text-blue-600 hover:underline">Details</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>

</html>