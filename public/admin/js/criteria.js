
$(document).ready(function () {
    const inputs = document.querySelectorAll('input[type="number"]');
        const totalInput = document.querySelector('#total_percentage');
        const errorMessage = document.querySelector('#error-message');

        inputs.forEach(input => {
            input.addEventListener('input', () => {
                let total = 0;
                let error = false;
                inputs.forEach(input => {
                    const val = parseInt(input.value) || 0;
                    total += val;
                    if (val > parseInt(input.max)) {
                        error = true;
                        input.value = '';
                    }
                });
                if (total > 100) {
                    totalInput.value = '';
                    errorMessage.textContent = 'Error: Total cannot be greater than 100';
                } else if (error) {
                    totalInput.value = '';
                    errorMessage.textContent = 'Error: Value cannot be greater than the allowed maximum';
                } else {
                    totalInput.value = total;
                    errorMessage.textContent = '';
                }
            });
        });
    });
