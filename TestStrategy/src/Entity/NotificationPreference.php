<?php

namespace App\Entity;

use App\Repository\NotificationPreferenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificationPreferenceRepository::class)]
class NotificationPreference
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'notificationPreference')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private bool $emailNotificationsEnabled = true;

    #[ORM\Column]
    private bool $remindersEnabled = true;

    #[ORM\Column]
    private int $reminderMinutesBefore = 60;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $now = new \DateTimeImmutable();
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function isEmailNotificationsEnabled(): bool
    {
        return $this->emailNotificationsEnabled;
    }

    public function setEmailNotificationsEnabled(bool $emailNotificationsEnabled): static
    {
        $this->emailNotificationsEnabled = $emailNotificationsEnabled;

        return $this;
    }

    public function isRemindersEnabled(): bool
    {
        return $this->remindersEnabled;
    }

    public function setRemindersEnabled(bool $remindersEnabled): static
    {
        $this->remindersEnabled = $remindersEnabled;

        return $this;
    }

    public function getReminderMinutesBefore(): int
    {
        return $this->reminderMinutesBefore;
    }

    public function setReminderMinutesBefore(int $reminderMinutesBefore): static
    {
        $this->reminderMinutesBefore = $reminderMinutesBefore;

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
}
