<?php
    session_start();

    include_once __DIR__ . '/../config/database.php';
    include_once __DIR__ . '/../config/functions.php';

    // Check if user is logged in
    //requireLogin();

    // Get user session id
    $id_user = getLoggedUserId();
    $id_user = -1;

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
        include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/header.php');
    ?>
    <!--BODY-->

    <h1 class="text-center mt-2">Home</h1>

    <!-- Display user matches -->
    <div class="row">
        <h2 class="mt-2">Le tue partite</h2>
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
        <h2 class="mt-2">Tutte le partite</h2>
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

    <!--Footer template-->
    <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php');
    ?>
</html>