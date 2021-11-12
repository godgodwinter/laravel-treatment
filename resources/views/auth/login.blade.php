<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login Page</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='{{asset('/')}}assets/css/kopekstylesheet.css'>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;1,300;1,400&display=swap" rel="stylesheet">
    <!-- <script src='main.js'></script> -->
    <script src="https://unpkg.com/boxicons@2.0.9/dist/boxicons.js"></script>
</head>
<body>
    <div id="container">
        <div id="wrapper">
            <form action="{{ route('login') }}" method="POST">
                @csrf
            <div id="loginForm">
                <h1>Login</h1>
                <span>Sign in to your account</span>
                <div id="inputField">
                    <input type="text" placeholder="Username" autocomplete="nope" name="identity" >
                </div>

  @if($errors->any())
  @foreach ($errors->all() as $error)
  <p id="wrong" class="wrong">
    {{ $error }}
  </p>
  @endforeach
@endif
                <div id="inputField">
                    <input type="password" placeholder="Password" autocomplete="nope"  name="password">
                </div>

                @error('password')
                <p id="wrong" class="wrong">
                    {{ $message }}
                </p>
            @enderror

                <div id="inputSignIn">
                    <input type="submit" value="Login">
                </div>
                <p>Not registered? <a href="#">Create an account</a></p>
            </div>
            </form>
            <div id="logoCompany">
                <div id="opacity">
                    <a href="#" target="_blank" id="linkLogo">
                        <img src="assets/github.png" alt="Your Logo">
                    </a>
                    <p>
                        Ramdani Skincare
                    </p>
                </div>
            </div>
        </div>
        {{-- <div id="credit">
            <p>
                Designed with
                <box-icon name='heart' type='solid' color='#ff1014' size="xs"></box-icon>
                by <a href="https://baemon.web.id/" target="_blank">Baemon Team</a>
            </p>
        </div>
        <div id="icon">
            <box-icon name='github' type='logo' animation='tada-hover' size='md'></box-icon>
        </div> --}}
    </div>
</body>
</html>
