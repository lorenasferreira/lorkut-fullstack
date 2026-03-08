<?php
$payload = $item['payload'];
?>

<div class="feed-item">

  <div class="feed-header">

    <img 
      src="<?= BASE_URL ?>assets/img/avatar.png"
      alt="Profile avatar"
      class="feed-avatar"
    >

    <div>
      <p class="feed-title">
        <?= t('feed.joined_community') ?? 'You joined a new community:' ?>
        <strong><?= htmlspecialchars($payload['name']) ?></strong>
      </p>

      <p class="feed-meta">
        <?= htmlspecialchars($item['created_at']) ?>
      </p>
    </div>

  </div>

  <div class="feed-body">

    <div class="feed-thumb-large">
      <img src="<?= asset($payload['image']) ?>"
        alt="<?= htmlspecialchars($payload['name']) ?>"
      >
    </div>

    <div class="feed-text">
      <p><?= nl2br(htmlspecialchars($payload['description'])) ?></p>
    </div>

  </div>

</div>