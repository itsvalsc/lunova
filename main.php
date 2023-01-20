<?php
//require_once "C:\\xampp\\htdocs\\lunova\\Foundation\\FDisco.php";
//require_once "C:\\xampp\\htdocs\\lunova\\Foundation\\FConnectionDB.php";
//require_once "C:\\xampp\\htdocs\\lunova\\inc\\configdb.php";
/*
require_once "./Foundation/FCliente.php";
require_once "./Entity/ECliente.php";
require_once "./Entity/EUtente.php";
require_once "./Entity/ECarta.php";
require_once "./Entity/EWallet.php";
require_once "./Foundation/FConnectionDB.php";
require_once "./inc/configdb.php";
require_once "./Foundation/FDisco.php";
require_once "./Entity/EDisco.php";
require_once "./Entity/EOrdine.php";
require_once "./Foundation/FOrdine.php";
require_once "./Entity/ESondaggio.php";
require_once "./Entity/ERichiesta.php";
require_once "./Foundation/FSondaggio.php";
require_once "./Foundation/FRichiesta.php";
require_once "./Entity/EVotazione.php";
require_once "./Foundation/FVotazione.php";
require_once "./Foundation/FAdmin.php";
require_once "./Foundation/FPersistentManager.php";
require_once "./Foundation/FArtista.php";
require_once "./Entity/EArtista.php";
require_once "./inc/init.php";
require_once "./Foundation/FImmagine.php";
require_once "./Entity/EImmagine.php";
*/


/*
$utt1 = new EClient("Valentina","Scimia","via vale","3","L'Aquila","AQ","67100","1029384756","valentina@scimia.com",'passwd3!');
$utt2 = new EClient("Noemi","Barbaro","via noemi","2","L'Aquila","AQ","67100","0987654321","noemi@barbaro.com",'passwd2!');
$utt3 = new EClient("luigi","Bartolomeo","via marruvio","1","avezzano","AQ","67051","1234567890","l@l.com",'passwd1!');

$a=FCliente::store($utt1);
$a=FCliente::store($utt2);
$a=FCliente::store($utt3);*/

/*
//TODO: aggiungete sul database alla tabella artista alla fine l'attributo NomeArte
$art1 = new EArtista("Rocco","Pagliarulo","Via Palermo","148","Salerno","SA","65123","3314756294","roccohunt@gmail.com","rocchino1","Rocco Hunt");
$art2 = new EArtista("Laura","Pausini","via roma","30","Faenza","23600","cappe","3451122637","laurapausini@gmail.com","laurina1","Laura Pausini");
$art3 = new EArtista("Alessandro","Aleotti","via salernitana","63","Milano","MI","20100","3478172664","jaxsupport@gmail.com","jaxino1","J-AX");
FArtista::store($art1);
FArtista::store($art2);
FArtista::store($art3);
//$a=FCliente::load('l@l.com');*/

//$a=FCliente::prelevaCliente('pluto@gmail.com');

//$a = new EDisco('Cinquanta','2022',12,'1) Easy 2) BEER 3) girl','1',null,1500);

//$b = FDisco::prelevaDischiperGenere('0');

//print_r($b);

//$s = new EOrdine('34567');
//$s->Compile('34567','roma','00100','pizza', 'carta', '33');
//$s->setIdCliente('67890')
//$f = FOrdine::store($s);

//$b=new ERichiesta('dc4',"2022-10-10");

//$a = FPersistentManager::getInstance();
//$b = $a->prelevaOrdini('ut1');
//print_r($b);

/*
$pers = FPersistentManager::getInstance();

$elenco = $pers->prelevaDischi();
foreach ($elenco as $p ){$o = $p->getTitolo();
print_r($o);}
var_dump($elenco);


$a = new EDisco('Cinq','2022',12,'1) Easy 2) BEER 3) girl','1',null,1500);
FDisco::store($a);
*/

/*
$s = FCliente::load('valentina@scimia.com');
//$b = $s[0]->getEmail();
var_dump($s);

$a = FPersistentManager::getInstance();
$b = $a->prelevaArtisti();
print_r($b);
*/
require_once "./Foundation/FConnectionDB.php";
require_once './Entity/ENotifiche.php';
require_once './Entity/ECommento.php';
require_once "./Foundation/FPersistentManager.php";
require_once './Foundation/FNotifiche.php';
require_once ("inc/crosswords.txt");






//TODO:vedere nella pagina di visualizzazione singolo singolo prodotto che l'autore risulta con artista id, corregere e mettere nome artista
//TODO:matodi per prelevare informazioni input scritte su vettore post
//TODO:commenti e pagamenti
//TODO:riempire il db con esempi
//TODO:carrello






