
<?php

session_start();
include 'db.php';
if(!isset($_SESSION['email'])){
    header('Location:login.php');
    exit();
}


if(isset($_GET['id'])){
    $id =  $_GET['id'];
    $sql =  $conn->prepare("select * from student where id=?");
    $sql->bind_param('i',$id);
    $sql->execute();
    $user =  $sql->get_result()->fetch_assoc();
}


if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $class = $_POST['class'];
    $batch = $_POST['batch'];
    $city = $_POST['city'];

    $sql = $conn->prepare('update student set name=?,class=?,batch=?,email=?,city=? where id =?');
    $sql->bind_param('sssssi',$name,$class,$batch,$email,$city,$id);
    if($sql->execute()){
    
    header('Location:dashboard.php');
        exit;
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
            <div class="container mt-5">
           <div class="row justify-content-center">
                <div class="col-md-6">
                   <div class="card shadow">
                    
                    <div class="card-body">
                       <h2 class="text-center mb-4">
                        Update Student Details
                    </h2>
                    
                        <form action="" method="post">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="formId1"
                                    placeholder=""
                                    value="<?= $user['name'];?>"
                                    
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
                                    value="<?= $user['email'];?>"
                                />
                                <label for="formId1">Email</label>
                            </div>
                            
                            
                            
                            <div class="mb-3">
                                <label for="" class="form-label">Class</label>
                                <select
                                    class="form-select form-select-md"
                                    name="class"
                                    id=""
                                    value="<?= $user['class'];?>"
                                >
                                    <!-- <option selected>Select one</option> -->
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
                                    value="<?= $user['batch'];?>"
                                >
                                    <!-- <option selected>Select one</option> -->
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
                                    value="<?= $user['city'];?>"
                                    
                                />
                                <label for="formId1">City</label>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100"
                            >
                                Update Student
                            </button>
                            
                            
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
