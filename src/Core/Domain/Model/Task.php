<?php

declare(strict_types=1);

namespace App\Core\Domain\Model;

use App\Common\Domain\TimestampableTrait;
use Ramsey\Uuid\UuidInterface;

final class Task
{
    use TimestampableTrait;

    private UuidInterface $id;
    private int $authorId;
    private int $executorId;
    private int $status;
    private string $title;
    private string $description;
    private string $optionalFields;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    /**
     * @return int
     */
    public function getExecutorId(): int
    {
        return $this->executorId;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getOptionalFields(): string
    {
        return $this->optionalFields;
    }
}
