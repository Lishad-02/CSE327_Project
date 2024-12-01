<div class="form-page">
    <div class="form-container">
        <h2>Add a New Book</h2>
        <form action="add_books.php" method="POST">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>

            <label for="author">Author</label>
            <input type="text" id="author" name="author" required>

            <label for="genre">Genre</label>
            <input type="text" id="genre" name="genre" required>

            <label for="description">Description</label>
            <textarea id="description" name="description"></textarea>

            <label for="publication_date">Publication Date</label>
            <input type="date" id="publication_date" name="publication_date" required>

            <button type="submit">Add Book</button>
        </form>
    </div>
</div>
