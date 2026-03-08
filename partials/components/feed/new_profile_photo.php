<?php
$payload = $item['payload'];
$photoPath = $payload['photo'] ?? '';

if ($photoPath && !str_starts_with($photoPath, 'http')) {
    $photoPath = BASE_URL . ltrim($photoPath, './');
}
?>

<div class="feed-item">

  <div class="feed-header">

    <img 
      src="<?= htmlspecialchars($photoPath) ?>" 
      alt="New avatar" 
      class="feed-avatar"
    >

    <div>
      <p class="feed-title">
        <?= t('feed.updated_profile_photo') ?? 'You updated your profile picture ✨' ?>
      </p>

      <p class="feed-meta">
        <?= htmlspecialchars($item['created_at']) ?>
      </p>
    </div>

  </div>

  <div class="feed-body">

    <div class="feed-avatar-preview">
      <img 
        src="<?= htmlspecialchars($photoPath) ?>" 
        alt="New avatar large"
      >
    </div>

  </div>

</div>