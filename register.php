<?php 
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
$success = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>GovConnect — Register</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
<style>
  body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #1f1c2c, #928dab);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px;
  }
  .container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 40px rgba(0,0,0,0.4);
    max-width: 1100px;
    width: 100%;
  }
  .form-box {
    padding: 40px;
    background: rgba(20,20,30,0.85);
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: #fff;
  }
  .form-box h2 { margin: 0 0 20px; font-size: 32px; text-align: center; }
  .row { margin-bottom: 15px; }
  label { font-size: 17px; display: block; margin-bottom: 4px; color: #ccc; }
  input, select {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: none;
    font-size: 19px;
    outline: none;
  }
  .btn {
    width: 100%;
    padding: 14px;
    border-radius: 12px;
    border: none;
    font-weight: bold;
    cursor: pointer;
    background: linear-gradient(90deg, #667eea, #764ba2);
    color: #fff;
    margin-top: 10px;
    transition: transform 0.2s;
  }
  .btn:hover { transform: scale(1.02); }
  .link { display:block; margin-top:14px; text-align:center; font-size:19px; color:#ddd; text-decoration:none; }
  .link:hover { text-decoration: underline; }

  /* Message styling */
  .message {
    padding:12px 14px;
    margin-bottom:15px;
    border-radius:8px;
    font-size:19px;
    display:flex;
    align-items:center;
    gap:10px;
    opacity: 1;
    transition: opacity 0.5s ease;
  }
  .error { background:#ffdddd; color:#900; border:1px solid #e0a0a0; }
  .success { background:#ddffdd; color:#060; border:1px solid #90c090; }
  .message i { font-size:21px; }

  .info-box {
    padding:40px;
    background:linear-gradient(135deg,#232526,#414345);
    color:#fff;
    display:flex;
    flex-direction:column;
    justify-content:center;
    text-align:center;
  }
  .info-box h1 { font-size:37px; margin-bottom:20px; }
  .switch-btn { margin-top:20px; padding:14px; border-radius:12px; border:none; background:linear-gradient(180deg,#f2c94c,#f2994a); font-weight:bold; cursor:pointer; }
  .switch-btn:hover { opacity:0.9; }
  .hidden { display:none; }
  @media(max-width:900px) { .container { grid-template-columns:1fr; } .info-box { display:none; } }
</style>
</head>
<body>

<div class="container">

  <!-- LEFT: Registration Forms -->
  <div class="form-box">
    <?php if($error): ?>
      <div class="message error"><i class="fa-solid fa-circle-exclamation"></i> <?= str_replace(['<b>','</b>'], '', $error) ?></div>
    <?php endif; ?>
    <?php if($success): ?>
      <div class="message success"><i class="fa-solid fa-circle-check"></i> <?= str_replace(['<b>','</b>'], '', $success) ?></div>
    <?php endif; ?>

    <!-- User Registration (default) -->
    <form id="userForm" method="post" action="/govconnect/register_process.php">
      <input type="hidden" name="role" value="user"/>
      <h2><i class="fa-solid fa-user"></i> User Registration</h2>
      <div class="row"><input type="text" name="name" placeholder="Full Name" required></div>
      <div class="row"><input type="email" name="email" placeholder="Email Address" required></div>
      <div class="row"><input type="text" name="phone" placeholder="Phone Number" required></div>
      <div class="row"><input type="text" name="nid" placeholder="National ID" required></div>
      <div class="row">
        <label>Date of Birth</label>
        <input type="date" name="dob" required>
      </div>
      <div class="row"><input type="text" name="location" placeholder="Permanent Address" required></div>
      <div class="row"><input type="password" name="password" placeholder="Password" required></div>
      <button type="submit" class="btn">Register</button>
      <a href="/govconnect/login.php" class="link">Already have an account? Login</a>
    </form>

    <!-- Response Team Registration -->
    <form id="responseForm" class="hidden" method="post" action="/govconnect/register_process.php">
      <input type="hidden" name="role" value="response"/>
      <h2><i class="fa-solid fa-truck-fast"></i> Response Team Registration</h2>
      <div class="row"><input type="text" name="name" placeholder="Team Name" required></div>
      <div class="row">
        <select name="category" required>
          <option value="">— Select Category —</option>
          <option value="police">Police</option>
          <option value="medical">Medical</option>
          <option value="fire">Fire</option>
          <option value="gov">Government</option>
        </select>
      </div>
      <div class="row"><input type="text" name="incharge_name" placeholder="Incharge Name" required></div>
      <div class="row"><input type="text" name="incharge_id" placeholder="Incharge ID" required></div>
      <div class="row"><input type="email" name="incharge_email" placeholder="Incharge Email" required></div>
      <div class="row"><input type="text" name="incharge_phone" placeholder="Incharge Phone" required></div>
      <div class="row"><input type="text" name="identification" placeholder="Station Code" required></div>
      <div class="row"><input type="text" name="location" placeholder="Location/Address" required></div>
      <div class="row"><input type="text" name="phone" placeholder="Official Team Phone" required></div>
      <div class="row"><input type="email" name="email" placeholder="Official Team Email" required></div>
      <div class="row"><input type="number" name="employee_number" placeholder="Number of Employees" required></div>
      <div class="row"><input type="password" name="password" placeholder="Password" required></div>
      <button type="submit" class="btn">Register</button>
      <a href="/govconnect/login.php" class="link">Already have an account? Login</a>
    </form>
  </div>

  <!-- RIGHT: Info + Switch -->
  <div class="info-box">
    <h1>Welcome to GovConnect</h1>
    <p>Report problems, track responses, and collaborate with public service teams — all in one place.</p>
    <p style="font-size:18px;opacity:0.9">
      Response Team accounts require admin approval. Your ID will be <strong>Pending</strong> until approved.
    </p>
    <button id="switchBtn" class="switch-btn">Register as Response Team</button>
  </div>

</div>

<script>
  const userForm = document.getElementById('userForm');
  const responseForm = document.getElementById('responseForm');
  const switchBtn = document.getElementById('switchBtn');
  let showingUser = true;

  switchBtn.addEventListener('click', () => {
    if(showingUser){
      userForm.classList.add('hidden');
      responseForm.classList.remove('hidden');
      switchBtn.innerText = "Register as User";
      showingUser = false;
    } else {
      responseForm.classList.add('hidden');
      userForm.classList.remove('hidden');
      switchBtn.innerText = "Register as Response Team";
      showingUser = true;
    }
  });

  // Auto-dismiss messages
  const messages = document.querySelectorAll('.message');
  messages.forEach(msg => {
    setTimeout(() => {
      msg.style.opacity = '0';
      setTimeout(() => msg.remove(), 500); // Remove from DOM after fade
    }, 4000); // 4 seconds delay
  });
</script>

</body>
</html>
