<?php

namespace App\Entity;

use App\Repository\ArticleNoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleNoteRepository::class)]
class ArticleNote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $note = null;

    #[ORM\ManyToOne(inversedBy: 'User')]
    #[ORM\JoinColumn(nullable: false)]
    private ?article $Article = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'yes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?self $user = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'user')]
    private Collection $yes;

    public function __construct()
    {
        $this->yes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getArticle(): ?article
    {
        return $this->Article;
    }

    public function setArticle(?article $Article): static
    {
        $this->Article = $Article;

        return $this;
    }

    public function getUser(): ?self
    {
        return $this->user;
    }

    public function setUser(?self $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(self $ye): static
    {
        if (!$this->yes->contains($ye)) {
            $this->yes->add($ye);
            $ye->setUser($this);
        }

        return $this;
    }

    public function removeYe(self $ye): static
    {
        if ($this->yes->removeElement($ye)) {
            // set the owning side to null (unless already changed)
            if ($ye->getUser() === $this) {
                $ye->setUser(null);
            }
        }

        return $this;
    }
}
