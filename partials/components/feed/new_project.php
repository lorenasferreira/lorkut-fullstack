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
        You published a new project: <strong><?= htmlspecialchars($payload['name']) ?></strong>
      </p>
      <p class="feed-meta"><?= htmlspecialchars($item['created_at']) ?></p>
    </div>
  </div>
  <div class="feed-body">
    <div class="feed-thumb-large">
      <img src="<?= asset($payload['thumb']) ?>" alt="Project thumbnail">
    </div>
    <div class="feed-text">
      <p><?= htmlspecialchars($payload['tagline']) ?></p>
      <p class="feed-stack"><?= htmlspecialchars($payload['stack']) ?></p>
      <a class="feed-link" href="<?= htmlspecialchars($payload['url']) ?>" target="_blank">
        View on GitHub ↗
      </a>
    </div>
  </div>
</div>
