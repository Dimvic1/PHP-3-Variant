<?php
function length(string $text): int
{
    return preg_match_all('/./us', $text);
}
$errors = [];

$title = '';
$content = '';
$tags = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 

    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $tags = trim($_POST['tags'] ?? '');

    if ($title === '') {
        $errors[] = 'Title статті є обов’язковим.';
    } elseif (length($title) < 5 || length($title) > 100) {
        $errors[] = 'Title статті повинен містити від 5 до 100 символів.';
    }

    if ($content === '') {
        $errors[] = 'Content статті є обов’язковим.';
    } elseif (length($content) < 20) {
        $errors[] = 'Content статті повинен містити щонайменше 20 символів.';
    }
    if ($tags === '') {
        $errors[] = 'Tags статті є обов’язковим.';
        }
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Нова стаття</title>
</head>
<body>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errors)): ?>

    <h2>Статтю створено</h2>

    <p><strong>Title:</strong></p>
    <p><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></p>

    <p><strong>Content:</strong></p>
    <p><?= nl2br(htmlspecialchars($content, ENT_QUOTES, 'UTF-8')) ?></p>

    <p><strong>Tags:</strong></p>
    <p><?= htmlspecialchars($tags, ENT_QUOTES, 'UTF-8') ?></p>

<?php else: ?>

    <h2>Нова стаття</h2>

    <?php if (!empty($errors)): ?>
        <h3>Помилка:</h3>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="form.php">

        <label for="title">Title:</label>
        <input
            type="text"
            id="title"
            name="title"
            minlength="5"
            maxlength="100"
            required
            value="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>"
        >

        <br><br>

        <label for="content">Сontent:</label>
        <textarea
            id="content"
            name="content"
            minlength="20"
            required
        ><?= htmlspecialchars($content, ENT_QUOTES, 'UTF-8') ?></textarea>

        <br><br>

        <label for="tags">Tags:</label>
        <input
            type="text"
            id="tags"
            name="tags"
            value="<?= htmlspecialchars($tags, ENT_QUOTES, 'UTF-8') ?>"
        >

        <br><br>

        <button type="submit">Створити статтю</button>

    </form>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const title = document.getElementById('title');
    const content = document.getElementById('content');
    const tags = document.getElementById('tags');

    title.value = localStorage.getItem('draft_title') ?? title.value;
    content.value = localStorage.getItem('draft_content') ?? content.value;
    tags.value = localStorage.getItem('draft_tags') ?? tags.value;

    title.addEventListener('input', function() {
        localStorage.setItem('draft_title', title.value);
    });

    content.addEventListener('input', function() {
        localStorage.setItem('draft_content', content.value);
    });

    tags.addEventListener('input', function() {
        localStorage.setItem('draft_tags', tags.value);
    });
});
</script>
<?php endif; ?>
<script>
document.querySelector('form').addEventListener('submit', function(event) {
    const title = document.getElementById('title').value.trim();

    if (title.length < 5 || title.length > 100) {
        event.preventDefault();
        alert('Title повинен містити від 5 до 100 символів.');
    }
});
</script>
</body>
</html>