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

1. **Clone the Repository**

    ```bash
    git clone <repository_url>
    ```

2. **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Environment Configuration**

    - Create a copy of the `.env` file

    ```bash
    cp .env.example .env
    ```

    - Update the `.env` file with your database credentials

4. **Generate an application key**

    ```bash
    php artisan key:generate
    ```

5. **Run Migrations**

    ```bash
    php artisan migrate
    ```

6. **Start the development server**

    ```bash
    php artisan serve
    ```

7. **Compile assets**

    ```bash
    npm run dev
    ```

8. **Visit the application in your browser**

    ```bash
    http://localhost:8000
    ```
