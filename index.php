
<?php
session_start();
unset($_SESSION["user_id"]);

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

    <div class="flex min-h-screen mt-0  2xl:max-w-screen-2xl 2xl:mx-auto 2xl:border-x-2 2xl:border-gray-200 ">


        <main class="flex-1 py-10  pb-5 sm:px-10 ">
            <div class="relative items-center content-center flex">

                <div class="relative items-center content-center flex gap-5 ml-2 font-medium">
                    <p>You must be logged in to borrow a book. Please <a href="login.php" class="text-blue-400 underline hover:text-red-500">log in</a> or <a href="sign-up.php" class="text-blue-400 underline hover:text-red-500">create an account</a>.</p>
                    <!-- <button class="flex items-center space-x-2 group">
                        <svg class="h-5 w-5 group-hover:fill-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g>
                                <path d="M16 13v-2H7V8l-5 4 5 4v-3h9Z"></path>
                                <path d="M19 3H9c-1.1 0-2 .9-2 2v4h2V5h10v14H9v-4H7v4c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2Z"></path>
                            </g>
                        </svg>
                        <span>Login</span>
                    </button>

                    <button class="flex items-center space-x-2 group">
                        <svg class="h-5 w-5 group-hover:fill-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g>
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4Z"></path>
                                <path d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4Z"></path>
                                <path d="M20 12h-3v-2h3V7h2v3h3v2h-3v3h-2Z"></path>
                            </g>
                        </svg>
                        <span>Create Account</span>
                    </button> -->
                </div>
            </div>



            <section class="mt-9">

                <div  class="">

                    <div class="flex items-center justify-end">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">

                                <select id="categoryFilter" class="font-semibold text-gray-700 text-base">
                                <option value="all">All Categories</option>
                                <?php
                                $categories = $inst_Category->getAllCategories();
                                foreach ($categories as $category) : ?>
                                <option value="<?=htmlspecialchars($category->getName()) ?>"> <?=htmlspecialchars($category->getName())?></option>;
                                    
                                <?php endforeach ; ?>
                                </select>

                                <select id="statusFilter" class="font-semibold text-gray-700 text-base">
                                    <option value="all">All Books</option>
                                    <option value="available">Available Books</option>
                                    <option value="unavailable">Unavailable Books</option>
                                </select>
                            </div>
                        </div>
                    </div>

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