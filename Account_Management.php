<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="api.css">
    <title>Account Management API</title>
</head>
<body>
    <div class="container">
        <h1>Account Management</h1>
        
        <div class="action-container">
            <h3>Read All Accounts</h3>
            <button id="getAllAccounts">Get All Accounts</button>
        </div>
        
        <div class="action-container">
            <h3>Get Single Account</h3>
            <input type="number" id="accountId" placeholder="Enter Account ID">
            <button id="getSingleAccount">Get Account</button>
        </div>
        
        <div class="action-container">
            <h3>Search Accounts</h3>
            <input type="text" id="searchTerm" placeholder="Search by username, email, or name">
            <button id="searchAccounts">Search</button>
        </div>
        
        <div class="action-container">
            <h3>Create Account</h3>
            <input type="text" id="createFirstName" placeholder="First Name">
            <input type="text" id="createLastName" placeholder="Last Name">
            <input type="text" id="createUsername" placeholder="Username">
            <input type="email" id="createEmail" placeholder="Email">
            <input type="password" id="createPassword" placeholder="Password">
            <button id="createAccount">Create Account</button>
        </div>
        
        <div class="action-container">
            <h3>Update Account</h3>
            <input type="number" id="updateAccountId" placeholder="Account ID">
            <input type="text" id="updateFirstName" placeholder="New First Name (optional)">
            <input type="text" id="updateLastName" placeholder="New Last Name (optional)">
            <input type="text" id="updateUsername" placeholder="New Username (optional)">
            <input type="email" id="updateEmail" placeholder="New Email (optional)">
            <input type="password" id="updatePassword" placeholder="New Password (optional)">
            <button id="updateAccount">Update Account</button>
        </div>
        
        <div class="action-container">
            <h3>Delete Account</h3>
            <input type="number" id="deleteAccountId" placeholder="Account ID">
            <button id="deleteAccount">Delete Account</button>
        </div>
        
        <!-- NEW: Enquiry Form Management Section -->
        <h1>Enquiry Form Management</h1>
        
        <div class="action-container">
            <h3>Read All Enquiry Forms</h3>
            <button id="getAllEnquiries">Get All Enquiries</button>
        </div>
        
        <div class="action-container">
            <h3>Search Enquiry Forms</h3>
            <input type="text" id="enquirySearchTerm" placeholder="Search by email or contact number">
            <button id="searchEnquiries">Search</button>
        </div>
        <!-- End of new section -->
        
        <div class="result">
            <h3>Result:</h3>
            <div id="result">Results will appear here...</div>
        </div>

    </div>
    
    <script>

        const baseUrl = "http://localhost/Account_Management/";
        
        function showResult(data) {
            document.getElementById('result').textContent = 
                typeof data === 'object' ? JSON.stringify(data, null, 2) : data;
        }
        
// ALL ACCOUNTS //

        document.getElementById('getAllAccounts').addEventListener('click', function() {
            fetch(baseUrl + "read_accounts.php")
                .then(response => response.json())
                .then(data => showResult(data))
                .catch(error => showResult("Error: " + error));
        });
        
// SINGLE ACCOUNT //

        document.getElementById('getSingleAccount').addEventListener('click', function() {
            const accountId = document.getElementById('accountId').value;
            if (!accountId) {
                showResult("Please enter an Account ID");
                return;
            }
            
            fetch(baseUrl + "read_single_account.php", {
                method: "POST",
                body: JSON.stringify({
                    account_id: accountId
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => showResult(data))
            .catch(error => showResult("Error: " + error));
        });
        
// SEARCH ACCOUNTS //

        document.getElementById('searchAccounts').addEventListener('click', function() {
            const searchTerm = document.getElementById('searchTerm').value;
            if (!searchTerm) {
                showResult("Please enter a search term");
                return;
            }
            
            fetch(baseUrl + "search_accounts.php", {
                method: "POST",
                body: JSON.stringify({
                    search: searchTerm
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => showResult(data))
            .catch(error => showResult("Error: " + error));
        });
        
// CREATE AN ACCOUNT //

        document.getElementById('createAccount').addEventListener('click', function() {
            const firstName = document.getElementById('createFirstName').value;
            const lastName = document.getElementById('createLastName').value;
            const username = document.getElementById('createUsername').value;
            const email = document.getElementById('createEmail').value;
            const password = document.getElementById('createPassword').value;
            
            if (!firstName || !lastName || !username || !email || !password) {
                showResult("Please fill in all required fields");
                return;
            }
            
            fetch(baseUrl + "create_account.php", {
                method: "POST",
                body: JSON.stringify({
                    firstName: firstName,
                    lastName: lastName,
                    username: username,
                    email: email,
                    password: password
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => showResult(data))
            .catch(error => showResult("Error: " + error));
        });
        
 // UPDATE ACCOUNT //

        document.getElementById('updateAccount').addEventListener('click', function() {
            const accountId = document.getElementById('updateAccountId').value;
            if (!accountId) {
                showResult("Please enter an Account ID");
                return;
            }
            
            const data = {
                account_id: accountId
            };
            
            const firstName = document.getElementById('updateFirstName').value;
            const lastName = document.getElementById('updateLastName').value;
            const username = document.getElementById('updateUsername').value;
            const email = document.getElementById('updateEmail').value;
            const password = document.getElementById('updatePassword').value;
            
            if (firstName) data.firstName = firstName;
            if (lastName) data.lastName = lastName;
            if (username) data.username = username;
            if (email) data.email = email;
            if (password) data.password = password;
            
            fetch(baseUrl + "update_account.php", {
                method: "POST",
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => showResult(data))
            .catch(error => showResult("Error: " + error));
        });
        
// DELETE ACCOUNT //

        document.getElementById('deleteAccount').addEventListener('click', function() {
            const accountId = document.getElementById('deleteAccountId').value;
            if (!accountId) {
                showResult("Please enter an Account ID");
                return;
            }
            
            if (!confirm("Are you sure you want to delete this account?")) {
                return;
            }
            
            fetch(baseUrl + "delete_account.php", {
                method: "POST",
                body: JSON.stringify({
                    account_id: accountId
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => showResult(data))
            .catch(error => showResult("Error: " + error));
        });
        
// GET ALL ENQUIRIES //

        document.getElementById('getAllEnquiries').addEventListener('click', function() {
            fetch(baseUrl + "read_enquiries.php")
                .then(response => response.json())
                .then(data => showResult(data))
                .catch(error => showResult("Error: " + error));
        });
        
// SEARCH ENQUIRIES //

        document.getElementById('searchEnquiries').addEventListener('click', function() {
            const searchTerm = document.getElementById('enquirySearchTerm').value;
            if (!searchTerm) {
                showResult("Please enter a search term");
                return;
            }
            
            fetch(baseUrl + "search_enquiries.php", {
                method: "POST",
                body: JSON.stringify({
                    search: searchTerm
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => showResult(data))
            .catch(error => showResult("Error: " + error));
        });
        
    </script>
</body>
</html>