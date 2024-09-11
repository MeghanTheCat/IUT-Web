<div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required autofocus>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="password-confirm">Confirm password</label>
            <input type="password" name="password_confirmation" id="passord-confirm" required>
        </div>
        <button type="submit">Register</button>
    </form>
</div>
