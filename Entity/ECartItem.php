<?php

/** La classe ECarrello caratterizza il carello di un cd attraverso:
 * IdCartItem: identificativo del cartItem
 * IdCart: identifica l'id del carrello collegato al cartItem
 * quantity: identifica la quantità del cartItem
 * id_disco: identifica l'id del disco inserito nel carrello
 * totprice: identifica il prezzo totale del cartItem
 */

class ECartItem {

    private string $IdCartItem;
    private string $IdCart;
    private int $quantity;
    private string $id_disco;
    private float $totprice;

    public function __construct(EDisco $disco){
        $this->IdCartItem = random_int(0,99999);
        $this->IdCart = random_int(0,99999);
        $this->id_disco = $disco->getID();
        $this->quantity = 1;
        $this->totprice = 0.0; 
    }

    /** metodi get */

    public function getIdCart()
    { return $this->IdCart; }

    public function getIdCartItem()
    { return $this->IdCartItem; }

    public function getIdItem()
    { return $this->id_disco; }

    public function getQuantity(): int 
    { return $this->quantity; }

    public function getTotPrice(): float 
    { return $this->totprice; }

    /** metodi set */
    
    public function setIdCartItem( $IdOrdineItem ) :void
    { $this->IdCartItem = $IdOrdineItem; }

    public function setIdCart( $IdOrdineItem ) :void
    { $this->IdCart = $IdOrdineItem; }

    public function setIdItem( EDisco $_disco ) :void
    { $this->id_disco = $_disco->getID(); }

    public function setQuantity( int $quantity) :void 
    { $this->quantity = $quantity; }

    public function setTotPrice( float $totprice ) :void 
    { $this->totprice = $totprice; }
}
?>