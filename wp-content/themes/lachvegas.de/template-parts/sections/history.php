<?php 

$data = new stdClass();
$data->date_historical = '1618-05-23';

$datetime1 = new DateTime('1618-05-23');
$datetime2 = new DateTime();
$interval = $datetime1->diff($datetime2);

?>

<section class="history">
    <div class="history__block">
        <span>Heute vor <?= $interval->format('%y')?> Jahren</span> 
        <span>23.05.1618</span>
        <h3>Prager Fenstersturz</h3>
        <p>In Prag (damals Böhmen) stürzen 2 protestantische Beamte besoffen aus dem Fenster nachdem sie von ihren Vorgesetzten mit gepanschtem Bier abgefüllt wurden. Der Vorfall löste den 30-Jährigen Krieg aus.e</p>
    </div>
    
    <div class="history_block">
        <span>Heute in 100 Jahren</span> 
        <p>Bangladesh: Letztes aktives Atomkraftwerk abgeschaltet und in Erdkern versenkt.</p>
        <p>Lachvegas.de kann die Zukunft vorhersagen? Nicht ganz, aber kurios wäre es wenn man wissen könnte was in 100 Jahren passieren wird.</p>
    </div>
</section>