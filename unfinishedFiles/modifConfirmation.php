<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Popup Modal Box</title>

    <link rel="stylesheet" href="modifConfirmation.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
  </head>
  <body>
    <section>
      <button class="show-modal">Envoyer</button>
      <span class="overlay"></span>

      <script>
setTimeout(function() {
 
    window.location.href = "../../models/expenseSheet/addExpenseSheet.php";
}, 5000); 
</script>

      <div class="modal-box">
        <i class="fa-regular fa-circle-check"></i>
        <h2>Completed</h2>
        <h3>Vos modifications ont été appliquées !</h3>

      </div>
    </section>
    <script>
      const section = document.querySelector("section"),
        overlay = document.querySelector(".overlay"),
        showBtn = document.querySelector(".show-modal"),
        closeBtn = document.querySelector(".close-btn");

      showBtn.addEventListener("click", () => section.classList.add("active"));

      overlay.addEventListener("click", () =>
        section.classList.remove("active")
      );

      closeBtn.addEventListener("click", () =>
        section.classList.remove("active")
      );
    </script>
    
  </body>
</html>