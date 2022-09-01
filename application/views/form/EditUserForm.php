<div class="container">

    <div class="row">

        <div class="col md-6 mx-auto mt-5">

            <form class="text-center border border-light p-5" method="POST">

                <p class="h4 mb-4">Edit User</p>

                <input type="text" id="user_type" value="<?= $user_type?>" name="user_type" class="form-control mb-4" placeholder="">

                <input type="text" id="user_name" value="<?= $user_name?>" name="user_name" class="form-control mb-4" placeholder="">

                <input type="text" id="pass" value="<?= $pass?>" name="pass" class="form-control mb-4" placeholder="">

                <input type="number" id="balance" value="<?= $balance?>" name="balance" class="form-control mb-4">

                <button class="btn btn-info my-4 btn-block" type="submit">Send</button>

            </form>

        </div>

    </div>

</div>