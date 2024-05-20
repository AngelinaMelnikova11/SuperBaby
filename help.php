<?php require_once('header.php');?>
<style>

.faq {
  width: 80%;
  margin: 0 auto;
}
 
details {
  background-color: #456fce;
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 1em;
  margin-bottom: 2em;
}
 
summary {
  font-weight: bold;
  cursor: pointer;
}
 
details[open] {
  background-color: #dd84fa;
}
</style>

<h1 class="h1_img" id="omission">Справка</h1>
<section class="faq">
<details>
    <summary>Наши Контакты</summary>
    <p>Почта: superbaby@gmail.com</p>
    <p>Номер Телефона: 89375732885</p>
  </details>
  <details>
    <summary>Наша история</summary>
    <p>Организация дошкольного образования "Superbaby" была основана в 2010 году группой педагогов и психологов с целью создания инновационной среды для развития малышей с самого раннего возраста. </p>
    <p>С первых дней существования "Superbaby" стало популярным местом среди родителей, которые ценили индивидуальный подход к каждому ребенку, творческие методики обучения и уникальные программы развития. </p>
    <p>За короткое время организация заслужила репутацию лучшего дошкольного учреждения в городе, благодаря чему количество детей, посещающих "Superbaby", постоянно росло. 
</p>
    <p>Сегодня "Superbaby" имеет несколько филиалов по всему городу, а его успешные выпускники продолжают обучение в престижных учебных заведениях, демонстрируя высокие результаты на учебе и в жизни.</p>
  </details>
  <details>
    <summary>Какова программа обучения и развития детей в вашей организации??</summary>
    <p>Ответ</p>
  </details>
  <details>
    <summary>Какие меры безопасности и санитарно-гигиенические стандарты соблюдаются в вашем дошкольном учреждении?</summary>
    <p>Ответ</p>
  </details>
  <details>
    <summary>акие документы необходимы для поступления ребенка в ваше дошкольное учреждение?</summary>
    <p>Ответ</p>
  </details>
</section>
<script type="text/javascript">

document.querySelectorAll('.faq details').forEach((item) =&gt; {
  item.addEventListener('toggle', (event) =&gt; {
    if (event.target.open) {
      document.querySelectorAll('.faq details').forEach((otherItem) =&gt; {
        if (otherItem !== event.target) {
          otherItem.removeAttribute('open');
        }
      });
    }
  });
});
</script>
<?php require_once('footer.php');?>

