<?php

$resultStmt = $conn->prepare("
  SELECT 
    p.slug,
    p.thumbnail,
    pt.title
  FROM projects p
  JOIN project_translations pt 
    ON pt.project_id = p.id
  WHERE pt.lang = ?
  ORDER BY p.created_at DESC
");

$resultStmt->bind_param("s", $lang);
$resultStmt->execute();
$result = $resultStmt->get_result();

$total = $result->num_rows;
?>

<section>
  <span class="right-bar-names"><?= t('nav.projects'); ?></span>
  <span class="quantity-right-bar">(<?= $total ?>)</span>

  <div class="thumbs">

    <?php while ($p = $result->fetch_assoc()): ?>

      <a
        href="<?= with_lang(BASE_URL . 'pages/project.php?slug=' . urlencode($p['slug'])) ?>"
        class="thumb-link">
        <img
          src="<?= asset($p['thumbnail']) ?>"
          alt="<?= htmlspecialchars($p['title']) ?>"
          class="thumb">
      </a>

    <?php endwhile; ?>

  </div>
</section>