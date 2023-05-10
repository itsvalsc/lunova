# lunova
1. Scaricare XAMPP con versione di php 8 o superiore
2. Scaricare il file zip allegato e copiare l'intero progetto (decompresso) nella cartella htdocs di xampp
4. Aprire il Pannello di Controllo di XAMPP e far partire Apache Server 
5. Prima di far partire MySQL Server, aprire Config->my.ini, settare il valore di max_allowed_packet=100M 
5. Aprire il browser e digitare "localhost/phpmyadmin/" e successivamente importare il file "lunova.sql" caricato nella tabella DBtabs nella cartella lunova del progetto
6. Una volta eseguito nel browser digitare "localhost/lunova"