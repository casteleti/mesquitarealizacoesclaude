<?php

declare(strict_types=1);

class Validator
{
    private array $errors = [];
    private array $data   = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function required(string $field, string $label): static
    {
        if (empty(trim((string) ($this->data[$field] ?? '')))) {
            $this->errors[$field] = "$label é obrigatório.";
        }
        return $this;
    }

    public function maxLength(string $field, int $max, string $label): static
    {
        $val = $this->data[$field] ?? '';
        if (mb_strlen((string) $val) > $max) {
            $this->errors[$field] = "$label deve ter no máximo $max caracteres.";
        }
        return $this;
    }

    public function email(string $field, string $label = 'E-mail'): static
    {
        $val = $this->data[$field] ?? '';
        if ($val && !filter_var($val, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = "$label inválido.";
        }
        return $this;
    }

    public function in(string $field, array $allowed, string $label): static
    {
        $val = $this->data[$field] ?? '';
        if ($val !== '' && !in_array($val, $allowed, true)) {
            $this->errors[$field] = "$label inválido.";
        }
        return $this;
    }

    public function numeric(string $field, string $label): static
    {
        $val = $this->data[$field] ?? '';
        if ($val !== '' && !is_numeric($val)) {
            $this->errors[$field] = "$label deve ser numérico.";
        }
        return $this;
    }

    public function passes(): bool
    {
        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function firstError(): string
    {
        return $this->errors ? array_values($this->errors)[0] : '';
    }

    public function get(string $field, mixed $default = ''): mixed
    {
        return $this->data[$field] ?? $default;
    }
}
