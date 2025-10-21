<?php

namespace Http\Forms;

use Core\Validator;

class NoteForm extends BaseForm
{
    protected function rules(): void
    {
        // Only validate if title is explicitly provided
        if (isset($this->attributes['title']) && !empty($this->attributes['title'])) {
            if (!Validator::string($this->attributes['title'], 1, 255)) {
                $this->errors['title'] = 'Title must be between 1 and 255 characters';
            }
        }
        if (empty($this->attributes['content'] ?? '')) {
            $this->errors['content'] = 'Content is required';
        } elseif (!Validator::string($this->attributes['content'], 1, 20000)) {
            $this->errors['content'] = 'Content must be between 1 and 20000 characters';
        }
    }
}
