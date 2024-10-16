function changeView() {

    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");

}
function signUp() {

    var f = document.getElementById("firstname");
    var l = document.getElementById("lastname");
    var e = document.getElementById("email");
    var p = document.getElementById("password");
    var m = document.getElementById("mobile");
    var g = document.getElementById("gender");
   


    var form = new FormData;
    form.append("f", f.value);
    form.append("l", l.value);
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("m", m.value);
    form.append("g", g.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "success") {
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msg").className = "bi bi-check2-circle fs-5";
                document.getElementById("alertdiv").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";
                
            } else {
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    }

    request.open("POST", "signupProcess.php", true);
    request.send(form);

}
function signIn() {

    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberme");

    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "home.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
            }

        }
    };

    r.open("POST", "signInProcess.php", true);
    r.send(f);

}
var bm;
function forgotPassword() {

    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Verification code has sent to your email. Please check your inbox");
                var m = document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}
function showPassword1() {

    var i = document.getElementById("npi");
    var eye = document.getElementById("e1");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function showPassword2() {

    var i = document.getElementById("rnp");
    var eye = document.getElementById("e2");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function resetpw() {

    var email = document.getElementById("email2");
    var np = document.getElementById("npi");
    var rnp = document.getElementById("rnp");
    var vcode = document.getElementById("vc");

    var f = new FormData();
    f.append("e", email.value);
    f.append("n", np.value);
    f.append("r", rnp.value);
    f.append("v", vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {

                bm.hide();
                alert("Password reset success");
                window.location.reload()

            } else {
                alert(t);
            }

        }
    };

    r.open("POST", "resetPassword.php", true);
    r.send(f);

}
function payNow(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["mail"];
            var amount = obj["amount"];
            

            if (t == "1") {
                alert("Please log in or sign up");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please update your profile first");
                window.location = "userProfile.php";
            } else {

                // Payment completed. It can be a successful failure.
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                   
                    saveInvoice(orderId, id, mail, amount);

                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221085",    // Replace your Merchant ID
                    "return_url": "http://localhost/eGames/singleProductView.php",     // Important
                    "cancel_url":"http://localhost/eGames/singleProductView.php",     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": "Door bell wireles",
                    "amount":  amount,
                    "currency": obj["currency"],
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": "No.1, Galle Road",
                    "city": "Colombo",
                    "country": "Sri Lanka",
                    "delivery_address": "No. 46, Galle road, Kalutara South",
                    "delivery_city": "Kalutara",
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                document.getElementById('payhere-payment').onclick = function (e) {
                    payhere.startPayment(payment);
                }

            }
        }
    }

    r.open("GET", "buyNowProcess.php?id=" + id, true)
    r.send();

}
function saveInvoice(orderId, id, mail, amount,) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("i", id);
    f.append("m", mail);
    f.append("a", amount);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveInvoice.php", true);
    r.send(f);

}

function printInvoice() {
    var body = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = body;
}

function sendInvoice(id){
 
    var page = document.getElementById("page");
       
    

    var f = new FormData();
    f.append("page",page.innerHTML);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function(){
        if(r.readyState==4){
            var t = r.responseText;
            alert(t)
        }
    }
    r.open("POST","sendInvoiceEmail.php?id"+id,true);
    r.send(f);
}


function addToWatchlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "removed") {
                document.getElementById("heart" + id).style.className = "text-dark";
                window.location.reload();
            } else if (t == "added") {
                document.getElementById("heart" + id).style.className = "text-danger";
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "wacthlistProcess.php?id=" + id, true);
    r.send();
}
function addToCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("GET", "cartProcess.php?id=" + id, true);
    r.send();

}
function deleteFromCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Product removed from cart");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "removeFromCart.php?id=" + id, true);
    r.send();

}
function basicSearch(x) {

    var txt = document.getElementById("basic_search_txt");


    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "basicsearch.php", true);
    r.send(f);

}
function advancedSearch(x) {
    var txt = document.getElementById("t");
    var category = document.getElementById("c");
    var sort = document.getElementById("s");



    var f = new FormData();
    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("s", sort.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;
        }
    }

    r.open("POST", "advanceSearchProcess.php", true);
    r.send(f);
}
var av
function veryfication() {
    var email = document.getElementById("email");

    var f = new FormData();

    f.append("e", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                var adminVerificationModal = document.getElementById("verificationModal");
                av = new bootstrap.Modal(adminVerificationModal);
                av.show();
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "adminSigninProcess.php", true);
    r.send(f);
}
function verify() {
    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Sucess") {
                av.hide();
                window.location = "adminpanel.php"
            } else {
                alert(t)
            }
        }
    }
    r.open("GET", "adminVerificationProcess.php?v=" + verification.value, true)
    r.send()
}
function blockuser(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "blocked") {
                document.getElementById("ub" + email).innerHTML = "unblock";
                document.getElementById("ub" + email).classList = "btn btn-success";
                window.location.reload()
            } else if (t == "unblock") {
                document.getElementById("ub" + email).innerHTML = "block"
                document.getElementById("ub" + email).classList = "btn btn-danger"
                window.location.reload()
            }
            alert(t)
        }
    }

    r.open("GET", "userblockProcess.php?email=" + email, true);
    r.send()

}
function blockGames(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "blocked") {
                document.getElementById("ub" + email).innerHTML = "unblock";
                document.getElementById("ub" + email).classList = "btn btn-success";
                window.location.reload();
            } else if (t == "unblock") {
                document.getElementById("ub" + email).innerHTML = "block"
                document.getElementById("ub" + email).classList = "btn btn-danger"
                window.location.reload();
            }
            alert(t)
        }
    }

    r.open("GET", "blockGamesProcess.php?id=" + id, true);
    r.send()

}
function sellinghistory(x) {

    var txt = document.getElementById("selling_search_txt");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sellingHistorySearchResult").innerHTML = t;
        }
    }

    r.open("POST", "sellinghistorySearch.php", true);
    r.send(f);

}
function changeProductImage() {
    var image = document.getElementById("imageuploader");

    image.onchange = function () {

        var file_count = image.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;
            }

        } else {
            alert("Please select 3 or less than 3 images.");
        }

    }
}
function changeProductImage2() {
    var image = document.getElementById("imageuploader2");

    image.onchange = function () {

        var file_count = image.files.length;

        if (file_count <= 1) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("q" + x).src = url;
            }

        } else {
            alert("Please select 1 or less than 1 images.");
        }

    }
}

function addGame() {
    var category = document.getElementById("category");
    var title = document.getElementById("title");
    var price = document.getElementById("price");
    var refund = document.getElementById("refund");
    var developer = document.getElementById("developer");
    var publisher = document.getElementById("publisher");
    var description = document.getElementById("description");
    var releasedate = document.getElementById("rd");
    var mram = document.getElementById("mram");
    var mvga = document.getElementById("mvga");
    var mprocesser = document.getElementById("mprocesser");
    var mos = document.getElementById("mos");
    var mhdd = document.getElementById("mhdd");
    var ram = document.getElementById("ram");
    var vga = document.getElementById("vga");
    var processer = document.getElementById("processer");
    var os = document.getElementById("os");
    var hdd = document.getElementById("hdd");
    var image = document.getElementById("imageuploader");
    var video = document.getElementById("video");



    var f = new FormData();

    f.append("ca", category.value);
    f.append("title", title.value);
    f.append("price", price.value);
    f.append("refund", refund.value);
    f.append("developer", developer.value);
    f.append("publisher", publisher.value);
    f.append("description", description.value);
    f.append("rs", releasedate.value);
    f.append("mram", mram.value);
    f.append("mvga", mvga.value);
    f.append("mpr", mprocesser.value);
    f.append("mos", mos.value);
    f.append("mhdd", mhdd.value);
    f.append("ram", ram.value);
    f.append("vga", vga.value);
    f.append("pr", processer.value);
    f.append("os", os.value);
    f.append("hdd", hdd.value);
    f.append("video", video.value);
    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("image" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Product image saved successfully") {
                window.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "addGamesProcess.php", true);
    r.send(f);
}
function addScreenShot(id) {
    var image = document.getElementById("imageuploader");



    var f = new FormData();
    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("image" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText
            alert(t)
        }
    }
    r.open("POST", "addscreenshotProcess.php?id=" + id, true);
    r.send(f)
}

function search(x) {
    var txt = document.getElementById("t");
    var category = document.getElementById("c");

    var f = new FormData();
    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("page", x);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;
        }
    }

    r.open("POST", "updateSearch.php", true);
    r.send(f)
}
function updateGames(id) {
    var price = document.getElementById("price");
    var description = document.getElementById("description");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("price", price.value);
    f.append("description", description.value);


    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("image" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Product image saved successfully") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "updateGamesProcess.php?id=" + id, true);
    r.send(f);
}
function changeImage() {
    var view = document.getElementById("viewImg");//img tag
    var file = document.getElementById("profileimg");//file chooser

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }

}
function updateProfile() {
    var fname = document.getElementById("f");
    var lname = document.getElementById("l");
    var image = document.getElementById("profileimg");

    var f = new FormData();
    f.append("fn", fname.value);
    f.append("ln", lname.value);

    if (image.files.length == 0) {

        var confirmation = confirm("Are you sure You don't want to update Profile Image?");

        if (confirmation) {
            alert("you have not selected any image.");
        }

    } else {
        f.append("image", image.files[0]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
                alert("Sucess")
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);
}
function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {

                // window.location = "home.php";
                window.location.reload();

            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "signoutProcess.php", true);
    r.send();

}
function viewMessages(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("chat_box").innerHTML = t;
        }
    }

    r.open("GET", "viewMsgProcess.php?e=" + email, true);
    r.send();

}
function send_msg() {
    var email = document.getElementById("rmail");
    var txt = document.getElementById("msg_txt");

    var f = new FormData();
    f.append("e", email.innerHTML);
    f.append("t", txt.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "sendMsgProcess.php", true);
    r.send(f);
}
function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {


                window.location.reload();

            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "signout.php", true);
    r.send();

}
function adminSignout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {


                window.location = "adminSignIn.php";

            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "adminSignOut.php", true);
    r.send();

}
function manageGameSearch(x){
    var txt = document.getElementById("t");


    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("manage_game_result").innerHTML = t;
        }
    }
   r. open("POST","manageGamesSearch.php",true);
   r.send(f);
}
function manageUserSearch(x){
    var txt = document.getElementById("t");


    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("manage_user_result").innerHTML = t;
        }
    }
   r. open("POST","manageUserSearch.php",true);
   r.send(f);
}
function cartSearch(x){
    var txt = document.getElementById("t");


    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("cart_result").innerHTML = t;
        }
    }
   r. open("POST","cartSearch.php",true);
   r.send(f);
}
function wacthlistSearch(x){
    var txt = document.getElementById("t");


    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("wacthlist_result").innerHTML = t;
        }
    }
   r. open("POST","wacthlistSearch.php",true);
   r.send(f);
}
function purchesHistorySearch(x){
    var txt = document.getElementById("t");


    var f = new FormData();
    f.append("t", txt.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("purches_result").innerHTML = t;
        }
    }
   r. open("POST","purchesHistorySearch.php",true);
   r.send(f);
}

