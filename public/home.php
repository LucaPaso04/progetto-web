<?php
    session_start();

    include_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/config/functions.php');

    // Check if user is logged in
    requireLogin();

    // Get user session id
    $id_user = getLoggedUserId();

    // Get all matches, team and host username ordered by match date and hour
    $partite = getAllMatches();
?>

<!DOCTYPE html>
<html lang="it">
    <!--Header template-->
    <?php
        $titolo = "Homepage";
        include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/header.php');
    ?>
    <!--BODY-->

    <h1 class="text-center mt-2">Home</h1>

    <div class="row">
        <?php
            if (count($partite) > 0) {
                foreach ($partite as $partita) {
                    include($_SERVER['DOCUMENT_ROOT'] . '/templates/match_card.php');
                }
            } else {
                echo '<p class="text-center">Non partecipi ancora a nessuna partita.</p>';
            }
        ?>
    </div>

    <!--/BODY-->
    <!--Footer template-->
    <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php');
    ?>
</html>