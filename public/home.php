<?php
    session_start();

    include_once __DIR__ . '/../config/database.php';
    include_once __DIR__ . '/../config/functions.php';

    // Check if user is logged in
    //requireLogin();

    // Get user session id
    $id_user = getLoggedUserId();
    $id_user = -1; //TODO solo per test

    // Get user matches, team and host username ordered by match date and hour
    $user_matches = getUserMatches($conn, $id_user);

    // Get all matches, team and host username ordered by match date and hour
    $all_matches = getAllMatches($conn);
?>

<!DOCTYPE html>
<html lang="it">
    <!--Header template-->
    <?php
        $titolo = "Home";
        $css_specifico = "/src/css/home.css";
        include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/header.php');
    ?>
    <!--BODY-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mt-2">Home</h1>
            </div>
        </div>

        <!-- Display user matches -->
        <div class="row">
            <div class="col-12">
                <h2 class="mt-2">Le tue partite</h2>
            </div>
        </div>

        <div class="row">
            <?php
                if (count($user_matches) > 0) {
                    foreach ($user_matches as $match) {
                        include($_SERVER['DOCUMENT_ROOT'] . '/templates/match_card.php');
                    }
                } else {
                    echo '<p class="text-center">Non partecipi ancora a nessuna partita.</p>';
                }
            ?>
        </div>

        <!-- Display all matches -->
        <div class="row">
            <div class="col-12">
                <h2 class="mt-2">Tutte le partite</h2>
            </div>
        </div>

        <div class="row">
            <?php
                if (count($all_matches) > 0) {
                    foreach ($all_matches as $match) {
                        include($_SERVER['DOCUMENT_ROOT'] . '/templates/match_card.php');
                    }
                } else {
                    echo '<p class="text-center">Non ci sono partite disponibili.</p>';
                }
            ?>
        </div>

        <!-- New Match Button -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-primary p-0 rounded-circle btn-add-match" title="Nuova partita" aria-label="Nuova partita">
                <i class="bi bi-plus"></i>
            </button>
        </div>
    </div>

    <!--Footer template-->
    <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php');
    ?>
</html>