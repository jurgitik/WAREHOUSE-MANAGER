<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAREHOUSE MANAGER</title>
    <link rel="icon" href="assets/popcorn.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="./assets/gears-logo.png">
</head>

<body>
    <div class="container">
        %%%content%%%
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //danger messages dissapear after 4 sek
        document.addEventListener("DOMContentLoaded", function() {
            let alertElement = document.getElementById("alertMessage");
            if (alertElement) {
                setTimeout(function() {
                    alertElement.style.display = "none";
                }, 4000);
            }
        });

        // error input unset color red after correction

        // add an event listener to each input field
        $('input[type="text"]').on('input', function() {
            // remove the 'error' class when the user starts typing
            $(this).removeClass('error');
        });



        //edit-amount

        document.addEventListener("DOMContentLoaded", function() {
            const editable = document.querySelector(".editable");
            const editButton = document.querySelector(".edit_button");
            const displayValue = editable.previousElementSibling;

            if (editButton) {
                editButton.addEventListener("click", editAmount);
            }

            const saveButton = document.querySelector(".save-button");
            if (saveButton) {
                saveButton.addEventListener("click", saveAmount);
            }

            function editAmount() {
                editable.style.display = 'block';
                editable.previousElementSibling.style.display = 'none';
                editable.focus();
                editButton.style.display = "none";
                saveButton.style.display = "block";
            }


            function saveAmount(e) {
                // take value
                const amount = editable.value;

                fetch('?page=edit-amount&id=' + saveButton.dataset.id, {
                        body: new URLSearchParams({
                            amount,
                        }),
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        },
                        method: 'POST'
                    })
                    .then(resp => resp.text())
                    .then(resp => console.log(resp))
                    .catch(error => console.log(error));
                displayValue.textContent = amount;
                displayValue.style.display = 'block';
                editable.style.display = 'none';
                saveButton.style.display = "none";
                editButton.style.display = "block";
            }
        });
    </script>
</body>

</html>