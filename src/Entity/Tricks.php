<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TricksRepository")
 */
class Tricks
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
	
	 /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $description ;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $category ;
	

    public function getId(): ?int
    {
        return $this->id;
    }
	
	public function getName() : ?string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription() : ?string
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getCategory() : ?string
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->description = $category;
    }
	
}
