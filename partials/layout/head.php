<?php
$pageTitle = $pageTitle ?? 'Lorkut';
$pageCss = $pageCss ?? [];
$lang = $_SESSION['lang'] ?? 'en';

$base = defined('BASE_URL') ? rtrim(BASE_URL, '/') : '';
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($pageTitle) ?></title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="<?= $base ?>/assets/css/style.css" />

  <?php foreach ($pageCss as $css): ?>
    <link rel="stylesheet" href="<?= $base ?>/assets/css/<?= htmlspecialchars($css) ?>" />
  <?php endforeach; ?>

</head>
<body>