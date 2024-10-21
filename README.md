# Note Taking Application

This is a note-taking application built with Laravel 10, Vue 3 and Laravel Mix.

## Features

-   Create, read, update, and delete notes.
-   Add to-do lists to notes
-   Add images to notes
-   Pin important notes

## Setup Instructions

### Prerequisites

Before setting up the project, make sure you have the following installed:

-   PHP 8.2
-   Composer 2
-   Node.js 20
-   npm

### Installation Steps

1. **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

1. **Environment Configuration**

    - Create a copy of the `.env` file

    ```bash
    cp .env.example .env
    ```

    - Update the `.env` file with your database credentials

1. **Generate an application key**

    ```bash
    php artisan key:generate
    ```

1. **Run Migrations**

    ```bash
    php artisan migrate
    ```

1. **Start the development server**

    ```bash
    php artisan serve
    ```

1. **Compile assets**

    ```bash
    npm run dev
    ```

1. **Visit the application in your browser**

    ```bash
    http://localhost:8000
    ```
