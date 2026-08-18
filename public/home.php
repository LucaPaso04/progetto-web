<?php
    session_start();

    include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    // Get user session id
    $id_user = $_SESSION['user_id'] ?? null;

    // Get user matches ordered by date and hour
    $stmt = $pdo->prepare("SELECT m.*, p.team FROM `match` m JOIN `partecipation` p ON m.id_match = p.id_match WHERE p.id_user = ? ORDER BY m.date ASC, m.hour ASC");
    $stmt->execute([$id_user]);
    $partite = $stmt->fetchAll(PDO::FETCH_ASSOC);
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