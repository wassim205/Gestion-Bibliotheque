
<?php
session_start();
if($_SESSION['role'] != 'user'){
    header('Location: login.php');
    exit;
}

require_once 'Class/BooksClass.php';
require_once 'Class/DatabaseClass.php';
require_once 'Class/CategoryClass.php';

$database = new Database();
$db = $database->connect();
$inst_Book = new Book($db);
$books = $inst_Book->getAllBooks();
$inst_Category = new Category($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHaven</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">





</head>

<body class="font-montserrat text-sm bg-white" >
    <div class="flex min-h-screen  2xl:max-w-screen-2xl 2xl:mx-auto 2xl:border-x-2 2xl:border-gray-200 ">
    <aside class=" w-1/6 py-10 pl-10  min-w-min  border-r border-gray-300  hidden md:block ">

<div class=" font-bold text-lg flex items-center gap-x-3">
    <img src="image.png" class="w-8" alt="">

    <div class="tracking-wide ">Book<span class="text-red-600">Haven</span></div>
</div>

<!-- Menu -->
<div class="mt-12 flex flex-col gap-y-4 text-gray-500 fill-gray-500 text-sm">
    <div class="text-gray-400/70  font-medium uppercase">Menu</div>
    <a class="flex items-center space-x-2 py-1   font-semibold  border-r-4 border-r-red-600 pr-20 " href="#">
        <svg class="h-5 w-5 fill-red-600 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" >
            <path d="M5 22h14v0c1.1 0 2-.9 2-2v-9 0c0-.27-.11-.53-.29-.71l-8-8v0c-.4-.39-1.02-.39-1.41 0l-8 8h0c-.2.18-.3.44-.3.71v9 0c0 1.1.89 2 2 2Zm5-2v-5h4v5Zm-5-8.59l7-7 7 7V20h-3v-5 0c0-1.11-.9-2-2-2h-4v0c-1.11 0-2 .89-2 2v5H5Z"></path>
        </svg>
        <span>Home</span>
    </a>

    <a class=" flex items-center space-x-2 py-1  group hover:border-r-4 hover:border-r-red-600 hover:font-semibold " href="userProfile.php">
        <svg class="h-5 w-5 group-hover:fill-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M12 2v0C9.23 2 7 4.23 7 7c0 2.76 2.23 5 5 5 2.76 0 5-2.24 5-5v0c0-2.77-2.24-5-5-5Zm0 8v0c-1.66 0-3-1.35-3-3 0-1.66 1.34-3 3-3 1.65 0 3 1.34 3 3v0c0 1.65-1.35 3-3 3Zm9 11v-1 0c0-3.87-3.14-7-7-7h-4v0c-3.87 0-7 3.13-7 7v1h2v-1 0c0-2.77 2.23-5 5-5h4v0c2.76 0 5 2.23 5 5v1Z"></path>
        </svg>
        <span>Profile</span>
    </a>

   
    <div class="mt-8 text-gray-400/70  font-medium uppercase">General</div>
    <a class=" flex items-center space-x-2 py-1  group hover:border-r-4 hover:border-r-red-600 hover:font-semibold " href="#">                  
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:stroke-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        <span>Settings</span>
    </a>
    
    <form action="Logout.php">
    <button type="submit" class=" flex items-center space-x-2 py-1  w-full group hover:border-r-4 hover:border-r-red-600 hover:font-semibold ">                  
        <svg class="h-5 w-5 group-hover:fill-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g>
                <path d="M16 13v-2H7V8l-5 4 5 4v-3Z"></path>
                <path d="M20 3h-9c-1.11 0-2 .89-2 2v4h2V5h9v14h-9v-4H9v4c0 1.1.89 2 2 2h9c1.1 0 2-.9 2-2V5c0-1.11-.9-2-2-2Z"></path>
            </g>
        </svg>
        <span>Logout</span>
    </button>
    </form>
 
 



</div><!-- /Menu -->

</aside>

        <main class=" flex-1 py-10  px-5 sm:px-10 ">
            <div class="relative justify-end items-center content-center flex">

                <div class="relative items-center content-center flex ml-2">
                    <span class="text-gray-400 absolute left-4 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>

                    <input type="text" id="search-books" class="text-xs ring-1 bg-transparent ring-gray-200 focus:ring-green-300 pl-10 pr-5 text-gray-600 py-3 rounded-full w-full outline-none focus:ring-1"  placeholder="Search ..." oninput="searchBooks(this.value)">

                </div>
            </div>



            <section class="mt-9">

                <div  class="">

                    <div class="flex items-center justify-end">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <!-- Category Filter -->
                                <select id="categoryFilter" class="font-semibold text-gray-700 text-base">
                                <option value="all">All Categories</option>
                                <?php
                                $categories = $inst_Category->getAllCategories();
                                foreach ($categories as $category) : ?>
                                <option value="<?=htmlspecialchars($category->getName()) ?>"> <?=htmlspecialchars($category->getName())?></option>;

                                <?php endforeach ; ?>
                                </select>
                                <!-- Status Filter -->
                                <select id="statusFilter" class="font-semibold text-gray-700 text-base">
                                    <option value="all">All Books</option>
                                    <option value="available">Available Books</option>
                                    <option value="unavailable">Unavailable Books</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <!-- Books Grid -->
                <div id="booksGrid" class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-x-5 gap-y-5">

                </div>
                </div>

            </section>

        </main>




    </div>



    <script>
        function fetchBooks() {
            const category = $('#categoryFilter').val();
            const filtrage = $('#statusFilter').val();

            $.ajax({
                url: 'filter_books.php',
                method: 'POST',
                data: {
                    category: category,
                    filtrage: filtrage,
                },
                success: function(response) {
                    $('#booksGrid').html(response);
                },
                error: function() {
                    $('#booksGrid').html('<p class="text-center text-gray-500">Failed to fetch books.</p>');
                }
            });
        }


        $('#categoryFilter, #statusFilter').on('change', fetchBooks);
        $(document).ready(fetchBooks);





    </script>

</body>

</html>