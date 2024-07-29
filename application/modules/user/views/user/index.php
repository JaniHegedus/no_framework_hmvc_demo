<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users</title><!-- Title -->
    <!-- Calling the StyleSheets -->
    <link rel="stylesheet" href="/public/css/General.css">
    <link rel="stylesheet" href="/public/css/Sidebar.css">
    <link rel="stylesheet" href="/public/css/Header.css">
    <script src="/no_framework/public/js/alerts.js"></script>
    <!-- Creating Icon -->
    <link rel="icon" href="https://cdn.iconscout.com/icon/premium/png-256-thumb/user-database-15-805248.png" type="image/x-icon">
</head>
<body>
<?php
// Include the header.php
require 'application/views/partials/header.php';

// Call the function with the specific context
renderHeader('Users', true, true,
    [
        'inputFields' => [
            ['class' => 'id-bar', 'name' => 'id', 'type' => 'number', 'placeholder' => 'Id:'],
            ['class' => 'user-name-bar', 'name' => 'UserName', 'type' => 'text', 'placeholder' => 'UserName']
        ],
        'buttons' => [
            ['class' => 'plus-button', 'name' => 'create', 'value' => '', 'formaction' => '/user/create', 'iconClass' => 'plus-icon', 'iconSrc' => '/public/images/icons/iconmonstr-user-23.svg', 'alt' => 'Add', 'tooltip' => 'Add']
        ]
    ],
    [
        'inputFields' => [
            ['class' => 'user-id-bar', 'name' => 'remid', 'type' => 'number', 'placeholder' => 'RemoveId:']
        ],
        'buttons' => [
            ['class' => 'minus-button', 'name' => 'delete', 'value' => '', 'formaction' => '/user/delete', 'iconClass' => 'minus-icon', 'iconSrc' => '/public/images/icons/iconmonstr-user-27.svg', 'alt' => 'Remove', 'tooltip' => 'Remove']
        ]
    ]
);
//Creating Navigation Bar
include 'application/views/partials/navbar.php';
?>

<!-- Display Users Table -->
<div class="user-table">
    <h2>Current Users</h2>
    <table class="welcome-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">No users found</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?php

if (isset($_SESSION['alert_message'])) {
    echo '<script>showAlert("' . $_SESSION['alert_message'] . '");</script>';
    unset($_SESSION['alert_message']);
}
?>
</body>
</html>
