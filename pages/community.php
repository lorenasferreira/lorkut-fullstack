<?php
require_once __DIR__ . '/../config/bootstrap.php';

$slug = trim($_GET['slug'] ?? '');

if (!$slug) {
    header("Location: " . BASE_URL);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM communities WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();
$community = $result->fetch_assoc();

if (!$community) {
    header("Location: " . BASE_URL);
    exit;
}

$pageTitle = htmlspecialchars($community['title']) . " | L.Orkut";
$pageCss = ['community.css'];

require_once __DIR__ . '/../partials/layout/head.php';
?>

<?php include __DIR__ . '/../partials/layout/header.php'; ?>

<main class="layout">

    <?php include __DIR__ . '/../partials/navigation/sidebar-left.php'; ?>

    <section class="central-profile community-page">

        <header>
            <h1 class="community-title">
                <?= htmlspecialchars($community['title']) ?>
            </h1>
        </header>

        <hr class="divider-main" />

        <div class="community-content">

            <img
                src="<?= BASE_URL . htmlspecialchars($community['thumbnail']) ?>"
                alt="<?= htmlspecialchars($community['title']) ?>"
                class="community-thumbnail">

            <p class="community-description">
                <?= nl2br(htmlspecialchars($community['description'])) ?>
            </p>

        </div>

    </section>

    <aside class="sidebar-right">
        <?php include __DIR__ . '/../partials/navigation/sidebar-right-projects.php'; ?>
        <?php include __DIR__ . '/../partials/navigation/sidebar-right-communities.php'; ?>
    </aside>

</main>

<?php require_once __DIR__ . '/../partials/layout/footer.php'; ?>