<?php
require_once __DIR__ . '/config/bootstrap.php';
$pageTitle = t('login.meta.title');
$pageCss = ['index.css'];
require_once __DIR__ . '/partials/layout/head.php';
?>

<main class="shell">
  <div class="lang-switch">
    <a href="?lang=en" <?= (($_SESSION['lang'] ?? 'en') === 'en') ? 'aria-current="true"' : '' ?>>EN</a>
    <a href="?lang=pt" <?= (($_SESSION['lang'] ?? 'en') === 'pt') ? 'aria-current="true"' : '' ?>>PT</a>
    <a href="?lang=es" <?= (($_SESSION['lang'] ?? 'en') === 'es') ? 'aria-current="true"' : '' ?>>ES</a>
    <a href="?lang=fr" <?= (($_SESSION['lang'] ?? 'en') === 'fr') ? 'aria-current="true"' : '' ?>>FR</a>
  </div>

  <div class="login-grid">
    <section class="intro-box orkut-panel" aria-labelledby="brand-title">
      <h1 class="logo-word" id="brand-title"><?= t('common.brand') ?></h1>

      <p class="intro-line"><?= t('login.intro.1') ?></p>
      <p class="intro-line"><?= t('login.intro.2') ?></p>
      <p class="intro-line"><?= t('login.intro.3') ?></p>
    </section>

    <aside class="login-side">
      <section class="login-card" aria-labelledby="signin-title">
        <h2 id="signin-title" class="signin-title"><?= t('login.signin.title') ?></h2>

        <img
          class="avatar"
          src="./assets/img/avatar.png"
          alt="<?= htmlspecialchars(t('login.avatar.alt')) ?>" />

        <div class="who">
          <div class="who-name"><?= t('common.name') ?></div>
          <div class="who-role"><?= t('common.role') ?></div>
        </div>
      </section>

      <section class="cta-card">
        <a href="<?= htmlspecialchars(with_lang('./pages/profile.php')) ?>" class="btn-primary">
          <?= t('login.cta.profile') ?>
        </a>
      </section>
    </aside>
  </div>
  <?php
  $message = urlencode(t('footer.contact_message'));
  $whatsappLink = "https://wa.me/34662321407?text={$message}";
  ?>
  <footer class="footerbar" role="contentinfo">
    <div class="footer-inner">
      <small class="copy">
        © <?= date('Y') ?> Lorena Ferreira — <?= t('footer.inspired') ?>
      </small>
      <nav class="foot-links" id="footerLinks" aria-label="Footer">
        <a href="<?= BASE_URL ?>pages/about.php?lang=<?= $currentLang ?>" rel="nofollow"><?= t('footer.about') ?></a>
        <span aria-hidden="true">—</span>
        <a href="<?= $whatsappLink ?>" target="_blank" rel="noopener noreferrer">
          <?= t('footer.contact') ?>
        </a>
        <span aria-hidden="true">—</span>
        <a href="<?= BASE_URL ?>pages/privacy.php?lang=<?= $currentLang ?>">
          <?= t('footer.privacy') ?>
        </a>
        <span aria-hidden="true">—</span>
        <a href="<?= BASE_URL ?>pages/terms.php?lang=<?= $currentLang ?>" rel="nofollow">
          <?= t('footer.terms') ?>
        </a>
      </nav>
    </div>
  </footer>
</main>