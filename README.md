# Notes App

A modern note-taking application built with vanilla PHP, featuring auto-generated titles, inline editing, and toast notifications.

## Features

- 📝 **Auto-Generated Titles** - Titles are automatically created from the first 50 characters of your note content
- ✏️ **Inline Editing** - Edit note titles directly in the sidebar with keyboard shortcuts (Enter to save, Escape to cancel)
- 🔔 **Toast Notifications** - Clean, modern notifications for all actions (success, error, warning, info)
- 🔐 **User Authentication** - Secure login and registration system
- 📱 **Responsive Design** - Works seamlessly on desktop and mobile devices
- 🎨 **Modern UI** - Built with Tailwind CSS v4

## Tech Stack

- **Backend**: PHP 8+
- **Database**: PostgreSQL
- **Frontend**: Tailwind CSS v4 (CDN)
- **Testing**: Pest PHP
- **Architecture**: MVC with Repository Pattern, Dependency Injection

## Requirements

- PHP 8.0 or higher
- PostgreSQL
- Composer

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/frost23z/notes-php.git
   cd notes-php
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Set up the database**
   - Create a PostgreSQL database named `notes`
   - Update database credentials in `config.php`:
     ```php
     "db" => [
         'dsn' => 'pgsql:host=localhost;port=5432;dbname=notes',
         'user' => 'your_username',
         'password' => 'your_password',
         'dbname' => 'notes'
     ]
     ```

4. **Run database migrations**
   ```bash
   psql -U your_username -d notes -f database/schema.sql
   psql -U your_username -d notes -f database/migration_add_timestamps.sql
   ```

5. **Start the development server**
   ```bash
   php -S localhost:8000 -t public
   ```

6. **Visit the app**
   Open your browser and go to `http://localhost:8000`

## Usage

### Creating Notes
- Click "New Note" to create a note
- Just write your content - the title will be auto-generated
- Click "Save" to save your note

### Editing Notes
- Click on any note in the sidebar to view it
- Click the edit button (pencil icon) to edit the note
- Double-click a note title in the sidebar to edit it inline

### Deleting Notes
- Click the delete button (trash icon) on the active note in the sidebar
- Confirm the deletion when prompted

## Testing

Run the test suite with Pest:

```bash
./vendor/bin/pest
```

## Project Structure

```
├── Core/              # Core application classes
│   ├── Container.php  # Dependency injection container
│   ├── Database.php   # Database connection
│   ├── Router.php     # HTTP routing
│   ├── functions.php  # Helper functions
│   └── Repositories/  # Data access layer
├── Http/              # HTTP layer
│   ├── controllers/   # Request handlers
│   └── middlewares/   # Middleware classes
├── database/          # Database migrations
├── public/            # Web root
│   └── index.php      # Entry point
├── routes.php         # Route definitions
├── tests/             # Pest test suite
└── views/             # View templates
    └── partials/      # Reusable view components
```

## Key Features Explained

### Auto-Generated Titles
Notes no longer require manual title input. When you create or edit a note, the system automatically generates a title from the first 50 characters of your content. This makes note-taking faster and more intuitive.

### Inline Title Editing
Click the edit button next to any note title in the sidebar to edit it inline. Use keyboard shortcuts for quick editing:
- **Enter** - Save changes
- **Escape** - Cancel editing

### Toast Notifications
The app uses a modern toast notification system with four types:
- **Success** (green) - For successful operations
- **Error** (red) - For errors
- **Warning** (yellow) - For warnings
- **Info** (blue) - For informational messages

Toasts auto-dismiss after 5 seconds and can be manually closed.