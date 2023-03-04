function confirmDelete(rowId) {
    var confirmed = confirm("Are you sure you want to delete this row?");
    if (confirmed) {
      var form = document.createElement("form");
      form.setAttribute("method", "post");
      form.setAttribute("action", "delete.php");
      
      var input = document.createElement("input");
      input.setAttribute("type", "hidden");
      input.setAttribute("name", "row_id");
      input.setAttribute("value", rowId);
      
      form.appendChild(input);
      document.body.appendChild(form);
      
      form.submit();
    }
  }