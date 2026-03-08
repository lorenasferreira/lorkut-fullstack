<?php
require_once __DIR__ . '/../config/bootstrap.php';

$pageTitle = t('about.meta.title') ?? 'About | L.Orkut';
$pageCss = ['about.css'];

require_once __DIR__ . '/../partials/layout/head.php';
?>

<?php include __DIR__ . '/../partials/layout/header.php'; ?>

<main class="layout">

    <?php include __DIR__ . '/../partials/navigation/sidebar-left.php'; ?>

    <section class="central-profile about-page">

        <header>
            <h1 class="about-title"><?= t('about.title'); ?></h1>
        </header>

        <hr class="divider-main" />

        <div class="about-content">

            <p><?= t('about.paragraph.1'); ?></p>
            <p><?= t('about.paragraph.2'); ?></p>

            <div class="about-links">
                <a href="https://linkedin.com/in/lorenasferreira" target="_blank">LinkedIn</a>
                <a href="https://github.com/lorenasferreira" target="_blank">GitHub</a>
            </div>

        </div>

    </section>

    <aside class="sidebar-right">
        <?php include __DIR__ . '/../partials/navigation/sidebar-right-projects.php'; ?>
        <?php include __DIR__ . '/../partials/navigation/sidebar-right-communities.php'; ?>
    </aside>

</main>

<?php require_once __DIR__ . '/../partials/layout/footer.php'; ?>