<?php
header("Content-Type: application/json; charset=UTF-8");
$lang = $_GET["lang"] ?? "en";
$fortunes = [

  "en" => [
    "Good things take time — but some start today.",
    "A small step today unlocks a big moment tomorrow.",
    "You’re closer than you think.",
    "Someone is grateful for you today — even if you don’t know it yet.",
    "Your energy is attracting the right people.",
    "A memory from your past will make you smile soon.",
    "Trust the timing — it’s working in your favor.",
    "Something beautiful is forming quietly behind the scenes.",
    "You will receive clarity today.",
    "Today is a good day to begin again."
  ],

  "pt" => [
    "Coisas boas levam tempo — mas algumas começam hoje.",
    "Um pequeno passo hoje desbloqueia um grande momento amanhã.",
    "Você está mais perto do que imagina.",
    "Alguém é grato por você hoje — mesmo que você não saiba.",
    "Sua energia está atraindo as pessoas certas.",
    "Uma lembrança do passado vai te fazer sorrir em breve.",
    "Confie no tempo — ele está trabalhando a seu favor.",
    "Algo lindo está se formando silenciosamente nos bastidores.",
    "Você receberá clareza hoje.",
    "Hoje é um bom dia para recomeçar."
  ],

  "es" => [
    "Las cosas buenas toman tiempo — pero algunas empiezan hoy.",
    "Un pequeño paso hoy desbloquea un gran momento mañana.",
    "Estás más cerca de lo que crees.",
    "Alguien está agradecido por ti hoy — aunque no lo sepas.",
    "Tu energía está atrayendo a las personas correctas.",
    "Un recuerdo del pasado te hará sonreír pronto.",
    "Confía en el tiempo — está trabajando a tu favor.",
    "Algo hermoso se está formando en silencio.",
    "Recibirás claridad hoy.",
    "Hoy es un buen día para empezar de nuevo."
  ]
];

if (!isset($fortunes[$lang])) {
    $lang = "en";
}

$random = $fortunes[$lang][array_rand($fortunes[$lang])];

echo json_encode([
    "date" => date("M jS"),
    "fortune" => $random
]);