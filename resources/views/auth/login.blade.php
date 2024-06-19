<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
        .container{
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
        .help{
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <form class="form" method="POST" action="{{ url('login') }}">
            <p class="form-title">Login</p>
            @csrf
            <div class="input-container">
                <input placeholder="Enter email" type="email" name="email">
                <p class="help is-danger">{{ $errors->first('email') }}</p>
            </div>
            
            <div class="input-container">
                <input placeholder="Enter password" type="password" name="password">
                <p class="help is-danger">{{ $errors->first('password') }}</p>
            </div>
            <button class="submit" type="submit">
                Login
            </button>
        </form>
    </div>
</body>

</html>