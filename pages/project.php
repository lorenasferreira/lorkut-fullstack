<?php
require_once __DIR__ . '/../config/bootstrap.php';

$slug = $_GET['slug'] ?? null;

if (!$slug) {
  http_response_code(404);
  die('Project not found.');
}

$stmt = $conn->prepare("
  SELECT 
    p.id,
    p.slug,
    p.thumbnail,
    p.tech_stack,
    p.github_url,
    p.live_url,
    pt.title,
    pt.short_description,
    pt.full_description
  FROM projects p
  JOIN project_translations pt 
    ON pt.project_id = p.id
  WHERE p.slug = ? AND pt.lang = ?
");

$stmt->bind_param("ss", $slug, $lang);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();

if (!$project && $lang !== 'en') {
  $fallbackStmt = $conn->prepare("
    SELECT 
      p.id,
      p.slug,
      p.thumbnail,
      p.tech_stack,
      p.github_url,
      p.live_url,
      pt.title,
      pt.short_description,
      pt.full_description
    FROM projects p
    JOIN project_translations pt 
      ON pt.project_id = p.id
    WHERE p.slug = ? AND pt.lang = 'en'
  ");
  $fallbackStmt->bind_param("s", $slug);
  $fallbackStmt->execute();
  $project = $fallbackStmt->get_result()->fetch_assoc();
}

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

$photosStmt = $conn->prepare("
  SELECT p.* 
  FROM photos p
  JOIN project_photos pp ON p.id = pp.photo_id
  WHERE pp.project_id = ?
");

$photosStmt->bind_param("i", $project['id']);
$photosStmt->execute();
$photos = $photosStmt->get_result();

?>

<main class="layout">

  <?php include __DIR__ . '/../partials/navigation/sidebar-left.php'; ?>

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

          <?php if (!empty($project['github_url'])): ?>
            <a href="<?= htmlspecialchars($project['github_url']); ?>"
              target="_blank"
              class="btn-primary">
              GitHub Repo
            </a>
          <?php endif; ?>

          <?php if (!empty($project['live_url'])): ?>
            <a href="<?= htmlspecialchars($project['live_url']); ?>"
              target="_blank"
              class="btn-secondary">
              Live Demo
            </a>
          <?php endif; ?>

        </div>

      </div>

    </div>

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

    <h3 class="section-title">Project Photos</h3>

    <?php if ($photos->num_rows === 0): ?>
      <p class="muted">No screenshots yet.</p>
    <?php else: ?>
      <div class="photo-grid">
        <?php while ($img = $photos->fetch_assoc()): ?>
          <img
            src="<?= BASE_URL . htmlspecialchars(ltrim($img['image_url'], '/')); ?>"
            alt="Project Screenshot">
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

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

  <aside class="sidebar-right">
    <?php include __DIR__ . '/../partials/navigation/sidebar-right-projects.php'; ?>
    <?php include __DIR__ . '/../partials/navigation/sidebar-right-communities.php'; ?>
  </aside>

</main>

<?php require_once __DIR__ . '/../partials/layout/footer.php'; ?>