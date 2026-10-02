<?php

session_start();
include 'db.php';
if(!isset($_SESSION['email'])){
    header('Location:login.php');
    exit();
}
$error='';

$result =  $conn->query("select * from student");
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $class = $_POST['class'];
    $batch = $_POST['batch'];
    $city = $_POST['city'];

    if(empty($name) || empty($email) || empty($class) || empty($batch)|| empty($city)){
        $error = 'All fields are mandatory';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = 'Email format does not match';
    } else {
        $check = $conn->prepare('select * from student WHERE email=?');
        $check->bind_param('s',$email);
        $check->execute();
        $res = $check->get_result();

        if($res->num_rows > 0){
            $error = 'Student with this email already exists';
        } else {
            $sql = $conn->prepare('insert into student(name,class,batch,email,city) values(?,?,?,?,?)');
            $sql->bind_param('sssss',$name,$class,$batch,$email,$city);
            if($sql->execute()){
                header('Location:dashboard.php');
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </head>

    <body>
        <header>
            <nav
                class="navbar navbar-expand-sm navbar-light bg-secondary"
            >
                <div class="container">
                    <a class="navbar-brand" href="#">Hello <?php echo $_SESSION['name']; ?></a>
                    <button
                        class="navbar-toggler d-lg-none"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapsibleNavId"
                        aria-controls="collapsibleNavId"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" aria-current="page"
                                    >Home
                                    <span class="visually-hidden">(current)</span></a
                                >
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li> -->
                           
                        </ul>
                        <a
                            name=""
                            id=""
                            class="btn btn-primary"
                            href="csv.php"
                            role="button"
                            >CSV</a
                        >
                        <a
                            name=""
                            id=""
                            class="btn btn-primary"
                            href="pdf.php"
                            role="button"
                            >PDF</a
                        >
                        
                        <form class="d-flex my-2 my-lg-0" action="logout.php">
                           
                            <button
                                class="btn btn-warning  my-2 my-sm-0"
                                type="submit"
                            >
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            
        </header>
         <main>
        <div class="container mt-5">
           <div class="row justify-content-center">
                <div class="col-md-6">
                   <div class="card shadow">
                    
                    <div class="card-body">
                       <h2 class="text-center mb-4">
                        Add Student
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
                            
                            
                            
                            <div class="mb-3">
                                <label for="" class="form-label">Class</label>
                                <select
                                    class="form-select form-select-md"
                                    name="class"
                                    id=""
                                >
                                    <option selected>Select one</option>
                                    <option value="8">8th</option>
                                    <option value="9">9th</option>
                                    <option value="10">10th</option>
                                    <option value="11">11th</option>
                                    
                                </select>
                            </div>
                            
                            
                            <div class="mb-3">
                                <label for="" class="form-label">Batch</label>
                                <select
                                    class="form-select form-select-md"
                                    name="batch"
                                    id=""
                                >
                                    <option selected>Select one</option>
                                    <option value="Morning">Morning</option>
                                    <option value="Afternoon">Afternoon</option>
                                    <option value="Evening">Evening</option>
                                    
                                    
                                </select>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="city"
                                    id="formId1"
                                    placeholder=""
                                    
                                />
                                <label for="formId1">City</label>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100"
                            >
                                Add Student
                            </button>
                            
                            
                        </form>
                    </div>
                   </div>
                   
                </div>
           </div>
        </div>


        <div
            class="container"
        >
            <div
                class="table-responsive"
            >
                <table
                    class="table table-danger"
                >
                    <thead>
                        <tr>
                            <th scope="col">Student ID</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Student Email</th>
                            <th scope="col">Student Class</th>
                            <th scope="col">Student Batch</th>
                            <th scope="col">Student City</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php while($row= $result->fetch_assoc()){ ?>
                        <tr class="">
                            <td scope="row"><?= $row['id']; ?></td>
                            <td scope="row"><?= $row['name'] ?></td>
                            <td scope="row"><?= $row['email'] ?></td>
                            <td scope="row"><?= $row['class'] ?></td>
                            <td scope="row"><?= $row['batch'] ?></td>
                            <td scope="row"><?= $row['city'] ?></td>
                            <td scope="row">
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm mb-1"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to delete this student? This action cannot be undone.');"> <i class="fa-solid fa-trash"></i></a> 
                            </td>
                        </tr>
                       
                        <?php } ?>
                    </tbody>
                </table>
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
