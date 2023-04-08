

var i = 0;
//1st year
//fyfs
function addSub1(existingData) {
    var tableBody = document.getElementById("fyfs");
    var newRow = tableBody.insertRow(-1);
    ++i;

    var selectSub = `<select name="fy_fs[${i}][subjects1]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>
                       ${subOptions(existingData ? existingData.subjects1 : null)}
                     </select>
                     <input type="hidden" name="fy_fs[${i}][id]" value="">`;
    var inputUnits = `<input type="text" name="fy_fs[${i}][units1]" class="form-control text-center" onkeypress="validateInput(event)" onpaste="return false" required>`;
    if (existingData) {
      inputUnits = `<input type="text" name="fy_fs[${i}][units1]" class="form-control text-center" value="${existingData.units1}" onkeypress="validateInput(event)" onpaste="return false">`;
    }

    newRow.innerHTML = `
      <td>${selectSub}</td>
      <td>${inputUnits}</td>
      <td><button type="button" class="btn btn-danger" onclick="removeSub1(this)">Remove</button></td>
    `;
    initializeSelect2('.selectsub');

  }

function removeSub1(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

//fyss
function addSub2(existingData) {
    var tableBody = document.getElementById("fyss");
    var newRow = tableBody.insertRow(-1);
    ++i;

    var selectSub = `<select name="fy_ss[${i}][subjects2]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>
                       ${subOptions(existingData ? existingData.subjects2 : null)}
                     </select>
                     <input type="hidden" name="fy_ss[${i}][id]" value="">`;
    var inputUnits = `<input type="text" name="fy_ss[${i}][units2]" class="form-control text-center" onkeypress="validateInput(event)" onpaste="return false" required>`;
    if (existingData) {
      inputUnits = `<input type="text" name="fy_ss[${i}][units2]" class="form-control text-center" value="${existingData.units2}" onkeypress="validateInput(event)" onpaste="return false">`;
    }

    newRow.innerHTML = `
      <td>${selectSub}</td>
      <td>${inputUnits}</td>
      <td><button type="button" class="btn btn-danger" onclick="removeSub2(this)">Remove</button></td>
    `;
    initializeSelect2('.selectsub');

  }

function removeSub2(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

//2nd year
function addSub3(existingData) {
    var tableBody = document.getElementById("syfs");
    var newRow = tableBody.insertRow(-1);
    ++i;

    var selectSub = `<select name="sy_fs[${i}][subjects3]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>
                       ${subOptions(existingData ? existingData.subjects3 : null)}
                     </select>
                     <input type="hidden" name="sy_fs[${i}][id]" value="">`;
    var inputUnits = `<input type="text" name="sy_fs[${i}][units3]" class="form-control text-center" onkeypress="validateInput(event)" onpaste="return false" required>`;
    if (existingData) {
      inputUnits = `<input type="text" name="sy_fs[${i}][units3]" class="form-control text-center" value="${existingData.units3}" onkeypress="validateInput(event)" onpaste="return false">`;
    }

    newRow.innerHTML = `
      <td>${selectSub}</td>
      <td>${inputUnits}</td>
      <td><button type="button" class="btn btn-danger" onclick="removeSub3(this)">Remove</button></td>
    `;
    initializeSelect2('.selectsub');

  }

function removeSub3(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

//fyss
function addSub4(existingData) {
    var tableBody = document.getElementById("syss");
    var newRow = tableBody.insertRow(-1);
    ++i;

    var selectSub = `<select name="sy_ss[${i}][subjects4]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>
                       ${subOptions(existingData ? existingData.subjects4 : null)}
                     </select>
                     <input type="hidden" name="sy_ss[${i}][id]" value="">`;
    var inputUnits = `<input type="text" name="sy_ss[${i}][units4]" class="form-control text-center" onkeypress="validateInput(event)" onpaste="return false" required>`;
    if (existingData) {
      inputUnits = `<input type="text" name="sy_ss[${i}][units4]" class="form-control text-center" value="${existingData.units4}" onkeypress="validateInput(event)" onpaste="return false">`;
    }

    newRow.innerHTML = `
      <td>${selectSub}</td>
      <td>${inputUnits}</td>
      <td><button type="button" class="btn btn-danger" onclick="removeSub4(this)">Remove</button></td>
    `;
    initializeSelect2('.selectsub');

  }

function removeSub4(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

//3rd year
function addSub5(existingData) {
    var tableBody = document.getElementById("tyfs");
    var newRow = tableBody.insertRow(-1);
    ++i;

    var selectSub = `<select name="ty_fs[${i}][subjects5]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>
                       ${subOptions(existingData ? existingData.subjects5 : null)}
                     </select>
                     <input type="hidden" name="ty_fs[${i}][id]" value="">`;
    var inputUnits = `<input type="text" name="ty_fs[${i}][units5]" class="form-control text-center" onkeypress="validateInput(event)" onpaste="return false" required>`;
    if (existingData) {
      inputUnits = `<input type="text" name="ty_fs[${i}][units5]" class="form-control text-center" value="${existingData.units5}" onkeypress="validateInput(event)" onpaste="return false">`;
    }

    newRow.innerHTML = `
      <td>${selectSub}</td>
      <td>${inputUnits}</td>
      <td><button type="button" class="btn btn-danger" onclick="removeSub5(this)">Remove</button></td>
    `;
    initializeSelect2('.selectsub');

  }

function removeSub5(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

//tyss
function addSub6(existingData) {
    var tableBody = document.getElementById("tyss");
    var newRow = tableBody.insertRow(-1);
    ++i;

    var selectSub = `<select name="ty_ss[${i}][subjects6]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>
                       ${subOptions(existingData ? existingData.subjects6 : null)}
                     </select>
                     <input type="hidden" name="ty_ss[${i}][id]" value="">`;
    var inputUnits = `<input type="text" name="ty_ss[${i}][units6]" class="form-control text-center" onkeypress="validateInput(event)" onpaste="return false" required>`;
    if (existingData) {
      inputUnits = `<input type="text" name="ty_ss[${i}][units6]" class="form-control text-center" value="${existingData.units6}" onkeypress="validateInput(event)" onpaste="return false">`;
    }

    newRow.innerHTML = `
      <td>${selectSub}</td>
      <td>${inputUnits}</td>
      <td><button type="button" class="btn btn-danger" onclick="removeSub6(this)">Remove</button></td>
    `;
    initializeSelect2('.selectsub');

  }

function removeSub6(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

//4th year
function addSub7(existingData) {
    var tableBody = document.getElementById("foyfs");
    var newRow = tableBody.insertRow(-1);
    ++i;

    var selectSub = `<select name="foy_fs[${i}][subjects7]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>
                       ${subOptions(existingData ? existingData.subjects7 : null)}
                     </select>
                     <input type="hidden" name="foy_fs[${i}][id]" value="">`;
    var inputUnits = `<input type="text" name="foy_fs[${i}][units7]" class="form-control text-center" onkeypress="validateInput(event)" onpaste="return false" required>`;
    if (existingData) {
      inputUnits = `<input type="text" name="foy_fs[${i}][units7]" class="form-control text-center" value="${existingData.units7}" onkeypress="validateInput(event)" onpaste="return false">`;
    }

    newRow.innerHTML = `
      <td>${selectSub}</td>
      <td>${inputUnits}</td>
      <td><button type="button" class="btn btn-danger" onclick="removeSub7(this)">Remove</button></td>
    `;
    initializeSelect2('.selectsub');

  }

function removeSub7(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

//foyss
function addSub8(existingData) {
    var tableBody = document.getElementById("foyss");
    var newRow = tableBody.insertRow(-1);
    ++i;

    var selectSub = `<select name="foy_ss[${i}][subjects8]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>
                       ${subOptions(existingData ? existingData.subjects8 : null)}
                     </select>
                     <input type="hidden" name="foy_ss[${i}][id]" value="">`;
    var inputUnits = `<input type="text" name="foy_ss[${i}][units8]" class="form-control text-center" onkeypress="validateInput(event)" onpaste="return false" required>`;
    if (existingData) {
      inputUnits = `<input type="text" name="foy_ss[${i}][units8]" class="form-control text-center" value="${existingData.units8}" onkeypress="validateInput(event)" onpaste="return false">`;
    }

    newRow.innerHTML = `
      <td>${selectSub}</td>
      <td>${inputUnits}</td>
      <td><button type="button" class="btn btn-danger" onclick="removeSub8(this)">Remove</button></td>
    `;
    initializeSelect2('.selectsub');

  }

function removeSub8(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

//5th year
function addSub9(existingData) {
    var tableBody = document.getElementById("fiyfs");
    var newRow = tableBody.insertRow(-1);
    ++i;

    var selectSub = `<select name="fiy_fs[${i}][subjects9]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>
                       ${subOptions(existingData ? existingData.subjects9 : null)}
                     </select>
                     <input type="hidden" name="fiy_fs[${i}][id]" value="">`;
    var inputUnits = `<input type="text" name="fiy_fs[${i}][units9]" class="form-control text-center" onkeypress="validateInput(event)" onpaste="return false" required>`;
    if (existingData) {
      inputUnits = `<input type="text" name="fiy_fs[${i}][units9]" class="form-control text-center" value="${existingData.units9}" onkeypress="validateInput(event)" onpaste="return false">`;
    }

    newRow.innerHTML = `
      <td>${selectSub}</td>
      <td>${inputUnits}</td>
      <td><button type="button" class="btn btn-danger" onclick="removeSub9(this)">Remove</button></td>
    `;
    initializeSelect2('.selectsub');

  }

function removeSub9(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

//foyss
function addSub10(existingData) {
    var tableBody = document.getElementById("fiyss");
    var newRow = tableBody.insertRow(-1);
    ++i;

    var selectSub = `<select name="fiy_ss[${i}][subjects10]" data-placeholder="Select subject" data-allow-clear="1" class="selectsub" required>
                       ${subOptions(existingData ? existingData.subjects8 : null)}
                     </select>
                     <input type="hidden" name="fiy_ss[${i}][id]" value="">`;
    var inputUnits = `<input type="text" name="fiy_ss[${i}][units10]" class="form-control text-center" onkeypress="validateInput(event)" onpaste="return false" required>`;
    if (existingData) {
      inputUnits = `<input type="text" name="fiy_ss[${i}][units10]" class="form-control text-center" value="${existingData.units10}" onkeypress="validateInput(event)" onpaste="return false">`;
    }

    newRow.innerHTML = `
      <td>${selectSub}</td>
      <td>${inputUnits}</td>
      <td><button type="button" class="btn btn-danger" onclick="removeSub10(this)">Remove</button></td>
    `;
    initializeSelect2('.selectsub');

  }

function removeSub10(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
