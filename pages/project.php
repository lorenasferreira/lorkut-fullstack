<?php
require_once __DIR__ . '/../config/bootstrap.php';

$slug = $_GET['slug'] ?? null;

if (!$slug) {
    http_response_code(404);
    die(t('project.not_found') ?? 'Project not found.');
}

$stmt = $conn->prepare("SELECT * FROM projects WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();

if (!$project) {
    http_response_code(404);
    die(t('project.not_found') ?? 'Project not found.');
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

<!-- DESKTOP VERSION -->
<main class="layout">

  <?php include __DIR__ . '/../partials/navigation/sidebar-left.php'; ?>

  <section class="central-profile">

    <header>
      <p class="profile-name-central"><?= htmlspecialchars($project['title']); ?></p>
    </header>

    <hr class="divider-main" />

    <div class="project-thumbnail">
      <img 
        src="<?= BASE_URL . htmlspecialchars(ltrim($project['thumbnail'], '/')); ?>" 
        alt="<?= htmlspecialchars($project['title']); ?>"
        class="project-image"
      >
    </div>

    <hr class="divider-main" />

    <div class="project-meta">

      <div class="dark-blue">
        <p>
          <span class="profile-titles"><?= t('project.created'); ?></span>
          <?= date("d M Y", strtotime($project['created_at'])); ?>
        </p>
      </div>

      <div class="light-blue">
        <p>
          <span class="profile-titles"><?= t('project.technologies'); ?></span>
          <?= htmlspecialchars(implode(' • ', $techs)); ?>
        </p>
      </div>

      <?php if (!empty($project['live_demo_url'])): ?>
        <div class="dark-blue">
          <p>
            <a href="<?= htmlspecialchars($project['live_demo_url']); ?>" target="_blank" rel="noopener">
              <?= t('project.view_demo'); ?>
            </a>
          </p>
        </div>
      <?php endif; ?>

      <?php if (!empty($project['repo_url'])): ?>
        <div class="light-blue">
          <p>
            <a href="<?= htmlspecialchars($project['repo_url']); ?>" target="_blank" rel="noopener">
              <?= t('project.view_repo'); ?>
            </a>
          </p>
        </div>
      <?php endif; ?>

    </div>

    <hr class="divider-main" />

    <div class="project-description">
      <p><?= nl2br(htmlspecialchars($project['full_description'])); ?></p>
    </div>

    <hr class="divider-main" />

    <h3><?= t('project.videos'); ?></h3>

    <?php if ($videos->num_rows === 0): ?>
      <p class="muted"><?= t('project.no_videos'); ?></p>
    <?php else: ?>
      <div class="video-grid">
        <?php while ($v = $videos->fetch_assoc()): ?>
          <div class="video-item">
            <video 
              src="<?= BASE_URL . htmlspecialchars(ltrim($v['video_url'], '/')); ?>" 
              controls>
            </video>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  </section>

  <aside class="sidebar-right">
    <?php include __DIR__ . '/../partials/navigation/sidebar-right-projects.php'; ?>
    <?php include __DIR__ . '/../partials/navigation/sidebar-right-communities.php'; ?>
  </aside>

</main>



<!-- MOBILE VERSION -->
<div class="project-mobile">

  <section class="pm-header">
    <img 
      src="<?= BASE_URL . htmlspecialchars(ltrim($project['thumbnail'], '/')); ?>" 
      class="pm-project-image"
      alt="<?= htmlspecialchars($project['title']); ?>"
    >
    <h1 class="pm-name"><?= htmlspecialchars($project['title']); ?></h1>
  </section>

  <section class="pm-meta">
    <p><strong><?= t('project.created'); ?></strong>
      <?= date("d M Y", strtotime($project['created_at'])); ?>
    </p>

    <p><strong><?= t('project.technologies'); ?></strong>
      <?= htmlspecialchars(implode(' • ', $techs)); ?>
    </p>

    <?php if (!empty($project['live_demo_url'])): ?>
      <p>
        <a href="<?= htmlspecialchars($project['live_demo_url']); ?>" target="_blank">
          <?= t('project.view_demo'); ?>
        </a>
      </p>
    <?php endif; ?>

    <?php if (!empty($project['repo_url'])): ?>
      <p>
        <a href="<?= htmlspecialchars($project['repo_url']); ?>" target="_blank">
          <?= t('project.view_repo'); ?>
        </a>
      </p>
    <?php endif; ?>
  </section>

  <section class="pm-description">
    <p><?= nl2br(htmlspecialchars($project['full_description'])); ?></p>
  </section>

  <section class="pm-videos">
    <h3><?= t('project.videos'); ?></h3>

    <?php if ($videos->num_rows === 0): ?>
      <p class="muted"><?= t('project.no_videos'); ?></p>
    <?php else: ?>
      <?php
      $videosStmt->execute();
      $videosMobile = $videosStmt->get_result();
      ?>
      <?php while ($v = $videosMobile->fetch_assoc()): ?>
        <video 
          src="<?= BASE_URL . htmlspecialchars(ltrim($v['video_url'], '/')); ?>" 
          controls>
        </video>
      <?php endwhile; ?>
    <?php endif; ?>
  </section>

</div>

<nav class="pm-bottom-nav">
  <a href="<?= BASE_URL ?>pages/home.php"><?= t('nav.home'); ?></a>
  <a href="<?= BASE_URL ?>pages/search.php"><?= t('nav.search'); ?></a>
  <a href="<?= BASE_URL ?>pages/projects.php"><?= t('nav.projects'); ?></a>
  <a href="<?= BASE_URL ?>pages/profile.php"><?= t('nav.profile'); ?></a>
</nav>

<?php require_once __DIR__ . '/../partials/layout/footer.php'; ?>