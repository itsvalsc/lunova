<?php


/**
 * Class checked
 * @package Entity
 */
class ECartItem {

    private string $IdCart;

    private string $IdCartItem;
    
    private int $quantity;
    
    private string $id_disco;
    
    private float $totprice;

    public function __construct(EDisco $disco){
        $this->IdCartItem = random_int(0,1000);
        $this->IdCart = random_int(0,1000);
        $this->id_disco = $disco->getID();
        $this->quantity = 1;
        $this->totprice = 0.0; 
    }



    //metodi get

    public function getIdCartItem()
    { return $this->IdCartItem; }

    public function getIdCart()
    { return $this->IdCart; }

    public function getIdItem()
    { return $this->id_disco; }

    public function getQuantity(): int 
    { return $this->quantity; }

    public function getTotPrice(): float 
    { return $this->totprice; }



    //metodi set
    
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