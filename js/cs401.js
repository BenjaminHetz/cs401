$(function() {
    $("form").submit(function(event) {
        var values = $("form").serialize();
        var title = $("#booktitle").val();
        var author = $("#bookauthor").val();
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: "addBook.php",
            data: values,
            success: function() {
                $('#books tbody').prepend("<tr><td>" + title.html() + "</td><td>" + author.html() + "</td></tr>");
                $('#booktitle').val('');
                $('#bookauthor').val('');
                
            },
            error: function () {
            }
        });
        return true;
    });
});
