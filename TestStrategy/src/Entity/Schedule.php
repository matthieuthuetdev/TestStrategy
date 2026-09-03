<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'schedules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\Column(length: 150)]
    private ?string $name = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $slug = null;

    #[ORM\Column]
    private ?int $appointmentDuration = null;

    #[ORM\Column]
    private ?int $bufferTime = null;

    #[ORM\Column(length: 64)]
    private ?string $timezone = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /** @var Collection<int, Availability> */
    #[ORM\OneToMany(mappedBy: 'schedule', targetEntity: Availability::class, orphanRemoval: true)]
    private Collection $availabilities;

    /** @var Collection<int, Unavailability> */
    #[ORM\OneToMany(mappedBy: 'schedule', targetEntity: Unavailability::class, orphanRemoval: true)]
    private Collection $unavailabilities;

    /** @var Collection<int, Appointment> */
    #[ORM\OneToMany(mappedBy: 'schedule', targetEntity: Appointment::class, orphanRemoval: true)]
    private Collection $appointments;

    public function __construct()
    {
        $now = new \DateTimeImmutable();
        $this->createdAt = $now;
        $this->updatedAt = $now;
        $this->availabilities = new ArrayCollection();
        $this->unavailabilities = new ArrayCollection();
        $this->appointments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getAppointmentDuration(): ?int
    {
        return $this->appointmentDuration;
    }

    public function setAppointmentDuration(int $appointmentDuration): static
    {
        $this->appointmentDuration = $appointmentDuration;

        return $this;
    }

    public function getBufferTime(): ?int
    {
        return $this->bufferTime;
    }

    public function setBufferTime(int $bufferTime): static
    {
        $this->bufferTime = $bufferTime;

        return $this;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function setTimezone(string $timezone): static
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /** @return Collection<int, Availability> */
    public function getAvailabilities(): Collection
    {
        return $this->availabilities;
    }

    public function addAvailability(Availability $availability): static
    {
        if (!$this->availabilities->contains($availability)) {
            $this->availabilities->add($availability);
            $availability->setSchedule($this);
        }

        return $this;
    }

    public function removeAvailability(Availability $availability): static
    {
        $this->availabilities->removeElement($availability);

        return $this;
    }

    /** @return Collection<int, Unavailability> */
    public function getUnavailabilities(): Collection
    {
        return $this->unavailabilities;
    }

    public function addUnavailability(Unavailability $unavailability): static
    {
        if (!$this->unavailabilities->contains($unavailability)) {
            $this->unavailabilities->add($unavailability);
            $unavailability->setSchedule($this);
        }

        return $this;
    }

    public function removeUnavailability(Unavailability $unavailability): static
    {
        $this->unavailabilities->removeElement($unavailability);

        return $this;
    }

    /** @return Collection<int, Appointment> */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): static
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments->add($appointment);
            $appointment->setSchedule($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): static
    {
        $this->appointments->removeElement($appointment);

        return $this;
    }
}
