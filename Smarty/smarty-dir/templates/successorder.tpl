<link rel="stylesheet" type="text/css" href="https://bootswatch.com/5/vapor/bootstrap.css">
{if $logged}
    <div class = "container">
    <div class="alert alert-dismissible alert-info"  style="margin-top:100px;">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Il tuo ordine è stato eseguito!</strong> Grazie per aver scelto Lunova.
        <a href="/lunova/" class="alert-link">
            Torna alla home</a>

    </div>
        <a href="">
            <button type="button" class="btn btn-primary">Vedi ordini</button>
        </a>
    </div>
{/if}