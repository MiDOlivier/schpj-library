<div style="height: 100vh">
    <div class="flex-center flex-column">

        <form class="text-center border border-light p-5" method="POST">

            <p class="h4 mb-4">LP2 Project - Closed Library System</p>
            <br>
            <p class="h4 mb-4">Log In</p>
            <input type="text" id="user_name"  name="user_name" class="form-control mb-4">
            <input type="password" id="pass" name="pass"  class="form-control mb-4">

            <button class="btn btn-info btn-block my-4" type="submit">Submit</button>

            <br>

            <br>

            <p class=" mb-4">Developed by Miguel Lima Lopes de Oliveira, GU3015343</p>
            
            <p class="red-text"><?= $error ? 'Incorrect Credentials.' : '' ?></p>
        </form>

    </div>
</div>