<?php

namespace App\DTO;

use DateMalformedStringException;
use DateTime;

class CreateEventDTO
{
    public array $errors = [];

    public function __construct(
        public string $title,
        public string $description,
        public string $startDate,
        public string $endDate,
    ) {
    }

    public function validate(): void
    {
        try {
            $startDate = new DateTime($this->startDate);
        } catch (DateMalformedStringException $e) {
            $this->errors[] = 'Start date Malformed [' . $this->startDate . ']';
        }

        try {
            $endDate = new DateTime($this->endDate);
        } catch (DateMalformedStringException $e) {
            $this->errors[] = 'Start date Malformed [' . $this->endDate . ']';
        }

        if (count($this->errors)) {
            return;
        }

        if (isset($startDate) && isset($endDate) && $startDate->diff($endDate)->invert) {
            $this->errors[] = 'Start date should be greater then End Date';
        }
    }

    public function hasErrors(): bool
    {
        return !!count($this->errors);
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ];
    }
}