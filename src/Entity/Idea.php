<?php

namespace App\Entity;

use App\Repository\IdeaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=IdeaRepository::class)
 */
class Idea
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Ce titre n'est pas valide")
     * @Assert\Length(
     *     min="10", max="255",
     *     minMessage="10 caractères minim SVP !",
     *     maxMessage="255 caractères maximum SVP !"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     *  @Assert\NotBlank(message="La description n'est pas valide")
     * @Assert\Length(
     *     min="40", max="600",
     *     minMessage="40 caractères minim SVP !",
     *     maxMessage="600 caractères maximum SVP !"
     * )
     * @ORM\Column(type="string", length=600)
     */
    private $description;

    /**
     * @Assert\NotBlank(message="Ce nom n'est pas valide")
     * @Assert\Length(
     *     min="2", max="255",
     *     minMessage="2 caractères minim SVP !",
     *     maxMessage="255 caractères maximum SVP !"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $author;


    /**
     * @ORM\Column(type="date")
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="ideas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
