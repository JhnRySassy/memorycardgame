<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/landingpage.css" />
    <title>Rick and Morty Memory Card Game</title>
</head>
<body>
        
    <header>
        <h2>Rick and Morty Memory Card Game</h2>
        <ul>
            <li>Home</li>
            <li>Play</li>
            <li>Wallet</li>
            <li>Coins</li>
            <a href="Log_in.php">Log out</a>
        </ul>
    </header>
    <div class="logo">
        <!-- <img src="assets/rickandmortylogo.png"> -->
      </div>
    <main>
        <p>Welcome to Rick and Morty Memory Card Game <?php echo $user_data['user_name'] ?></p>
        <a href="CardGame.php" class="button">Single Player</a>
        <a href="createlobby.php" class="button">Create Lobby</a>
        <a href="CardGame.php" class="button">Join Lobby</a>
        <a href="CardGame.php" class="button">Leaderboards</a>
    </main>
</body>
</html>