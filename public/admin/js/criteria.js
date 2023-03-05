const numInputs = document.querySelectorAll('input[type="number"]');
const totalInput = document.querySelector('#total');
const errorMessage = document.querySelector('#error-message');

numInputs.forEach(input => {
  input.addEventListener('input', () => {
    let total = 0;
    numInputs.forEach(input => {
      total += parseInt(input.value) || 0;
    });
    if (total > 100) {
      totalInput.value = '';
      errorMessage.textContent = 'Error: Total cannot be greater than 100';
    } else {
      totalInput.value = total;
      errorMessage.textContent = '';
    }
    if (input.value.length > 2 || parseInt(input.value) > parseInt(input.max)) {
      input.value = input.value.slice(0, -1);
    }
  });
});