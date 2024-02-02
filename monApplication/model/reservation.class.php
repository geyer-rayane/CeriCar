<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="jabaianb.reservation")
 */
class reservation{

	/** @Id @Column(type="integer")
	 *  @GeneratedValue
	 */ 
	public $id;

	//Plusieurs occurrences d'un même voyage pointant pourtant vers la même entité
	/**
   * @ManyToOne(targetEntity="voyage",cascade={"persist"})
   * @JoinColumn(name="voyage", referencedColumnName="id")
   */ 
	public $voyage;

	//Plusieurs occurrences d'un même voyageur pointant pourtant vers la même entité type utilisateur car un voyageur est un utilisateur
	/**
   * @ManyToOne(targetEntity="utilisateur",cascade={"persist"})
   * @JoinColumn(name="voyageur", referencedColumnName="id")
   */ 
	public $voyageur;
	
	public function __construct($voyage, $voyageur) 
	{
        $this->voyage = $voyage;
        $this->voyageur = $voyageur;
    }

}
?>
