
<?php

require_once 'Class/BooksClass.php';
require_once 'Class/DatabaseClass.php';

$database = new Database();
$db = $database->connect();
$bookController = new Book($db);
$books = $bookController->getAllBooks();

?>

<!DOCTYPE html>
<html lang="en" :class="isDark ? 'dark' : 'light'" x-data="{ isDark: false }">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHaven</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">





</head>

<body class="font-montserrat text-sm bg-white dark:bg-zinc-900 " >
    <div class="flex min-h-screen  2xl:max-w-screen-2xl 2xl:mx-auto 2xl:border-x-2 2xl:border-gray-200 dark:2xl:border-zinc-700 ">
        <!-- Left Sidebar -->
        <!-- <aside class=" w-1/6 py-10 pl-10  min-w-min  border-r border-gray-300 dark:border-zinc-700  hidden md:block ">

            <div class=" font-bold text-lg flex items-center gap-x-3">
                <img src="image.png" class="w-8" alt="">
 
                <div class="tracking-wide dark:text-white">Book<span class="text-red-600">Haven</span></div>
            </div>

            
            <div class="mt-12 flex flex-col gap-y-4 text-gray-500 fill-gray-500 text-sm">
                <div class="text-gray-400/70  font-medium uppercase">Menu</div>
                <a class="flex items-center space-x-2 py-1 dark:text-white  font-semibold  border-r-4 border-r-red-600 pr-20 " href="#">
                    <svg class="h-5 w-5 fill-red-600 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" >
                        <path d="M5 22h14v0c1.1 0 2-.9 2-2v-9 0c0-.27-.11-.53-.29-.71l-8-8v0c-.4-.39-1.02-.39-1.41 0l-8 8h0c-.2.18-.3.44-.3.71v9 0c0 1.1.89 2 2 2Zm5-2v-5h4v5Zm-5-8.59l7-7 7 7V20h-3v-5 0c0-1.11-.9-2-2-2h-4v0c-1.11 0-2 .89-2 2v5H5Z"></path>
                    </svg>
                    <span>Home</span>
                </a>

                <a class=" flex items-center space-x-2 py-1  group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white " href="#">                  
                    <svg class="h-5 w-5 group-hover:fill-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 2v0C9.23 2 7 4.23 7 7c0 2.76 2.23 5 5 5 2.76 0 5-2.24 5-5v0c0-2.77-2.24-5-5-5Zm0 8v0c-1.66 0-3-1.35-3-3 0-1.66 1.34-3 3-3 1.65 0 3 1.34 3 3v0c0 1.65-1.35 3-3 3Zm9 11v-1 0c0-3.87-3.14-7-7-7h-4v0c-3.87 0-7 3.13-7 7v1h2v-1 0c0-2.77 2.23-5 5-5h4v0c2.76 0 5 2.23 5 5v1Z"></path>
                    </svg>
                    <span>Profile</span>
                </a>

               
                <div class="mt-8 text-gray-400/70  font-medium uppercase">General</div>
                <a class=" flex items-center space-x-2 py-1  group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white " href="#">                  
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:stroke-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                    <span>Settings</span>
                </a>
                <a class=" flex items-center space-x-2 py-1  group hover:border-r-4 hover:border-r-red-600 hover:font-semibold dark:hover:text-white" href="#">                  
                    <svg class="h-5 w-5 group-hover:fill-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g>
                            <path d="M16 13v-2H7V8l-5 4 5 4v-3Z"></path>
                            <path d="M20 3h-9c-1.11 0-2 .89-2 2v4h2V5h9v14h-9v-4H9v4c0 1.1.89 2 2 2h9c1.1 0 2-.9 2-2V5c0-1.11-.9-2-2-2Z"></path>
                        </g>
                    </svg>
                    <span>Logout</span>
                </a> 
                <a class=" flex items-center space-x-2 py-1 mt-4" href="#">
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="toggle" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer"  @click="isDark = !isDark" :value="isDark"/>
                        <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>
                    <label for="toggle" class="">Dark Theme</label>
                </a> 


            </div>

        </aside> -->
        <!-- /Left Sidebar -->

        <main class=" flex-1 py-10  px-5 sm:px-10 ">
            <div class="relative justify-end items-center content-center flex">




                <div class="relative items-center content-center flex ml-2">
                    <span class="text-gray-400 absolute left-4 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" class="text-xs ring-1 bg-transparent ring-gray-200 dark:ring-zinc-600 focus:ring-red-300 pl-10 pr-5 text-gray-600 dark:text-white  py-3 rounded-full w-full outline-none focus:ring-1" placeholder="Search ...">
                </div>
            </div>



            <section class="mt-9">

                <div  class="flex items-center justify-between">
                    <div id="availableStatut" class="hidden">
                        <span class="font-semibold text-gray-700 text-base dark:text-white">Available Books</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <!-- Category Filter -->
                                <select id="categoryFilter" class="font-semibold text-gray-700 text-base dark:text-white">
                                    <option value="all">All Categories</option>
                                    <option value="Romance">Romance</option>
                                    <option value="Fantasy">Fantasy</option>
                                    <option value="Horror">Horror</option>
                                </select>

                                <!-- Status Filter -->
                                <select id="statusFilter" class="font-semibold text-gray-700 text-base dark:text-white">
                                    <option value="all">All Books</option>
                                    <option value="available">Available Books</option>
                                    <option value="unavailable">Unavailable Books</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="mt-4 grid grid-cols-2  sm:grid-cols-4 gap-x-5 gap-y-5">
                    <?php foreach ($books as $book): ?>
                        <?php if ($book->getBookStatus() == "available" ): ?>

                            <div class="relative rounded-xl overflow-hidden ">
                                <img src="<?php echo htmlspecialchars($book->getCoverImage()); ?>" class="object-cover w-80 h-81 -z-10" alt="">
                                <div class="absolute top-0 h-full w-full bg-gradient-to-t from-black/50 p-3 flex flex-col justify-between">
                                    <?php if($book->getBookStatus() == "available"): ?>
                                        <a href="#" class="p-2.5 bg-gray-800/80 rounded-lg text-white self-end hover:bg-red-600/80">
                                            <span class="text-white text-xs">Borrow</span>
                                        </a>
                                    <?php else: ?>
                                        <a href="#" class="p-2.5 bg-gray-800/80 rounded-lg text-white self-end hover:bg-red-600/80">
                                        <span class="text-white text-xs">Reserve</span>

                                        </a>
                                    <?php endif; ?>
                                    <div class="self-center flex flex-col items-center space-y-2">
                                        <span class="capitalize text-white font-medium drop-shadow-md"><strong>Author:</strong> <?php echo htmlspecialchars($book->getAuthor()); ?></span>
                                        <span class="text-gray-300 text-xs"><strong>Category:</strong> <?php echo htmlspecialchars($book->getCategory());?></span>

                                    </div>
                                </div>
                            </div>
                            <script>
                                document.getElementById("availableStatut").classList.remove("hidden");
                            </script>
                        <?php endif ?>
                    <?php endforeach; ?>
                </div>

                <div id="inavailableStatut" class="flex hidden items-center justify-between mt-10">
                    <span class="font-semibold text-gray-700 text-base dark:text-white">In available Books</span>
                </div>
                <div class="mt-4 grid grid-cols-2  sm:grid-cols-4 gap-x-5 gap-y-5">
                    <?php foreach ($books as $book): ?>
                        <?php if ($book->getBookStatus() != "available" ): ?>
                            <div class="relative rounded-xl overflow-hidden ">
                            <img src="<?php echo htmlspecialchars($book->getCoverImage()); ?>" class="object-cover w-80 h-81 -z-10" alt="">
                            <div class="absolute top-0 h-full w-full bg-gradient-to-t from-black/50 p-3 flex flex-col justify-between">
                                <?php if($book->getBookStatus() == "available"): ?>
                                    <a href="#" class="p-2.5 bg-gray-800/80 rounded-lg text-white self-end hover:bg-red-600/80">
                                        <span class="text-white text-xs">Borrow</span>
                                    </a>
                                <?php else: ?>
                                    <a href="#" class="p-2.5 bg-gray-800/80 rounded-lg text-white self-end hover:bg-red-600/80">
                                    <span class="text-white text-xs">Reserve</span>

                                    </a>
                                <?php endif; ?>
                                <div class="self-center flex flex-col items-center space-y-2">
                                    <span class="capitalize text-white font-medium drop-shadow-md"><strong>Author:</strong> <?php echo htmlspecialchars($book->getAuthor()); ?></span>
                                    <span class="text-gray-300 text-xs"><strong>Category:</strong> <?php echo htmlspecialchars($book->getCategory());?></span>

                                </div>
                            </div>
                        </div>
                            <script>
                                document.getElementById("inavailableStatut").classList.remove("hidden");
                            </script>
                        <?php endif ?>

                    <?php endforeach; ?>

                </div>
            </section>

        </main>




    </div>

</body>

</html>