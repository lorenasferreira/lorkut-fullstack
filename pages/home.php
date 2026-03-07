<?php
require_once __DIR__ . '/../config/bootstrap.php';

$pageTitle = t('home.meta.title') ?? 'Home | L.Orkut';
$pageCss = ['home.css'];

require_once __DIR__ . '/../partials/layout/head.php';
?>

<?php include __DIR__ . '/../partials/layout/header.php'; ?>

<main class="layout">

  <?php include __DIR__ . '/../partials/navigation/sidebar-left.php'; ?>

  <section class="central-profile">

    <header>
      <p class="profile-name-central"><?= t('home.updates_from') ?? 'Updates from:'; ?></p>
    </header>

    <hr class="divider-main" />

    <div id="fortune-box" class="fortune-card">
      <img 
        src="<?= BASE_URL ?>assets/icons/sorte-do-dia.png"
        alt="Luck of the day icon"
        aria-hidden="true"
        class="fortune-icon"
      >
      <div class="fortune-content"></div>
    </div>

    <?php
    $sql = "SELECT id, type, user_id, payload, created_at 
            FROM activity_feed 
            ORDER BY created_at DESC 
            LIMIT 20";

    $result = $conn->query($sql);
    ?>

    <div class="activity-feed">
      <?php while ($row = $result->fetch_assoc()): ?>

        <?php
        $item = [
          'type'       => $row['type'],
          'user_id'    => $row['user_id'],
          'payload'    => json_decode($row['payload'], true),
          'created_at' => $row['created_at']
        ];

        switch ($item['type']) {
          case 'new_project':
            include __DIR__ . '/../partials/components/feed/new_project.php';
            break;

          case 'new_community':
            include __DIR__ . '/../partials/components/feed/new_community.php';
            break;

          case 'new_testimonial':
            include __DIR__ . '/../partials/components/feed/new_testimonial.php';
            break;

          case 'new_profile_photo':
            include __DIR__ . '/../partials/components/feed/new_profile_photo.php';
            break;
        }
        ?>

      <?php endwhile; ?>
    </div>

  </section>

  <aside class="sidebar-right">
    <?php include __DIR__ . '/../partials/navigation/sidebar-right-projects.php'; ?>
    <?php include __DIR__ . '/../partials/navigation/sidebar-right-communities.php'; ?>
  </aside>

</main>

<div class="home-mobile">

  <section class="hm-header">
    <h1 class="hm-title"><?= t('home.updates_from'); ?> <?= t('common.name'); ?></h1>
  </section>

  <section class="hm-fortune">
    <div class="fortune-card-mobile">
      <img 
        src="<?= BASE_URL ?>assets/icons/sorte-do-dia.png"
        alt=""
        class="fortune-icon"
      >
      <div class="fortune-content"></div>
    </div>
  </section>

  <section class="hm-feed">
    <?php
    $mobileFeed = $conn->query(
      "SELECT id, type, user_id, payload, created_at 
       FROM activity_feed 
       ORDER BY created_at DESC 
       LIMIT 10"
    );
    ?>

    <?php while ($row = $mobileFeed->fetch_assoc()): ?>
      <?php
      $item = [
        'type'       => $row['type'],
        'user_id'    => $row['user_id'],
        'payload'    => json_decode($row['payload'], true),
        'created_at' => $row['created_at']
      ];

      switch ($item['type']) {
        case 'new_project':
          include __DIR__ . '/../partials/components/feed/new_project.php';
          break;

        case 'new_community':
          include __DIR__ . '/../partials/components/feed/new_community.php';
          break;

        case 'new_testimonial':
          include __DIR__ . '/../partials/components/feed/new_testimonial.php';
          break;

        case 'new_profile_photo':
          include __DIR__ . '/../partials/components/feed/new_profile_photo.php';
          break;
      }
      ?>
    <?php endwhile; ?>
  </section>

</div>

<nav class="pm-bottom-nav">
  <a href="home.php" class="active"><?= t('nav.home'); ?></a>
  <a href="search.php"><?= t('nav.search'); ?></a>
  <a href="projects.php"><?= t('nav.projects'); ?></a>
  <a href="profile.php"><?= t('nav.profile'); ?></a>
</nav>

<script src="<?= BASE_URL ?>assets/js/fortune.js"></script>

<?php require_once __DIR__ . '/../partials/layout/footer.php'; ?>