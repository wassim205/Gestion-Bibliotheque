<?php
require '../Class/DatabaseClass.php';
require '../AdminController/homepagecontroller.php';

$database = new Database();
$db = $database->connect();

$admin = new Admin($db);
$books = $admin->displayBooks();
$categories = $admin->displayCategories();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-100 h-screen">
    <div class="flex h-full z-10">
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
                    <a class="bg-blue-600 text-white py-1 px-3 rounded-lg" href="../logout.php">Log Out</a>
                </div>
            </header>

            <main class="p-6 flex-1 overflow-y-auto">
                
            <div class="flex justify-end">
                <form action="" method="POST">
                <button class="bg-blue-600 text-white py-1 px-3 rounded-lg" name="addbook">Add a book</button>
                </form>
            </div>

                <div class="mt-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-bold p-4">All books</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b">
                            <th class="py-2 px-4">Image</th>
                                <th class="py-2 px-4">Title</th>
                                <th class="py-2 px-4">Author</th>
                                <th class="py-2 px-4">Categorie</th>
                                <th class="py-2 px-4">The number of times borrowed</th>
                                <th class="py-2 px-4">Status</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($books as $book) : ?>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-2 px-4"><img src="<?php echo $book['cover_image']; ?>" alt="" width="50"></td>
                                <td class="py-2 px-4 cursor-pointer hover:text-blue-700 hover:font-bold hover:underline"><?php echo $book['title']; ?></td>
                                <td class="py-2 px-4"><?php echo $book['author']; ?></td>
                                <td class="py-2 px-4"><?php echo $book['name']; ?></td>
                                <td class="py-2 px-4"><?php echo $book['summary']; ?></td>
                                <td class="py-2 px-4"><?php echo $book['status']; ?></td>
                                <td class="py-2 px-4 flex items-center w-full">
                                    <a href="#" class="text-blue-600 hover:underline mx-3">Modifier</a>
                                    <a href="#" class="text-red-600 hover:underline">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    
    <?php if (isset($_POST['addbook'])) : ?>
    <div id="formOverlay" class="fixed flex flex-col w-full h-full top-0 items-center justify-center bg-black bg-opacity-95">
        <div class="flex justify-center items-center w-full px-4">
            <h1 class="text-2xl font-bold mb-6 mr-32 text-center text-blue-800">Insert New Book</h1>
            <i class="fa-solid fa-xmark text-white cursor-pointer mb-4 mr-6" onclick="closeForm()" style="font-size: 24px;"></i>
        </div>
        <form action="../AdminController/Gestion_book.php" method="POST" class="space-y-4 w-1/3">
            <div>
                <label for="title" class="block text-md font-medium text-white">Book Title</label>
                <input type="text" id="title" name="title" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="author" class="block text-md font-medium text-white">Book Author</label>
                <input type="text" id="author" name="author" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="cover_image" class="block text-md font-medium text-white">Cover Image Link</label>
                <input type="url" id="cover_image" name="cover_image" placeholder="https://example.com/image.jpg" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="summary" class="block text-md font-medium text-white">Summary</label>
                <textarea id="summary" name="summary" rows="5" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
            </div>
            <div>
                <label for="category" class="block text-md font-medium text-white">Category</label>
                <select type="text" id="category" name="category" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <?php foreach($categories as $category) : ?> 
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md shadow" name="insertBook">Insert Book</button>
            </div>
        </form>
    </div>
<?php endif ?>

<script>
    function closeForm() {
        document.getElementById('formOverlay').style.display = 'none';
    }
</script>

    
</body>

</html>