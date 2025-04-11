# Aura Interiors RESTful API

A RESTful API for managing user accounts and handling enquiry form submissions for the Aura Interiors Website. This API provides endpoints for creating, reading, updating, and deleting user accounts, as well as retrieving and searching enquiry form submissions.

## Overview

This API provides a complete account management system with full CRUD functionality (Create, Read, Update, Delete) for user accounts. Additionally, it includes read and search capabilities for enquiry form submissions. The API is designed to be easily integrated with web applications that require user authentication and contact form functionality.

## Setup and Installation

1. Clone the repository to your web server directory
2. Import the attached database
3. Access the API through `http://localhost/Account_Management/`

## API Endpoints

### Account Management

#### Read All Accounts
- **Endpoint**: `read_accounts.php`
- **Method**: GET
- **Description**: Retrieves a list of all user accounts in the system.
- **Response**: JSON array of account objects.

#### Read Single Account
- **Endpoint**: `read_single_account.php`
- **Method**: POST
- **Description**: Retrieves details for a specific account by ID.
- **Request Body**:
  ```json
  {
    "account_id": 123
  }
  ```
- **Response**: JSON object containing account details.

#### Search Accounts
- **Endpoint**: `search_accounts.php`
- **Method**: POST
- **Description**: Searches for accounts by username, email, or name.
- **Request Body**:
  ```json
  {
    "search": "search_term"
  }
  ```
- **Response**: JSON array of matching account objects.

#### Create Account
- **Endpoint**: `create_account.php`
- **Method**: POST
- **Description**: Creates a new user account.
- **Request Body**:
  ```json
  {
    "firstName": "John",
    "lastName": "Alex",
    "username": "johnalex",
    "email": "johnalex@gmail.com",
    "password": "secure_password"
  }
  ```
- **Response**: JSON object confirming creation with account details.

#### Update Account
- **Endpoint**: `update_account.php`
- **Method**: POST
- **Description**: Updates an existing account's information.
- **Request Body**:
  ```json
  {
    "account_id": 123,
    "firstName": "Ollie",     // Optional
    "lastName": "Lexis",      // Optional
    "username": "johnsmith",  // Optional
    "email": "ollie.lexis@gmail.com", // Optional
    "password": "new_password" // Optional
  }
  ```
- **Response**: JSON object confirming update with account details.

#### Delete Account
- **Endpoint**: `delete_account.php`
- **Method**: POST
- **Description**: Deletes an account from the system.
- **Request Body**:
  ```json
  {
    "account_id": 123
  }
  ```
- **Response**: JSON object confirming deletion.

### Enquiry Form Management

#### Read All Enquiries
- **Endpoint**: `read_enquiries.php`
- **Method**: GET
- **Description**: Retrieves all enquiry form submissions.
- **Response**: JSON array of enquiry objects.

#### Search Enquiries
- **Endpoint**: `search_enquiries.php`
- **Method**: POST
- **Description**: Searches for enquiry submissions by email or contact number.
- **Request Body**:
  ```json
  {
    "search": "search_term"
  }
  ```
- **Response**: JSON array of matching enquiry objects.

## Usage Examples

### JavaScript Fetch Example (Get All Accounts)

```javascript
fetch('http://your-domain/Account_Management/read_accounts.php')
  .then(response => response.json())
  .then(data => console.log(data))
  .catch(error => console.error('Error:', error));
```

### JavaScript Fetch Example (Create Account)

```javascript
fetch('http://your-domain/Account_Management/create_account.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    firstName: 'Jane',
    lastName: 'Renii',
    username: 'janreniih',
    email: 'jane@gmail.com',
    password: 'secure_password'
  }),
})
  .then(response => response.json())
  .then(data => console.log(data))
  .catch(error => console.error('Error:', error));
```

## Author

Curtis Bennett - 4FSC0WE004 25T1