## Subscription Management System

### Overview

This is a Laravel-based subscription management system that allows users to register, view plans, and purchase subscriptions using Stripe payment processing. The system includes user authentication, plan management, and webhook handling for payment verification.

### Features

- User registration and authentication.
- Plan display and selection.
- Stripe payment integration.
- Webhook handling for payment status updates.
- Subscription and transaction management
- Responsive frontend using Blade templates

### Requirements

- PHP >= 8.2
- Composer
- Laravel 12
- MySQL
- Stripe account and API keys
- Node.js and NPM (for frontend assets)

### Installation

1. Clone the Repository

```bash
    git clone <repository-url>
    cd product-caching
```
2. Install PHP Dependencies

```bash
    composer install
```
3. Install JavaScript Dependencies

```bash
    npm install
```
4. Set Up Environment
- Copy the .env.example file to .env:

```bash
    cp .env.example .env
```
- Generate an application key:
```bash
    php artisan key:generate
```
- Update .env with your database and Redis credentials:
```base
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3307
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    
    STRIPE_SECRET_KEY=sk_test_51IZ4h3DAuvR6KSdrAtEE0IhiMONzHhrlITaj6jmAxzcUtMmRIz5mSFsETrkW8KClj07t04zppJxl5fBDaydRLMOB00h7PKeKoH
    STRIPE_WEBHOOK_KEY=whsec_52e71097d011276a2fff16df12ae34fe936cd04091becd422eed85eed266c9d8
```

6. Run Migrations & seeder

```bash
    php artisan migrate --seed
```
7. Build Frontend Assets

```bash
    nmp run dev
```
Or, for production

```bash
    npm run build
```
8. Start the Development Server

```bash
    php artisan serve
```
### Usage
1. View Plans:
   - Access the homepage (/) to view all available plans
   - Click on a plan to see details
2. Purchase a Plan:
   - Select a plan and fill out the registration form
   - Submit to create an account and proceed to Stripe checkout
   - Complete payment on Stripe's secure page
3. Payment Processing:
   - Successful payments redirect to homepage with success message
   - Failed/cancelled payments show error message
   - Webhook endpoint processes payment completion
4. Authentication:
   - Register via plan purchase form
   - Login/logout functionality available
   - Guest middleware protects registration/login routes
   - Auth middleware protects logout route


### Project Structure
- Controllers:
    - app/Http/Controllers/HomeController.php: 
      - Handles homepage display 
      - Fetches and passes all plans to the view
    - app/Http/Controllers/PlanController.php:
      - Manages plan display and purchase operations
      - Handles Stripe checkout sessions
      - Processes webhook events
      - Manages subscription and transaction status updates
- Models:
    - app/Models/User.php: Handles user authentication and roles
    - app/Models/Plan.php: Stores plan details (name, price, billing cycle)
    - app/Models/Transaction.php: Tracks payment transactions
    - app/Models/Subscription.php: Manages user subscriptions
- Views:
    - resources/views/index.blade.php: 
      - Displays all available plans
      - Shows success messages
      - Uses custom components for layout and plan cards
    - resources/views/plans/show.blade.php
      - Displays individual plan details
      - Includes registration form for new users
      - Initiates payment process
- Routes:
    - routes/web.php: Defines routes for registration
- Factory:
    - database/factories/ProductFactory.php: Seeds 10000 sample products
- Styles:
    - resources/css/app.css: Tailwind CSS styles.
