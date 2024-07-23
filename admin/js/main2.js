let addBtn = document.querySelector(".add-btn");
let deleteBtn = document.querySelector(".delete-btn");
let studentArea = document.querySelector(".teacher-info-area");

let count = 1;
let arr = [];
arr.push(studentArea.children[0]);
// let n = 0;

addBtn.addEventListener("click",(event) =>{
let output = `
        <div class="content-area mt-5">
            <hr class="border border-primary border-3 opacity-75">
            <h5 class="text-center font-weight-bold">Teacher number ${count + 1}</h5>
            <!-- create teacher account -->
            <h3 class="font-weight-bold"><i class="fa-solid fa-file-pen mr-2"></i>Login Details</h3>
            <div class="card mt-3 mb-3 text-dark border border-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="email${count + 1}">Teacher's Email</label>
                        <input type="email" name="email${count + 1}" class="form-control border border-primary" placeholder="Enter teacher email...">
                    </div>
                    <div class="form-group">
                        <label for="password${count + 1}">Teacher's Password</label>
                        <input type="password" name="password${count + 1}" class="form-control border border-primary" placeholder="Enter teacher password...">
                    </div>
                </div>
            </div>
            <!-- create teacher info -->
            <h3 class="font-weight-bold"><i class="fa-solid fa-circle-info mr-2"></i></i>Information Details</h3>
            <div class="card mt-3 text-dark border border-primary">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="form-group col-md-5">
                            <label for="Fname${count + 1}">First name</label>
                            <input type="text" name="Fname${count + 1}" class="form-control border border-primary border border-primary" placeholder="Enter teacher first name...">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="Lname${count + 1}">Last name</label>
                            <input type="text" name="Lname${count + 1}" class="form-control border border-primary" placeholder="Enter teacher last name...">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="phoneNum${count + 1}">Phone number</label>
                            <input type="text" name="phoneNum${count + 1}" class="form-control border border-primary" placeholder="Enter teacher phone number...">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="DoB${count + 1}">Date of Birth</label>
                            <input type="date" name="DoB${count + 1}" class="form-control border border-primary">
                        </div>
                        <div class="form-check col-md-3">
                            <div class="d-flex justify-content-around mr-3">
                                <div class="col-md-2">
                                    <input class="form-check-input" type="radio" name="gender${count + 1}" id="gender1" value="0">
                                    <label class="form-check-label" for="gender1">Male</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="radio" name="gender${count + 1}" id="gender2" value="1">
                                    <label class="form-check-label" for="gender2">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;

let output2 = `
        <div class="content-area">
            <!-- create teacher account -->
            <h3 class="font-weight-bold"><i class="fa-solid fa-file-pen mr-2"></i>Login Details</h3>
            <div class="card mt-3 mb-3 text-dark border border-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="email1">Teacher's Email</label>
                        <input type="email" name="email1" class="form-control border border-primary" placeholder="Enter teacher email...">
                    </div>
                    <div class="form-group">
                        <label for="password1">Teacher's Password</label>
                        <input type="password" name="password1" class="form-control border border-primary" placeholder="Enter teacher password...">
                    </div>
                </div>
            </div>
            <!-- create teacher info -->
            <h3 class="font-weight-bold"><i class="fa-solid fa-circle-info mr-2"></i></i>Information Details</h3>
            <div class="card mt-3 text-dark border border-primary">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="form-group col-md-5">
                            <label for="Fname1">First name</label>
                            <input type="text" name="Fname1" class="form-control border border-primary border border-primary" placeholder="Enter teacher first name...">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="Lname1">Last name</label>
                            <input type="text" name="Lname1" class="form-control border border-primary" placeholder="Enter teacher last name...">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="phoneNum1">Phone number</label>
                            <input type="text" name="phoneNum1" class="form-control border border-primary" placeholder="Enter teacher phone number...">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="DoB1">Date of Birth</label>
                            <input type="date" name="DoB1" class="form-control border border-primary">
                        </div>
                        <div class="form-check col-md-3">
                            <div class="d-flex justify-content-around mr-3">
                                <div class="col-md-2">
                                    <input class="form-check-input" type="radio" name="gender1" id="gender1" value="0">
                                    <label class="form-check-label" for="gender1">Male</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="radio" name="gender1" id="gender2" value="1">
                                    <label class="form-check-label" for="gender2">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;

    if(count >= 1){
        studentArea.insertAdjacentHTML("beforeend",output);  
    }else{
        studentArea.insertAdjacentHTML("beforeend",output2);
    }
    let n = studentArea.children.length - 1;
    arr.push(studentArea.children[n]);
    console.log(arr);
    count++;
});

deleteBtn.addEventListener("click", (event) => { 
    arr.pop();
    count--;
    console.log(arr);
    studentArea.innerHTML = "";
    arr.forEach(element => {
        studentArea.appendChild(element);
    });
});
