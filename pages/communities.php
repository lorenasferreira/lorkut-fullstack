<?php
require_once __DIR__ . '/../config/bootstrap.php';

$pageTitle = t('communities.meta.title') ?? 'Communities | L.Orkut';
$pageCss = ['communities.css'];

require_once __DIR__ . '/../partials/layout/head.php';

$result = $conn->query("SELECT * FROM communities ORDER BY created_at DESC");
?>

<?php include __DIR__ . '/../partials/layout/header.php'; ?>

<main class="layout">

    <?php include __DIR__ . '/../partials/navigation/sidebar-left.php'; ?>

    <section class="central-profile communities-page">

        <header>
            <h1 class="communities-title">
                <?= t('communities.title') ?? 'Communities'; ?>
            </h1>
        </header>

        <hr class="divider-main" />

        <div class="communities-grid">

            <?php while ($community = $result->fetch_assoc()): ?>

                <a
                    href="<?= BASE_URL ?>pages/community.php?slug=<?= htmlspecialchars($community['slug']) ?>"
                    class="community-card">

                    <img
                        src="<?= BASE_URL . htmlspecialchars($community['thumbnail']) ?>"
                        alt="<?= htmlspecialchars($community['title']) ?>">

                    <h3><?= htmlspecialchars($community['title']) ?></h3>

                </a>

            <?php endwhile; ?>

        </div>

    </section>

    <aside class="sidebar-right">
        <?php include __DIR__ . '/../partials/navigation/sidebar-right-projects.php'; ?>
        <?php include __DIR__ . '/../partials/navigation/sidebar-right-communities.php'; ?>
    </aside>

</main>

<?php require_once __DIR__ . '/../partials/layout/footer.php'; ?>