<?php
require_once __DIR__ . '/../config/bootstrap.php';

$pageTitle = t('terms.meta.title') ?? 'Terms | L.Orkut';
$pageCss = ['terms.css'];

require_once __DIR__ . '/../partials/layout/head.php';
?>

<?php include __DIR__ . '/../partials/layout/header.php'; ?>

<main class="layout">

    <?php include __DIR__ . '/../partials/navigation/sidebar-left.php'; ?>

    <section class="central-profile terms-page">

        <header>
            <h1 class="terms-title"><?= t('terms.title'); ?></h1>
        </header>

        <hr class="divider-main" />

        <div class="terms-content">
            <p><?= t('terms.paragraph.1'); ?></p>
            <p><?= t('terms.paragraph.2'); ?></p>
            <p><?= t('terms.paragraph.3'); ?></p>
        </div>

    </section>

    <aside class="sidebar-right">
        <?php include __DIR__ . '/../partials/navigation/sidebar-right-projects.php'; ?>
        <?php include __DIR__ . '/../partials/navigation/sidebar-right-communities.php'; ?>
    </aside>

</main>

<?php require_once __DIR__ . '/../partials/layout/footer.php'; ?>