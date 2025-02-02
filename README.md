# Marketing Commission

A Laravel-based system for visualize marketing commissions.

## Application Overview

<div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
  <img src="https://github.com/muhammadaliyusuf/marketing-commission/blob/main/ApplicationOverview/List-Marketing-Commission-Page.png" style="width: 48%; height: auto;">
  <img src="https://github.com/muhammadaliyusuf/marketing-commission/blob/main/ApplicationOverview/List-Payments-Page.png" style="width: 48%; height: auto;">
</div>
<div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
  <img src="https://github.com/muhammadaliyusuf/marketing-commission/blob/main/ApplicationOverview/Payment-Detail-1.png" style="width: 48%; height: auto;">
  <img src="https://github.com/muhammadaliyusuf/marketing-commission/blob/main/ApplicationOverview/Payment-Detail-2.png" style="width: 48%; height: auto;">
</div>

## Prerequisites

- PHP >= 8.1
- Composer
- MySQL

## Installation Steps

1. Clone the repository:
```bash
git clone https://github.com/muhammadaliyusuf/marketing-commission.git
cd marketing-commission
```

2. Install PHP dependencies:
```bash
composer install
```

3. Create environment file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Copy the generated key:
   - The key will be automatically added to your .env file
   - If not added automatically, copy the generated key (it will look like: base64:xxxxxxxxx...)
   - Open your .env file and paste the key in the APP_KEY field:
   ```
   APP_KEY=base64:your_generated_key_here
   ```

6. Configure database connection in `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marketing_commission
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run database migrations:
```bash
php artisan migrate
```

8. Run database seeders:
```bash
php artisan db:seed
php artisan db:seed --class=PaymentSeeder
```

## Additional Setup

Since the `/vendor` directory is not included in version control (as specified in `.gitignore`), make sure to:

1. Run `composer update` after cloning to install all required dependencies
2. If you encounter any issues with dependencies, try:
   - Clearing composer cache: `composer clear-cache`
   - Removing `composer.lock` and running `composer install` again

## Usage

1. Start the Laravel development server:
```bash
php artisan serve
```

## Database Schema

The database migrations will create the following structure:

### Tables

1. **marketings**
   - Contains marketing personnel information
   - Fields:
     - `id`: Unique identifier
     - `name`: Marketing personnel name

2. **sales**
   - Records sales transactions
   - Fields:
     - `id`: Unique identifier
     - `transaction_number`: Unique transaction identifier
     - `marketing_id`: Reference to marketing personnel
     - `date`: Transaction date
     - `cargo_fee`: Shipping/cargo charges (15,2 decimal)
     - `total_balance`: Total balance amount (15,2 decimal)
     - `grand_total`: Final total amount (15,2 decimal)

3. **payments**
   - Manages payment information for sales
   - Fields:
     - `id`: Unique identifier
     - `payment_number`: Unique payment identifier
     - `sale_id`: Reference to sales transaction
     - `amount`: Payment amount (12,2 decimal)
     - `payment_method`: Either 'cash' or 'credit'
     - `status`: Payment status ('pending', 'paid', 'failed')
     - `term_length`: Length of payment terms (optional)
     - `due_date`: Payment due date (optional)
     - `timestamps`: Created and updated timestamps

4. **payment_installments**
   - Tracks installment payments for credit transactions
   - Fields:
     - `id`: Unique identifier
     - `payment_id`: Reference to main payment
     - `installment_amount`: Amount per installment (12,2 decimal)
     - `installment_number`: Sequential number of installment
     - `due_date`: Installment due date
     - `status`: Installment status ('pending', 'paid', 'overdue')
     - `timestamps`: Created and updated timestamps

### Relationships

- Each **sale** belongs to one **marketing** personnel
- Each **payment** belongs to one **sale**
- Each **payment** can have multiple **payment_installments** (for credit payments)

## Disclaimer

-   This project was developed as part of the assessment process required for recruitment at **_PT. Herca Cipta Dermal Perdana_**.

## Contact

Muhammad Ali Yusuf - muhammadaliyusuff22@gmail.com
