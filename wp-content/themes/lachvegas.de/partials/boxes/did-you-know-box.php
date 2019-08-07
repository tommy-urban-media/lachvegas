<?php

$txt = [
    'Fische sind die am seltensten überfahrenen Tiere',
    'Übermäßiges Rauchen kann die Länge des erigierten Penis um bis zu 8 mm verkürzen',
	'Der Amerikaner Horst Schultz stellte eine Weltrekord auf in dem er seinen Samen 5,67m weit, 3,75m hoch und mit 68,71Km/H abspritzte. Toll!',
	'Ein Dreieck hat exakt 25% weniger Ecken als ein Quadrat',
	'Das Sandmännchen hat die Schuhgröße 6',
	'Das Sandmännchen hat 1978 die Russische Puppe “Mascha” im Weltraum geheiratet',
	'Wer keinen Mittagschlaf macht ist tagsüber länger wach'
];

$random_text = $txt[rand(0, count($txt)-1)];

?>


<div class="did-you-know-box" data-component="FooterBox">
	<span class="did-you-know-box__close" data-close-btn>&times;</span>
	<span class="did-you-know-box__title">Wusstest du schon?</span>
	<div class="did-you-know-box__body">
		<p><?= $random_text ?></p>
		<p><a href="/unnuetzes-wissen">mehr unnützes Wissen</a></p>
	</div>
</div>