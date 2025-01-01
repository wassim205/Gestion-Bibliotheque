<?php
require_once 'Class/BooksClass.php';
require_once 'Class/DatabaseClass.php';


session_start();
$database = new Database();
$db = $database->connect();
$bookController = new Book($db);

$selectedCategory = isset($_POST['category']) ? $_POST['category'] : 'all';
$selectedStatus = isset($_POST['filtrage']) ? $_POST['filtrage'] : 'all';

$books = $bookController->getAllBooks();
$filteredBooks = array_filter($books, function ($book) use ($selectedCategory, $selectedStatus) {
    $matchesCategory = $selectedCategory === 'all' || $book->getCategory() === $selectedCategory;
    $matchesStatus = $selectedStatus === 'all' ||
                     ($selectedStatus === 'available' && $book->getBookStatus() === 'available') ||
                     ($selectedStatus === 'unavailable' && $book->getBookStatus() !== 'available');
    return $matchesCategory && $matchesStatus;
});

// Generate HTML for filtered books
foreach ($filteredBooks as $book) : ?>

    <div class='relative rounded-xl overflow-hidden cursor-pointer group '>
        <img src='<?= htmlspecialchars($book->getCoverImage()) ?>' class='object-cover w-full h-full -z-10' alt='Book cover'>
        <div class='absolute text-right top-0 h-full w-full bg-gradient-to-t from-black/50 p-3 flex flex-col justify-between '>
            <form action='Controllers/borrowing_reservation.php' method='POST' class='h-1/11 flex justify-end'>
                <input type="hidden" name="book_id" id="" value="<?=htmlspecialchars($book->getId());?>">
                <?php  if($book->getBookStatus() == 'available'){
                    if(isset($_SESSION["user_id"])){
                        echo '<button name="Borrow_book" type="submit" class="z-30 w-1/4  hover:bg-green-500 p-2.5 bg-gray-800/80 rounded-lg text-white self-end hover:bg-red-600/80">Borrow</button>';
                    }
                    else{
                        echo '<div onclick="showLoginInfo()" class="z-30   hover:bg-green-500 p-2.5 bg-gray-800/80 rounded-lg text-white self-end hover:bg-red-600/80">Borrow</div>';
                    }
                }
                else{
                    if(isset($_SESSION["user_id"])){
                        echo '<button name="Reserve_book" type="submit" class="z-30 w-1/4  hover:bg-green-500 p-2.5 bg-gray-800/80 rounded-lg text-white self-end hover:bg-red-600/80">Reserve</button>';

                    }
                    else{
                        echo '<div onclick="showLoginInfo()" class="z-30 hover:bg-green-500 p-2.5 bg-gray-800/80 rounded-lg text-white self-end hover:bg-red-600/80">Reserve</div>';
                    }
                }

                ?>

            </form>

            <div class='self-center flex flex-col items-center space-y-2'>
                <span class='capitalize text-white font-medium drop-shadow-md'><strong>Author:</strong> <?= htmlspecialchars($book->getAuthor()) ?></span>
                <span class='text-gray-300 text-xs'><strong>Title:</strong> <?= htmlspecialchars($book->getTitle()) ?></span>
                <span class='text-gray-300 text-xs'><strong>Category:</strong> <?= htmlspecialchars($book->getCategory()) ?></span>
            </div>
        </div>
        <div class='hidden group-hover:block text-red-500 font-bold absolute w-full h-full top-0 bg-black bg-opacity-60 z-20'>
            <div class='flex justify-center items-center h-full w-full'>
                <button class=" h-full w-full" onclick="showSection('sectionX-<?= $book->getId() ?>')">More Details</button>
            </div>
        </div>
    </div>
    
    <section id='sectionX-<?= $book->getId() ?>' class='fixed hidden flex flex-col w-full h-full top-0 items-center justify-center bg-black bg-opacity-95 z-50'>
        <div class='w-1/2 mx-auto bg-purple-400 p-5'>
            <div class='card-container flex justify-end'>
                <button name='hideElement' onclick="hideSection('sectionX-<?= $book->getId() ?>')">✖</button>
            </div>
            <div class='text-white flex items-center'>
                <div>
                    <img src="<?= htmlspecialchars($book->getCoverImage()) ?>" alt="">
                </div>
                <div class='p-5'>
                    <h2 class='text-2xl font-bold'>Title : <?= htmlspecialchars($book->getTitle()) ?></h2>
                    <p class='mt-2'><span class="text-lg font-medium">Author : </span> <?= htmlspecialchars($book->getAuthor()) ?></p>
                    <p class='mt-2'><span class="text-lg font-medium">Category : </span> <?= htmlspecialchars($book->getCategory()) ?></p>
                    <p class='mt-2'><span class="text-lg font-medium">Status : </span> <?= htmlspecialchars($book->getBookStatus()) ?></p>
                    <p class='mt-2'><span class="text-lg font-medium">Summary : </span> <?= htmlspecialchars($book->getSummary()) ?></p>
                </div>
           
            </div>
        </div>
    </section>

<?php endforeach; ?>


    <section id='login-info' class='fixed hidden flex flex-col w-full h-full top-0 items-center justify-center bg-black bg-opacity-95 z-50'>
        <div class='w-1/2 mx-auto bg-black bg-opacity-90 p-5'>
            <div class='card-container flex justify-end'>
                <button name='hideElement' onclick="hideSection('login-info')">✖</button>
            </div>
            <div class='text-white flex items-center text-lg font-medium'>
                <p>You must be logged in to borrow a book. Please <a href="login.php" class="text-blue-400 underline">log in</a> or <a href="sign-up.php" class="text-blue-400 underline">create an account</a>.</p>

           
            </div>
        </div>
    </section>
<script>
    function showSection(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function hideSection(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function showLoginInfo() {
            const infoSection = document.getElementById('login-info');
            if (infoSection.classList.contains('hidden')) {
                infoSection.classList.remove('hidden');
            } else {
                infoSection.classList.add('hidden');
            }
        }
</script>