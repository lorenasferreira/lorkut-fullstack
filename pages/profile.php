<?php
require_once __DIR__ . '/../config/bootstrap.php';

$pageTitle = t('profile.meta.title');
$pageCss = ['profile.css'];

require_once __DIR__ . '/../partials/layout/head.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['author'], $_POST['message'])) {
  $author = trim($_POST['author']);
  $message = trim($_POST['message']);
  $avatar = "https://i.pravatar.cc/80?img=" . rand(1, 70);

  if ($author !== "" && $message !== "") {
    $stmt = $conn->prepare(
      "INSERT INTO testimonials (author, message, avatar_url) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sss", $author, $message, $avatar);
    $stmt->execute();
  }

  $redirect = function_exists('with_lang')
    ? with_lang('profile.php#testimonies')
    : 'profile.php#testimonies';

  header("Location: {$redirect}");
  exit;
}
?>

<?php include __DIR__ . '/../partials/layout/header.php'; ?>

<main class="layout">

  <?php include __DIR__ . '/../partials/navigation/sidebar-left.php'; ?>

  <section class="central-profile">

    <header>
      <p class="profile-name-central"><?= t('common.name'); ?></p>
    </header>

    <hr class="divider-main" />

    <div class="container-central">
      <ul class="profile-counters">
        <li class="stat">
          <span class="label"><?= t('profile.counters.scraps'); ?></span>
          <span class="value">
            <img src="<?= BASE_URL ?>assets/icons/book.svg" class="icon" alt="">
            <strong>3</strong>
          </span>
        </li>

        <li class="stat">
          <span class="label"><?= t('profile.counters.photos'); ?></span>
          <span class="value">
            <img src="<?= BASE_URL ?>assets/icons/camera.svg" class="icon" alt="">
            <strong>4</strong>
          </span>
        </li>

        <li class="stat">
          <span class="label"><?= t('profile.counters.videos'); ?></span>
          <span class="value">
            <img src="<?= BASE_URL ?>assets/icons/video-camera.svg" class="icon" alt="">
            <strong>2</strong>
          </span>
        </li>

        <li class="stat">
          <span class="label"><?= t('profile.counters.fans'); ?></span>
          <span class="value">
            <img src="<?= BASE_URL ?>assets/icons/star.svg" class="icon" alt="">
            <strong>0</strong>
          </span>
        </li>

        <li class="stat">
          <span class="label"><?= t('profile.counters.trustful'); ?></span>
          <span class="value">
            <img src="<?= BASE_URL ?>assets/icons/star.svg" class="icon" alt="">
            <img src="<?= BASE_URL ?>assets/icons/star.svg" class="icon" alt="">
            <img src="<?= BASE_URL ?>assets/icons/star.svg" class="icon" alt="">
          </span>
        </li>

        <li class="stat">
          <span class="label"><?= t('profile.counters.cool'); ?></span>
          <span class="value">
            <img src="<?= BASE_URL ?>assets/icons/cool.svg" class="icon" alt="">
            <img src="<?= BASE_URL ?>assets/icons/cool.svg" class="icon" alt="">
            <img src="<?= BASE_URL ?>assets/icons/cool.svg" class="icon" alt="">
          </span>
        </li>
      </ul>
    </div>

    <hr class="divider-main" />

    <?php
    $conn->query("INSERT INTO profile_views (viewed_at) VALUES (NOW())");

    $total_views = $conn->query("SELECT COUNT(*) AS total FROM profile_views")
      ->fetch_assoc()['total'];

    $yesterday_views = $conn->query(
      "SELECT COUNT(*) AS yesterday FROM profile_views
       WHERE DATE(viewed_at) = CURDATE() - INTERVAL 1 DAY"
    )->fetch_assoc()['yesterday'];

    $lastweek_views = $conn->query(
      "SELECT COUNT(*) AS lastweek FROM profile_views
       WHERE viewed_at >= CURDATE() - INTERVAL 7 DAY"
    )->fetch_assoc()['lastweek'];
    ?>

    <div class="profile-stats">
      <p>
        <strong><?= t('profile.views.total'); ?></strong> <?= $total_views; ?>,
        <strong><?= t('profile.views.last_week'); ?></strong> <?= $lastweek_views; ?>,
        <strong><?= t('profile.views.yesterday'); ?></strong> <?= $yesterday_views; ?>
      </p>
    </div>

    <hr class="divider-main" />

    <div class="dark-blue">
      <p><span class="profile-titles"><?= t('profile.fields.birthday'); ?></span> 10-07-1997</p>
    </div>
    <div class="light-blue">
      <p><span class="profile-titles"><?= t('profile.fields.age'); ?></span> 28</p>
    </div>
    <div class="dark-blue">
      <p><span class="profile-titles"><?= t('profile.fields.interests'); ?></span> <?= t('profile.values.interests'); ?></p>
    </div>
    <div class="light-blue">
      <p>
        <span class="profile-titles"><?= t('profile.fields.who_am_i'); ?></span>
        <?= t('profile.values.who_am_i'); ?>
      </p>
    </div>
    <div class="dark-blue">
      <p><span class="profile-titles"><?= t('profile.fields.hometown'); ?></span> <?= t('profile.values.hometown'); ?></p>
    </div>
    <div class="light-blue">
      <p>
        <span class="profile-titles"><?= t('profile.fields.webpages'); ?></span>
        <a href="https://www.linkedin.com/in/lorenasferreira/" target="_blank" rel="noopener">
          <?= t('profile.links.linkedin'); ?>
        </a>
        &nbsp;|&nbsp;
        <a href="https://github.com/lorenasferreira" target="_blank" rel="noopener">
          <?= t('profile.links.github'); ?>
        </a>
      </p>
    </div>

    <?php
    $approved = [];
    $res = $conn->query(
      "SELECT * FROM testimonials WHERE status = 'approved' ORDER BY created_at DESC"
    );
    while ($row = $res->fetch_assoc()) $approved[] = $row;

    $fake_testimonials = [
      [
        "author" => "Marina B.",
        "message" => t('profile.fake_testimonials.0.message'),
        "avatar_url" => "./../assets/img/mandy.png",
        "created_at" => "Fake"
      ],
      [
        "author" => "Lucas M.",
        "message" => t('profile.fake_testimonials.1.message'),
        "avatar_url" => "./../assets/img/avatar1.png",
        "created_at" => "Fake"
      ]
    ];

    $all_testimonials = array_merge($approved, $fake_testimonials);
    $total_count = count($all_testimonials);
    ?>

    <section class="card testimonies" id="testimonies">
      <header class="card__header">
        <h3><?= t('profile.testimonials.title'); ?></h3>
        <small class="muted"><?= $total_count; ?> <?= t('profile.testimonials.total'); ?></small>
      </header>

      <form class="tm-form" method="POST">
        <input name="author" placeholder="<?= t('profile.testimonials.form.name'); ?>" required />
        <textarea name="message" placeholder="<?= t('profile.testimonials.form.message'); ?>" maxlength="280" required></textarea>
        <div class="tm-actions">
          <small>280</small>
          <button class="btn-primary" type="submit"><?= t('profile.testimonials.form.post'); ?></button>
        </div>
      </form>

      <div class="testimonial-list">
        <?php foreach ($all_testimonials as $tm): ?>
          <div class="testimonial-card">
            <img class="tm-avatar" src="<?= htmlspecialchars($tm['avatar_url']); ?>" alt="">
            <div>
              <strong><?= htmlspecialchars($tm['author']); ?></strong>
              <p><?= nl2br(htmlspecialchars($tm['message'])); ?></p>
              <small class="muted">
                <?= ($tm['created_at'] === "Fake")
                  ? t('profile.testimonials.fake_time')
                  : date(t('profile.testimonials.date_format'), strtotime($tm['created_at'])); ?>
              </small>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

  </section>

  <aside class="sidebar-right">
    <?php include __DIR__ . '/../partials/navigation/sidebar-right-projects.php'; ?>
    <?php include __DIR__ . '/../partials/navigation/sidebar-right-communities.php'; ?>
  </aside>

</main>

<?php
$mobileProjects = $conn->query(
  "SELECT slug, title, thumbnail FROM projects ORDER BY created_at ASC"
);

$mobileCommunities = $conn->query(
  "SELECT slug, title, thumbnail FROM communities ORDER BY created_at ASC"
);
?>

<div class="profile-mobile">

  <section class="pm-header">
   <img src="<?= BASE_URL ?>assets/img/avatar.png" class="pm-avatar" alt="Profile avatar">
    <h1 class="pm-name"><?= t('common.name'); ?></h1>
    <p class="pm-location"><?= t('profile.values.hometown'); ?></p>

    <div class="pm-actions">
      <a href="#projects" class="btn-primary">
        <?= t('profile.mobile.view_projects'); ?>
      </a>
      <a href="mailto:you@email.com" class="btn-secondary">
        <?= t('profile.mobile.message'); ?>
      </a>
    </div>
  </section>

  <section class="pm-counters">
    <div class="pm-counter-item">
      <span><?= t('profile.counters.scraps'); ?></span>
      <strong>3</strong>
    </div>
    <div class="pm-counter-item">
      <span><?= t('profile.counters.photos'); ?></span>
      <strong>4</strong>
    </div>
    <div class="pm-counter-item">
      <span><?= t('profile.counters.videos'); ?></span>
      <strong>2</strong>
    </div>
    <div class="pm-counter-item">
      <span><?= t('profile.counters.fans'); ?></span>
      <strong>0</strong>
    </div>
  </section>

  <section class="pm-tabs">
    <button class="pm-tab active" data-tab="social">
      <?= t('profile.mobile.tab_social'); ?>
    </button>
    <button class="pm-tab" data-tab="professional">
      <?= t('profile.mobile.tab_professional'); ?>
    </button>
  </section>

  <section class="pm-tab-content active" id="social">
    <p><strong><?= t('profile.fields.interests'); ?></strong></p>
    <p><?= t('profile.values.interests'); ?></p>

    <p><strong><?= t('profile.fields.who_am_i'); ?></strong></p>
    <p><?= t('profile.values.who_am_i'); ?></p>
  </section>

  <section class="pm-tab-content" id="professional">
    <p><strong><?= t('profile.fields.webpages'); ?></strong></p>
    <p>
      <a href="https://www.linkedin.com/in/lorenasferreira/" target="_blank">
        <?= t('profile.links.linkedin'); ?>
      </a>
      &nbsp;|&nbsp;
      <a href="https://github.com/lorenasferreira" target="_blank">
        <?= t('profile.links.github'); ?>
      </a>
    </p>
  </section>

  <section class="pm-section" id="projects">
    <header class="pm-section-header">
      <h3><?= t('profile.mobile.my_projects'); ?></h3>
      <a href="projects.php"><?= t('common.view_all'); ?></a>
    </header>

    <div class="pm-horizontal-scroll">
  <?php while ($p = $mobileProjects->fetch_assoc()): ?>
    <div class="pm-card">
      <a href="<?= BASE_URL ?>pages/project.php?slug=<?= urlencode($p['slug']) ?>">
        <img 
          src="<?= BASE_URL . htmlspecialchars(ltrim($p['thumbnail'], '/')) ?>" 
          alt="<?= htmlspecialchars($p['title']) ?>"
        >
      </a>
      <p><?= htmlspecialchars($p['title']) ?></p>
    </div>
  <?php endwhile; ?>
</div>
  </section>

  <section class="pm-section">
    <header class="pm-section-header">
      <h3><?= t('profile.mobile.communities'); ?></h3>
      <a href="communities.php"><?= t('common.view_all'); ?></a>
    </header>

    <div class="pm-horizontal-scroll">
  <?php while ($c = $mobileCommunities->fetch_assoc()): ?>
    <div class="pm-card small">
      <a href="<?= BASE_URL ?>pages/community.php?slug=<?= urlencode($c['slug']) ?>">
        <img 
          src="<?= BASE_URL . htmlspecialchars(ltrim($c['thumbnail'], '/')) ?>" 
          alt="<?= htmlspecialchars($c['title']) ?>"
        >
      </a>
    </div>
  <?php endwhile; ?>
</div>
  </section>

</div>

<nav class="pm-bottom-nav">
  <a href="home.php">Home</a>
  <a href="search.php">Search</a>
  <a href="projects.php">Projects</a>
  <a href="profile.php" class="active">Profile</a>
</nav>

<script type="module" src="<?= BASE_URL ?>assets/js/main.js"></script>

<?php require_once __DIR__ . '/../partials/layout/footer.php'; ?>