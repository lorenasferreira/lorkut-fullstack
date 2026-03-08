<?php
require_once __DIR__ . '/../config/bootstrap.php';

$pageTitle = 'Projects | L.Orkut';
$pageCss = ['projects.css'];

require_once __DIR__ . '/../partials/layout/head.php';
require_once __DIR__ . '/../partials/layout/header.php';

$stmt = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");
$projects = $stmt->fetch_all(MYSQLI_ASSOC);
?>

<main class="layout">

    <?php include __DIR__ . '/../partials/navigation/sidebar-left.php'; ?>

    <section class="central-profile">

        <h1>Projects</h1>

        <div class="projects-grid">
            <?php foreach ($projects as $p): ?>
                <div class="project-card">
                    <img src="<?= BASE_URL . $p['thumbnail']; ?>" alt="<?= $p['title']; ?>">
                    <h3><?= htmlspecialchars($p['title']); ?></h3>
                    <p><?= htmlspecialchars($p['short_description']); ?></p>
                    <a href="<?= with_lang('project.php?slug=' . $p['slug']); ?>">
                        View Project
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </section>

    <aside class="sidebar-right">
        <?php include __DIR__ . '/../partials/navigation/sidebar-right-projects.php'; ?>
        <?php include __DIR__ . '/../partials/navigation/sidebar-right-communities.php'; ?>
    </aside>

</main>

<?php require_once __DIR__ . '/../partials/layout/footer.php'; ?>