<?php
require_once __DIR__ . '/../config/bootstrap.php';

$pageTitle = t('privacy.meta.title') ?? 'Privacy | L.Orkut';
$pageCss = ['privacy.css'];

require_once __DIR__ . '/../partials/layout/head.php';
?>

<?php include __DIR__ . '/../partials/layout/header.php'; ?>

<main class="layout">

    <?php include __DIR__ . '/../partials/navigation/sidebar-left.php'; ?>

    <section class="central-profile privacy-page">

        <header>
            <h1 class="privacy-title"><?= t('privacy.title'); ?></h1>
        </header>

        <hr class="divider-main" />

        <div class="privacy-content">
            <p><?= t('privacy.paragraph.1'); ?></p>
            <p><?= t('privacy.paragraph.2'); ?></p>
            <p><?= t('privacy.paragraph.3'); ?></p>
        </div>

    </section>

    <aside class="sidebar-right">
        <?php include __DIR__ . '/../partials/navigation/sidebar-right-projects.php'; ?>
        <?php include __DIR__ . '/../partials/navigation/sidebar-right-communities.php'; ?>
    </aside>

</main>

<?php require_once __DIR__ . '/../partials/layout/footer.php'; ?>