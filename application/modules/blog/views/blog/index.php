<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
</head>
<body>
<h1>Blog Posts</h1>
<?php foreach ($posts as $post): ?>
    <h2><?php echo $post['title']; ?></h2>
    <p><?php echo $post['content']; ?></p>
<?php endforeach; ?>
</body>
</html>
