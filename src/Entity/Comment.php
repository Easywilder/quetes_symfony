<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\Column(type="integer")
     */
    private $rate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\episode", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $episode_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getAuthorId(): ?user
    {
        return $this->author_id;
    }

    public function setAuthorId(?user $author_id): self
    {
        $this->author_id = $author_id;

        return $this;
    }

    public function getEpisodeId(): ?episode
    {
        return $this->episode_id;
    }

    public function setEpisodeId(?episode $episode_id): self
    {
        $this->episode_id = $episode_id;

        return $this;
    }
}
