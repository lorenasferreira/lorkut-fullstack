<?php
require_once __DIR__ . '/../config/bootstrap.php';

$slug = $_GET['slug'] ?? null;

if (!$slug) {
  http_response_code(404);
  die('Project not found.');
}

$stmt = $conn->prepare("SELECT * FROM projects WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();

if (!$project) {
  http_response_code(404);
  die('Project not found.');
}

$pageTitle = htmlspecialchars($project['title']) . ' | L.Orkut';
$pageCss = ['project.css'];

require_once __DIR__ . '/../partials/layout/head.php';
require_once __DIR__ . '/../partials/layout/header.php';

$techs = [];
if (!empty($project['tech_stack'])) {
  $techs = array_map('trim', explode(",", $project['tech_stack']));
}

$videosStmt = $conn->prepare("SELECT * FROM videos WHERE project_id = ?");
$videosStmt->bind_param("i", $project['id']);
$videosStmt->execute();
$videos = $videosStmt->get_result();
?>

<main class="layout">

  <?php include __DIR__ . '/../partials/navigation/sidebar-left.php'; ?>

  <!-- 🔥 CENTRAL CONTENT -->
  <section class="central-profile project-detail">

    <h1 class="project-title">
      <?= htmlspecialchars($project['title']); ?>
    </h1>

    <div class="project-hero">

      <div class="project-hero-image">
        <img
          src="<?= BASE_URL . htmlspecialchars(ltrim($project['thumbnail'], '/')); ?>"
          alt="<?= htmlspecialchars($project['title']); ?>">
      </div>

      <div class="project-hero-content">

        <p class="project-description">
          <?= nl2br(htmlspecialchars($project['full_description'])); ?>
        </p>

        <div class="project-buttons">

          <?php if (!empty($project['repo_url'])): ?>
            <a href="<?= htmlspecialchars($project['repo_url']); ?>"
              target="_blank"
              class="btn-primary">
              GitHub Repo
            </a>
          <?php endif; ?>

          <?php if (!empty($project['live_demo_url'])): ?>
            <a href="<?= htmlspecialchars($project['live_demo_url']); ?>"
              target="_blank"
              class="btn-secondary">
              Live Demo
            </a>
          <?php endif; ?>

        </div>

      </div>

    </div>

    <!-- TECH STACK -->
    <?php if (!empty($techs)): ?>
      <h3 class="section-title">Tech Stack</h3>
      <div class="tech-stack">
        <?php foreach ($techs as $tech): ?>
          <span class="tech-chip">
            <?= htmlspecialchars($tech); ?>
          </span>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- VIDEOS -->
    <h3 class="section-title">Project Videos</h3>

    <?php if ($videos->num_rows === 0): ?>
      <p class="muted">No videos available.</p>
    <?php else: ?>
      <div class="video-grid">
        <?php while ($v = $videos->fetch_assoc()): ?>
          <video
            src="<?= BASE_URL . htmlspecialchars(ltrim($v['video_url'], '/')); ?>"
            controls>
          </video>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  </section>

  <!-- 🔥 RIGHT SIDEBAR (FORA DA SECTION!) -->
  <aside class="sidebar-right">
    <?php include __DIR__ . '/../partials/navigation/sidebar-right-projects.php'; ?>
    <?php include __DIR__ . '/../partials/navigation/sidebar-right-communities.php'; ?>
  </aside>

</main>

<?php require_once __DIR__ . '/../partials/layout/footer.php'; ?>