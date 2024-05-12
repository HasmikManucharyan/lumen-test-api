# Lumen test api

## Installation

1. Clone the repository: `git clone https://github.com/HasmikManucharyan/lumen-test-api`
2. Install dependencies: `composer install`
3. Configure the env file.
4. Migrate the database: `php artisan migrate`
5. Start the server: `php -S localhost:8000 -t public`

## Usage

### Endpoints

#### GET /
Get a list of all loans.
For filter /?sum=xxxx&created_at=xxxx-xx-xx
#### POST /loans
Create new loan

#### GET / loans/{id}
Show loan

#### PUT /loans/{id}
Update loan

#### DELETE /loans/{id}
Delete loan


