<form action="search.php" class="searchform" method="POST">
    <div class="form-row">
        <input type="text" name="searchQuery" <?php keepSearchValue(); ?> placeholder="Search" required />
        <button type="submit" name="searchSent"><i class="fa fa-search"></i></button>
    </div>
</form>
