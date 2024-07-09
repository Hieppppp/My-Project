<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 100px;
        }

        .form {
            background-color: #fff;
            display: block;
            padding: 1rem;
            max-width: 350px;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .form-title {
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 600;
            text-align: center;
            color: #000;
        }

        .input-container {
            position: relative;
        }

        .input-container input,
        .form button {
            outline: none;
            border: 1px solid #e5e7eb;
            margin: 8px 0;
        }

        .input-container input {
            background-color: #fff;
            padding: 1rem;
            padding-right: 2.2rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            width: 300px;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .input-container span {
            display: grid;
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            padding-left: 1rem;
            padding-right: 1rem;
            place-content: center;
        }

        .input-container span svg {
            color: #9CA3AF;
            width: 1rem;
            height: 1rem;
        }

        .submit {
            display: block;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
            background-color: #4F46E5;
            color: #ffffff;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 500;
            width: 100%;
            border-radius: 0.5rem;
            text-transform: uppercase;
        }

        .signup-link {
            color: #6B7280;
            font-size: 0.875rem;
            line-height: 1.25rem;
            text-align: center;
        }

        .signup-link a {
            text-decoration: underline;
        }

        .help {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <form class="form" method="POST" action="{{ route('register') }}">
            <p class="form-title">Register</p>
            @csrf
            <div class="input-container">
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter name">
                <p class="help is-danger">{{ $errors->first('name') }}</p>
            </div>
            <div class="input-container">
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email">
                <p class="help is-danger">{{ $errors->first('email') }}</p>
            </div>
            <div class="input-container">
                <input type="password" id="password" name="password" placeholder="Enter password">
                <p class="help is-danger">{{ $errors->first('password') }}</p>
            </div>
            <div class="input-container">
                <input type="password" name="password_confirmation" placeholder="Enter confirm password">
                <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
            </div>
            <div class="form-group form-check mb-3">
                <input type="checkbox" class="form-check-input" name="checkbox" id="terms">
                <label class="form-check-label" for="terms">I agree to the Terms of Service!</label>
            </div>
            <button type="submit" class="submit">Register</button>
            <p class="text-center mt-3">Do you already have an account? <a href="{{ route('login') }}">LOGIN NOW!</a></p>
        </form>

    </div>
</body>

</html>