<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Home Page</h1>
    <?php foreach ($blogs as $blog) : ?>
        <h1><a href="/blogs/<?= $blog->slug; ?>"><?= $blog->title; ?></a></h1>
        <p><?= $blog->intro; ?></p>
        <p>Published At - <?= $blog->created_at; ?></p>
    <?php endforeach; ?>
</body>

</html>