<?php
@include 'config.php';

session_start();

$name=$_SESSION['user_name'];
if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER PAGE</title>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="adminpage2.css">

    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="list_galleries.js"></script>
    <script src="ajaxslike.js"></script>
    <script src="ocjeni.js"></script>

    <style>
        html {
            height: 100%;
            position: relative;
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
        }

        .foot {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            margin-top: auto;
        }
    </style>

</head>

<body>
    <div id="test-div" data-name="<?php echo $name; ?>"></div>
    <span id="rezultat_ocjene"></span>

    <div class="container">

        <nav class="navbar">
            <div class="nav-left">
                <img src="loo.png" alt="logo"></img>
                <br>
                <a href="home.php" onclick="logout.php">Home</a>
            </div>
            <div class="nav-right">
                <span>Prijavljeni ste kao <?php echo $_SESSION['user_name']; ?></span>
                <a href="logout.php" class="btn">Logout</a>
            </div>
        </nav>

        <div class="content">
            <br>
            <br>

            <div class="control-panel">
                <div class="form-buttons">
                    <button onclick="listGalleries()" class="btn">Izlistaj galerije</button>
                </div>

                <br>
                <br>
                <form class="gallery-form" action="">
                <label style="color: white;" for="delete-gallery-select">Izaberite galeriju za učitavanje:</label>
                        <select id="delete-gallery-select" class="select-gallery" style="width: 200px;">
                        <option value="Odaberite ID galerije koju želite učitati" disabled select></option>
                        <?php
                            // Povezivanje na bazu podataka
                            include 'config.php';

                            // Izvršavanje upita za dohvaćanje ID-eva galerija
                            $query = "SELECT ID FROM galerija";
                            $result = mysqli_query($conn, $query);

                            // Prolazak kroz rezultate i stvaranje opcija za select
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['ID']}'>{$row['ID']}</option>";
                            }

                            // Oslobađanje resursa
                            mysqli_free_result($result);

                            // Zatvaranje konekcije
                            mysqli_close($conn);
                        ?>
                    </select>
                    <input type="submit" name="submit" value="Učitaj" class="btn">
                </form>
            </div>

            <br>
            <br>
            <br>

            <div id="gallery-list" class="gallery-container"></div>

        </div>
    </div>

    <footer class="foot">
        <center>
            <p style="color:yellow">Objektiv Web Gallery</p>
        </center>
        <center>
            <p>Sva prava zadržana. &copy; 2024</p>
            <br>
            <p>Kontakt informacije:</p>
            <br>
            <p>E-mail: <a href="mailto:pavicdejan005@gmail.com">E-mail</a></p>
            <br>
            <p>Telefon: 066/343-118</p>
            <br>
        </center>
    </footer>
</body>

</html>
