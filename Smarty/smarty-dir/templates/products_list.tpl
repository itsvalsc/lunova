<?php include ('header.tpl'); ?>
<div class ='row'>
    {section name = nr loop= $product}


            <div class="card" style="width: 18rem;">
                <img src="https://media.istockphoto.com/photos/vinyl-record-picture-id134119615?k=20&m=134119615&s=612x612&w=0&h=zI6Fig1j8mbZp16CgvaDRMPHAzTaBNhhcBR0AldRXtw=" alt="prova">
                <div class="card-body">
                    <h5 class="card-title"> {$product[nr]->getTitolo()} </h5>
                    <h6 class = "card-subtitle mb-2 text-muted">{$product[nr]->getPrezzo()}</h6>
                    <p class="card-text">{$product[nr]->getDescrizione() }</p>
                    <!--<button class="btn btn-secondary btn-sm btn-block rounded-0" onclick="location.href='<?php //echo ROOT_URL . '?page=view-product&id=' . esc_html($product->getID()); ?>'">Vedi</button>-->
                    <button class="btn btn-secondary btn-sm btn-block rounded-0" onclick="#">Vedi</button>
                    <form method="post">
                        <!--<input type="hidden" name="id" value="<?php// echo esc_html($product->getID()); ?>">-->
                        <input type="hidden" name="id" value="#"
                        <input name="add_to_cart" type="submit" class="btn btn-primary btn-sm btn-block rounded-0" value="Aggiungi al carrello">
                    </form>
                </div>
            </div>
    {/section}


</div>
