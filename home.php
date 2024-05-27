<div?php
@include 'config.php';

session_start();

$name = $_SESSION['admin_name'];
if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="adminpage2.css">

    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>

.foot {
    text-align: center; /* Centriranje teksta */
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    margin-bottom: 20px;
}

.foot p {
    margin: 0; /* Uklanja podrazumevani margin za paragrafe unutar .foot */
}

.foot a {
    color: blue; /* Boja linkova unutar .foot */
 
    margin: 0 10px; /* Daje malu razdaljinu između linkova */
}

        .highlight-div {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            background-color: rgba(20, 53, 219, 0.5);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .highlight-div p {
            
            font-size: 18px;
            color: red;
        }
        .highlight-div a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .highlight-div a:hover {
            background-color: #0056b3;
        }
        .highlight-div h2 {
           color:red;
        }
    </style>
</head>

<body>
    <div id="test-div" data-name="<?php echo $name; ?>"></div>
    <span id="rezultat_ocjene"></span>

    <div class="container">
        <nav class="navbar">
            <div class="nav-left">
                <img src="loo.png" alt="Logo">
                <br>
                <a href="login_form.php">Galerije</a>
            </div>
        </nav>

        <center>
            <img src="nas.png" width="400" height="400" alt="Naslovna slika">
            <div class="highlight-div">

            <h2>Dobrodošli!</h2>
            <br>
                <p>Drago nam je što ste ovde! Naša galerija je posvećena dijeljenju prelijepih slika koje hvataju trenutke iz svakodnevnog života, prirode, putovanja i još mnogo toga. Bilo da tražite inspiraciju, uživate u ljepoti svijeta oko nas, ili jednostavno želite da se opustite uz divne prizore, na pravom ste mjestu.

Pregledajte našu raznovrsnu kolekciju fotografija i pronađite one koje vas najviše inspirišu ili vas podsećaju na posebne trenutke. Svaka slika ima svoju priču i naš cilj je da vam omogućimo da ih doživite. Također možete ocijeniti slike i dati nam povratnu informaciju kako vam se sviđaju iste</p>
                <a href="user_page.php">Pogledajte dostupne galerije</a>
            </div>
        </center>
    </div>

    <br>
    <br>
    <br>

    <footer class="foot">

    <center><p style="color:yellow">Objektiv Web Gallery</p></center>
    <center><p>Sva prava zadržana. &copy; 2024</p>
    <br>
    <p>Kontakt informacije:</p><br>
        <p>E-mail: <a href="mailto:pavicdejan005@gmail.com">E-mail</a></p>
        <br>
        <p>Telefon: 066/343-118</p>
<br>
        </center>
    

</footer>

</body>
</html>
