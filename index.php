
<?php

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