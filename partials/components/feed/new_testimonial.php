<?php
$payload = $item['payload'];
?>
<div class="feed-item">
  <div class="feed-header">
    <img src="<?= asset($payload['avatar_url']) ?>" alt="Author avatar" class="feed-avatar">
    <div>
      <p class="feed-title">
        <strong><?= htmlspecialchars($payload['author']) ?></strong> left you a testimonial 💬
      </p>
      <p class="feed-meta"><?= htmlspecialchars($item['created_at']) ?></p>
    </div>
  </div>
  <div class="feed-body">
    <p class="feed-testimonial-text">
      “<?= htmlspecialchars($payload['message']) ?>”
    </p>
  </div>
</div>
