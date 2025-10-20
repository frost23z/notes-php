<?php

namespace Http\Forms;

use Core\Validator;

class NoteForm extends BaseForm
{
    protected function rules(): void
    {
        if (empty($this->attributes['title'] ?? '')) {
            $this->errors['title'] = 'Title is required';
        } elseif (!Validator::string($this->attributes['title'], 3, 255)) {
            $this->errors['title'] = 'Title must be between 3 and 255 characters';
        }

        if (empty($this->attributes['content'] ?? '')) {
            $this->errors['content'] = 'Content is required';
        } elseif (!Validator::string($this->attributes['content'], 10, 20000)) {
            $this->errors['content'] = 'Content must be between 10 and 20000 characters';
        }
    }
}
