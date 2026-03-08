<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/db_connect.php';
require_once __DIR__ . '/config.php';

$availableLangs = ['en', 'pt', 'es', 'ca', 'fr'];

if (isset($_GET['lang'])) {
  $requested = strtolower(trim($_GET['lang']));
  if (in_array($requested, $availableLangs, true)) {
    $_SESSION['lang'] = $requested;
  }
}

$lang = $_SESSION['lang'] ?? 'en';

$langFile = __DIR__ . "/../lang/{$lang}.json";
$fallbackFile = __DIR__ . "/../lang/en.json";

$raw = file_exists($langFile) ? file_get_contents($langFile) : null;
$translations = is_string($raw) ? json_decode($raw, true) : null;

if (!is_array($translations)) {
  $rawFallback = file_exists($fallbackFile) ? file_get_contents($fallbackFile) : '{}';
  $translations = json_decode($rawFallback, true);
  if (!is_array($translations)) {
    $translations = [];
  }
}

function t(string $key): string
{
  global $translations;
  return $translations[$key] ?? $key;
}

function with_lang(string $path): string
{
  $lang = $_SESSION['lang'] ?? 'en';
  $sep = str_contains($path, '?') ? '&' : '?';
  return $path . $sep . 'lang=' . urlencode($lang);
}

function asset($path) {
    return BASE_URL . ltrim($path, './');
}