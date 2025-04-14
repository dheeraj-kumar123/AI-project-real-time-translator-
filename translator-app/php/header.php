<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Translator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <header class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-language text-2xl"></i>
                <h1 class="text-xl font-bold">Travel Translator</h1>
            </div>
            <nav class="hidden md:flex space-x-6">
                <a href="/" class="hover:text-blue-200 transition"><i class="fas fa-home mr-1"></i> Home</a>
                <a href="/phrasebook.php" class="hover:text-blue-200 transition"><i class="fas fa-book mr-1"></i> Phrasebook</a>
                <a href="/live-translate.php" class="hover:text-blue-200 transition"><i class="fas fa-comments mr-1"></i> Live Translate</a>
                <a href="/camera-translate.php" class="hover:text-blue-200 transition"><i class="fas fa-camera mr-1"></i> Camera</a>
            </nav>
            <div class="flex items-center space-x-4">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="/profile.php" class="hover:text-blue-200 transition"><i class="fas fa-user-circle mr-1"></i> Profile</a>
                    <a href="/logout.php" class="hover:text-blue-200 transition"><i class="fas fa-sign-out-alt mr-1"></i> Logout</a>
                <?php else: ?>
                    <a href="/login.php" class="hover:text-blue-200 transition"><i class="fas fa-sign-in-alt mr-1"></i> Login</a>
                    <a href="/register.php" class="bg-blue-700 px-3 py-1 rounded hover:bg-blue-800 transition">Register</a>
                <?php endif; ?>
            </div>
            <button id="mobile-menu-button" class="md:hidden text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-blue-700 px-4 py-2">
            <a href="/" class="block py-2 hover:text-blue-200 transition"><i class="fas fa-home mr-2"></i>Home</a>
            <a href="/phrasebook.php" class="block py-2 hover:text-blue-200 transition"><i class="fas fa-book mr-2"></i>Phrasebook</a>
            <a href="/live-translate.php" class="block py-2 hover:text-blue-200 transition"><i class="fas fa-comments mr-2"></i>Live Translate</a>
            <a href="/camera-translate.php" class="block py-2 hover:text-blue-200 transition"><i class="fas fa-camera mr-2"></i>Camera</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="/profile.php" class="block py-2 hover:text-blue-200 transition"><i class="fas fa-user-circle mr-2"></i>Profile</a>
                <a href="/logout.php" class="block py-2 hover:text-blue-200 transition"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
            <?php else: ?>
                <a href="/login.php" class="block py-2 hover:text-blue-200 transition"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
                <a href="/register.php" class="block py-2 hover:text-blue-200 transition"><i class="fas fa-user-plus mr-2"></i>Register</a>
            <?php endif; ?>
        </div>
    </header>
    <main class="container mx-auto px-4 py-6">