<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use UserBundle\Entity\User;


/**
 * Events
 *
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\EventsRepository")
 */
class Events
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(name="locationLongitude", type="float")
     */
    private $locationLongitude;

    /**
     * @ORM\Column(name="locationLatitude", type="float")
     */
    private $locationLatitude;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="date")
     */
    private $date_start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="date")
     */
    private $date_end;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="poster", type="string", length=255)
     */
    private $poster;

    /**
     * @Assert\File(maxSize="500k")
     */
    public $file;

    /**
     * @var int
     *
     * @ORM\Column(name="nbreparticipation", type="integer", nullable=true)
     */
    private $nbreparticipation;



    /**
     * @ORM\Column(name="maxPlaces", type="integer")
     * @Assert\Type(type="integer", message="Event's Maximum Places Should Be Valid"),
     * @Assert\Range(min=9, minMessage="Event's Maximum Places Should Be Valid", max=9999, maxMessage="Event's Maximum Places Should Be Valid", invalidMessage="Event's Maximum Places Should Be Valid")
     */
    private $maxPlaces;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user",referencedColumnName="id", onDelete="cascade")
     */
    private $user;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Events
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Events
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    public function getLocationLongitude()
    {
        return $this->locationLongitude;
    }


    public function setLocationLongitude($locationLongitude)
    {
        $this->locationLongitude = $locationLongitude;
    }


    public function getLocationLatitude()
    {
        return $this->locationLatitude;
    }

    /**
     * @param mixed $locationLatitude
     */
    public function setLocationLatitude($locationLatitude)
    {
        $this->locationLatitude = $locationLatitude;
    }




    /**
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
     * @param \DateTime $date_start
     */
    public function setDateStart($date_start)
    {
        $this->date_start = $date_start;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->date_end;
    }

    /**
     * @param \DateTime $date_end
     */
    public function setDateEnd($date_end)
    {
        $this->date_end = $date_end;
    }


    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Events
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set poster
     *
     * @param string $poster
     *
     * @return Events
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster
     *
     * @return string
     */
    public function getPoster()
    {
        return $this->poster;
    }
    public function getWebPath()
    {
        return null === $this->poster ? null : $this->getUploadDir().'/'.$this->poster;
    }
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }
    protected function getUploadDir()
    {
        return 'images';
    }
    public function uploadPoster()
    {
        if (null === $this->file) {
            return;
        }
        if(!$this->id){
            $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
        }else{

            $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
        }
        $this->setPoster($this->file->getClientOriginalName());


    }
    public function setMaxPlaces($maxPlaces)
    {
        $this->maxPlaces = $maxPlaces;

        return $this;
    }

    public function getMaxPlaces()
    {
        return $this->maxPlaces;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getNbreparticipation()
    {
        return $this->nbreparticipation;
    }

    /**
     * @param int $nbreparticipation
     */
    public function setNbreparticipation($nbreparticipation)
    {
        $this->nbreparticipation = $nbreparticipation;
    }
    public function removeMember(User $member)
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
        }

        return $this;
    }

}


