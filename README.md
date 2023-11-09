# Installation

Before you begin, ensure that you have [Composer](https://getcomposer.org/) installed.

1. **Clone the repository:**
    ```bash
    git clone https://github.com/your_username/your_project.git
    ```

2. **Navigate to the project directory:**
    ```bash
    cd your_project
    ```

3. **Install PHP dependencies:**
    ```bash
    composer install
    ```

4. **Install JavaScript dependencies:**
    ```bash
    npm install
    ```

5. **Copy the configuration file and customize settings (e.g., database) in .env:**
    ```bash
    cp .env.example .env
    ```

6. **Generate the application key:**
    ```bash
    php artisan key:generate
    ```

7. **Run migrations and seed the database:**
    ```bash
    php artisan migrate
    php artisan db:seed
    ```

8. **Set permissions to view storage disk settings:**
    ```bash
    php artisan storage:link
    ```

# Start the Development Server

```bash
php artisan serve
npm run dev