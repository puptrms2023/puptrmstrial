
$(document).ready(function() {
      $('.datetimepicker-input').datetimepicker({
        format: 'YYYY-MM-DD',
        icons: {
          time: 'fas fa-clock',
          date: 'fas fa-calendar',
          up: 'fas fa-chevron-up',
          down: 'fas fa-chevron-down',
          previous: 'fas fa-chevron-left',
          next: 'fas fa-chevron-right',
          today: 'fas fa-calendar-day',
          clear: 'fas fa-trash-alt',
          close: 'fas fa-times'
        }
      });

  });


  function addRow(existingData) {
    var tableBody = document.getElementById("projects_initiated");
    var newRow = tableBody.insertRow(-1);

    // Populate input fields with existing data, if available
    if (existingData) {
        newRow.innerHTML = `
          <td><input type="text" name="projects[]" class="form-control form-control-sm" value="${existingData.project}"></td>
          <td><input type="text" name="sponsors[]" class="form-control form-control-sm" value="${existingData.sponsor}"></td>
          <td><input type="text" class="form-control form-control-sm datetimepicker-input" name="inclusive_date[]" data-toggle="datetimepicker" data-target="#datetimepicker1" value="${existingData.date}"></td>
          <td><input type="text" name="inclusive_level[]" class="form-control form-control-sm" value="${existingData.level}"></td>
          <td><input type="text" name="beneficiaries[]" class="form-control form-control-sm" value="${existingData.beneficiaries}"></td>
          <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></td>
        `;
    } else {
        newRow.innerHTML = `
          <td><input type="text" name="projects[]" class="form-control form-control-sm"></td>
          <td><input type="text" name="sponsors[]" class="form-control form-control-sm"></td>
          <td><input type="text" class="form-control form-control-sm datetimepicker-input" name="inclusive_date[]" data-toggle="datetimepicker" data-target="#datetimepicker1"></td>
          <td><input type="text" name="inclusive_level[]" class="form-control form-control-sm"></td>
          <td><input type="text" name="beneficiaries[]" class="form-control form-control-sm"></td>
          <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></td>
        `;
    }

    // Initialize datetimepicker for new row
    $(newRow).find('.datetimepicker-input').datetimepicker({
        format: 'YYYY-MM-DD',
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash-alt',
            close: 'fas fa-times'
        }
    });
}
function removeRow(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
// Assuming that existingData is an array of objects containing the existing data
existingData.forEach(function(data) {
    addRow(data);
});


function addRow1(existingData1) {
    var tableBody = document.getElementById("officership");
    var newRow = tableBody.insertRow(-1);

    if (existingData1) {
    newRow.innerHTML = `
      <td><input type="text" name="organization[]" class="form-control form-control-sm" value="${existingData1.organization}"></td>
      <td><input type="text" name="position_held[]" class="form-control form-control-sm" value="${existingData1.position_held}"></td>
      <td><input type="text" class="form-control form-control-sm datetimepicker-input" name="date_received[]" data-toggle="datetimepicker" data-target="#datetimepicker1" value="${existingData1.date_received}"></td>
      <td><input type="text" name="level[]" class="form-control form-control-sm" value="${existingData1.level}"></td>
      <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow1(this)">Remove</button></td>
    `;
    } else {
        newRow.innerHTML = `
        <td><input type="text" name="organization[]" class="form-control form-control-sm"></td>
        <td><input type="text" name="position_held[]" class="form-control form-control-sm"></td>
        <td><input type="text" class="form-control form-control-sm datetimepicker-input" name="date_received[]" data-toggle="datetimepicker" data-target="#datetimepicker1"></td>
        <td><input type="text" name="level[]" class="form-control form-control-sm"></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow1(this)">Remove</button></td>
      `;
    }
    // Initialize datetimepicker for new row
    $(newRow).find('.datetimepicker-input').datetimepicker({
        format: 'YYYY-MM-DD',
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash-alt',
            close: 'fas fa-times'
        }
    });
}

function removeRow1(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
existingData1.forEach(function(data) {
    addRow1(data);
});

function addRow2(existingData2) {
    var tableBody = document.getElementById("awards_received");
    var newRow = tableBody.insertRow(-1);

    if (existingData2) {
    newRow.innerHTML = `
      <td><input type="text" name="award[]" class="form-control form-control-sm" value="${existingData2.award}"></td>
      <td><input type="text" name="awarded_by[]" class="form-control form-control-sm" value="${existingData2.awarded_by}"></td>
      <td><input type="text" class="form-control form-control-sm datetimepicker-input" name="date_received_off[]" data-toggle="datetimepicker" data-target="#datetimepicker1" value="${existingData2.date_received_off}"></td>
      <td><input type="text" name="level_off[]" class="form-control form-control-sm" value="${existingData2.level_off}"></td>
      <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow2(this)">Remove</button></td>
    `;
} else {
    newRow.innerHTML = `
    <td><input type="text" name="award[]" class="form-control form-control-sm"></td>
    <td><input type="text" name="awarded_by[]" class="form-control form-control-sm"></td>
    <td><input type="text" class="form-control form-control-sm datetimepicker-input" name="date_received_off[]" data-toggle="datetimepicker" data-target="#datetimepicker1"></td>
    <td><input type="text" name="level_off[]" class="form-control form-control-sm"></td>
    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow2(this)">Remove</button></td>
  `;
}
    // Initialize datetimepicker for new row
    $(newRow).find('.datetimepicker-input').datetimepicker({
        format: 'YYYY-MM-DD',
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash-alt',
            close: 'fas fa-times'
        }
    });
}

function removeRow2(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

existingData2.forEach(function(data) {
    addRow1(data);
});

function addRow3(existingData3) {
    var tableBody = document.getElementById("community");
    var newRow = tableBody.insertRow(-1);

    if (existingData3) {
    newRow.innerHTML = `
      <td><input type="text" name="projects_com[]" class="form-control form-control-sm" value="${existingData3.projects_com}"></td>
      <td><input type="text" name="involvement[]" class="form-control form-control-sm" value="${existingData3.involvement}"></td>
      <td><input type="text" name="sponsored_by[]" class="form-control form-control-sm" value="${existingData3.sponsored_by}"></td>
      <td><input type="text" class="form-control form-control-sm datetimepicker-input" name="inclusive_date_com[]" data-toggle="datetimepicker" data-target="#datetimepicker1" value="${existingData3.inclusive_date_com}"></td>
      <td><input type="text" name="level_comm[]" class="form-control form-control-sm" value="${existingData3.level_comm}"></td>
      <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow3(this)">Remove</button></td>
    `;
} else {
    newRow.innerHTML = `
    <td><input type="text" name="projects_com[]" class="form-control form-control-sm"></td>
    <td><input type="text" name="involvement[]" class="form-control form-control-sm"></td>
    <td><input type="text" name="sponsored_by[]" class="form-control form-control-sm"></td>
    <td><input type="text" class="form-control form-control-sm datetimepicker-input" name="inclusive_date_com[]" data-toggle="datetimepicker" data-target="#datetimepicker1"></td>
    <td><input type="text" name="level_comm[]" class="form-control form-control-sm"></td>
    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow3(this)">Remove</button></td>
  `;
}
    // Initialize datetimepicker for new row
    $(newRow).find('.datetimepicker-input').datetimepicker({
        format: 'YYYY-MM-DD',
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash-alt',
            close: 'fas fa-times'
        }
    });
}

function removeRow3(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
existingData3.forEach(function(data) {
    addRow(data);
});
