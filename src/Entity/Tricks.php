<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="Tricks")
     */
    private $comments;




    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tricks")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     */
    private $categoryTricks;





    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }
	

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

    public function getCategoryTricks() : ?string
    {
        return $this->categoryTricks;
    }


    public function setCategoryTricks($categoryTricks)
    {
        $this->categoryTricks = $categoryTricks;
    }


    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setTricks($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getTricks() === $this) {
                $comment->setTricks(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
	
}
