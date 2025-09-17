<?php
// auth.php - simple helpers for session + role checking

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Require user to be logged in. If not, redirect to login.
 */
function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: /ems/login.php");
        exit();
    }
}

/**
 * Require a specific role (or one of roles in array).
 * If user lacks role, show access denied (or redirect).
 *
 * @param string|array $roles
 */
function require_role($roles) {
    if (!isset($_SESSION['role'])) {
        header("Location: /ems/login.php");
        exit();
    }
    $userRole = $_SESSION['role'];
    if (is_array($roles)) {
        if (!in_array($userRole, $roles)) {
            http_response_code(403);
            echo "Access Denied: insufficient privileges.";
            exit();
        }
    } else {
        if ($userRole !== $roles) {
            http_response_code(403);
            echo "Access Denied: insufficient privileges.";
            exit();
        }
    }
}
