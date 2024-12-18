# Ticket Management System

A web-based system for managing support tickets, allowing admins and agents to handle customer queries. The system provides functionality for customers to submit and track tickets, admins to assign tickets to agents and manage tickets/users, and agents to update status of assigned tickets. 

## Features
- **Login/Register**:
  - Login as customer/agent/admin user
  - Register as new customer

- **Profile**:
  - Update profile
  - Change password

- **Customer Interaction**:
  - Submit tickets
  - View user tickets and status

- **Admin Interaction**:
  - View all tickets
  - View ticket statistics
  - Assign tickets to agents
  - Update ticket statuses
  - Delete tickets
  - Create admin user
  - Create agent user
  - View all users
  - Delete users

- **Agent Interaction**:
  - View assigned tickets
  - Update status of assigned tickets

## Installation

### Prerequisites

Ensure you have the following installed:
- PHP >= 8.1
- Composer
- Laravel 11.x
- MySQL
- Node.js

### Clone the repository

```bash
git clone https://github.com/your-username/ticket-management-system.git
cd ticket-management-system
```

### Clone the repository

```bash
composer install
```

### Set up environment file
Copy the .env.example file to .env and configure it with your local environment settings, such as database connection, mailer settings, etc.

```bash
cp .env.example .env
```

### Set up the database
Create a database in MySQL then run the migrations to set up the required tables and seed the database with initial data:

```bash
php artisan migrate
php artisan db:seed
```

### Install frontend dependencies
```bash
npm install
npm run dev
```

### Run the application
```bash
php artisan serve
```
Visit http://127.0.0.1:8000 or localhost:8000 in your browser.

### Login as Test Users
The users included in the seed for testing are:
  - `customer1@example.com` (Customer)
  - `customer2@example.com` (Customer)
  - `admin1@example.com` (Admin)
  - `admin2@example.com` (Admin)
  - `agent1@example.com` (Agent)
  - `agent2@example.com` (Agent)

with `password` as password