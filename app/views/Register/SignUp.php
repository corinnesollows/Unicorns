<html>

<head>
    <title>Sign Up</title>
    <link href="/mvc/public/css/UserForm.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php 
		global $errorFirstName;
        global $errorLastName;
        global $errorEmail;
        global $errorPassword;
        global $errorPassword2;
        global $errorAddress;
        global $errorCity;
        global $errorProvince;
        global $errorPostalCode;
        global $errorPhoneNumber;
        global $errorPaymentMethod;
        global $errorCardNumber;
        global $errorCardName;
        global $errorExpDate;
        global $isValid;		
    ?>
        <div id="main">
            <form id="userForm" name="userForm" method="post" action="/mvc/public/UserRegistration/add">
                <div id="headerTitle">
                    <h1>New User</h1><span id="note">*Required Fields</span>
                </div>
                <div id="personal">
                    <h2>User Information</h2>
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" id="firstName" required/>
                    <span>*<?php echo $errorFirstName; ?></span>
                    <br>
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" id="lastName" required/>
                    <span>*<?php echo $errorLastName; ?></span>
                    <br>
                    <label for="email">Email address:</label>
                    <input type="text" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/>
                    <span>*<?php echo $errorEmail; ?></span>
                    <br>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" pattern=".{6,}" title="Must be 6 letters long!" required/>
                    <span>*<?php echo $errorPassword; ?></span>
                    <br>
                    <label for="password2">Retype Password:</label>
                    <input type="password" name="password2" id="password2" required/>
                    <span>*<?php echo $errorPassword2; ?></span>
                    <br>
                    <label for="address">Address:</label>
                    <input type="text" name="address" id="address" required/>
                    <span>*<?php echo $errorAddress; ?></span>
                    <br>
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city" required/>
                    <span>*<?php echo $errorCity; ?></span>
                    <br>
                    <label for="province">Province:</label>
                    <select name="province" id="province">
                        <option value="AB">Alberta</option>
                        <option value="BC">British Columbia</option>
                        <option value="MB">Manitoba</option>
                        <option value="NB">New Brunswick</option>
                        <option value="NL">Newfoundland and Labrador</option>
                        <option value="NS">Nova Scotia</option>
                        <option value="NT">Northwest Territories</option>
                        <option value="NU">Nunavut</option>
                        <option value="ON">Ontario</option>
                        <option value="PE">Prince Edward Island</option>
                        <option value="QC">Quebec</option>
                        <option value="SK">Saskatchewan</option>
                        <option value="YK">Yukon</option>
                    </select>
                    <span>*<?php echo $errorProvince; ?></span>
                    <br>
                    <label for="postalCode">Postal Code:</label>
                    <input type="text" name="postalCode" id="postalCode" pattern="[a-zA-Z][0-9][a-zA-Z]\s*[0-9][a-zA-Z][0-9]" required/>
                    <span>*<?php echo $errorPostalCode; ?></span>
                    <br>
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" placeholder="555-555-5555" pattern="\d{3}[\-]\d{3}[\-]\d{4}" required/>
                    <span>*<?php echo $errorPhoneNumber; ?></span>
                </div>

                <div id="credit">
                    <h2>Credit Card Information</h2>
                    <label for="paymentMethod">Payment Method:</label>
                    <select name="paymentMethod" id="paymentMethod">
                        <option value="Visa">Visa</option>
                        <option value="MasterCard">MasterCard</option>
                    </select>
                    <span>*<?php echo $errorPaymentMethod; ?></span>
                    <label for="cardNumber">Credit Card Number:</label>
                    <input type="number" name="cardNumber" id="cardNumber" required pattern="[0-9]{13,16}" />
                    <span>*<?php echo $errorCardNumber; ?></span>
                    <label for="cardName">Cardholder's Name:</label>
                    <input type="text" name="cardName" id="cardName" required/>
                    <span>*<?php echo $errorCardName; ?></span>
                    <label for="expDate">Expiration Date:</label>
                    <input type="date" name="expDate" id="expDate" min="2015-11-15" max="2100-01-01" required/>
                    <span>*<?php echo $errorExpDate; ?></span>
                </div>
                <br>
                <input type="submit" id="submit" name="submit" value="Sign Up" />
            </form>
        </div>
</body>

</html>