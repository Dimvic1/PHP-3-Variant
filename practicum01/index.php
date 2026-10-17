<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$blogs = [
    ['title' => 'Title1','author' => 'Author1', 'publishedAt' => '2026-09-01', 'views' => '200' ],
    ['title' => 'Title2','author' => 'Author2', 'publishedAt' => '2026-09-02', 'views' => '101' ],
    ['title' => 'Title3','author' => 'Author3', 'publishedAt' => '2026-09-03', 'views' => '30' ],
    ['title' => 'Title4','author' => 'Author4', 'publishedAt' => '2026-09-04', 'views' => '40' ]
    ];
$totalViews = array_sum(array_column($blogs, 'views'));
function formatBlog(array $blog): string
{
    if ($blog['views'] > 100) {
        $status = 'Популярна';
    }   
    else {
        $status = 'Звичайна';
    }

    return "{$blog['title']} — автор: {$blog['author']}, "
        . "дата публікації: {$blog['publishedAt']}, "
        . "перегляди: {$blog['views']}, "
        . "статус: {$status}";
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Список блогів</title>
    <style></style>
</head>
<body>

<h1>Список блогів</h1>

<table>
    <thead>
        <tr>
            <th>Назва</th>
            <th>Автор</th>
            <th>Дата публікації</th>
            <th>Перегляди</th>
            <th>Статус</th>
        </tr>
    </thead>

    <tbody>
        <?php var_dump($blogs); ?>
        <?php foreach ($blogs as $blog): ?>

            <?php
            $status = $blog['views'] > 100
                ? 'Популярна'
                : 'Звичайна';
            ?>

            <tr>
                <td><?= htmlspecialchars($blog['title']) ?></td>
                <td><?= htmlspecialchars($blog['author']) ?></td>
                <td><?= htmlspecialchars($blog['publishedAt']) ?></td>
                <td><?= (int) $blog['views'] ?></td>
                <td><?= $status ?></td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>
<div class="stats">
    <p>Сумарна кількість переглядів усіх статей: <strong><?= $totalViews ?></strong></p>
</div>
</body>
</html>