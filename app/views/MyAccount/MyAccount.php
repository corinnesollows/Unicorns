<html>

<head>
    <title>My Account</title>
    <link href="/mvc/public/css/UserForm.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Current values should be displayed -->
    <?php 
    include '/../Header/Header.php';
        global $errorPassword2;
        $errorFirstName = 
        $errorLastName = 
        $errorEmail =
        $errorPassword =
        $errorAddress =
        $errorCity =
        $errorProvince =
        $errorPostalCode=
        $errorPhoneNumber = 
		$errorPaymentMethod = 
		$errorCardNumber = 
		$errorCardName =
		$errorExpDate = "";
        $isValid = true;
     ?>
        <div id="main">
            <div id="headerTitle">
                <h1>My Account</h1><span id="note">*Required Fields</span>
            </div>

            <div id="personal">
                <h2>User Information</h2>
                <form id="userForm" name="personalForm" method="post" action="/mvc/public/MyAccount/update">
                    <input type='hidden' name='user_id' value='<?php echo MyAccount::getData('user_id'); ?>' />
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" id="firstName" value="<?php echo MyAccount::getData('fname'); ?>" required/>
                    <span>*<?php echo $errorFirstName; ?></span>
                    <br>
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" id="lastName" value="<?php echo MyAccount::getData('lname'); ?>" required/>
                    <span>*<?php echo $errorLastName; ?></span>
                    <br>
                    <label for="email">Email address:</label>
                    <input type="text" name="email" id="email" value="<?php echo MyAccount::getData('email'); ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/>
                    <span>*<?php echo $errorEmail; ?></span>
                    <br>
                    <label for="password">New Password:</label>
                    <input type="password" name="newPassword" id="newPassword" pattern=".{6,}" title= "Must be 6 letters long!"/>
                    <span><br><?php echo $errorPassword; ?></span>
                    <br>
                    <label for="password2">Retype New Password:</label>
                    <input type="password" name="newPassword2" id="newPassword2" />
                    <span>*<?php echo $errorPassword2; ?></span>                    
                    <br>
                    <label for="address">Address:</label>
                    <input type="text" name="address" id="address" value="<?php echo MyAccount::getData('address'); ?>" required/>
                    <span>*<?php echo $errorAddress; ?></span>
                    <br>
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city" value="<?php echo MyAccount::getData('city'); ?>" required/>
                    <span>*<?php echo $errorCity; ?></span>
                    <br>
                    <label for="province">Province:</label>
                    <select name="province" id="province">
                        <option value="AB" <?php if(MyAccount::getData('province') == 'AB')
                                echo "selected";?>>Alberta</option>
                        <option value="BC" <?php if(MyAccount::getData('province') == 'BC')
                                echo "selected";?>>British Columbia</option>
                        <option value="MB" <?php if(MyAccount::getData('province') == 'MB')
                                echo "selected";?>>Manitoba</option>
                        <option value="NB" <?php if(MyAccount::getData('province') == 'NB')
                                echo "selected";?>>New Brunswick</option>
                        <option value="NL" <?php if(MyAccount::getData('province') == 'NL')
                                echo "selected";?>>Newfoundland and Labrador</option>
                        <option value="NS" <?php if(MyAccount::getData('province') == 'NS')
                                echo "selected";?>>Nova Scotia</option>
                        <option value="NT" <?php if(MyAccount::getData('province') == 'NT')
                                echo "selected";?>>Northwest Territories</option>
                        <option value="NU" <?php if(MyAccount::getData('province') == 'NU')
                                echo "selected";?>>Nunavut</option>
                        <option value="ON" <?php if(MyAccount::getData('province') == 'ON')
                                echo "selected";?>>Ontario</option>
                        <option value="PE" <?php if(MyAccount::getData('province') == 'PE')
                                echo "selected";?>>Prince Edward Island</option>
                        <option value="QC" <?php if(MyAccount::getData('province') == 'QC')
                                echo "selected";?>>Quebec</option>
                        <option value="SK" <?php if(MyAccount::getData('province') == 'SK')
                                echo "selected";?>>Saskatchewan</option>
                        <option value="YK" <?php if(MyAccount::getData('province') == 'YK')
                                echo "selected";?>>Yukon</option>
                    </select>
                    <span>*<?php echo $errorProvince; ?></span>
                    <br>
                    <label for="postalCode">Postal Code:</label>
                    <input type="text" name="postalCode" id="postalCode" value="<?php echo MyAccount::getData('postal_code'); ?>" pattern="[a-zA-Z][0-9][a-zA-Z]\s*[0-9][a-zA-Z][0-9]" required/>
                    <span>*<?php echo $errorPostalCode; ?></span>
                    <br>
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" value="<?php echo MyAccount::getData('phone_number'); ?>" pattern="\d{3}[\-]\d{3}[\-]\d{4}" required/>
                    <span>*<?php echo $errorPhoneNumber; ?></span>
                    <br>
                    <input type="submit" id="update" name="submit" class="update" value="Update Personal Info" />
                </form>
                <br>
            </div>

            <div id="credit">
                <h2>Credit Card Information</h2>
                <form id="userForm" name="cardForm" method="post" action="/mvc/public/MyAccount/cardUpdate">
                    <input type='hidden' name='user_id' value='<?php echo MyAccount::getData('user_id'); ?>' />
                    <label for="paymentMethod">Payment Method:</label>
                    <select name="paymentMethod" id="paymentMethod">
                        <option value="Visa" <?php if(MyAccount::getCardData('payment_method') == 'Visa')
                                echo "selected";?>>Visa</option>
                        <option value="MasterCard" <?php if(MyAccount::getCardData('payment_method') == 'MasterCard')
                                echo "selected";?>>MasterCard</option>
                    </select>
                    <span>*<?php echo $errorPaymentMethod; ?></span>
                    <label for="cardNumber">Credit Card Number:</label>
                    <input type="text" name="cc_number" id="cc_number" value="<?php echo MyAccount::getCardData('cc_number'); ?>" pattern="[0-9]{13,16}" required/>
                    <span>*<?php echo $errorCardNumber; ?></span>
                    <label for="cardName">Cardholder's Name:</label>
                    <input type="text" name="cc_name" id="cc_name" value="<?php echo MyAccount::getCardData('cc_name'); ?>" required/>
                    <span>*<?php echo $errorCardName; ?></span>
                    <label for="phoneNumber">Expiration Date:</label>
                    <input type="date" name="cc_expiration_date" id="cc_expiration_date" value="<?php echo MyAccount::getCardData('cc_expiration_date'); ?>" min="2015-11-15" max="2100-01-01"  required/>
                    <span>*<?php echo $errorExpDate; ?></span>
                    <input type="submit" id="update" name="submit" class="update" value="Update Card Info" />
                </form>
            </div>

            <br>
            <form id="previousorder" name="previousorder" method="post" action="/mvc/public/PreviousOrders/previousorders">
                <input type="submit" id="previousorder" class="update" name="submit" value="View Previous Orders" />
            </form>
        </div>
</body>
</html>