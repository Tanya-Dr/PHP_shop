<h2>SIGNUP</h2>
<form class="signup__form">
    <label for="nickname" class="profile__label">
        <span>Your name</span>
        <input id="nickname" type="text" placeholder="Name" class="login__input">
    </label>
    <label for="email" class="profile__label">
        <span>Your email</span>
        <input type="email" placeholder="Email" class="login__input" required id="email">
    </label>
    <label for="pass" class="profile__label">
        <span>Your password</span>
        <input type="password" placeholder="Password" class="login__input" required id="pass">
    </label> 
    <label for="pass" class="profile__label">
        <span>Confirm the password</span>
        <input type="password" placeholder="Password" class="login__input" required id="passConfirm">
    </label> 
    <p class="form__err"></p>
    <button class="login__button button_registration" type="submit">
    SIGNUP
    </button>
    <a href="index.php?page=login" class="item__link">LOGIN</a>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/signup.js"></script>