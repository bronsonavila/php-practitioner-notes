<?php require('partials/head.php'); ?>

  <h1>All Users</h1>

  <!-- Lists the names of all users upon page load: -->
  <ul>
  <?php foreach ($users as $user) : ?>
    <li><?= $user->name; ?></li>
  <?php endforeach; ?>
  </ul>

  <h2>Submit Your Name</h2>

  <!-- Form to submit POST request, trigger controller associated with
    the "/users" path, and fetch data specified by the controller: -->
  <form method="POST" action="/users">
    <input name="name">
    <button type="submit">Submit</button>
  </form>

<?php require('partials/footer.php'); ?>
