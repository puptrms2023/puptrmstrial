$(document).ready(function() {
    // projects
    $(".add-row").click(function() {
      var html = '<tr>';
      html += '<td><input type="text" name="projects[]" class="form-control form-control-sm"></td>';
      html += '<td><input type="text" name="sponsors[]" class="form-control form-control-sm"></td>';
      html += '<td><input type="text" name="inclusive_date[]" class="form-control form-control-sm"></td>';
      html += '<td><input type="text" name="inclusive_level[]" class="form-control form-control-sm"></td>';
      html += '<td><input type="text" name="beneficiaries[]" class="form-control form-control-sm"></td>';
      html += '<td><button type="button" class="btn btn-danger remove-row"><i class="fas fa-minus"></i></button></td>';
      html += '</tr>';
      $("#projects_initiated tbody").append(html);
    });

    $(document).on("click", ".remove-row", function() {
      $(this).closest("tr").remove();
    });

    //offiership
    $(".add-row2").click(function() {
        var html = '<tr>';
        html += '<td><input type="text" name="organization[]" class="form-control form-control-sm"></td>';
        html += '<td><input type="text" name="position_held[]" class="form-control form-control-sm"></td>';
        html += '<td><input type="text" name="date_received[]" class="form-control form-control-sm"></td>';
        html += '<td><input type="text" name="level[]" class="form-control form-control-sm"></td>';
        html += '<td><button type="button" class="btn btn-danger remove-row2"><i class="fas fa-minus"></i></button></td>';
        html += '</tr>';
        $("#officership tbody").append(html);
      });

      $(document).on("click", ".remove-row2", function() {
        $(this).closest("tr").remove();
      });

      //awards
    $(".add-row3").click(function() {
        var html = '<tr>';
        html += '<td><input type="text" name="award[]" class="form-control form-control-sm"></td>';
        html += '<td><input type="text" name="awarded_by[]" class="form-control form-control-sm"></td>';
        html += '<td><input type="text" name="date_received[]" class="form-control form-control-sm"></td>';
        html += '<td><input type="text" name="level[]" class="form-control form-control-sm"></td>';
        html += '<td><button type="button" class="btn btn-danger remove-row3"><i class="fas fa-minus"></i></button></td>';
        html += '</tr>';
        $("#awards_received tbody").append(html);
      });

      $(document).on("click", ".remove-row3", function() {
        $(this).closest("tr").remove();
      });

      //community
    $(".add-row4").click(function() {
        var html = '<tr>';
        html += '<td><input type="text" name="projects_c[]" class="form-control form-control-sm"></td>';
        html += '<td><input type="text" name="involvement[]" class="form-control form-control-sm"></td>';
        html += '<td><input type="text" name="sponsored_by[]" class="form-control form-control-sm"></td>';
        html += '<td><input type="text" name="inclusive_dates[]" class="form-control form-control-sm"></td>';
        html += '<td><input type="text" name="level_c[]" class="form-control form-control-sm"></td>';
        html += '<td><button type="button" class="btn btn-danger remove-row4"><i class="fas fa-minus"></i></button></td>';
        html += '</tr>';
        $("#community tbody").append(html);
      });

      $(document).on("click", ".remove-row4", function() {
        $(this).closest("tr").remove();
      });

        //affiliation
    $(".add-row5").click(function() {
        var html = '<tr>';
        html += '<td><input type="text" name="affiliation[]" class="form-control form-control-sm"></td>';
        html += '<td><button type="button" class="btn btn-danger remove-row5"><i class="fas fa-minus"></i></button></td>';
        html += '</tr>';
        $("#affiliation tbody").append(html);
      });

      $(document).on("click", ".remove-row5", function() {
        $(this).closest("tr").remove();
      });

  });
