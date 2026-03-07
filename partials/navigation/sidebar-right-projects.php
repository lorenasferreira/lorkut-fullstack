<?php
$result = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");
$total = $result->num_rows;
?>

<section>
  <span class="right-bar-names">projects</span>
  <span class="quantity-right-bar">(<?= $total ?>)</span>

  <div class="thumbs">

    <?php while ($p = $result->fetch_assoc()): ?>

      <a 
        href="<?= BASE_URL ?>pages/project.php?slug=<?= urlencode($p['slug']) ?>" 
        class="thumb-link"
      >
        <img 
          src="<?= BASE_URL . htmlspecialchars(ltrim($p['thumbnail'], '/')) ?>" 
          alt="<?= htmlspecialchars($p['title']) ?>" 
          class="thumb"
        >
      </a>

    <?php endwhile; ?>

  </div>
</section>