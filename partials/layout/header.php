<?php
$currentLang = $_SESSION['lang'] ?? 'en';
?>

<header>
  <nav class="topbar">

    <div class="topbar__left">

      <a class="logo-brand" href="<?= with_lang('home.php'); ?>">
        <div class="logo">l.orkut</div>
      </a>

      <ul class="menu">
        <li><a href="<?= with_lang('home.php'); ?>"><?= t('nav.home'); ?></a></li>
        <li><a href="<?= with_lang('profile.php'); ?>"><?= t('nav.profile'); ?></a></li>
        <li class="locked">
          <span class="nav-link">
            <?= t('nav.scrapbook'); ?>
            <span class="lock-icon">🔒</span>
          </span>
        </li>
        <li><a href="<?= with_lang('projects.php'); ?>"><?= t('nav.projects'); ?></a></li>
        <li><a href="<?= with_lang('communities.php'); ?>"><?= t('nav.communities'); ?></a></li>
      </ul>

    </div>

    <div class="topbar__right">

      <div class="lang-switch">
        <a href="<?= current_url_with_lang('en'); ?>"
          <?= $currentLang === 'en' ? 'aria-current="true"' : '' ?>>EN</a>

        <a href="<?= current_url_with_lang('pt'); ?>"
          <?= $currentLang === 'pt' ? 'aria-current="true"' : '' ?>>PT</a>

        <a href="<?= current_url_with_lang('es'); ?>"
          <?= $currentLang === 'es' ? 'aria-current="true"' : '' ?>>ES</a>

        <a href="<?= current_url_with_lang('fr'); ?>"
          <?= $currentLang === 'fr' ? 'aria-current="true"' : '' ?>>FR</a>
      </div>

      <a href="<?= BASE_URL ?>/index.php" class="logout-btn">
        <?= t('nav.exit'); ?>
      </a>

      <form class="search" role="search" method="GET" action="<?= with_lang('search.php'); ?>">
        <input
          class="search__input"
          type="search"
          name="q"
          placeholder="<?= t('nav.search_placeholder'); ?>" />
      </form>

      <button type="submit" class="search-btn" aria-label="<?= t('nav.search'); ?>">
        <svg width="29" height="29" viewBox="0 0 39 39" fill="none">
          <path
            d="M31.85 34.125L21.6125 23.8875C20.8 24.5375 19.8656 25.0521 18.8094 25.4313C17.7531 25.8104 16.6292 26 15.4375 26C12.4854 26 9.98698 24.9776 7.94219 22.9328C5.8974 20.888 4.875 18.3896 4.875 15.4375C4.875 12.4854 5.8974 9.98698 7.94219 7.94219C9.98698 5.8974 12.4854 4.875 15.4375 4.875C18.3896 4.875 20.888 5.8974 22.9328 7.94219C24.9776 9.98698 26 12.4854 26 15.4375C26 16.6292 25.8104 17.7531 25.4313 18.8094C25.0521 19.8656 24.5375 20.8 23.8875 21.6125L34.125 31.85L31.85 34.125Z"
            fill="#d2cfcf" />
        </svg>
      </button>

      <button class="mnav-btn" type="button" aria-label="<?= t('nav.open_menu'); ?>">
        ☰
      </button>

    </div>
  </nav>
</header>

<div class="mnav-backdrop" hidden></div>

<aside class="mnav-drawer" aria-hidden="true">
  <div class="mnav-head">
    <strong>l.orkut</strong>
    <button class="mnav-close" type="button">✕</button>
  </div>

  <nav class="mnav-links">
    <a href="<?= with_lang('home.php'); ?>"><?= t('nav.home'); ?></a>
    <a href="<?= with_lang('profile.php'); ?>"><?= t('nav.profile'); ?></a>
    <a href="<?= with_lang('scrapbook.php'); ?>"><?= t('nav.scrapbook'); ?></a>
    <a href="<?= with_lang('projects.php'); ?>"><?= t('nav.projects'); ?></a>
    <a href="<?= with_lang('communities.php'); ?>"><?= t('nav.communities'); ?></a>
  </nav>
</aside>