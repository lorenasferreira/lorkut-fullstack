<?php
$result = $conn->query("SELECT * FROM communities ORDER BY created_at ASC");
$total = $result->num_rows;
?>

<section>
  <span class="right-bar-names">communities</span>
  <span class="quantity-right-bar">(<?= $total ?>)</span>

  <div class="thumbs">
    <?php while ($c = $result->fetch_assoc()): ?>

      <a 
        href="<?= BASE_URL ?>pages/community.php?slug=<?= urlencode($c['slug']) ?>" 
        class="thumb-link"
      >
        <img 
          src="<?= BASE_URL . htmlspecialchars(ltrim($c['thumbnail'], '/')) ?>" 
          alt="<?= htmlspecialchars($c['title']) ?>" 
          class="thumb"
        >
      </a>

    <?php endwhile; ?>
  </div>
</section>