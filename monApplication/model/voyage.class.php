<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="jabaianb.voyage")
 */
class voyage{

	/** @Id @Column(type="integer")
	 *  @GeneratedValue
	 */ 
	public $id;

	/**
   * @ManyToOne(targetEntity="utilisateur")
   * @JoinColumn(name="conducteur", referencedColumnName="id")
   */
	public $conducteur;
	//Plusieurs occurrences d'un même trajet qui pointent vers le même trajet 
	/**
    * @ManyToOne(targetEntity="trajet")
    * @JoinColumn(name="trajet", referencedColumnName="id")
    */
	public $trajet;
		
	/** @Column(type="integer") */ 
	public $tarif;

	/** @Column(type="integer") */ 
	public $nbplace;

	/** @Column(type="integer") */ 
	public $heuredepart;

	/** @Column(type="string", length=200) */ 
	public $contraintes;
	
	public function setNbplace($nbplace) 
	{
        $this->nbplace = $nbplace;
    }
	
	public function getNbPlace()
	{
		return $this->nbplace ;
	}	
	
	public function __construct($conducteur, $trajet, $tarif, $nbplace, $heuredepart, $contraintes) {
        $this->conducteur = $conducteur;
        $this->trajet = $trajet;
        $this->tarif = $tarif;
        $this->nbplace = $nbplace;
        $this->heuredepart = $heuredepart;
        $this->contraintes = $contraintes;
    }
	
	


}

?>
