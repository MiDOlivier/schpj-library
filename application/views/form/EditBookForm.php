<div class="container">

    <div class="row">

        <div class="col md-6 mx-auto mt-5">

            <form class="text-center border border-light p-5" method="POST">

                <p class="h4 mb-4">Edit Book</p>

                <input type="text" id="book_name" value="<?= $book_name?>" name="book_name" class="form-control mb-4" placeholder="Book Name...">

                <input type="text" id="book_desc" value="<?= $book_desc?>" name="book_desc" class="form-control mb-4" placeholder="Book Description...">

                <input type="text" id="book_cover" value="<?= $book_cover?>" name="book_cover" class="form-control mb-4" placeholder="Book Cover...">

                <button class="btn btn-info my-4 btn-block" type="submit">Send</button>

            </form>

        </div>

    </div>

</div>