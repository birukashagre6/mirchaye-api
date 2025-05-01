# Mirchaye API - Laravel Backend

![Database Schema](https://github.com/birukashagre6/mirchaye-api/blob/master/dbschema.png)

## 📌 Project Overview

A robust Laravel backend API for managing political parties, their posts, and user interactions.

## 🗄️ Database Schema

Our database consists of 5 main tables with the following relationships:

1. **Users** - Platform users
2. **Political Parties** - Registered political organizations
3. **Nebe Posts** - General platform announcements
4. **Party Posts** - Content specific to political parties
5. **Personal Access Tokens** - Authentication tokens

## 🛠️ Installation

```bash
# Clone the repository
git clone https://github.com/birukashagre6/mirchaye-api.git

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mirchaye
DB_USERNAME=root
DB_PASSWORD=

# Run migrations
php artisan migrate --seed

# Start development server
php artisan serve
# Request for token
POST /api/login
{
    "email": "user@example.com",
    "password": "password"
}

# Include token in headers
Authorization: Bearer {token}
