<!DOCTYPE html>
<html lang="en">
<head>
    <title>Advertisements</title><!-- Title -->
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
renderHeader('Advertisements', true, true,
    [
        'inputFields' => [
            ['class' => 'id-bar', 'name' => 'id', 'type' => 'number', 'placeholder' => 'Id:'],
            ['class' => 'user-id-bar', 'name' => 'userid', 'type' => 'number', 'placeholder' => 'UserId:'],
            ['class' => 'user-title-bar', 'name' => 'title', 'type' => 'text', 'placeholder' => 'Title:']
        ],
        'buttons' => [
            ['class' => 'plus-button', 'name' => 'create', 'value' => 'button3', 'formaction' => '/advertisements/create', 'iconClass' => 'plus-icon', 'iconSrc' => '/public/images/icons/iconmonstr-plus-2.svg', 'alt' => 'Add', 'tooltip' => 'Add']
        ]
    ],
    [
        'inputFields' => [
            ['class' => 'user-id-bar', 'name' => 'remid', 'type' => 'number', 'placeholder' => 'RemoveId:']
        ],
        'buttons' => [
            ['class' => 'minus-button', 'name' => 'delete', 'value' => 'button4', 'formaction' => '/advertisements/delete', 'iconClass' => 'minus-icon', 'iconSrc' => '/public/images/icons/iconmonstr-minus-6.svg', 'alt' => 'Remove', 'tooltip' => 'Remove']
        ]
    ]
);
//Creating Navigation Bar
include 'application/views/partials/navbar.php';
?>

<div>
    <h2>User Data:</h2>
    <table class="welcome-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>UserID</th>
            <th>Title</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($advertisements)): ?>
            <?php foreach ($advertisements as $advertisement): ?>
                <tr>
                    <td><?= $advertisement['id']; ?></td>
                    <td><?= $advertisement['userid']; ?></td>
                    <td><?= $advertisement['title']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">No Advertisements found!</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?php
// Start session if not already started

// Handle alert messages if they exist in the session
if (isset($_SESSION['alert_message'])) {
    echo '<script>showAlert("' . htmlspecialchars($_SESSION['alert_message'], ENT_QUOTES, 'UTF-8') . '");</script>';
    unset($_SESSION['alert_message']);
}
?>
</body>
</html>
