# Installation

Before you begin, ensure that you have [Composer](https://getcomposer.org/) installed.

1. **Clone the repository:**
    ```bash
    git clone https://github.com/Nocturnete/Proyecto1.git
    ```

2. **Navigate to the project directory:**
    ```bash
    cd Proyecto1
    ```

3. **Install PHP dependencies:**
    ```bash
    ../composer install
    ```

4. **Install JavaScript dependencies:**
    ```bash
    npm install
    ```

5. **Copy the configuration file and customize settings (e.g., database) in .env:**
    ```bash
    cp .env.example .env
    ```

6. **Start the Development Server**
    ```bash
    php artisan serve
    ```
    ```bash
    npm run dev
    ```