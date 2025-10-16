<?php

class Validator
{
    public static function validateNoteData($data): array
    {
        $errors = [];

        if (empty($data['title'])) {
            $errors['title'] = "Title is required";
        } elseif (!self::string($data['title'], 3, 255)) {
            $errors['title'] = "Title must be between 3 and 255 characters";
        }

        if (empty($data['content'])) {
            $errors['content'] = "Content is required";
        } elseif (!self::string($data['content'], 10, 20000)) {
            $errors['content'] = "Content must be between 10 and 20000 characters long";
        }

        return $errors;
    }

    public static function string($value, $min = 1, $max = INF): bool
    {
        $length = strlen(trim($value));
        return is_string($value) && $length >= $min && $length <= $max;
    }

    public static function email($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}