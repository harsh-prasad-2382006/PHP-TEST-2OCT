
<?php 

include 'db.php';

$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if(empty($name) || empty($email) || empty($password) || empty($confirmPassword)){
        $error = 'All fields are mandatory';
    } elseif($password !== $confirmPassword){
        $error = 'Passwords do not match';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = 'Email format does not match';
    } else {
        $check = $conn->prepare('select * from users WHERE email=?');
        $check->bind_param('s',$email);
        $check->execute();
        $res = $check->get_result();

        if($res->num_rows > 0){
            $error = 'User with this email already exists';
        } else {
            $hashedPassword = password_hash($password,PASSWORD_BCRYPT);

            $sql = $conn->prepare('insert into users(name,email,password) values(?,?,?)');
            $sql->bind_param('sss',$name,$email,$hashedPassword);

            if($sql->execute()){
                header('Location:login.php');
                exit;
            }
        }
    }
}


?>


<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
           <div
            class="container mt-5">
           <div class="row justify-content-center">
                <div class="col-md-6">
                   <div class="card shadow">
                    
                    <div class="card-body">
                       <h2 class="text-center mb-4">
                        User Registration
                    </h2>
                    <?php if($error != ''){ ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php } ?>
                        <form action="" method="post">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="formId1"
                                    placeholder=""
                                    
                                />
                                <label for="formId1">Name</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    id="formId1"
                                    placeholder=""
                                    
                                />
                                <label for="formId1">Email</label>
                            </div>
                            
                            
                            
                            <div class="form-floating mb-3">
                                <input
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    id="formId1"
                                    placeholder=""
                                    
                                />
                                <label for="formId1">Password</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input
                                    type="password"
                                    class="form-control"
                                    name="confirmPassword"
                                    id="formId1"
                                    placeholder=""
                                    
                                />
                                <label for="formId1">Confirm Password</label>
                            </div>
                            

                            <button
                                type="submit"
                                class="btn btn-primary w-100"
                            >
                                Register
                            </button>
                            <div class="text-center mt-3">
                            <span>Already have an account?</span>
                            <a href="login.php">Login</a>
                        </div>
                            
                        </form>
                    </div>
                   </div>
                   
                </div>
           </div>
        </div>
            
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
