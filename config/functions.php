<?php

//Authentication functions

function isUserLoggedIn(): bool
{
    return isset($_SESSION["user_id"]);
}

function requireLogin(): void
{
    if (!isUserLoggedIn()) {
        header("Location: /index.php");
        exit;
    }
}

function getLoggedUserId(): ?int
{
    if (!isUserLoggedIn()) {
        return null;
    }

    return (int) $_SESSION["user_id"];
}

function hasRole(string $role): bool
{
    return isset($_SESSION["user_role"])
        && $_SESSION["user_role"] === $role;
}

// Validation functions

// Security functions

// Database functions

function getAllMatches(): array
{
    $sql = "
        SELECT m.*, p.team, u.username AS host_username
        FROM `match` AS m
        JOIN partecipation AS p ON m.id_match = p.id_match
        JOIN `user` AS u ON m.id_host = u.id_user
        ORDER BY m.date ASC, m.hour ASC
    ";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Errore nella preparazione: " . $conn->error);
    }

    $stmt->execute();

    $result = $stmt->get_result();
    $matches = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    return $matches;
}


// Utility functions