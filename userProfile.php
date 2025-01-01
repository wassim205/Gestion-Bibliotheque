<?php


session_start();
if(!isset($_SESSION["user_id"])){
   header('Location: login.php');
   exit;
}

require_once 'Class/BooksClass.php';
require_once 'Class/DatabaseClass.php';
require_once 'Class/CategoryClass.php';
require_once 'Class/UserClass.php';
$database = new Database();
$db = $database->connect();
$inst_Book = new Book($db);
$inst_Category = new Category($db);
$inst_user = New User($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['returnBook'])) {
        $book_id = $_POST['book_id'];
        $borrowing_id = $_POST['borrowing_id'];
        $inst_user->returnBook($borrowing_id , $book_id);
    }
    if (isset($_POST['cancelReservation'])) {
        $reservation_id = $_POST['reservation_id'];
        $inst_user->cancelReservation($reservation_id);
    }

}

$books = $inst_Book->getAllBooks();
$reserved_Books = $inst_user->getReservedBooks();
$borrowed_books = $inst_user->getBorrowedBooks();


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

    <div class="tracking-wide">Book<span class="text-red-600">Haven</span></div>
</div>

<!-- Menu -->
<div class="mt-12 flex flex-col gap-y-4 text-gray-500 fill-gray-500 text-sm">
    <div class="text-gray-400/70  font-medium uppercase">Menu</div>
    <a class="flex items-center space-x-2 py-1  group hover:border-r-4 hover:border-r-red-600 hover:font-semibold " href="userpage.php">
        <svg class="h-5 w-5 group-hover:fill-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" >
            <path d="M5 22h14v0c1.1 0 2-.9 2-2v-9 0c0-.27-.11-.53-.29-.71l-8-8v0c-.4-.39-1.02-.39-1.41 0l-8 8h0c-.2.18-.3.44-.3.71v9 0c0 1.1.89 2 2 2Zm5-2v-5h4v5Zm-5-8.59l7-7 7 7V20h-3v-5 0c0-1.11-.9-2-2-2h-4v0c-1.11 0-2 .89-2 2v5H5Z"></path>
        </svg>
        <span>Home</span>
    </a>

    <a class=" flex items-center space-x-2 py-1  font-semibold  border-r-4 border-r-red-600 pr-20" href="#">                  
        <svg class="h-5 w-5 fill-red-600 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
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
    <button type="submit" class=" flex items-center space-x-2 py-1 w-full group hover:border-r-4 hover:border-r-red-600 hover:font-semibold">                  
        <svg class="h-5 w-5 group-hover:fill-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g>
                <path d="M16 13v-2H7V8l-5 4 5 4v-3Z"></path>
                <path d="M20 3h-9c-1.11 0-2 .89-2 2v4h2V5h9v14h-9v-4H9v4c0 1.1.89 2 2 2h9c1.1 0 2-.9 2-2V5c0-1.11-.9-2-2-2Z"></path>
            </g>
        </svg>
        <span>Logout</span>
    </button>
    </form>
 
    <!-- <a class=" flex items-center space-x-2 py-1 mt-4" href="#">
        <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
            <input type="checkbox" name="toggle" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer" />
            <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
        </div>
        <label for="toggle" class="">Dark Theme</label>
    </a>  -->


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

            <div id="books_borrowed">
                <?php if (empty($borrowed_books)) : ?>
                    <p class="text-gray-500">No books borrowed yet.</p>
                <?php else : ?>
                    <h1 class=" text-2xl font-bold text-gray-900 p-5">Borrowed Books</h1>
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 ">
                                <th class="border border-gray-300 px-4 py-2 text-left">Book Cover</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Author</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Borrow Date</th>
                                <!-- <th class="border border-gray-300 px-4 py-2 text-left">return Date</th> -->
                                <th class="border border-gray-300 px-4 py-2 text-left">Due Date</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($borrowed_books as $borrowed_book) : ?>
                            <?php if (is_null($borrowed_book['return_date'])) : ?>
                                    <tr class="border-t border-gray-300">
                                        <td class="border border-gray-300 px-4 py-2">
                                            <img src="<?= htmlspecialchars($borrowed_book['cover_image']) ?>" alt="Book Image" class="w-12 h-12 object-cover object-center">
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($borrowed_book['title']) ?></td>
                                        <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($borrowed_book['author']) ?></td>
                                        <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($borrowed_book['borrow_date']) ?></td>
                                        <?php if (strtotime($borrowed_book['due_date']) < strtotime(date('Y-m-d'))) : ?>
                                            <td class="text-red-500 border border-gray-300 px-4 py-2"><?= htmlspecialchars($borrowed_book['due_date']) ?></td>
                                        <?php else : ?>
                                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($borrowed_book['due_date']) ?></td>
                                        <?php endif; ?>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <form action="#" method="post">
                                                <input type="hidden" name="book_id" value="<?= htmlspecialchars($borrowed_book['book_id']) ?>" />
                                                <input type="hidden" name="borrowing_id" value="<?= htmlspecialchars($borrowed_book['borrowing_id']) ?>" />
                                                <button name="returnBook" type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to return this book?')">Return</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php endif ; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

            <div id="books_reserved">
            <?php if (empty($reserved_Books)) : ?>
                <p class="text-gray-500">No books reserved yet.</p>
            <?php else : ?>
                <h1 class=" text-2xl font-bold text-gray-900 p-5">Reserved Books</h1>
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 ">
                            <th class="border border-gray-300 px-4 py-2 text-left">Book Cover</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Author</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Reservation Date</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reserved_Books as $reserved_Book) : ?>
                            <tr class="border-t border-gray-300">
                                <td class="border border-gray-300 px-4 py-2">
                                    <img src="<?= htmlspecialchars($reserved_Book['cover_image']) ?>" alt="Book Image" class="w-12 h-12 object-cover object-center">
                                </td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($reserved_Book['title']) ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($reserved_Book['author']) ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($reserved_Book['reservation_date']) ?></td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <form action="#" method="post">
                                        <input type="hidden" name="reservation_id" value="<?= htmlspecialchars($reserved_Book['reservation_id']) ?>" />
                                        <button name="cancelReservation"  type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to cancel this reservation?')">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            </div>




    </main>




    </div>





</body>




</html>